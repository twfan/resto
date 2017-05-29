<?php


class Model_admin extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function cari_data_bener($table,$data)
	{
		$hasil_data = $this->db->get_where($table, $data);
		return $hasil_data->result();
	}

	public function baca_telfon_admin()
	{
		$query = "SELECT no_hp FROM `user_admin` WHERE id_user='ADM1'";
		$sql = $this->db->query($query);
		return $sql->result();
	}
}


?>