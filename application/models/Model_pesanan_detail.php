<?php


class Model_pesanan_detail extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function jumlah_data(){
		return $this->db->count_all('pesanan_pelanggan_makanan_detail');
	}

	public function tambah_data($data){
		$this->db->insert('pesanan_pelanggan_makanan_detail', $data);
	}
	public function cari_data_pesanan_untuk_pelanggan($id_pesanan,$koderesto)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan_makanan_detail.nama_makanan, pesanan_pelanggan_makanan_detail.jumlah_makanan, pesanan_pelanggan_makanan_detail.sub_harga_makanan FROM pesanan_pelanggan_makanan_detail WHERE pesanan_pelanggan_makanan_detail.id_pesanan='$id_pesanan' AND pesanan_pelanggan_makanan_detail.kode_resto='$koderesto' ");
		return $query->result();
	}
	public function baca_data_pesanan_untuk_pelanggan($id_pesanan)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan_makanan_detail.nama_makanan, pesanan_pelanggan_makanan_detail.jumlah_makanan, pesanan_pelanggan_makanan_detail.sub_harga_makanan FROM pesanan_pelanggan_makanan_detail WHERE pesanan_pelanggan_makanan_detail.id_pesanan='$id_pesanan'");
		return $query->result();
	}
		public function baca_harga($id_pesanan)
	{
		$query = $this->db->query("SELECT  pesanan_pelanggan_makanan_detail.sub_harga_makanan FROM pesanan_pelanggan_makanan_detail WHERE pesanan_pelanggan_makanan_detail.id_pesanan='$id_pesanan'");
		return $query->result();
	}
}


?>