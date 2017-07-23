<?php


class Model_iklan extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function jumlahdata($idresto){
		$this->db->where('kode_resto',$idresto);
		return $this->db->count_all('iklan_resto');
	}

	public function insert_data($data){
		$this->db->insert('iklan_resto', $data);
	}

	function update_data($idresto,$data){
		$this->db->where('kode_resto',$idresto);
		$this->db->update('iklan_resto',$data);
	}

	public function cek_jumlah_iklan_aktif()
	{
		

		$tanggal_sekarang = date('Y-m-d');
		$query = "SELECT COUNT('kode_resto') as total FROM iklan_resto WHERE DATE(NOW()) <tanggal_selesai OR  DATE(NOW()) =tanggal_selesai";
		$sql = $this->db->query($query);
		$total = $sql->result();	
		return $total[0]->total;
	}

	public function get_iklan_aktif()
	{


		$tanggal_sekarang = date('Y-m-d');
		$query = "SELECT *   FROM iklan_resto WHERE DATE(NOW()) <tanggal_selesai OR  DATE(NOW()) =tanggal_selesai";
		$sql = $this->db->query($query);
		return $sql->result();
		
	}

}


?>