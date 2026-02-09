<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('students');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['students'] = $this->students->get_students();
		$data['title'] = 'Student';

        $this->load->view('welcome_message', $data);
	}

	public function view($slug = NULL)
	{
		$data['student'] = $this->students->get_students($slug);

		if (empty($data['student']))
        {
			show_404();
        }

        $data['title'] = $data['student']['name'];

        $this->load->view('welcome_message', $data);
	}
}
