<?php
class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');


	}

	function index(){
		$this->load->view('login/v_login');
	}

	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);

		$cek = $this->m_login->cek_login("penguna",$where)->num_rows();
		$row =$this->m_login->get_pengguna_byusername($username);
		if($cek > 0){

			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'id_penguna'=> $row->id_penguna
				);

			$this->session->set_userdata($data_session);
			redirect(base_url("updatefimware"));

		}else{

			echo "Username dan password salah !";
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

 ?>
