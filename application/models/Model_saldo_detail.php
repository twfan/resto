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
	public function jumlahdata()
	{
		return $this->db->count_all('user_saldo_pelanggan_detail');
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
		$query = "SELECT user_saldo_pelanggan_detail.id_top_up , user_saldo_pelanggan_detail.id_user, user_login.nama_user, user_saldo_pelanggan_detail.jumlah_top_up_saldo, user_saldo_pelanggan_detail.kode_unik, user_saldo_pelanggan_detail.nama_rekening, user_saldo_pelanggan_detail.tanggal_transfer, user_saldo_pelanggan_detail.tanggal_konfirmasi, user_saldo_pelanggan_detail.bukti_transfer, user_saldo_pelanggan_detail.status_transaksi  FROM `user_saldo_pelanggan_detail`, `user_login` WHERE user_saldo_pelanggan_detail.id_user = user_login.id_user";
		$query = $this->db->query($query);
		return $query->result();
	}

	public function request_top_up($data)
	{
		$this->db->insert('user_saldo_pelanggan_detail',$data);
	}

	public function data_invoice($idtopup,$iduser)
	{
		$query = "SELECT user_login.email, user_saldo_pelanggan_detail.jumlah_top_up_saldo, user_saldo_pelanggan_detail.kode_unik, user_saldo_pelanggan_detail.status_transaksi FROM `user_login`, `user_saldo_pelanggan_detail` WHERE user_saldo_pelanggan_detail.id_top_up='$idtopup' AND user_saldo_pelanggan_detail.id_user = '$iduser' AND user_saldo_pelanggan_detail.id_user=user_login.id_user";
		$query = $this->db->query($query);
		return $query->result();
	}

	public function data_transaksi_belum_bayar($iduser)
	{
		$query = "SELECT `id_top_up`, `jumlah_top_up_saldo` FROM `user_saldo_pelanggan_detail` WHERE `id_user`='$iduser' AND `status_transaksi`='belum dibayar'";
		$query = $this->db->query($query);
		return $query->result();
	}

	public function update_konfirmasi($idtopup,$data)
	{
		$this->db->where('id_top_up',$idtopup);
		$this->db->update('user_saldo_pelanggan_detail',$data);
	}

}

?>