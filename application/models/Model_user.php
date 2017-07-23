<?php


class Model_user extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function baca_telfon_pelanggan($idpelanggan)
	{
		$query = "SELECT no_handphone FROM `user_login` WHERE id_user='$idpelanggan'";
		$sql = $this->db->query($query);
		return $sql->result();
	}

	public function baca_telfon_pelanggan_1($idpelanggan)
	{
		$query = "SELECT no_handphone FROM `user_login` WHERE id_user='$idpelanggan'";
		$sql = $this->db->query($query);
		$data = $sql->result();
		return $data[0]->no_handphone;
	}

	public function baca_nama($idpelanggan)
	{
		$query = "SELECT nama_user FROM `user_login` WHERE id_user='$idpelanggan'";
		$sql = $this->db->query($query);
		$data = $sql->result();
		return $data[0]->nama_user;
	}

	public function baca_data_table($table,$kolom,$data_pembanding)
	{
		$hasil_data =  $this->db->get_where($table, array($kolom => $data_pembanding));
		return $hasil_data->result();
	}
	public function cek_email($email)
	{
		$email_user = $email;
		$q = $this->db-> get_where ('user_login',array('email'=>$email));
		$hasil_data = $q->result_array();
		return $hasil_data;
	}
	public function decrypt_password($email)
	{
		
		$q = $this->db-> get_where ('user_login',array('email'=>$email));
		$hasil_data = $q->result_array();
		return $hasil_data;
	}

	public function tambah_data_user($data){
		$this->db->insert('user_login', $data);
	}

	public function jumlah_data_user(){
		return $this->db->count_all('user_login');
	}

	public function update_data_user($parameter,$parameter_pembanding,$data)
	{
		$this->db->where($parameter_pembanding,$parameter);
		$this->db->update('user_login',$data);
	}

	public function baca_data_pesanan_untuk_pelanggan($id_pelanggan)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan.id_pesanan, about_resto.nama_resto, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.status_pemesanan  FROM pesanan_pelanggan, about_resto  WHERE pesanan_pelanggan.id_pelanggan='$id_pelanggan' AND pesanan_pelanggan.kode_resto = about_resto.kode_resto");
		return $query->result();
	}
}


?>