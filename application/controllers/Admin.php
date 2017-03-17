<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session','encrypt'));
		$this->load->model('db_model');
		$kode_resto = $this->session->userdata('kode_resto');
	}
	
	public function index()
	{
		$this->load->view('login_admin');
	}
	public function register()
	{
		$this->load->view('register_admin');
	}
	public function proses_register()
	{
		
		$post = $this->input->post();
		$password = $post['password'];
		
		$jumlahdata = $this->db_model->jumlah_data('user_admin');
		$iduser = 'ADM' . ($jumlahdata+1);
		$data = array(
			'id_user' => $iduser,
			'username' => $post['username'],
			'password' => $post['password'],
			'nama_user' => $post['nama_user'],
			'email' => $post['email'],
			'status' => 'belum verifikasi'
		);
		$this->db_model->tambah_data('user_admin',$data);

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
		$link = base_url('admin/verifikasi');
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

	public function verifikasi()
	{

	}
	
}


