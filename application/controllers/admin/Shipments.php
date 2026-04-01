<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Shipments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shipments_model');
        $this->load->model('orders_model');
    }

    public function index()
    {
        $keyword = $this->input->get('search');
        $category = $this->input->get('category');

        $data['shipments'] = $this->shipments_model->get_all_shipments(array('keyword'=> $keyword,'category'=> $category));

        $this->load->view('layout/header');
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/pages/shipments/shipments', $data);
        $this->load->view('layout/footer');
    }

    public function edit_carrier( $id )
    {
        $shipment = $this->shipments_model->get_shipment_by_id( $id );

        if ( $shipment ) {

            switch ( $shipment->carrier ) {
                case 'FedEx':
                    $new_carrier = 'DHL';
                    break;
                case 'DHL':
                    $new_carrier = 'UPS';
                    break;
                case 'UPS':
                    $new_carrier = 'USPS';
                    break;
                default:
                    $new_carrier = 'FedEx';
            }

            $this->shipments_model->update_shipment_carrier( $id, $new_carrier );
        }

        redirect( 'admin/shipments' );
    }

    public function edit_status( $id )
    {
        $shipment = $this->shipments_model->get_shipment_by_id( $id );

        if ( $shipment ) {

            switch ( $shipment->status ) {
                case 'pending':
                    $new_status = 'shipped';
                    break;
                case 'shipped':
                    $new_status = 'delivered';
                    $this->orders_model->update_order_status_by_shipment( $shipment->order_id);
                    break;
                default:
                    $new_status = $shipment->status;
            }


            $this->shipments_model->update_shipment_status( $id, $new_status );
        }

        redirect( 'admin/shipments' );
    }
}
?>