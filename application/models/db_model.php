<?php


class Db_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function cek_email($email)
	{
		$email_user = $email;
		$q = $this->db-> get_where ('user_login',array('email_user'=>$email));
		$hasil_data = $q->result_array();
		return $hasil_data;
	}

	function tambah_data($table,$data){
		$this->db->insert($table, $data);
	}

	function jumlah_data($table){
		return $this->db->count_all($table);
	}

	function login($table,$data){
		$email_user = $data['email'];
		$password_user = $data['password'];
		$q = $this->db-> get_where ($table,array('email'=>$email_user,'password'=>$password_user));
		$hasil_data = $q->result_array();
		return $hasil_data;
	}

	function read_data($table,$parameter)
	{
		$hasil_data = $this->db->get_where($table, array('kode_resto' => $parameter));
		if($hasil_data->num_rows() > 0)
		{
			return "data ada";
		}else
		{
			return "data tidak ada";
		}
	}

	function cari_data($table,$parameter)
	{
		$hasil_data = $this->db->get_where($table, array('kode_resto' => $parameter));
		return $hasil_data->result();
	}

	function update_data($kode_resto,$data)
	{
		$this->db->where('kode_resto', $kode_resto);
		$this->db->update('about_resto', $data);
	}
}


?>