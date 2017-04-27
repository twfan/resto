<?php


class Model_review extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function baca_vote()
	{
		$query = $this->db->query("SELECT `id_resto`, COUNT(id_resto) AS 'total_vote' FROM review_pelanggan GROUP by id_resto");
		return $query->result();
	}

}


?>