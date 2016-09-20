<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
	}
	public function index()
	{

	}

	public function registerpelanggan($param=null)
	{
		$this->load->model('db_model');
		$post = $this->input->post();
		
		/*if($param=='kirim')
		{
			echo "asdasdsadasasdsasdsasadas";
			$jumlahdata = $this->db_model->jumlah_data('user_login');
			echo $jumlahdata + 1;	
		}else
		{
			$this->load->view('register');
		}*/
		$password= $this->input->post('password');
		$konfpassword= $this->input->post('konfpassword');

		if($konfpassword==$password)
		{
			if($param=='kirim')
			{
				if(!empty($post['nama']) && !empty($post['tanggal']) && !empty($post['gender']) && !empty($post['nohp']) && !empty($post['email']) && !empty($post['password']) )
				{
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
					redirect('utama/home');
					//print_r($data);
				}
				else
				{
					//berarti ada yang kosong field nya
				}
				
			}else
			{
				//kalo belom ada parameter kirim
				$this->load->view('register');
			}

		}else
		{
			//kalo password ga sama
			$this->load->view('register');
		}
		
	}

	public function home()
	{
		$this->load->view('home');
	}
}
