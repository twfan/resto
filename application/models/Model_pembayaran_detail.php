<?php


class Model_pembayaran_detail extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function jumlah_data(){
		return $this->db->count_all('pembayaran_detail');
	}

	public function insert_data($data){
		$this->db->insert('pembayaran_detail', $data);
	}

	public function baca_data(){
		$hasil_data = $this->db->get('pembayaran_detail');
		return $hasil_data->result();
	}

	public function update_status_terima($idpesanan,$data_detail,$data_pesanan)
	{
		$this->db->where('id_pesanan',$idpesanan);
		$this->db->update('pembayaran_detail',$data_detail);

		$this->db->where('id_pesanan',$idpesanan);
		$this->db->update('pesanan_pelanggan',$data_pesanan);
	}

}


?>