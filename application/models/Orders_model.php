<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_all_orders()
    {
        $this->db->select('orders.*, users.username as user, users.img_path as user_image, users.email as user_email');
        $this->db->from('orders');
        $this->db->join('users', 'users.id = orders.user_id');
        $this->db->order_by('orders.created_at', 'DESC');
        $orders = $this->db->get()->result_array();

        // Loop through orders and attach their specific items
        foreach ($orders as &$order) {
            $this->db->select('order_items.*, products.*');
            $this->db->from('order_items');
            $this->db->join('products', 'products.id = order_items.product_id');
            $this->db->where('order_items.order_id', $order['id']);
            $order['items'] = $this->db->get()->result();
        }
        
        return $orders;
    }
    

    public function get_orders_by_user($user_id)
    {
        // 1. Get the orders
        $this->db->where('user_id', $user_id);
        $orders = $this->db->get('orders')->result();

        // 2. Loop through orders and attach their specific items
        foreach ($orders as $order) {
            $this->db->select('order_items.*, products.*');
            $this->db->from('order_items');
            $this->db->join('products', 'products.id = order_items.product_id');
            $this->db->where('order_items.order_id', $order->id);
            $order->items = $this->db->get()->result();
        }

        return $orders;
    }

    public function get_order_by_id($id)
    {
        // 1. Get the order
        $this->db->where('id', $id);
        $order = $this->db->get('orders')->row();

        if ($order) {
            // 2. Get the items for this order
            $this->db->select('order_items.*, products.*');
            $this->db->from('order_items');
            $this->db->join('products', 'products.id = order_items.product_id');
            $this->db->where('order_items.order_id', $order->id);
            $order->items = $this->db->get()->result();
        }

        return $order;
    }


    public function insert_order_from_cart($user_id)
    {
        // 1. Get cart items for the user
        $cart_items = $this->db->get_where('cart', array('user_id' => $user_id))->result_array();

        if (empty($cart_items)) {
            return false; // No items in cart, cannot create order
        }

        // 2. Calculate total price
        $total_price = 0;
        foreach ($cart_items as $item) {
            $product = $this->db->get_where('products', array('id' => $item['product_id']))->row_array();
            $total_price += $product['complete_at_price'] * $item['quantity'];
        }

        // 3. Insert order into 'orders' table
        $order_data = array(
            'user_id' => $user_id,
            'total_price' => $total_price,
            'status' => 'processing',
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('orders', $order_data);

        // 4. Insert order items into 'order_items' table
        $order_id = $this->db->insert_id();
        foreach ($cart_items as $item) {
            $product = $this->db->get_where('products', array('id' => $item['product_id']))->row_array();
            $order_item_data = array(
                'order_id' => $order_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $product['complete_at_price'],
            );
            $this->db->update('products', array(
                'stock_quantity' => $product['stock_quantity'] - $item['quantity']
            ), array('id' => $item['product_id']));
            $this->db->insert('order_items', $order_item_data);
        }

        // 5. Clear the user's cart
        $this->db->delete('cart', array('user_id' => $user_id));
    }

    public function update_order_status($order_id, $new_status)
    {
        $this->db->where('id', $order_id);
        return $this->db->update('orders', array('status' => $new_status));
    }

    public function update_order_status_by_shipment($order_id)
    {
        $this->db->where('id', $order_id);
        $order = $this->db->get('orders')->row();

        if (!$order) {
            return false; // Order not found
        }

        $new_status = ($order->status === 'processing') ? 'completed' : 'processing';
        return $this->update_order_status($order_id, $new_status);
    }

    public function delete_order($id)
    {
        // Deleting the order will automatically delete related order items due to ON DELETE CASCADE
        $this->db->where('id', $id);
        return $this->db->delete('orders');
    }
}
