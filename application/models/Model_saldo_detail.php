<?php


class Model_saldo_detail extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	public function baca_data_table($table,$kolom,$data_pembanding)
	{
		$hasil_data =  $this->db->get_where($table, array($kolom => $data_pembanding));
		return $hasil_data->result();
	}
	public function jumlahdata($id_user)
	{
		$hasil_data = $this->db->get_where('user_saldo_pelanggan_detail', array('id_user' => $id_user))->num_rows();
		return $hasil_data;
	}

	public function data($number,$offset){
		return $query = $this->db->get('user_saldo_pelanggan_detail',$number,$offset)->result();		
	}

	public function baca_data_dengan_query_custom($query)
	{
		$query = $this->db->query($query);
		return $query->result();
	}

	public function list_top_up()
	{
		$query = "SELECT user_saldo_pelanggan_detail.id_top_up , user_saldo_pelanggan_detail.id_user, user_login.nama_user, user_saldo_pelanggan_detail.jumlah_top_up_saldo, user_saldo_pelanggan_detail.nama_rekening, user_saldo_pelanggan_detail.tanggal_transfer, user_saldo_pelanggan_detail.tanggal_konfirmasi, user_saldo_pelanggan_detail.status_transaksi  FROM `user_saldo_pelanggan_detail`, `user_login` WHERE user_saldo_pelanggan_detail.id_user = user_login.id_user";
		$query = $this->db->query($query);
		return $query->result();
	}

}

?>