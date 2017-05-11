<?php


class Model_saldo_website_detail extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function jumlah_data(){
		return $this->db->count_all('saldo_website_detail');
	}

	public function tambah_data_terima_saldo($data){
		$this->db->insert('saldo_website_detail', $data);
	}

}


?>