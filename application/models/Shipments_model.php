<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shipments_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_shipments()
    {
        $query = $this->db->get('shipments');
        
        return $query->result_array();
    }

    public function get_shipment_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('shipments');
        
        return $query->row();
    }

    public function insert_shipment($order_id)
    {
        $data = array(
            'order_id' => $order_id,
            'tracking_number' => 'TRK' . str_pad($order_id, 8, '0', STR_PAD_LEFT),
            'shipped_at' => date('Y-m-d H:i:s', strtotime('+1 day')), // Simulate shipment 1 day after order
            'created_at' => date('Y-m-d H:i:s'),
        );

        if($this->db->get_where('shipments', array('order_id' => $order_id))->num_rows() > 0) {
            return false; // Shipment already exists for this order
        }
        return $this->db->insert('shipments', $data);
    }

    public function update_shipment_carrier($id, $new_carrier)
    {
        $this->db->where('id', $id);
        return $this->db->update('shipments', array('carrier' => $new_carrier));
    }

    public function update_shipment_status($id, $new_status)
    {
        $this->db->where('id', $id);
        return $this->db->update('shipments', array('status' => $new_status));
    }

    public function delete_shipment_by_order($order_id)
    {
        $this->db->where('order_id', $order_id);
        return $this->db->delete('shipments');
    }
}
