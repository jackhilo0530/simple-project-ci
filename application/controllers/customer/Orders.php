<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('orders_model'));
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'user') {

            $user_id = $this->session->userdata('user_id');

            $result = $this->orders_model->get_orders_by_user($user_id);

            $data['orders'] = $result;

            $this->load->view('layout/header');
            $this->load->view('customer/layout/sidebar');
            $this->load->view('customer/pages/orders/orders', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('/auth/signin');
        }
    }

    public function insert_order()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'user') {

            $user_id = $this->session->userdata('user_id');

            $result = $this->orders_model->insert_order_from_cart($user_id);

            redirect('customer/cart');
        } else {
            redirect('/auth/signin');
        }
    }
}
?>