<?php


class Model_pesanan_pelanggan extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function tambah_data($data){
		$this->db->insert('pesanan_pelanggan',$data);
	}

	public function baca_kode_resto($id_pesanan)
	{
		$query = "SELECT kode_resto FROM `pesanan_pelanggan` WHERE id_pesanan='$id_pesanan'";
		$sql = $this->db->query($query);
		return $sql->result();
	}

	

	function baca_total_pesanan_perjam($date,$jam_acara)
	{
		$query = "SELECT `kode_resto`,`tanggal_acara`,`jam_acara`, COUNT(`tanggal_acara`) FROM `pesanan_pelanggan` WHERE `tanggal_acara` ='$date' AND `jam_acara` ='$jam_acara' GROUP BY kode_resto, tanggal_acara, jam_acara";
		$sql = $this->db->query($query);
		return $sql->result();
	}

	public function baca_status_bayar($id_pesanan)
	{
		$query = $this->db->query("SELECT `bukti_bayar` FROM `pesanan_pelanggan` WHERE `id_pesanan`='$id_pesanan'");
		return $query->result();
	}

	public function cari_data_pesanan_pelanggan($id_pesanan,$koderesto)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan.id_pesanan, pesanan_pelanggan.kode_resto,  about_resto.nama_resto, pesanan_pelanggan.id_pelanggan, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.tanggal_transaksi, pesanan_pelanggan.status_pemesanan FROM `pesanan_pelanggan`,  `about_resto` WHERE pesanan_pelanggan.id_pesanan ='$id_pesanan' AND about_resto.kode_resto = pesanan_pelanggan.kode_resto AND pesanan_pelanggan.kode_resto = '$koderesto'");
		return $query->result();
	}

	public function baca_data_pesanan_untuk_pelanggan($id_pesanan)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan.id_pesanan, pesanan_pelanggan.kode_resto,  about_resto.nama_resto, pesanan_pelanggan.id_pelanggan, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.tanggal_transaksi, pesanan_pelanggan.status_pemesanan FROM `pesanan_pelanggan`,  `about_resto` WHERE pesanan_pelanggan.id_pelanggan ='$id_pesanan' AND about_resto.kode_resto = pesanan_pelanggan.kode_resto AND pesanan_pelanggan.status_pemesanan = 'lanjut pembayaran'");
		return $query->result();
	}
	public function baca_data_pesanan_untuk_pelanggan_idpesanan($id_pesanan)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan.id_pesanan, pesanan_pelanggan.kode_resto,  about_resto.nama_resto, pesanan_pelanggan.id_pelanggan, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.tanggal_transaksi, pesanan_pelanggan.status_pemesanan FROM `pesanan_pelanggan`,  `about_resto` WHERE pesanan_pelanggan.id_pesanan ='$id_pesanan' AND about_resto.kode_resto = pesanan_pelanggan.kode_resto");
		return $query->result();
	}

	public function baca_harga($id_pesanan)
	{
		$query = $this->db->query("SELECT `total_bayar` FROM `pesanan_pelanggan` WHERE `id_pesanan`='$id_pesanan'");
		return $query->result();
	}

	public function update_bukti($id_pesanan,$data)
	{
		$this->db->where('id_pesanan',$id_pesanan);
		$this->db->update('pesanan_pelanggan',$data);
	}

	public function list_pesanan($id_pesanan)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan.id_pesanan, pesanan_pelanggan.kode_resto,  about_resto.nama_resto, pesanan_pelanggan.id_pelanggan, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.tanggal_transaksi, pesanan_pelanggan.status_pemesanan FROM `pesanan_pelanggan`,  `about_resto` WHERE pesanan_pelanggan.id_pelanggan ='$id_pesanan' AND about_resto.kode_resto = pesanan_pelanggan.kode_resto");
		return $query->result();
	}
	public function list_pesanan_berhasil($id_pesanan)
	{
		$query = $this->db->query("SELECT pesanan_pelanggan.id_pesanan, pesanan_pelanggan.kode_resto,  about_resto.nama_resto, pesanan_pelanggan.id_pelanggan, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.tanggal_transaksi, pesanan_pelanggan.status_pemesanan FROM `pesanan_pelanggan`,  `about_resto` WHERE pesanan_pelanggan.id_pelanggan ='$id_pesanan' AND about_resto.kode_resto = pesanan_pelanggan.kode_resto AND pesanan_pelanggan.status_pemesanan='selesai'");
		return $query->result();
	}

	public function list_konfirmasi_pembayaran()
	{
		$query = "SELECT pesanan_pelanggan.id_pesanan, pesanan_pelanggan.kode_resto,  about_resto.nama_resto, pesanan_pelanggan.id_pelanggan, pesanan_pelanggan.jumlah_kursi, pesanan_pelanggan.tanggal_acara, pesanan_pelanggan.jam_acara, pesanan_pelanggan.total_bayar, pesanan_pelanggan.bukti_bayar, pesanan_pelanggan.tanggal_transaksi, pesanan_pelanggan.status_pemesanan FROM `pesanan_pelanggan`,  `about_resto` WHERE  about_resto.kode_resto = pesanan_pelanggan.kode_resto AND pesanan_pelanggan.status_pemesanan = 'lanjut pembayaran'";
		$hasil = $this->db->query($query);
		return $hasil->result();
	}

	public function list_top_up()
	{
		$query = "SELECT user_saldo_pelanggan_detail.id_top_up , user_saldo_pelanggan_detail.id_user, user_login.nama_user, user_saldo_pelanggan_detail.jumlah_top_up_saldo, user_saldo_pelanggan_detail.nama_rekening, user_saldo_pelanggan_detail.tanggal_transfer, user_saldo_pelanggan_detail.tanggal_konfirmasi, user_saldo_pelanggan_detail.status_transaksi  FROM `user_saldo_pelanggan_detail`, `user_login` WHERE user_saldo_pelanggan_detail.id_user = user_login.id_user";
		$query = $this->db->query($query);
		return $query->result();
	}

	public function laporan_jumlah_pesanan($koderesto)
	{
		$query = "SELECT date_format(tanggal_acara, '%W') as hari, COUNT(date_format(tanggal_acara, '%W')) as jumlah_pesanan FROM pesanan_pelanggan WHERE kode_resto='$koderesto' GROUP BY hari";
		$hasil = $this->db->query($query);
		return $hasil->result();
	}

}


?>