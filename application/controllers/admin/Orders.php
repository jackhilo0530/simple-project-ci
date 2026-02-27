<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('orders_model');
        $this->load->model('shipments_model');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') == true || $this->session->userdata('role') == 'admin') {
            $data['all_orders'] = $this->orders_model->get_all_orders();

            $this->load->view('layout/header');
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/pages/orders/orders', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('auth/signin');
        }
    }

    public function edit_status($id)
    {
        $order = $this->orders_model->get_order_by_id($id);

        if ($order) {
            $current_status = $order->status;
            $new_status = '';

            switch ($current_status) {
                case 'pending':
                    $new_status = 'processing';
                    $this->shipments_model->insert_shipment($id);
                    break;
                case 'processing':
                    $new_status = 'cancelled';
                    $this->shipments_model->delete_shipment_by_order($id);
                    break;
                case 'cancelled':
                    $new_status = 'processing';
                    $this->shipments_model->insert_shipment($id);
                    break;
                default:
                    $new_status = $current_status;
            }

            $this->orders_model->update_order_status($id, $new_status);
            redirect('admin/orders');
        } else {
            redirect('admin/orders');
        }
    }

    public function delete($id)
    {
        $this->orders_model->delete_order($id);
        redirect('admin/orders');
    }
}
