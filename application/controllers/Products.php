<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->helper('url_helper');
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
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('pages/add_product');
            $this->load->view('footer');
            return;
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'sku' => $this->input->post('sku'),
                'price' => $this->input->post('price'),
                'image_path' => $this->input->post('image_path'),
                'category_id' => $this->input->post('category_id'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $this->products_model->insert_product($data);
            redirect('products');
        }
    }

    public function edit_product()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $id = $this->input->post('id');

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
                'image_path' => $this->input->post('image_path'),
                'category_id' => $this->input->post('category_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->products_model->update_product($id, $data);
            redirect('products');
        }
    }

    public function delete($id)
    {
        $this->products_model->delete_product($id);
        redirect('products');
    }
}
?>