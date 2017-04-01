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
		$post = $this->input->post();
		$username = $post['username'];
		$password = $post['password'];
		$table = 'user_admin';
		$data = array(
			'username' => $username,
			'password' => $password,
			'status' => 'sudah verifikasi'
		);
		$hasil = $this->Db_model->cari_data_bener($table,$data);
		header('Content-Type:application/json');
		echo json_encode($hasil);
	}


	public function register()
	{
		$this->load->view('register_admin');
	}
	public function proses_register()
	{
		$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "resto.stts@gmail.com";
        $config['smtp_pass'] = "12041995";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $this->load->library('email');
		$this->email->initialize($config);
		

		$post = $this->input->post();
		$password = $post['password'];
		$email = $post['email'];
		
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
		
		
		$link = base_url('admin/verifikasi/'.$username_string);
		$htmlContent = '<h3>Terima kasih telah mendaftar</h3>';
		$htmlContent .= "<div>Silahkan klik link berikut untuk melakukan verifikasi email </div> <a href='$link'>$link</a>";
		
		
		$this->email->from('resto.stts@gmail.com', 'Resto.com');
		$this->email->to($post['email']);
		$this->email->subject('Verifikasi email');
		$this->email->message($htmlContent);

		if ($this->email->send()) {
			$this->Db_model->tambah_data('user_admin',$data);
			$this->session->set_flashdata('email_sent','Email verifikasi telah dikirim, silahkan cek email anda untuk verifikasi email.');
		   	redirect('admin');
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
		$query = "SELECT user_saldo_pelanggan_detail.id_top_up , user_saldo_pelanggan_detail.id_user, user_login.nama_user, user_saldo_pelanggan_detail.jumlah_top_up_saldo, user_saldo_pelanggan_detail.nama_rekening, user_saldo_pelanggan_detail.tanggal_transfer, user_saldo_pelanggan_detail.tanggal_konfirmasi, user_saldo_pelanggan_detail.status_transaksi  FROM `user_saldo_pelanggan_detail`, `user_login` WHERE user_saldo_pelanggan_detail.id_user = user_login.id_user";
		
		$data = array(
			'record' => $this->Db_model->baca_data_dengan_query_custom($query)
		);
		$this->load->view('admin_blank',$data);
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


