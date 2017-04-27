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
		$this->load->view('login_admin');
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
			redirect('admin/home');
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
        $config['smtp_pass'] = "12041995";
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
		redirect('admin');
	}

	public function home()
	{
		$this->load->model('Model_saldo_detail');
		
		$data = array(
			'record' => $this->Model_saldo_detail->list_top_up()
		);
		$this->load->view('admin_blank',$data);
	}

	public function pembayaran()
	{
		$this->load->model('Model_pembayaran_detail');
		$data = array(
			'record' => $this->Model_pembayaran_detail->baca_data()
		);
		$this->load->view('admin_pembayaran',$data);

	}

	public function konfirmasi($id)
	{
		$data1 = array(
			'status_transaksi' => 'sudah konfirmasi admin' 
		);
		$this->Db_model->update_data_bener($id,'user_saldo_pelanggan_detail','id_top_up',$data1);
		
		$query = "SELECT user_saldo_pelanggan_detail.jumlah_top_up_saldo FROM `user_saldo_pelanggan_detail` WHERE user_saldo_pelanggan_detail.id_top_up = '$id' ";
		$hasil_jumlah_top_up_saldo = $this->Db_model->baca_data_dengan_query_custom($query);

		foreach ($hasil_jumlah_top_up_saldo as $row) {
			$jumlah_top_up_saldo = $row->jumlah_top_up_saldo;
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
		echo $saldo;

		$data2 = array('saldo'=>$saldo);

		$this->Db_model->update_data_bener($id_user,'user_saldo_pelanggan','id_user',$data2);
		redirect('admin/home');
	}

	
	
}


