<?php


class Model_owner extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function decrypt_password($email)
	{
		$q = $this->db-> get_where ('owner_resto',array('email'=>$email));
		$hasil_data = $q->result_array();
		return $hasil_data;
	}

	public function update_data_user($parameter,$parameter_pembanding,$data)
	{
		$this->db->where($parameter_pembanding,$parameter);
		$this->db->update('owner_resto',$data);
	}

	public function update_upgrade($koderesto,$data)
	{
		$this->db->where('kode_resto',$koderesto);
		$this->db->update('owner_resto',$data);
	}

	

	public function baca_tgl_selesai($koderesto)
	{
		
		$query = "SELECT tanggal_selesai FROM `owner_resto` WHERE kode_resto='$koderesto'";
		$sql = $this->db->query($query);
		$hasil = $sql->result();
		return $hasil[0]->tanggal_selesai;
	}


	function cek_email($email)
	{
		$email_user = $email;
		$q = $this->db-> get_where ('owner_resto',array('email'=>$email));
		$hasil_data = $q->result_array();
		return $hasil_data;
	}

	public function baca_telfon_resto($koderesto)
	{
		$query = "SELECT no_telp FROM `owner_resto` WHERE kode_resto='$koderesto'";
		$sql = $this->db->query($query);
		return $sql->result();
	}

	public function get_nama($koderesto)
	{
		$query = "SELECT nama_depan FROM `owner_resto` WHERE kode_resto='$koderesto'";
		$sql = $this->db->query($query);
		$data = $sql->result();
		$nama = $data[0]->nama_depan;
		return $nama;
	}

	public function baca_status_upgrade($koderesto)
	{
		$query = "SELECT status_upgrade FROM `owner_resto` WHERE kode_resto='$koderesto'";
		$sql = $this->db->query($query);
		$data = $sql->result();
		return $data[0]->status_upgrade;

	}

	public function get_tanggal_selesai($email)
	{
		$query = "SELECT tanggal_selesai FROM `owner_resto` WHERE email='$email'";
		$sql = $this->db->query($query);
		$data = $sql->result();
		return $data[0]->tanggal_selesai;
	}
}


?>