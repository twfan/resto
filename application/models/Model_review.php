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

	function baca_data_review($koderesto)
	{
		$query ="SELECT user_login.nama_user, review_pelanggan.judul_review, review_pelanggan.review_pelanggan, review_pelanggan.rating, review_pelanggan.tanggal_review FROM review_pelanggan, user_login WHERE review_pelanggan.id_resto='$koderesto' AND user_login.id_user = review_pelanggan.id_pelanggan";
		$hasil = $this->db->query($query);
		return $hasil->result();
	}

	function baca_rating()
	{
		$query = "SELECT `id_resto`, AVG(`rating`) as rating FROM `review_pelanggan` GROUP by `id_resto`";
		$hasil = $this->db->query($query);
		return $hasil->result();
	}

}


?>