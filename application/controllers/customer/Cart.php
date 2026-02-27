<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('auth_model');
        $this->load->model('products_model');
        $this->load->model('cart_model');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'user') {

            $user_id = $this->session->userdata('user_id');
            $cart_items = $this->cart_model->get_cart_items($user_id);
            $subtotal = $this->cart_model->calculate_subtotal($user_id);

            $data = array(
                'cart' => $cart_items,
                'subtotal' => $subtotal
            );
            $this->load->view('layout/header');
            $this->load->view('customer/layout/sidebar');
            $this->load->view('customer/pages/cart', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('/auth/signin');
        }
    }

    public function add($product_id)
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'user') {

            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'product_id' => $product_id,
                'quantity' => 1, // Default quantity, you can modify this as needed
            );

            $this->cart_model->add_to_cart($data);
            redirect('customer/products');
        } else {
            redirect('/auth/signin');
        }
    }

    public function update_quantity($cart_id)
    {

        // 1. Check permissions
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'user') {

            // 2. Security: Ensure quantity is a number and at least 1

            $quantity = $this->input->get('quantity');
            if (!is_numeric($quantity) || (int)$quantity < 1) {
                $quantity = 1; // Default to 1 if invalid
            }

            $user_id = $this->session->userdata('user_id');

            // 3. Update the database
            $this->cart_model->update_cart_item($cart_id, $quantity, $user_id);

            // 4. Go back to the cart page
            redirect('customer/cart');
        } else {
            redirect('/auth/signin');
        }
    }

    public function remove($cart_id)
    {
        
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'user') {

            $this->cart_model->remove_from_cart($cart_id);
            redirect('customer/cart');
        } else {
            redirect('/auth/signin');
        }
    }
}
