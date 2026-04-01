<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'admin') {
            $this->load->view('layout/header');
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/pages/dashboard');
            $this->load->view('layout/footer');
        } else {
            redirect('/auth/signin');
        }
    }
}
?>