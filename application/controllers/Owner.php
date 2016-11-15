<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session'));
	}

	public function index()
	{
		$this->load->view('login_owner');
	}

	public function register_resto()
	{
		$this->load->model('db_model');
		$post = $this->input->post();
		$password = $this->input->post('password');
		$konfpassword = $this->input->post('konf_password');
		if($password==$konfpassword)
		{
			if(!empty($post['nama_depan']) && !empty($post['nama_belakang']) && !empty($post['telpon']) && !empty($post['email']) && !empty($post['nama_resto']) && !empty($post['alamat_resto']) && !empty($post['kode_pos']) && !empty($post['provinsi']) && !empty($post['kota']) && !empty($post['deskripsi']) )
			{
				$jumlahdata = $this->db_model->jumlah_data('owner_resto');
				$idresto = 'OR' . ($jumlahdata+1);
				$data=array(
					'kode_resto' => $idresto,
					'nama_depan' => $post['nama_depan'],
					'nama_belakang' => $post['nama_belakang'],
					'no_telp_resto' => $post['telpon'],
					'email' => $post['email'],
					'password' => $post['password'],
					'nama_resto' => $post['nama_resto'],
					'alamat_resto' => $post['alamat_resto'],
					'kode_pos_resto' => $post['kode_pos'],
					'provinsi' => $post['provinsi'],
					'kota' => $post['kota'],
					'sekilas_resto' => $post['deskripsi'],
					'status_akun' => 'TRUE'
					);
				$this->db_model->tambah_data('owner_resto',$data);
				redirect('owner/dashboard_owner');
			}	
		}else
		{
			$this->session->set_flashdata('pesan','password dan ketik ulang password anda tidak sama');
			redirect('owner/register_resto');
		}
		

		$this->load->view('register_resto');
	}
	public function login()
	{
		if($this->session->userdata('user')==NULL)
		{
			$this->load->view('login_owner');
			$this->load->model('db_model');
			$post = $this->input->post();
			if(!empty($post['email_login']) && !empty($post['password_login']))
			{
				/*$this->db_model->login($post['email'],$post['password']);*/
				/*redirect('utama/');*/
				$data=array(
					'email' => $post['email_login'],
					'password' => $post['password_login']
					);
				$hasil = $this->db_model->login('owner_resto',$data);
				echo count($hasil);
				
				if(count($hasil)==1)
				{
					
					$this->session->set_userdata('user', $hasil[0]['nama_depan']);
					redirect('owner/dashboard_owner');
				}else
				{
					
					$this->session->set_flashdata('pesan','Kombinasi email / password anda salah');
					redirect('owner/login');
				}
			}
		}else
		{
			redirect('owner/dashboard_owner');
		}
	}

	public function dashboard_owner()
	{
		if($this->session->userdata('user')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$this->load->view('dashboard_blank');	
		}
		
	}

	public function log_out()
	{
		$this->session->unset_userdata('user');
		redirect('owner/login');
	}
}
