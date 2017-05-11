<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session'));
		$this->load->model('Db_model');
		$kode_resto = $this->session->userdata('kode_resto');
	}

	public function laporan()
	{
		$this->load->model('Model_pesanan_pelanggan');
		$koderesto = $this->session->userdata('kode_resto');
		$data_laporan = $this->Model_pesanan_pelanggan->laporan_jumlah_pesanan($koderesto);

		foreach ($data_laporan as $row) {	
			if($row->hari=="Monday")
			{
				$senin = $row->jumlah_pesanan;
			}else if($row->hari=="Tuesday"){
				$selasa = $row->jumlah_pesanan;
			}else if($row->hari=="Wednesday"){
				$rabu = $row->jumlah_pesanan;
			}else if($row->hari=="Thursday"){
				$kamis = $row->jumlah_pesanan;
			}else if($row->hari=="Friday"){
				$jumat = $row->jumlah_pesanan;
			}else if($row->hari=="Saturday"){
				$sabtu = $row->jumlah_pesanan;
			}else if($row->hari=="Sunday"){
				$minggu = $row->jumlah_pesanan;
			}
		}
		echo "Senin = ". $senin ."<br>";
		echo "Selasa = ". $selasa ."<br>";
		echo "rabu = ". $rabu ."<br>";
		echo "kamis = ". $kamis ."<br>";
		echo "jumat = ". $jumat ."<br>";
		echo "sabtu = ". $sabtu ."<br>";
		echo "minggu = ". $minggu ."<br>";
		
	}

	public function index()
	{
		$this->load->view('login_owner');
	}

	public function cek_reservasi()
	{
		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_pesanan_detail');
		$koderesto = $this->session->userdata('kode_resto');

		$idpesanan = $this->input->post('idpesanan');

		$data = array(
			'idpesanan' => $idpesanan,
			'record_pesanan_makanan' => $this->Model_pesanan_detail->cari_data_pesanan_untuk_pelanggan($idpesanan,$koderesto),
			'record_pesanan_meja' => $this->Model_pesanan_pelanggan->cari_data_pesanan_pelanggan($idpesanan,$koderesto)
		);
		
		$this->load->view('dashboard_cek_reservasi',$data);
	}

	public function register_resto()
	{
		$this->load->library('email');

		$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "resto.stts@gmail.com";
        $config['smtp_pass'] = "twfan1204";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

		$this->email->initialize($config);

		$this->load->model('Db_model');
		$this->load->model('Model_saldo_resto_detail');
		$this->load->model('Model_saldo_resto');
		$this->load->model('Model_owner');
		$this->load->library('encryption');
		$post = $this->input->post();
		$password = $this->input->post('password');
		$password_enc = $this->encryption->encrypt($password);

		$konfpassword = $this->input->post('konf_password');
		if($password==$konfpassword)
		{

			if(!empty($post['nama_depan']) && !empty($post['nama_belakang']) && !empty($post['telpon']) && !empty($post['email'])  )
			{
				$cekemail = $this->Model_owner->cek_email($post['email']);
				if(count($cekemail)>0)
				{
					$this->session->set_flashdata('pesan','Email sama');
					redirect('owner/register_resto');
				}else
				{
					$jumlahdata = $this->Db_model->jumlah_data('owner_resto');
					$idresto = 'OR' . ($jumlahdata+1);
					$jumlahdata = $this->Model_saldo_resto->jumlah_data();
					$idsaldoresto = 'ISR' . ($jumlahdata+1);

					$data1=array(
						'kode_resto' => $idresto,
						'nama_depan' => $post['nama_depan'],
						'no_telp' => $post['telpon'],
						'email' => $post['email'],
						'password' => $password_enc,
						'status_akun' => 'FALSE'
						);
					$this->Db_model->tambah_data('owner_resto',$data1);

					$data2=array(
						'id_saldo_resto' => $idsaldoresto,
						'id_resto' => $idresto,
						'saldo' => 0,
						'status' => 1
						);
					$this->Model_saldo_resto->tambah_data($data2);

					$this->email->initialize($config);
					$link = base_url('owner/verifikasi/').'/'. $idresto;
					$htmlContent = '<h3>Terima kasih telah mendaftar</h3>';
					$htmlContent .= "<div>Silahkan klik link berikut untuk melakukan verifikasi email </div> <a href='$link'>$link</a>";

					$this->email->from('resto.stts@gmail.com', 'Resto.com');
					$this->email->to($post['email']);
					$this->email->subject('Verifikasi email');
					$this->email->message($htmlContent);

					if ($this->email->send()) {
						$this->session->set_flashdata('pesan','daftar berhasil');
					   	redirect('owner');
					} else {
					    show_error($this->email->print_debugger());
					}
				}
				
			}	
		}else
		{
			$this->session->set_flashdata('pesan','password dan ketik ulang password anda tidak sama');
			redirect('owner/register_resto');
		}
		

		$this->load->view('register_resto');
	}
	public function verifikasi($id)
	{
		$this->load->model('Model_owner');
		$data =array(
			'status_akun' => 'TRUE'
		);
		$this->Model_owner->update_data_user($id,'kode_resto',$data);
		$this->session->set_flashdata('pesan', 'Terima kasih anda telah melakukan verifikasi email.');
		redirect('owner');
	}
	public function login()
	{
		if($this->session->userdata('user_owner')==NULL)
		{
			$this->load->view('login_owner');
			$this->load->model('Model_owner');
			$this->load->library('encryption');
			$post = $this->input->post();
			if(!empty($post['email_login']) && !empty($post['password_login']))
			{
				
				$email = $post['email_login'];
				$data = $this->Model_owner->decrypt_password($email);
				$password_enc = $data[0]['password'];
				$password_dec = $this->encryption->decrypt($password_enc);
				if($password_dec==$post['password_login'])
				{
					
					$this->session->set_userdata('user_owner', $data[0]['nama_depan']);
					$this->session->set_userdata('kode_resto', $data[0]['kode_resto']);
					
					redirect('owner/dashboard_owner');
				}else
				{
					
					$this->session->set_flashdata('pesan','email pass salah');
					redirect('owner/login');
				}
				/*echo $data[0]['password'];*/
				/*$data=array(
					'email' => $post['email_login'],
					'password' => $post['password_login']
					);
				$hasil = $this->Db_model->login('owner_resto',$data);
				echo count($hasil);
				
				if(count($hasil)==1)
				{
					
					$this->session->set_userdata('user_owner', $hasil[0]['nama_depan']);
					$this->session->set_userdata('kode_resto', $hasil[0]['kode_resto']);
					
					redirect('owner/dashboard_owner');
				}else
				{
					
					$this->session->set_flashdata('pesan','Kombinasi email / password anda salah');
					redirect('owner/login');
				}*/
			}
		}else
		{
			echo "masuk 2";
			redirect('owner/dashboard_owner');
		}
	}

	public function dashboard_owner()
	{
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{

			$kode_resto = $this->session->userdata('kode_resto');
			$data = array(
				'record_pesanan' => $this->Db_model->baca_data_pesanan_untuk_owner($kode_resto)
			);
			$this->load->view('dashboard_blank',$data);
		}
		
	}
	public function dashboard_about()
	{
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$kode_resto = $this->session->userdata('kode_resto');
			$cek_data = $this->Db_model->read_data('about_resto',$kode_resto);
			if($cek_data=="data ada")
			{
				/*echo "benar1";*/
				$cek_data = $this->Db_model->read_data('menu_resto',$kode_resto);
				if($cek_data=="data ada")
				{
					/*echo "benar2";*/
					$cek_data = $this->Db_model->read_data('foto_resto',$kode_resto);
					if($cek_data=="data ada")
					{
						/*echo "benar3";*/
						$data = array(
							'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
							'record_menu' => $this->Db_model->read('menu_resto',$kode_resto),
							'record_foto' => $this->Db_model->read('foto_resto',$kode_resto)
						);
						$this->load->view('dashboard_about',$data);
					}else
					{
						/*echo "salah3";*/
						$data = array(
							'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
							'record_menu' => $this->Db_model->read('menu_resto',$kode_resto)
						);
						$this->load->view('dashboard_about',$data);
					}
				}else
				{
					/*echo "salah2";*/
					$data = array(
							'record' => $this->Db_model->cari_data('about_resto',$kode_resto)
						);
						$this->load->view('dashboard_about',$data);
				}
				
			}else
			{
				/*echo "salah1";*/
				$this->load->view('dashboard_about_without_data');
			}
			
			
		}
	}

	public function about_system()
	{
		$this->load->model('Db_model');
		$post = $this->input->post();
		
		$kode_resto = $this->session->userdata('kode_resto');
		$cek_data = $this->Db_model->read_data('about_resto',$kode_resto);

		$config['upload_path'] = './uploads/resto_profile/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1024;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['overwrite'] = TRUE;
		$config['file_name'] = $kode_resto;
		
		$this->load->library('upload', $config);

		if($cek_data=="data ada")
		{
			if($this->upload->do_upload('userfile'))
			{
				$upload_data = $this->upload->data();
				/*var_dump($upload_data);*/
				$gambar_resto = base_url()."uploads/resto_profile/". $upload_data['file_name'];
				$data=array(
								'nama_resto' => $post['namaresto'],
								'foto_resto' => $gambar_resto,
								'alamat_resto' => $post['alamatresto'],
								'no_telfon' => $post['notelfonresto'],
								'jadwal_buka' => $post['jadwal'],
								'tipe_sajian' => $post['sajian'],
								'harga_terendah' => $post['terendah'],
								'harga_tertinggi' => $post['tertinggi'],
								'metode_pembayaran' => $post['pembayaran'],
								'biaya_kursi' => $post['biayakursi'],
								'kuota_harian' => $post['kuotajam'],
								'sms' => $post['sms'],
								'email' => $post['emal'],
								'status' => 'TRUE'
								);
					$this->Db_model->update_data($kode_resto,$data);
					$this->session->set_flashdata('pesan','1');
					redirect('owner/dashboard_about');
			}else
			{
				echo $this->upload->display_errors();
				$data=array(
								'nama_resto' => $post['namaresto'],
								'alamat_resto' => $post['alamatresto'],
								'no_telfon' => $post['notelfonresto'],
								'jadwal_buka' => $post['jadwal'],
								'tipe_sajian' => $post['sajian'],
								'harga_terendah' => $post['terendah'],
								'harga_tertinggi' => $post['tertinggi'],
								'metode_pembayaran' => $post['pembayaran'],
								'biaya_kursi' => $post['biayakursi'],
								'kuota_harian' => $post['kuotajam'],
								'sms' => $post['sms'],
								'email' => $post['email'],
								'status' => 'TRUE'
								);
					$this->Db_model->update_data($kode_resto,$data);
					$this->session->set_flashdata('pesan','1');
					redirect('owner/dashboard_about');
			}
			
		}else
		{
			$jumlahdata = $this->Db_model->jumlah_data('about_resto');
			if(!empty($post['namaresto']) && !empty($post['alamatresto']) && !empty($post['notelfonresto']) && !empty($post['jadwal']) && !empty($post['sajian']) && !empty($post['terendah']) && !empty($post['tertinggi']) && !empty($post['terendah']) && !empty($post['pembayaran']))
			{
				if($this->upload->do_upload('userfile'))
				{
					$upload_data = $this->upload->data();
					$gambar_resto = base_url()."uploads/resto_profile/". $upload_data['file_name'];
				}
				$idabout = 'AR' . ($jumlahdata+1);
				$data=array(
							'kode_about' => $idabout,
							'kode_resto' => $this->session->userdata('kode_resto'),
							'nama_resto' => $post['namaresto'],
							'foto_resto' => $gambar_resto,
							'alamat_resto' => $post['alamatresto'],
							'no_telfon' => $post['notelfonresto'],
							'jadwal_buka' => $post['jadwal'],
							'tipe_sajian' => $post['sajian'],
							'harga_terendah' => $post['terendah'],
							'harga_tertinggi' => $post['tertinggi'],
							'metode_pembayaran' => $post['pembayaran'],
							'status' => 'TRUE'
							);
				$this->Db_model->tambah_data('about_resto',$data);
				redirect('owner/dashboard_about');
			}
		}
		
		
		/*$nama_resto = $this->input->post('namaresto');
		echo $nama_resto;*/
	
		
	}

	public function about_system_makanan()
	{
		$this->load->model('Db_model');
		$post = $this->input->post();
		$kode_resto = $this->session->userdata('kode_resto');
		
		$jumlahdata = $this->Db_model->jumlah_data('menu_resto');
		if(!empty($post['namamakanan']) && !empty($post['deskripsimakanan']) && !empty($post['hargamakanan']))
		{
			$idmenu = 'ME'.($jumlahdata+1);
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 1024;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
			$config['overwrite'] = TRUE;
			$config['file_name'] = $idmenu;

			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('userfile'))
			{
				$upload_data = $this->upload->data();
				$gambar_makanan = base_url()."uploads/". $upload_data['file_name'];

			
			$data=array(
						'kode_menu' => $idmenu,
						'kode_resto' => $kode_resto,
						'nama_makanan' => $post['namamakanan'],
						'deskripsi' => $post['deskripsimakanan'],
						'harga' => $post['hargamakanan'],
						'foto_makanan' => $gambar_makanan,
						'status' => 'TRUE'
				);
			
			$this->Db_model->tambah_data('menu_resto',$data);
			$this->session->set_flashdata('pesan','1');
			redirect('owner/dashboard_owner_menu');
			}else
			{
				echo $this->upload->display_errors();
			}
			

		}else
		{
			$this->session->set_flashdata('pesan','form_tidak_lengkap');
			redirect('owner/dashboard_owner_menu');
		}
	}

	public function about_system_foto()
	{
		$this->load->model('Db_model');
		$post = $this->input->post();
		$kode_resto = $this->session->userdata('kode_resto');
		if($this->Db_model->read_jumlah_data_batasan('foto_resto',$kode_resto)=="bisa")
		{
			$jumlahdata = $this->Db_model->jumlah_data('foto_resto');
		
			$config['upload_path'] = './uploads/foto_resto/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 1024;
			$config['max_width'] = 1024;
			$config['max_height'] = 1024;
			$config['file_name'] = $kode_resto;

			$this->load->library('upload', $config);
			if($this->upload->do_upload('userfile'))
			{
				$upload_data = $this->upload->data();
				$gambar_resto = base_url()."uploads/foto_resto/". $upload_data['file_name'];

				
				$data=array(
							'kode_resto' => $kode_resto,
							'path_foto' => $gambar_resto,
							'status' => 'TRUE'
					);
				//echo print_r($data);
				$this->Db_model->tambah_data('foto_resto',$data);
				redirect('owner/dashboard_owner_foto');
			}else
			{
				echo $this->upload->display_errors();
			}
		}else
		{
			redirect('owner/dashboard_owner_foto');
		}
		
	}

	public function dashboard_owner_foto()
	{
		$this->load->model('Db_model');
		$kode_resto = $this->session->userdata('kode_resto');
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$cek_data = $this->Db_model->read_data('about_resto',$kode_resto);
			if($cek_data=="data ada")
			{
				$data = array(
					'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
					'record_menu' => $this->Db_model->read('menu_resto',$kode_resto),
					'record_foto' => $this->Db_model->read('foto_resto',$kode_resto)
				);

				$this->load->view('dashboard_about_foto',$data);
			}else
			{
				$this->load->view('dashboard_about_without_data');
			}
			
		}
	}

	public function hapus_foto($id="")
	{
		$this->load->model('Db_model');
		$this->Db_model->delete_foto($id);
		redirect(base_url('owner/dashboard_owner_foto'));
	}

	public function dashboard_owner_menu()
	{
		$this->load->model('Db_model');
		$kode_resto = $this->session->userdata('kode_resto');
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$cek_data = $this->Db_model->read_data('about_resto',$kode_resto);
			if($cek_data=="data ada")
			{
				$data = array(
					'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
					'record_menu' => $this->Db_model->read('menu_resto',$kode_resto)
				);

				$this->load->view('dashboard_about_menu',$data);
			}else
			{
				$this->load->view('dashboard_about_without_data');
			}
			
		}
	}

	public function edit_menu($id="")
	{
		
		$this->load->model('Db_model');
		$kode_resto = $this->session->userdata('kode_resto');
		if($id!="" && !empty($id)){
			$data = array(
					'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
					'record_menu' => $this->Db_model->read('menu_resto',$kode_resto),
					'record_edit' => $this->Db_model->edit($id,'menu_resto')
				);
			$this->load->view('dashboard_about_menu_edit',$data);
		}else
		{
			$data = array(
					'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
					'record_menu' => $this->Db_model->read('menu_resto',$kode_resto)
				);

				$this->load->view('dashboard_about_menu',$data);
		}
	}

	public function update_makanan()
	{
		$post = $this->input->post();

		$kode_menu = $this->input->post('id');
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 250;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['overwrite'] = TRUE;
		$config['file_name'] = $kode_menu;

		$this->load->library('upload', $config);


		if(!empty($post['namamakanan']) && !empty($post['deskripsimakanan']) && !empty($post['hargamakanan'])){
			$this->load->model('Db_model');

			if($this->upload->do_upload('userfile'))
			{
				$upload_data = $this->upload->data();
				$gambar_makanan = base_url()."uploads/". $upload_data['file_name'];
				$data = array(
					'nama_makanan' => $post['namamakanan'],
					'deskripsi' => $post['deskripsimakanan'],
					'foto_makanan' => $gambar_makanan,
					'harga' => $post['hargamakanan']
				);		
				
			$this->Db_model->update($post['id'],$data,'menu_resto');
			redirect(base_url('owner/dashboard_owner_menu'));
			}else
			{
				echo $this->upload->display_errors();
			}


			/*
			$this->Db_model->update($post['id'],$data,'menu_resto');
			redirect(base_url('owner/dashboard_owner_menu'));*/
		}
	}

	public function hapus_makanan($id="")
	{
		$this->load->model('Db_model');
		$this->Db_model->delete_menu($id);
		redirect(base_url('owner/dashboard_owner_menu'));
	}

	public function dashboard_reservation()
	{
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$this->load->view('dashboard_reservation');	
		}
		
	}
	public function dashboard_photo()
	{
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$this->load->view('dashboard_photo');	
		}
		
	}
	public function dashboard_menu()
	{
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$this->load->view('dashboard_menu');	
		}
		
	}

	public function log_out()
	{
		$this->session->unset_userdata('user_owner');
		redirect('owner/login');
	}


	public function contoh()
	{
		$this->load->view('dashboard_about');
	}


	public function terima_pemesanan($idpemesanan)
	{
		$this->load->model('Db_model');
		$data = array(
			'status_pemesanan' => 'lanjut pembayaran'
		);
		$this->Db_model->update_data_bener($idpemesanan,'pesanan_pelanggan','id_pesanan',$data);
		redirect('owner/dashboard_owner');
	}

	public function tolak_pemesanan($idpemesanan)
	{

	}

}
