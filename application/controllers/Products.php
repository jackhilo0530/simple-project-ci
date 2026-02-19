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
        $data['products'] = $this->products_model->get_all_products();

        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('pages/products', $data);
        $this->load->view('footer');
    }

    public function add_product()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required|unique[products.sku]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('pages/add_product');
            $this->load->view('footer');
        } else {

            $upload_result = $this->do_upload('image_path');

            // 2. Prepare data for DB
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'sku' => $this->input->post('sku'),
                'price' => $this->input->post('price'),
                'category' => $this->input->post('category'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            // 3. If upload was successful, save the FILENAME, not the POST data
            if (isset($upload_result['file_name'])) {
                $data['image_path'] = $upload_result['file_name'];
            } else {
                $data['image_path'] = 'default.jpg'; // Optional fallback
            }

            $this->products_model->insert_product($data);
            redirect('products');
        }
    }

    public function edit_product($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['product'] = $this->products_model->get_by_id($id);

            $this->load->view('header');
            $this->load->view('pages/edit_product', $data);
            $this->load->view('footer');
            return;
        } else {

            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'sku' => $this->input->post('sku'),
                'price' => $this->input->post('price'),
                'category' => $this->input->post('category'),
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
            redirect('products');
        }
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
        redirect('products');
    }
}
