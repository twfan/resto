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
}


?>