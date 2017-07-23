<?php


class Db_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}


	public function getall($table,$bulan)
	{
		/*$hasil_data = $this->db->get($table);
		return $hasil_data->result();*/
		/*"SELECT date_format(tanggal, '%W') as hari, COUNT(date_format(tanggal, '%W')) as jumlah_pesanan FROM $table GROUP BY hari"*/
		/*$query = "SELECT  STR_TO_DATE(tanggal, '%d/%m/%Y') FROM $table ";*/


/*		$query = "SELECT date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%W') as hari,  COUNT(date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%W')) as jumlah_pesanan FROM $table WHERE date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%M')='january' GROUP BY hari ";
		$hasil = $this->db->query($query);
		return $hasil->result();*/

		/*$query = "SELECT date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%M') as BULAN FROM $table GROUP BY BULAN ";
		$hasil = $this->db->query($query);
		return $hasil->result();*/

			$query = "SELECT date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%M') as BULAN FROM $table GROUP BY BULAN ";
		$hasil = $this->db->query($query);
		return $hasil->result();
	}

	public function getall_byMonth($table)
	{
		$query = "SELECT date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%W') as hari,  COUNT(date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%W')) as jumlah_pesanan FROM $table WHERE date_format(STR_TO_DATE(tanggal, '%d/%m/%Y'), '%M')=$month GROUP BY hari ";
		$hasil = $this->db->query($query);
		return $hasil->result();
	}
	function cek_email($email)
	{
		$email_user = $email;
		$q = $this->db-> get_where ('user_login',array('email'=>$email));
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

	function read_data_bener($table,$data)
	{
		$hasil_data = $this->db->get_where($table, $data);
		if($hasil_data->num_rows() > 0)
		{
			return $hasil_data->result();
		}else
		{
			return "data tidak ada";
		}
	}
	function read_jumlah_data_batasan($table,$parameter)
	{
		$hasil_data = $this->db->get_where($table, array('kode_resto' => $parameter));
		if($hasil_data->num_rows() >= 10)
		{
			return "tidak bisa";
		}else
		{
			return "bisa";
		}
	}
	function read_jumlah_iklan_batasan($table)
	{
		$hasil_data = $this->db->get_where($table);
		if($hasil_data->num_rows() >= 3)
		{
			return "tidak bisa";
		}else
		{
			return "bisa";
		}
	}

	function cari_data($table,$parameter)
	{
		$hasil_data = $this->db->get_where($table, array('kode_resto' => $parameter));
		return $hasil_data->result();
	}

	public function read($table,$parameter)
	{
		$hasil_data = $this->db->get_where($table, array('kode_resto' => $parameter,'status'=>'TRUE'));
		if($hasil_data->num_rows() > 0)
		{
			return $hasil_data->result();
		}else
		{
			return "data tidak ada";
		}
	}

	public function baca_seluruh_table($table)
	{
		$hasil_data = $this->db->get($table);
		return $hasil_data->result();
	}

	public function edit($id,$table)
	{
		$this->db->where('kode_menu', $id);
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
		{
			$data= $query->row();
			$query->free_result();
		}
		else
		{
			$data = null;
		}
		return $data;
	}

	public function update($id,$data,$table)
	{
		$this->db->where('kode_menu',$id);
		$this->db->update($table,$data);
	}

	public function delete_menu($id){
		$data = array(
	        'status' => 'FALSE'
		);
		$this->db->where('kode_menu',$id);
		$this->db->update('menu_resto', $data);
	}

	public function delete_foto($id)
	{
		$this->db->where('id_foto',$id);
		$this->db->delete('foto_resto');
	}

	function update_data($kode_resto,$data)
	{
		$this->db->where('kode_resto', $kode_resto);
		$this->db->update('about_resto', $data);
	}

	public function update_data_bener($parameter,$table,$parameter_pembanding,$data)
	{
		$this->db->where($parameter_pembanding,$parameter);
		$this->db->update($table,$data);
	}

	public function cari_data_bener($table,$data)
	{
		$hasil_data = $this->db->get_where($table, $data);
		return $hasil_data->result();
	}
	function cari_data_pelanggan($parameter)
	{
		$hasil_data = $this->db->get_where('user_login', array('id_user' => $parameter));
		return $hasil_data->result();
	}
	function cari_data_resto($parameter)
	{
		$hasil_data = $this->db->get_where('owner_resto', array('kode_resto' => $parameter));
		return $hasil_data->result();
	}

	public function cari_nama_resto($id)
	{
		$this->db->select('nama_resto');
		$this->db->where('kode_resto', $id);
		$query = $this->db->get('about_resto');
		return $query->result();
	}

	
	public function baca_data_pesanan_untuk_owner($id_resto)
	{
		/*SELECT user_login.nama_user, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.status_pemesanan FROM pesanan_pelanggan, user_login WHERE pesanan_pelanggan.kode_resto='OR1';*/
		
		$query = $this->db->query("SELECT pesanan_pelanggan.id_pesanan, user_login.nama_user, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar,  pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.status_pemesanan, pesanan_pelanggan.tanggal_transaksi FROM pesanan_pelanggan, user_login WHERE pesanan_pelanggan.kode_resto='$id_resto' AND pesanan_pelanggan.id_pelanggan=user_login.id_user;");
		return $query->result();


		/*
		QUERY JOIN

		SELECT pesanan_pelanggan.id_pesanan, about_resto.nama_resto, user_login.nama_user FROM `pesanan_pelanggan` 
		JOIN user_login ON user_login.id_user = pesanan_pelanggan.id_pelanggan
		JOIN about_resto ON about_resto.kode_resto = pesanan_pelanggan.kode_resto
		WHERE pesanan_pelanggan.id_pelanggan='UL1'*/
	}

	

	public function baca_data_dengan_query_custom($query)
	{
		
		$query = $this->db->query($query);
		return $query->result();
	}
}


?>