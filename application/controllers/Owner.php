<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session'));
		$this->load->model('db_model');
		$kode_resto = $this->session->userdata('kode_resto');
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
			if(!empty($post['nama_depan']) && !empty($post['nama_belakang']) && !empty($post['telpon']) && !empty($post['email'])  )
			{
				$jumlahdata = $this->db_model->jumlah_data('owner_resto');
				$idresto = 'OR' . ($jumlahdata+1);
				$data=array(
					'kode_resto' => $idresto,
					'nama_depan' => $post['nama_depan'],
					'no_telp' => $post['telpon'],
					'email' => $post['email'],
					'password' => $post['password'],
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
					$this->session->set_userdata('kode_resto', $hasil[0]['kode_resto']);
					
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
	public function dashboard_about()
	{
		if($this->session->userdata('user')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$kode_resto = $this->session->userdata('kode_resto');
			$cek_data = $this->db_model->read_data('about_resto',$kode_resto);
			if($cek_data=="data ada")
			{
				$data = array(
					'record' => $this->db_model->cari_data('about_resto',$kode_resto)
				);
				$this->load->view('dashboard_about',$data);
			}else
			{
				$this->load->view('dashboard_about_without_data');
			}
			
			
		}
	}

	public function about_system()
	{
		$this->load->model('db_model');
		$post = $this->input->post();
		$kode_resto = $this->session->userdata('kode_resto');
		$cek_data = $this->db_model->read_data('about_resto',$kode_resto);
		//echo $cek_data;
		if($cek_data=="data ada")
		{
			$data=array(
							'nama_resto' => $post['namaresto'],
							'alamat_resto' => $post['alamatresto'],
							'no_telfon' => $post['notelfonresto'],
							'jadwal_buka' => $post['jadwal'],
							'tipe_sajian' => $post['sajian'],
							'harga_terendah' => $post['terendah'],
							'harga_tertinggi' => $post['tertinggi'],
							'metode_pembayaran' => $post['pembayaran'],
							'status' => 'TRUE'
							);
				$this->db_model->update_data($kode_resto,$data);
				redirect('owner/dashboard_owner');
		}else
		{
			$jumlahdata = $this->db_model->jumlah_data('about_resto');
			if(!empty($post['namaresto']) && !empty($post['alamatresto']) && !empty($post['notelfonresto']) && !empty($post['jadwal']) && !empty($post['sajian']) && !empty($post['terendah']) && !empty($post['tertinggi']) && !empty($post['terendah']) && !empty($post['pembayaran']))
			{
				$idabout = 'AR' . ($jumlahdata+1);
				$data=array(
							'kode_about' => $idabout,
							'kode_resto' => $this->session->userdata('kode_resto'),
							'nama_resto' => $post['namaresto'],
							'alamat_resto' => $post['alamatresto'],
							'no_telfon' => $post['notelfonresto'],
							'jadwal_buka' => $post['jadwal'],
							'tipe_sajian' => $post['sajian'],
							'harga_terendah' => $post['terendah'],
							'harga_tertinggi' => $post['tertinggi'],
							'metode_pembayaran' => $post['pembayaran'],
							'status' => 'TRUE'
							);
				$this->db_model->tambah_data('about_resto',$data);
				redirect('owner/dashboard_owner');
			}
		}
		
		
		/*$nama_resto = $this->input->post('namaresto');
		echo $nama_resto;*/
		
	}

	public function about_system_makanan()
	{
		$this->load->model('db_model');
		$post = $this->input->post();
		$kode_resto = $this->session->userdata('kode_resto');
		
		$jumlahdata = $this->db_model->jumlah_data('menu_resto');
		if(!empty($post['namamakanan']) && !empty($post['deskripsimakanan']) && !empty($post['hargamakanan']))
		{
			$idmenu = 'ME'.($jumlahdata+1);
			$data=array(
						'kode_menu' => $idmenu,
						'kode_resto' => $kode_resto,
						'nama_makanan' => $post['namamakanan'],
						'deskripsi' => $post['deskripsimakanan'],
						'harga' => $post['hargamakanan'],
						'status_menu' => 'TRUE'
				);
			$this->db_model->tambah_data('menu_resto',$data);
			redirect('owner/dashboard_owner_menu');
		}
	}

	public function dashboard_owner_menu()
	{
		$this->load->model('db_model');
		$kode_resto = $this->session->userdata('kode_resto');
		if($this->session->userdata('user')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$cek_data = $this->db_model->read_data('about_resto',$kode_resto);
			if($cek_data=="data ada")
			{
				$data = array(
					'record' => $this->db_model->cari_data('about_resto',$kode_resto)
				);
				$this->load->view('dashboard_about_menu',$data);
			}else
			{
				$this->load->view('dashboard_about_without_data');
			}
			
		}
	}

	public function dashboard_reservation()
	{
		if($this->session->userdata('user')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$this->load->view('dashboard_reservation');	
		}
		
	}
	public function dashboard_photo()
	{
		if($this->session->userdata('user')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$this->load->view('dashboard_photo');	
		}
		
	}
	public function dashboard_menu()
	{
		if($this->session->userdata('user')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$this->load->view('dashboard_menu');	
		}
		
	}

	public function log_out()
	{
		$this->session->unset_userdata('user');
		redirect('owner/login');
	}


	public function contoh()
	{
		$this->load->view('dashboard_about');
	}
}
