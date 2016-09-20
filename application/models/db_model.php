<?php


class Db_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function tambah_data($table,$data){
		$this->db->insert($table, $data);
	}

	function jumlah_data($table){
		return $this->db->count_all($table);
	}
}


?>