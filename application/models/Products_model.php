<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_products()
    {
        $this->db->select('products.*, category.name as category_name');
        $this->db->from('products');

        $this->db->join('category', 'products.category_id = category.id', 'left');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('products', array('id' => $id));

        return $query->row_array();
    }

    public function search_products($keyword)
    {
        $this->db->select('products.*, category.name as category_name');
        $this->db->from('products');
        $this->db->join('category', 'products.category_id = category.id', 'left');

        // Grouping the search terms together
        $this->db->group_start();
        $this->db->like('products.name', $keyword);
        $this->db->or_like('products.sku', $keyword);
        $this->db->or_like('category.name', $keyword); // Bonus: Search by category name too!
        $this->db->group_end();

        // Now any future filters (like status) will work correctly
        // $this->db->where('products.status', 1); 

        $query = $this->db->get();
        return $query->result_array();
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
