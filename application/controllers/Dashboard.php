<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');

        if(!$this->session->userdata('logged_in')){
            redirect('auth/signin');
        }
    }
    public function index()
    {

        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("dashboard");
        $this->load->view("footer");
    }
}
?>