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
        $this->load->view('customer/layout/sidebar');
        $this->load->view('customer/pages/products/products', $data);
        $this->load->view('layout/footer');
    }

    public function detail_product($id)
    {
        $product = $this->products_model->get_by_id($id);
        if (!$product) {
            show_404();
            return;
        }

        $data['product'] = $product;

        $this->load->view('layout/header');
        $this->load->view('customer/layout/sidebar');
        $this->load->view('customer/pages/products/product_detail', $data);
        $this->load->view('layout/footer');
    }
}
