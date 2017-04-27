<?php


class Model_resto extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function baca_data_resto()
	{
		$hasil_data = $this->db->get('about_resto');
		return $hasil_data->result();
	}

	public function baca_data_resto_keyword($keyword)
	{
		$query = $this->db->query("SELECT * FROM about_resto WHERE `nama_resto` LIKE '%$keyword%'");
		return $query->result();
	}

	public function baca_harga($id)
	{
		$query = $this->db->query("SELECT `biaya_kursi` FROM about_resto WHERE `kode_resto` = '$id'");
		return $query->result();
	}

}


?>