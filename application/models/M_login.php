<?php

class M_login extends CI_Model{
	function cek_login($table,$where){
		return $this->db->get_where($table,$where);
	}



	function get_pengguna_byusername($username)
	{
			$this->db->where('username', $username);
			return $this->db->get('penguna')->row();
	}



}
