<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('session', 'form_validation'));
	}

	
	public function index()
	{
		$this->session->set_flashdata('msg','');
		$this->load->view('templates/header');
		$this->load->view('home');
		$this->load->view('templates/footer');
	}
}
