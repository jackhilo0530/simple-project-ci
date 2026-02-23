<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_products($page = 1, $limit = 4)
    {
        $offset = ($page - 1) * $limit;
        $this->db->select('products.*, category.name as category_name');
        $this->db->from('products');

        $this->db->join('category', 'products.category_id = category.id', 'left');

        $total = $this->db->count_all_results('', FALSE);

        $this->db->limit($limit, $offset);

        $query = $this->db->get();

        return array(
            'products' => $query->result_array(),
            'total' => $total
        );
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('products', array('id' => $id));

        return $query->row_array();
    }

    public function search_products($keyword, $category_id, $page = 1, $limit = 4)  
    {
        $offset = ($page - 1) * $limit;

        $this->db->select('products.*, category.name as category_name');
        $this->db->from('products');
        $this->db->join('category', 'products.category_id = category.id', 'left');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('products.name', $keyword);
            $this->db->or_like('products.sku', $keyword);
            $this->db->group_end();
        }

        if (!empty($category_id)) {
            $this->db->where('products.category_id', $category_id);
        }

        $total = $this->db->count_all_results('', FALSE);
        $this->db->limit($limit, $offset);

        $query = $this->db->get();

        return array(
            'products' => $query->result_array(),
            'total' => $total
        );
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
