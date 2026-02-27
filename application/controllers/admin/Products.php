<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/signin');
        }

        $this->load->model('products_model');
        $this->load->helper('url_helper');
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

    public function index()
    {
        // FIX: Change 'post' to 'get' so values stay in the URL
        $keyword = $this->input->get('search');
        $category_id = $this->input->get('category_id');
        $page = $this->input->get('page') ?: 1;

        // Fetch data from Model
        if (!$keyword && !$category_id) {
            $result = $this->products_model->get_all_products($page);
        } else {
            $result = $this->products_model->search_products($keyword, $category_id, $page);
        }

        $data['products'] = $result['products'];
        $data['total_products'] = $result['total'];
        $data['current_page'] = $page;

        // --- PAGINATION SETTINGS ---
        $this->load->library('pagination');
        $config['base_url'] = site_url('products');
        $config['total_rows'] = $result['total'];
        $config['per_page'] = 4;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['use_page_numbers'] = TRUE;

        // CRITICAL: This automatically appends ?search=...&category_id=... to your pagination links
        $config['reuse_query_string'] = TRUE;

        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('layout/header');
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/pages/products/products', $data);
        $this->load->view('layout/footer');
    }

    public function add_product()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('complete_at_price', 'Complete At Price', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required|is_unique[products.sku]');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('stock_quantity', 'Stock Quantity', 'trim|required|integer');
        if ($this->form_validation->run() == FALSE) {

            $data['categories'] = $this->products_model->get_categories();

            $this->load->view('layout/header');
            $this->load->view('admin/pages/products/add_product', $data);
            $this->load->view('layout/footer');
        } else {

            $upload_result = $this->do_upload('image_path');

            // 2. Prepare data for DB
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'sku' => $this->input->post('sku'),
                'price' => $this->input->post('price'),
                'stock_quantity' => $this->input->post('stock_quantity'),
                'status' => 'inactive',
                'category_id' => $this->input->post('category_id'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            if($this->input->post('complete_at_price') > 0) {
                $data['complete_at_price'] = $this->input->post('complete_at_price');
            }

            // 3. If upload was successful, save the FILENAME, not the POST data
            if (isset($upload_result['file_name'])) {
                $data['image_path'] = $upload_result['file_name'];
            } else {
                $data['image_path'] = 'default.jpg'; // Optional fallback
            }

            $this->products_model->insert_product($data);
            redirect('admin/products');
        }
    }

    public function edit_product($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('complete_at_price', 'Complete At Price', 'trim|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('stock_quantity', 'Stock Quantity', 'trim|required|integer');

        if ($this->form_validation->run() == FALSE) {
            $data['product'] = $this->products_model->get_by_id($id);

            $this->load->view('layout/header');
            $this->load->view('admin/pages/products/edit_product', $data);
            $this->load->view('layout/footer');
            return;
        } else {

            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'sku' => $this->input->post('sku'),
                'complete_at_price' => $this->input->post('complete_at_price'),
                'stock_quantity' => $this->input->post('stock_quantity'),
                'category_id' => $this->input->post('category_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            if (!empty($_FILES['image_path']['name'])) {
                $upload_result = $this->do_upload('image_path');

                if (isset($upload_result['file_name'])) {
                    $data['image_path'] = $upload_result['file_name'];
                } else {
                    $data['image_path'] = 'default.jpg'; // Optional fallback
                }
            }

            $this->products_model->update_product($id, $data);
            redirect('admin/products');
        }
    }

    public function detail_product($id)
    {
        $data['product'] = $this->products_model->get_by_id($id);

        if($data['product']) {
            $this->load->view('layout/header');
            $this->load->view('admin/pages/products/detail_product', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('admin/products');
        }
    }

    public function toggle_status($id)
    {
        $product = $this->products_model->get_by_id($id);
        if ($product) {
            $new_status = ($product['status'] === 'active') ? 'inactive' : 'active';
            $this->products_model->update_product($id, array('status' => $new_status));
        }
        redirect('admin/products');
    }

    public function toggle_draft($id)
    {
        $product = $this->products_model->get_by_id($id);
        if ($product) {

            if($product['is_draft']) {
                $this->products_model->update_product($id, array('status' => 'inactive'));
                $this->products_model->update_product($id, array('is_draft' => FALSE));
            } else {
                $this->products_model->update_product($id, array('is_draft' => TRUE));
            }
        }
        redirect('admin/products');
    }

    public function do_upload($field_name)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE; // Highly recommended

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            return array('error' => $this->upload->display_errors());
        } else {
            return $this->upload->data(); // Returns array containing 'file_name'
        }
    }

    public function delete($id)
    {
        $this->products_model->delete_product($id);
        redirect('admin/products');
    }
}
