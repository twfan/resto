<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session'));
	}
	public function index()
	{
		$this->load->view('home');

	}

	public function home()
	{
		redirect("utama/");
	}

	public function login()
	{
		if($this->session->userdata('user')==NULL)
		{
			$this->load->view('login');
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
					redirect('utama/dashboard_user');
				}else
				{
					
					$this->session->set_flashdata('pesan','Kombinasi email / password anda salah');
					redirect('utama/login');
				}
			}
		}else
		{
			
			redirect('utama/dashboard_user');
		}
	}



	public function registerpelanggan()
	{
		$this->load->model('db_model');
		$post = $this->input->post();
		$this->load->library('form_validation');
		$password= $this->input->post('password');
		$konfpassword= $this->input->post('konfpassword');
		if($konfpassword==$password)
		{
			
				if(!empty($post['nama']) && !empty($post['tanggal']) && !empty($post['gender']) && !empty($post['nohp']) && !empty($post['email']) && !empty($post['password']) )
				{
					$cekemail = $this->db_model->cek_email($post['email']);
					//echo count($cekemail);
					if(count($cekemail)>=1)
					{
						$this->session->set_flashdata('email_kembar','Email telah terdaftar silahkan gunakan email lain');
						redirect('utama/registerpelanggan');
					}else
					{
						//echo "masuk siniiiiiiiiiii";
						$jumlahdata = $this->db_model->jumlah_data('user_login');
						$iduser = 'UL' . ($jumlahdata+1);
						$data=array(
							'id_user' => $iduser,
							'nama_user' => $post['nama'],
							'jenis_kelamin' => $post['gender'],
							'tanggal_lahir' => $post['tanggal'],
							'no_handphone' => $post['nohp'],
							'email_user' => $post['email'],
							'password' => $post['password']
							);
						$this->db_model->tambah_data('user_login',$data);
						redirect('utama');
					}
					//print_r($data);
				}
				else
				{
					
				}

		}else
		{
			//kalo password ga sama
			
		}
		$this->load->view('register');
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
					'email_resto' => $post['email'],
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
				redirect('utama/dashboard_user');
			}	
		}else
		{
			$this->session->set_flashdata('pesan','password dan ketik ulang password anda tidak sama');
			redirect('utama/register_resto');
		}
		

		$this->load->view('register_resto');
	}

	public function dashboard_user()
	{
		if($this->session->userdata('user')==NULL)
		{
			redirect('utama/login');
		}else
		{
			$this->load->view('dashboard_blank');	
		}
		
	}
	public function log_out()
	{
		$this->session->unset_userdata('user');
		redirect('utama/login');
	}
}
