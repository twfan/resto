<?php


class Model_bayar_upgrade extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function jumlah_data(){
		return $this->db->count_all('bayar_upgrade');
	}

	public function insert_data($data){
		$this->db->insert('bayar_upgrade', $data);
	}

}


?>