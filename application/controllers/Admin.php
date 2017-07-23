<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session','encrypt'));
		$this->load->model('Db_model');
		$kode_resto = $this->session->userdata('kode_resto');
	}
	
	public function index()
	{
		if($this->session->userdata('username')==""){
			$this->load->view('login_admin');
		}else
		{
			redirect('admin/home');
		}
		
	}

	public function proses_login()
	{
		$this->load->model('Model_admin');
		$post = $this->input->post();
		$username = $post['username'];
		$password = $post['password'];
		$table = 'user_admin';
		$data = array(
			'username' => $username,
			'password' => $password,
			'status' => 'sudah verifikasi'
		);
		$hasil = $this->Model_admin->cari_data_bener($table,$data);
		if(count($hasil)>0)
		{
			$this->session->set_userdata('username',$username);
			redirect('admin/home');
		}else
		{
			redirect('admin');
		}
	}


	public function register()
	{
		$this->load->view('register_admin');
	}
	public function proses_register()
	{
		
		$post = $this->input->post();
		$password = $post['password'];
		
		$jumlahdata = $this->Db_model->jumlah_data('user_admin');
		$iduser = 'ADM' . ($jumlahdata+1);

		$username_string = $post['username'];
		$password_string = $post['password'];
		$data = array(
			'id_user' => $iduser,
			'username' => $username_string,
			'password' => $password_string,
			'nama_user' => $post['nama_user'],
			'email' => $post['email'],
			'status' => 'belum verifikasi'
		);
		$this->Db_model->tambah_data('user_admin',$data);

		$this->load->library('email');
		$post = $this->input->post();
		$email = $post['email'];
		$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "resto.stts@gmail.com";
        $config['smtp_pass'] = "twfan1204";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

		$this->email->initialize($config);
		$link = base_url('admin/verifikasi/'.$username_string);
		$htmlContent = '<h1>Terima kasih telah mendaftar</h1>';
		$htmlContent .= "<div>Silahkan klik link berikut untuk melakukan verifikasi email </div> <a href='$link'>$link</a>";
		
		$this->email->from('resto.stts@gmail.com', 'Resto.com');
		$this->email->to($email);
		$this->email->subject('Verifikasi email');
		$this->email->message($htmlContent);

		if ($this->email->send()) {
			header('Content-Type:application/json');
			echo json_encode($data);
        } else {
            show_error($this->email->print_debugger());
        }
	}

	public function verifikasi($id)
	{
		$data = array('status'=>'sudah verifikasi');
		$this->Db_model->update_data_bener($id,'user_admin','username',$data);
		redirect('admin/home');
	}

	public function home()
	{
		if($this->session->userdata('username')==""){
			$this->load->view('login_admin');
		}else
		{
			$this->load->model('Model_saldo_detail');
			$data = array(
				'record' => $this->Model_saldo_detail->list_top_up()
			);
			$this->load->view('admin_blank',$data);
		}
	}

	public function log_out()
	{
		$this->session->unset_userdata('username');
		redirect('admin');
	}

	public function pembayaran()
	{
		$this->load->model('Model_pembayaran_detail');
		$data = array(
			'record' => $this->Model_pembayaran_detail->baca_data()
		);
		$this->load->view('admin_pembayaran',$data);

	}

	public function pembayaran_terima($idpesanan)
	{
		$this->load->model('Model_pembayaran_detail');
		$data_detail= array(
			'status' => '1'
		);
		$data_pesanan=array(
			'status_pemesanan' => 'selesai'
		);

		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_saldo_resto');
		$this->load->model('Model_saldo_resto_detail');
		$this->load->model('Model_saldo_website');
		$this->load->model('Model_saldo_website_detail');
		$this->load->model('Model_pesanan_pelanggan');
		

		$bayar = $this->Model_pesanan_pelanggan->baca_bayar($idpesanan);
		$koderesto = $this->Model_pesanan_pelanggan->baca_id_resto($idpesanan);
		
		$potongan_website = ((10/100)*$bayar);
		
		$jumlahdata = $this->Model_saldo_website_detail->jumlah_data();
		$idsaldodetail = 'ISWD'.($jumlahdata+1);
		$data4 = array(
			'id_saldo_website_detail' => $idsaldodetail,
			'id_pesanan' => $idpesanan,
			'tanggal_terima' => date("Y-m-d"),
			'jumlah_terima' => $potongan_website
		);
		$this->Model_saldo_website_detail->tambah_data_terima_saldo($data4);


		$hasil_model = $this->Model_saldo_website->baca_saldo();
		$saldo_website = $hasil_model[0]->saldo;
		$total_saldo_website = $saldo_website + $potongan_website;
		$data_saldo = array(
				'saldo' => $total_saldo_website
		);
		$this->Model_saldo_website->update_saldo($data_saldo);


		
		$total_pendapatan_resto = $bayar - $potongan_website;
		$jumlahdata = $this->Model_saldo_resto_detail->jumlah_data();
		$idsaldodetail = 'ISRD'.($jumlahdata+1);
		$data3 = array(
			'id_saldo_resto_detail' => $idsaldodetail,
			'id_resto' => $koderesto,
			'id_pesanan' => $idpesanan,
			'jumlah_terima_saldo' => $total_pendapatan_resto,
			'status' => 1
		);
		$this->Model_saldo_resto_detail->tambah_data($data3);


		$saldo_resto = $this->Model_saldo_resto->baca_saldo($koderesto);
		$total_saldo_resto = $saldo_resto + $total_pendapatan_resto;
		$data_saldo = array(
				'saldo' => $total_saldo_resto
		);
		$this->Model_saldo_resto->update_saldo($koderesto,$data_saldo);



		$this->Model_pembayaran_detail->update_status_terima($idpesanan,$data_detail,$data_pesanan);
		redirect('admin');
	}
	public function pembayaran_tolak($idpesanan)
	{
		
	}


	public function konfirmasi($id)
	{
		$this->load->Model('Model_saldo');
		$this->load->Model('Model_user');
		$data1 = array(
			'status_transaksi' => 'sudah konfirmasi admin' 
		);
		$this->Db_model->update_data_bener($id,'user_saldo_pelanggan_detail','id_top_up',$data1);
		
		$query = "SELECT user_saldo_pelanggan_detail.id_user,user_saldo_pelanggan_detail.jumlah_top_up_saldo, user_saldo_pelanggan_detail.kode_unik FROM `user_saldo_pelanggan_detail` WHERE user_saldo_pelanggan_detail.id_top_up = '$id' ";
		$hasil_jumlah_top_up_saldo = $this->Db_model->baca_data_dengan_query_custom($query);

		foreach ($hasil_jumlah_top_up_saldo as $row) {
			$jumlah_top_up_saldo = $row->jumlah_top_up_saldo +$row->kode_unik;
			$id_user = $row->id_user;
		}
		
		$query = "SELECT user_saldo_pelanggan_detail.id_user FROM `user_saldo_pelanggan_detail` WHERE user_saldo_pelanggan_detail.id_top_up = '$id'";
		$hasil_id_user = $this->Db_model->baca_data_dengan_query_custom($query);

		foreach ($hasil_id_user as $row) {
			$id_user = $row->id_user;
		}
		$query = "SELECT user_saldo_pelanggan.saldo FROM user_saldo_pelanggan  WHERE user_saldo_pelanggan.id_user = '$id_user'";
		$hasil_saldo_sekarang = $this->Db_model->baca_data_dengan_query_custom($query);

		foreach ($hasil_saldo_sekarang as $row) {
			$saldo_sekarang = $row->saldo;
		}

		$saldo = $saldo_sekarang + $jumlah_top_up_saldo;
		

		$data2 = array('saldo'=>$saldo);

		$this->Model_saldo->update_saldo($id_user,$data2);

		//SMS PELANGGAN
		$hasil_telp_pelanggan = $this->Model_user-> baca_telfon_pelanggan($id_user);
		foreach ($hasil_telp_pelanggan as $row) {
			$hp_pelanggan = $row->no_handphone;
		}

		$message=urlencode("Hai, top up anda telah berhasil. Saldo anda sekarang dapat digunakan untuk melakukan transaksi. Terimakasih. *pesan-meja-stts.com");
		$curlHandle = curl_init();
		$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$hp_pelanggan&message=$message";
		curl_setopt($curlHandle, CURLOPT_URL,$url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
		$hasil = curl_exec($curlHandle);
		curl_close($curlHandle);

		redirect('admin/home');
	}

	public function penarikan()
	{
		$this->load->model('Model_penarikan_saldo');
		$data = array(
			'record' =>$this->Model_penarikan_saldo->get_data()
			);
		$this->load->view('admin_konfirmasi_penarikan',$data);
	}
	public function konfirmasi_penarikan($id)
	{


		$this->load->model('Model_penarikan_saldo');
		$this->load->model('Model_owner');
		$this->load->model('Model_saldo_resto');
		$this->load->model('Model_saldo_resto_detail');
		

		$data  = $this->Model_penarikan_saldo->get_databycode($id);
		$idresto = $data[0]->id_resto;
		$jumlah_penarikan = $data[0]->jumlah_penarikan;
		$bank = $data[0]->bank;
		$rekening = $data[0]->rekening;
		$noresto = $this->Model_owner->baca_telfon_resto($idresto);
		$telfonresto = $noresto[0]->no_telp;

		$saldo = $this->Model_saldo_resto->baca_saldo($idresto);
		$saldoakhir = $saldo - $jumlah_penarikan;

		$jumlahdata = $this->Model_saldo_resto_detail->jumlah_data();
		$idsaldodetail = 'ISRD'.($jumlahdata+1);
		$data2 = array(
			'id_saldo_resto_detail' => $idsaldodetail,
			'id_resto' => $idresto,
			'id_pesanan' => 'TARIK_SALDO',
			'jumlah_terima_saldo' => -$jumlah_penarikan,
			'status' => 1
		);
		$this->Model_saldo_resto_detail->tambah_data($data2);

		$data1 = array(
			'saldo' => $saldoakhir
		);
		$this->Model_saldo_resto->update_saldo($idresto,$data1);

		$message=urlencode("****PERMINTAAN PENARIKAN SALDO SELESAI**** Permintaan penarikan saldo restaurant anda dengan kode penarikan ".$id. " dengan jumlah Rp. ".number_format($jumlah_penarikan).",00 dikirim ke bank ".$bank." ke nomor rekening ".$rekening." telah selesai terima kasih. *pesan-meja-stts.com");
		$curlHandle = curl_init();
		$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$telfonresto&message=$message";
		curl_setopt($curlHandle, CURLOPT_URL,$url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
		$hasil = curl_exec($curlHandle);
		curl_close($curlHandle);

		$data = array(
			'status' => 1
		);
		$this->Model_penarikan_saldo->update_databyid($id,$data);
		redirect('admin/penarikan');
	}


	
	
}


