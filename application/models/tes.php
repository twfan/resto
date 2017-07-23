<?php


class tes extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function insert_data($data){
		$this->db->insert('tes', $data);
	}

}


?>