<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_to_cart($data)
    {
        $user_id = $data['user_id'];
        $product_id = $data['product_id'];
        $quantity = $data['quantity'];

        // Check if the product is already in the cart
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('cart');

        if ($query->num_rows() > 0) {
            // If it exists, update the quantity
            $cart_item = $query->row();
            $new_quantity = $cart_item->quantity + $quantity;
            $this->db->where('id', $cart_item->id);
            return $this->db->update('cart', array('quantity' => $new_quantity, 'updated_at' => date('Y-m-d H:i:s')));
        } else {
            // If it doesn't exist, insert a new record
            return $this->db->insert('cart', array(
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'created_at' => date('Y-m-d H:i:s'),
            ));
        }
    }

    public function get_cart_items($user_id)
    {
        $this->db->select('cart.*, products.name as product_name, products.complete_at_price as product_price, products.image_path as image_path');
        $this->db->from('cart');
        $this->db->join('products', 'cart.product_id = products.id');
        $this->db->where('cart.user_id', $user_id);
        return $this->db->get()->result();
    }

    public function calculate_subtotal($user_id)
    {
        $this->db->select('SUM(cart.quantity * products.complete_at_price) as subtotal');
        $this->db->from('cart');
        $this->db->join('products', 'cart.product_id = products.id');
        $this->db->where('cart.user_id', (int)$user_id); // Cast to int for security

        $query = $this->db->get();
        $result = $query->row();

        // Check if the result exists and is not null
        if ($result && $result->subtotal) {
            return (float) $result->subtotal;
        }

        return 0.00;
    }

    public function update_cart_item($cart_id, $quantity, $user_id)
    {
        $data = array(
            'quantity'   => (int)$quantity, // Ensure it's a number
            'updated_at' => date('Y-m-d H:i:s')
        );

        // Only update if the ID matches AND it belongs to the logged-in user
        $this->db->where('id', $cart_id);
        $this->db->where('user_id', $user_id);

        return $this->db->update('cart', $data);
    }
    public function remove_from_cart($cart_item_id)
    {
        $this->db->where('id', $cart_item_id);
        return $this->db->delete('cart');
    }

    public function clear_cart($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->delete('cart');
    }
}
