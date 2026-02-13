<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Auth extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->library(array('session'));
            $this->load->helper(array('url'));
            $this->load->model('auth_model');
        }
        public function signup(){

            $this->load->helper('form', 'url');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|is_unique[users.username]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Confirm password', 'trim|required|min_length[6]|matches[password]');

            if($this->form_validation->run() == FALSE){
                $this->load->view('header');
                $this->load->view('user/signup');
                $this->load->view('footer');
            } else {
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                if($this->auth_model->signup($username, $email, $password)) {
                    
                    $this->load->view('header');
                    $this->load->view('user/signin');
                    $this->load->view('footer');
                } else {
                    $this->load->view('header');
                    $this->load->view('user/signup');
                    $this->load->view('footer');
                }

            }
        }

        public function signin() {

            $data = new stdClass();

            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if($this->form_validation->run() == FALSE) {
                $this->load->view('header');
                $this->load->view('user/signin');
                $this->load->view('footer');
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                if($this->auth_model->resolve_user_signin($username, $password)) {
                    $user_id = $this->auth_model->get_user_id_from_username($username);
                    $user = $this->auth_model->get_user($user_id);

                    $_SESSION['user_id'] = (int)$user->id;
                    $_SESSION['username'] = (string)$user->username;
                    $_SESSION['logged_in'] = (bool)true;
    
                    redirect('/dashboard');
                } else {
                    $data->error = 'Wrong username or password.';
                    $this->load->view('header');
                    $this->load->view('user/signin', $data);
                    $this->load->view('footer');
                }
                
            }
        }

        public function logout() {

            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                foreach($_SESSION as $key => $value) {
                    unset($_SESSION[$key]);
                }

                redirect('/');
            }
        }
    }
?>