<?php
    defined("BASEPATH") OR exit("No direct script access allowed");

    class Auth_model extends CI_Model {
        public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library("upload");
        }

        public function get_all_users($page = 1, $limit = 4) {
            $offset = ($page - 1) * $limit;

            $total = $this->db->count_all('users');
            $this->db->limit($limit, $offset);
            $query = $this->db->get('users');
            return array(
                'users' => $query->result_array(),
                'total' => $total
            );
        }

        public function search_users($keyword, $role, $page = 1, $limit = 4) {
            $offset = ($page - 1) * $limit;

            if (!empty($keyword)) {
                $this->db->group_start();
                $this->db->like('username', $keyword);
                $this->db->or_like('email', $keyword);
                $this->db->group_end();
            }

            if (!empty($role)) {
                $this->db->where('role', $role);
            }

            $total = $this->db->count_all_results('users', FALSE);
            $this->db->limit($limit, $offset);

            return array(
                'users' => $this->db->get()->result_array(),
                'total' => $total
            );
        }

        public function signup($data) {

            return $this->db->insert('users', $data);
        }

        public function resolve_user_signin($username, $password) {
            $this->db->select('password_hash');
            $this->db->from('users');
            $this->db->where('username', $username);
            $hash = $this->db->get()->row('password_hash');

            return $this->verify_password_hash($password, $hash);
        }

        public function get_user_id_from_username($username) {
            $this->db->select('id');
            $this->db->from('users');
            $this->db->where('username', $username);

            return $this->db->get()->row('id');
        }

        public function get_user($user_id) {
            $this->db->from('users');
            $this->db->where('id', $user_id);

            return $this->db->get()->row_array();
        }

        private function verify_password_hash($password, $hash) {
            return hash('sha256', $password) === $hash;
        }

        public function update_user($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }

        public function delete_user($id) {
            $this->db->where('id', $id);
            return $this->db->delete('users');
        }
    }
?>