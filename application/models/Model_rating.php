<?php


class Model_rating extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function tambah_data($data){
		$this->db->insert('rating', $data);
	}

	function update_rating($koderesto,$rating)
	{
		$query = "UPDATE `rating` SET `rating`='$rating' WHERE `kode_resto`='$koderesto'";
		$hasil = $this->db->query($query);
	}
}


?>