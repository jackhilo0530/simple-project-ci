<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_admin extends CI_Controller
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
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/pages/user/users', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('/auth/signin');
        }
    }

    public function get_user_details($id)
    {
        $data['user'] = $this->auth_model->get_user($id);

        if ($data['user']) {
            $this->load->view('admin/pages/user/detail_modal', $data);
        } else {
            echo '<div class="p-6 text-center font-semibold text-red-500">User not found.</div>';
        }
    }

    public function edit_user($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        }


        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->auth_model->get_user($id);

            $this->load->view('layout/header');
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/pages/user/edit_user', $data);
            $this->load->view('layout/footer');
            return;
        } else {

            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->input->post('password')) {
                $data['password_hash'] = hash('sha256', $this->input->post('password'));
            }

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

    public function toggle_status($id)
    {
        $user = $this->auth_model->get_user($id);
        if ($user) {
            $new_status = ($user['status'] === 'active') ? 'inactive' : 'active';
            $this->auth_model->update_user($id, array('status' => $new_status));
        }
        redirect('users');
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
}
