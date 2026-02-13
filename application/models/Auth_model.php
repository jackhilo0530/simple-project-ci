<?php
    defined("BASEPATH") OR exit("No direct script access allowed");

    class Auth_model extends CI_Model {
        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function signup($username, $email, $password) {

            $data = array(
                'username' => $username,
                'email'=> $email,
                'password_hash'=> hash('sha256', $password),
                'created_at' => date('Y-m-d H:i:s'),
            );

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

            return $this->db->get()->row();
        }

        private function verify_password_hash($password, $hash) {
            return hash('sha256', $password) === $hash;
        }
    }
?>