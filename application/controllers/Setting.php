<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct() {
							parent::__construct();

							if($this->session->userdata('status') != "login"){
								redirect(base_url("login"));
							}
	}

	public function index()
	{
    $this->load->view("templates/header.php");
		$this->load->view('templates/sidebar_setting.php');
		$this->load->view('setting/index.php');
		$this->load->view("templates/footer.php");
	}
}
