<?php


class Model_saldo_resto extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function jumlah_data(){
		return $this->db->count_all('user_saldo_resto');
	}

	function tambah_data($data){
		$this->db->insert('user_saldo_resto', $data);
	}

}


?>