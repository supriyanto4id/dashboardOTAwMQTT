<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
			{
							parent::__construct();
							$this->load->model('update_fimware_model');
							$this->load->helper('url_helper');
							$this->load->helper(array('form', 'url'));


			$this->load->library('form_validation');
			$this->load->library('datatables');
			}


	public function index()
	{
		$host   = "192.168.137.2";
		$port     = 1883;
		$username = "";
		$password = "";
		require("asset/phpMQTT/phpMQTT.php");
		// require("config.php");
			$this->load->view("templates/header.php");
			$this->load->view("templates/sidebar_dashboard.php");
		  $this->load->view('dashboard/index.php');
			$this->load->view("templates/footer.php");
	}


	public function updateFimware()
	{

		$data['penguna'] = $this->update_fimware_model->get_penguna();
		$data['error'] = ' ';

		$this->load->view("templates/header.php");
		$this->load->view('templates/sidebar_fimware.php');
		$this->load->view('update_fimware/index.php',$data);
		$this->load->view("templates/footer.php");
	}

	public function do_upload()
				{
					$config['upload_path']          = 'asset/uploads/';
					$config['allowed_types']        = 'bin';
					$config['max_size']             = 300;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('userfile'))
					{
									// $error = array('error' => $this->upload->display_errors());
									$data['penguna'] = $this->update_fimware_model->get_penguna();
									$data['error'] = $this->upload->display_errors();
									$this->load->view("templates/header.php");
									$this->load->view('templates/sidebar_fimware.php');
									$this->load->view('update_fimware/index.php',$data);
									$this->load->view("templates/footer.php");
					}
					else
					{
						  $this->session->set_flashdata('message', 'Create Record Success');
						redirect(site_url('user/updatefimware'));
					}

				}



	public function setting()
	{

		$this->load->view("templates/header.php");
		$this->load->view('templates/sidebar_setting.php');
		$this->load->view('setting/index.php');
		$this->load->view("templates/footer.php");
	}


public function publish()
{
	$host   = "192.168.137.2";
	$port     = 1883;
	$username = "";
	$password = "";
	require("asset/phpMQTT/phpMQTT.php");
		$message =  file_get_contents('asset/dist/img/user2-160x160.jpg');
		//MQTT client id to use for the device. "" will generate a client id automatically
		$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());

		if ($mqtt->connect(true,NULL,$username,$password)) {
			$mqtt->publish("topic",$message, 0);
			$mqtt->close();
		}else{
			echo "Fail or time out";

}

	}
}
