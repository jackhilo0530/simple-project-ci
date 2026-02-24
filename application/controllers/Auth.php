<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('auth_model');
        $this->load->library('upload');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'admin') {

            $keyword = $this->input->get('search');
            $category = $this->input->get('role');

            $page = $this->input->get('page') ?: 1;

            if (!$keyword && !$category) {
                $result = $this->auth_model->get_all_users($page);
            } else {
                // Implement search/filter logic in the model if needed
                $result = $this->auth_model->search_users($keyword, $category, $page);
            }

            $data['users'] = $result['users'];
            $data['total'] = $result['total'];
            $data['current_page'] = $page;

            // --- PAGINATION SETTINGS ---
            $this->load->library('pagination');
            $config['base_url'] = site_url('auth');
            $config['total_rows'] = $result['total'];
            $config['per_page'] = 4;
            $config['page_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
            $config['use_page_numbers'] = TRUE;


            $config['reuse_query_string'] = TRUE;

            $this->pagination->initialize($config);
            $data['pagination_links'] = $this->pagination->create_links();


            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('pages/user/users', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('/auth/signin');
        }
    }
    public function signup()
    {

        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm password', 'trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('pages/user/signup');
            $this->load->view('layout/footer');
        } else {
            $upload_result = $this->do_upload('avatar');

            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password_hash' => hash('sha256', $this->input->post('password')),
                'role' => $this->input->post('role'),
                'created_at' => date('Y-m-d H:i:s')
            );

            if (isset($upload_result['file_name'])) {
                $data['img_path'] = $upload_result['file_name'];
            } else {
                $data['img_path'] = 'default.jpg'; // Optional fallback
            }

            if ($this->auth_model->signup($data)) {

                $this->load->view('layout/header');
                $this->load->view('pages/user/signin');
                $this->load->view('layout/footer');
            } else {
                $this->load->view('layout/header');
                $this->load->view('pages/user/signup');
                $this->load->view('layout/footer');
            }
        }
    }

    public function signin()
    {

        $data = new stdClass();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('pages/user/signin');
            $this->load->view('layout/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->auth_model->resolve_user_signin($username, $password)) {
                $user_id = $this->auth_model->get_user_id_from_username($username);
                $user = $this->auth_model->get_user($user_id);

                $_SESSION['user_id'] = (int)$user['id'];

                
                $_SESSION['username'] = (string)$user['username'];
                $_SESSION['logged_in'] = (bool)true;
                $_SESSION['role'] = (string)$user['role'];

                redirect('/dashboard');
            } else {
                $data->error = 'Wrong username or password.';
                $this->load->view('layout/header');
                $this->load->view('pages/user/signin', $data);
                $this->load->view('layout/footer');
            }
        }
    }

    public function do_upload($field_name)
    {

        $config['upload_path'] = './uploads/avatars/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field_name)) {
            return array('error' => $this->upload->display_errors());
        } else {
            return $this->upload->data();
        }
    }

    public function get_user_details($id)
    {
        $data['user'] = $this->auth_model->get_user($id);

        if ($data['user']) {
            $this->load->view('pages/user/detail_modal', $data);
        } else {
            echo '<div class="p-6 text-center text-red-500 font-semibold">User not found.</div>';
        }
    }

    public function edit_user($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->auth_model->get_user($id);

            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('pages/user/edit_user', $data);
            $this->load->view('layout/footer');
            return;
        } else {

            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role'),
                'updated_at' => date('Y-m-d H:i:s')
            );

             if (!empty($_FILES['avatar']['name'])) {
                $upload_result = $this->do_upload('avatar');

                if (isset($upload_result['file_name'])) {
                    $data['img_path'] = $upload_result['file_name'];
                }
            }

            $this->auth_model->update_user($id, $data);
            redirect('users');
        }
    }

    public function logout()
    {

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
        }

        redirect('/');
    }

    public function delete_user($id)
    {
        $this->auth_model->delete_user($id);
        redirect('users');
    }
}
