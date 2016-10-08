<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		
	}

	
	public function index()
	{
		$this->load->view('templates/header-panel');
		$this->load->view('panel');
		$this->load->view('templates/footer');
	}
}
