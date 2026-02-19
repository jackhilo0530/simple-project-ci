<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_products()
    {
        $query = $this->db->get('products');

        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('products', array('id' => $id));

        return $query->row_array();
    }

    public function insert_product($data)
    {
        return $this->db->insert('products', $data);
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }
}
?>