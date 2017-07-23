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

	public function upgrade_akun()
	{
		$this->load->model('Model_owner');
		$this->load->model('Model_saldo_resto');
		$koderesto = $this->session->userdata('kode_resto');
		$saldo = $this->Model_saldo_resto->baca_saldo($koderesto);
		$hasil = $this->Model_owner->baca_status_upgrade($koderesto);
		if($hasil==0)
		{
			$data = array(
				'saldo'=> $saldo
			);

			$this->load->view('dashboard_upgrade',$data);
		}else
		{
			$this->load->view('dashboard_sudah_upgrade');
		}
	}

	public function laporan()
	{
		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_resto');
		$koderesto = $this->session->userdata('kode_resto');
		$hasil = $this->Model_resto->nama_resto($koderesto);
		$nama_resto= "nama restaurant";
		foreach ($hasil as $row) {
			$nama_resto = $row->nama_resto;
		}
		if($nama_resto==NULL)
		{
			$nama_resto="nama restaurant";
		}
		
		
		$data_laporan = $this->Model_pesanan_pelanggan->laporan_jumlah_pesanan($koderesto);
		
		$senin=0;
		$selasa=0;
		$rabu=0;
		$kamis=0;
		$jumat=0;
		$sabtu=0;
		$minggu=0;
		
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

		$data = array(
			'senin' => $senin,
			'selasa' => $selasa,
			'rabu' => $rabu,
			'kamis' => $kamis,
			'jumat' => $jumat,
			'sabtu' => $sabtu,
			'minggu' => $minggu,
			'nama_resto' => $nama_resto
		);


		$this->load->view('dashboard_laporan',$data);
		
	}

	public function index()
	{
		/*$this->load->view('login_owner');
		*/
		$this->load->Model('Db_model');
		$post = $this->input->post();
		$bulan = $post['bulan'];

			
			$data_laporan = $this->Db_model->getall('penjualanpos',$bulan);
			ini_set('max_execution_time', 300);
		var_dump($data_laporan);
	/*	$senin=0;
		$selasa=0;
		$rabu=0;
		$kamis=0;
		$jumat=0;
		$sabtu=0;
		$minggu=0;
		
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

		$data = array(
			'senin' => $senin,
			'selasa' => $selasa,
			'rabu' => $rabu,
			'kamis' => $kamis,
			'jumat' => $jumat,
			'sabtu' => $sabtu,
			'minggu' => $minggu,
			'nama_resto' => "laporan"
		);
		$this->load->view('dashboard_laporan',$data);
		/*echo "<pre>". var_dump($data). "</pre>";*/
	/*	$this->load->view('tes',$data);*/

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
		$this->load->model('Model_rating');
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

					$data3=array(
						'kode_resto'=>$idresto,
						'rating' => '0',
						'status' => 1
						);
					$this->Model_rating->tambah_data($data3);
					redirect('owner');

					/*
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
					   	
					} else {
					    show_error($this->email->print_debugger());
					}*/
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
			$tanggal_sekarang = date('Y-m-d');
			if(!empty($post['email_login']) && !empty($post['password_login']))
			{

				$email = $post['email_login'];
				$data = $this->Model_owner->decrypt_password($email);
				$password_enc = $data[0]['password'];
				$password_dec = $this->encryption->decrypt($password_enc);
				
				if($password_dec==$post['password_login'] && $email==$data[0]['email'])
				{
					if( $data[0]['status_akun']=="TRUE")
					{
						$this->session->set_userdata('user_owner', $data[0]['nama_depan']);
						$this->session->set_userdata('kode_resto', $data[0]['kode_resto']);
						$koderesto = $this->session->userdata['kode_resto'];
						echo $tanggal_sekarang; 
						echo $this->Model_owner->get_tanggal_selesai($post['email_login']);
						
						if($this->Model_owner->get_tanggal_selesai($post['email_login'])<$tanggal_sekarang)
						{
							$data = array(
								'status_upgrade' => 0
								
							);
							
							$this->Model_owner->update_upgrade($koderesto,$data);
							
						}
					
						redirect('owner/dashboard_owner');
					}else
					{
						$this->session->set_flashdata('pesan','verifikasi_0');
						redirect('owner/login');
					}
				}else
				{
					$this->session->set_flashdata('pesan','tidak_terdaftar');
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
		$this->load->model('Model_resto');
		$this->load->model('Model_owner');
		if($this->session->userdata('user_owner')==NULL)
		{
			redirect('owner/login');
		}else
		{
			$kode_resto = $this->session->userdata('kode_resto');
			$cek_data = $this->Db_model->read_data('about_resto',$kode_resto);
			$status_upgrade = $this->Model_owner->baca_status_upgrade($kode_resto);
			if($cek_data=="data ada")
			{
				/*echo "benar1";*/
				$cek_data = $this->Db_model->read_data('menu_resto',$kode_resto);
				
				if($cek_data=="data ada")
				{
					/*echo "benar2";*/
						$opt = array(
							'seafood' => 'Sea food',
							'chinese' => 'Chinese food',
							'japanese' => 'Japanese food',
							'local' => 'Local food',
							);
					$cek_data = $this->Db_model->read_data('foto_resto',$kode_resto);

					if($cek_data=="data ada")
					{
						/*echo "benar3";*/
						$opt = array(
							'seafood' => 'Sea food',
							'chinese' => 'Chinese food',
							'japanese' => 'Japanese food',
							'local' => 'Local food',
							);

						$data = array(
							'opt' => $opt,
							'selected_opt' => $this->Model_resto->baca_selected($kode_resto),
							'status_upgrade' => $status_upgrade,
							'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
							'record_menu' => $this->Db_model->read('menu_resto',$kode_resto),
							'record_foto' => $this->Db_model->read('foto_resto',$kode_resto)
						);
						$this->load->view('dashboard_about',$data);
					}else
					{
						/*echo "salah3";*/
						$opt = array(
							'seafood' => 'Sea food',
							'chinese' => 'Chinese food',
							'japanese' => 'Japanese food',
							'local' => 'Local food',
							);
						$data = array(
							'opt' => $opt,
							'selected_opt' => $this->Model_resto->baca_selected($kode_resto),
							'status_upgrade' => $status_upgrade,
							'record' => $this->Db_model->cari_data('about_resto',$kode_resto),
							'record_menu' => $this->Db_model->read('menu_resto',$kode_resto)
						);
						$this->load->view('dashboard_about',$data);
					}
				}else
				{
					/*echo "salah2";*/
						$opt = array(
							'seafood' => 'Sea food',
							'chinese' => 'Chinese food',
							'japanese' => 'Japanese food',
							'local' => 'Local food',
							);
					$data = array(
							'opt' => $opt,
							'selected_opt' => $this->Model_resto->baca_selected($kode_resto),
							'status_upgrade' => $status_upgrade,
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
		$config['max_width'] = 2500;
		$config['max_height'] = 2500;
		$config['overwrite'] = TRUE;
		$config['file_name'] = $kode_resto;
		
		$this->load->library('upload', $config);
		/*echo "<pre>";
		var_dump($post);
		echo "</pre>";*/
		if($cek_data=="data ada")
		{
			if($this->upload->do_upload('userfile'))
			{
				$upload_data = $this->upload->data();
				
				$gambar_resto = base_url()."uploads/resto_profile/". $upload_data['file_name'];
				$data=array(
								'nama_resto' => $post['namaresto'],
								'foto_resto' => $gambar_resto,
								'alamat_resto' => $post['alamatresto'],
								'kota' => $post['kota'],
								'no_telfon' => $post['notelfonresto'],
								'jadwal_buka' => $post['jadwal'],
								'tipe_sajian' => json_encode($post['masakan']),
								'halal' => $post['halal'],
								'harga_terendah' => $post['terendah'],
								'harga_tertinggi' => $post['tertinggi'],
								'metode_pembayaran' => $post['pembayaran'],
								'biaya_kursi' => $post['biayakursi'],
								'kota' => $post['kota'],
								'sms' => $post['sms'],
								'email' => $post['emal'],
								'status' => 'TRUE'
								);
					$this->Db_model->update_data($kode_resto,$data);
					$this->session->set_flashdata('pesan','1');
					redirect('owner/dashboard_about');
			}else
			{
				/*echo $this->upload->display_errors();*/
				
				$data=array(
								'nama_resto' => $post['namaresto'],
								'alamat_resto' => $post['alamatresto'],
								'kota' => $post['kota'],
								'no_telfon' => $post['notelfonresto'],
								'jadwal_buka' => $post['jadwal'],
								'tipe_sajian' => json_encode($post['masakan']),
								'halal' => $post['halal'],
								'harga_terendah' => $post['terendah'],
								'harga_tertinggi' => $post['tertinggi'],
								'metode_pembayaran' => $post['pembayaran'],
								'biaya_kursi' => $post['biayakursi'],
								'sms' => $post['sms'],
								'email' => $post['email'],
								'status' => 'TRUE'
								);
					$this->Db_model->update_data($kode_resto,$data);
					$this->session->set_flashdata('pesan','2');
					redirect('owner/dashboard_about');
			}
			
		}else
		{
			$jumlahdata = $this->Db_model->jumlah_data('about_resto');
				
				if($this->upload->do_upload('userfile'))
				{
					$upload_data = $this->upload->data();
					$gambar_resto = base_url()."uploads/resto_profile/". $upload_data['file_name'];
					$idabout = 'AR' . ($jumlahdata+1);
					$data=array(
								'kode_about' => $idabout,
								'kode_resto' => $this->session->userdata('kode_resto'),
								'nama_resto' => $post['namaresto'],
								'foto_resto' => $gambar_resto,
								'alamat_resto' => $post['alamatresto'],
								'kota' => $post['kota'],
								'no_telfon' => $post['notelfonresto'],
								'jadwal_buka' => $post['jadwal'],
								'tipe_sajian' => json_encode($post['masakan']),
								'halal' => $post['halal'],
								'harga_terendah' => $post['terendah'],
								'harga_tertinggi' => $post['tertinggi'],
								'metode_pembayaran' => $post['pembayaran'],
								'biaya_kursi' => $post['biayakursi'],
								'sms' => $post['sms'],
								'email' => $post['email'],
								'status' => 'TRUE'
								);
					$this->Db_model->tambah_data('about_resto',$data);
					$this->session->set_flashdata('pesan','1');
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
			$config['max_width'] = 2500;
			$config['max_height'] = 2500;
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
			$this->session->set_flashdata('menu','1');
			redirect('owner/dashboard_owner_menu');
			}else
			{
				$this->session->set_flashdata('menu','2');
				redirect('owner/dashboard_owner_menu');
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
			$config['max_width'] = 2500;
			$config['max_height'] = 2500;
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
				$this->session->set_flashdata('foto','1');
				$this->Db_model->tambah_data('foto_resto',$data);
				redirect('owner/dashboard_owner_foto');
				
			}else
			{
				
				$this->session->set_flashdata('foto','2');
				redirect('owner/dashboard_owner_foto');
			}
		}else
		{
			$this->session->set_flashdata('foto','3');
			redirect('owner/dashboard_owner_foto');
		}
		
	}
	public function pasang_iklan($idresto)
	{
		$this->load->model('Model_owner');
		$this->load->model('Model_saldo_resto');
		$koderesto = $this->session->userdata('kode_resto');
		$saldo = $this->Model_saldo_resto->baca_saldo($koderesto);
		$hasil = $this->Model_owner->baca_status_upgrade($koderesto);
		if($hasil==0)
		{
			redirect('owner/dashboard_about');
		}else
		{
			$this->load->view('iklan');
		}

		
	}

	public function about_system_iklan()
	{
		$this->load->model('Db_model');
		$this->load->model('Model_owner');
		$this->load->model('Model_iklan');

		$post = $this->input->post();
		$idresto = $post['koderesto'];
		$tanggal_selesai = $this->Model_owner->baca_tgl_selesai($idresto);
		$config['upload_path'] = './uploads/iklan/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2500;
		$config['max_width'] = 1500;
		$config['max_height'] = 750;
		$config['overwrite'] = TRUE;
		$config['file_name'] = 'iklan_'.$idresto;
		
		
		$this->load->library('upload', $config);

		$upload_data = $this->upload->data();

		if($this->upload->do_upload('userfile'))
		{
			if($this->Model_iklan->jumlahdata($idresto)==0)
			{
				$upload_data = $this->upload->data();
				
				$gambar_resto = base_url()."uploads/iklan/". $upload_data['file_name'];
				$data=array(
					'kode_resto' => $idresto,
					'path_iklan' => $gambar_resto,
					'tanggal_selesai' => $tanggal_selesai,
					'status' => 1
				);
				$this->Model_iklan->insert_data($data);
			}else
			{
				$upload_data = $this->upload->data();
				$config['file_name'] = 'iklan_'.$idresto;
				$gambar_resto = base_url()."uploads/iklan/". $upload_data['file_name'];
				$data=array(
					'path_iklan' => $gambar_resto,
					'tanggal_selesai' => $tanggal_selesai,
					'status' => 1

				);
				$this->Model_iklan->update_data($kode_resto,$data);
			}
			
			$this->session->set_flashdata('pesan','1');
			redirect('owner/dashboard_about');
		}else
		{
			$this->session->set_flashdata('pesan','3');
			redirect('owner/dashboard_about');
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
			$this->session->set_flashdata('update','1');
			$this->Db_model->update($post['id'],$data,'menu_resto');
			redirect(base_url('owner/dashboard_owner_menu'));
			}else
			{
				$data = array(
					'nama_makanan' => $post['namamakanan'],
					'deskripsi' => $post['deskripsimakanan'],
					'harga' => $post['hargamakanan']
				);		
			$this->session->set_flashdata('update','1');
			$this->Db_model->update($post['id'],$data,'menu_resto');
			redirect(base_url('owner/dashboard_owner_menu'));
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

	

	public function bayar_upgrade_saldo()
	{
		$this->load->model('Model_bayar_upgrade');
		$this->load->model('Model_owner');
		$this->load->model('Model_saldo_resto');
		$this->load->model('Model_saldo_resto_detail');
		$koderesto = $this->session->userdata('kode_resto');
		$post = $this->input->post();
		$saldo = $post['saldo'];
		if($saldo<15000)
		{
			$this->session->set_flashdata('pesan','saldo_kurang');
			redirect('owner/dashboard_about');
		}else
		{
			$saldo_akhir = $saldo-15000;

			$jumlahdata = $this->Model_saldo_resto_detail->jumlah_data();
			$idsaldodetail = 'ISRD'.($jumlahdata+1);
			$data = array(
				'id_saldo_resto_detail' => $idsaldodetail,
				'id_resto' => $koderesto,
				'id_pesanan' => 'UG',
				'jumlah_terima_saldo' => -15000,
				'status' => 1
			);
			$this->Model_saldo_resto_detail->tambah_data($data);

			$data_saldo = array(
				'saldo' => $saldo_akhir
			);
			$this->Model_saldo_resto->update_saldo($koderesto,$data_saldo);

			
			$tanggal_awal =  date('Y-m-d');
			$tanggal_selesai = date('Y-m-d',strtotime($tanggal_awal.'+30 day'));
			$data1 = array(
				'status_upgrade' => 1,
				'tanggal_awal' => $tanggal_awal,
				'tanggal_selesai' => $tanggal_selesai
			);
			$this->Model_owner->update_upgrade($koderesto,$data1);


			$this->session->set_flashdata('pesan','berhasil_bayar');
			redirect('owner/upgrade_akun');
		}

	}

	public function proses_bayar_upgrade()
	{
		$this->load->model('Model_bayar_upgrade');
	
		$koderesto = $this->session->userdata('kode_resto');
		$post = $this->input->post();
		
		$jumlahdata = $this->Model_bayar_upgrade->jumlah_data();
		$id_pembayaran = 'UG' . ($jumlahdata+1);
	
		$config['upload_path'] = './uploads/pembayaran/upgrade/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1025;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['overwrite'] = TRUE;
		$config['file_name'] = $id_pembayaran;
		$this->load->library('upload', $config);
		
		
		$upload_data = $this->upload->data();

		if($upload_data['file_name']!="")
		{
			if($this->upload->do_upload('userfile'))
			{
				$upload_data = $this->upload->data();
				$gambar_bukti = base_url()."uploads/pembayaran/upgrade/". $upload_data['file_name'];
				$data = array(
					'id_bayar' => $id_pembayaran,
					'id_resto' => $koderesto,
					'path_foto' => $gambar_bukti,
					'status' => 0
				);
				$this->Model_bayar_upgrade->insert_data($data);

				$this->session->set_flashdata('pesan','1');
				redirect("owner/upgrade_akun/");
			}else
			{
				$this->session->set_flashdata('pesan','0');
				redirect("owner/upgrade_akun/");
			}
		}
	}

	public function pemasukan()
	{
		$this->load->model('Model_saldo_resto_detail');
		$this->load->model('Model_saldo_resto');
		$koderesto = $this->session->userdata['kode_resto'];
		
		
		/*echo"<pre>";
		var_dump($data);
		echo"</pre>";*/

		$data = array(
			'pemasukan' =>  $this->Model_saldo_resto_detail->get_data($koderesto),
			'saldo' => $this->Model_saldo_resto->baca_saldo($koderesto)
		);
		
		$this->load->view('dashboard_pemasukan',$data);
	}

	public function request_tarik()
	{
		$this->load->model('Model_penarikan_saldo');
		$post = $this->input->post();
		$saldo_resto = $post['saldo'];
		$jum_tarik = $post['tariksaldo'];
		$bank = $post['bank'];
		$rekening = $post['rekening'];
		$koderesto = $this->session->userdata['kode_resto'];
		if($jum_tarik>$saldo_resto)
		{
			$this->session->set_flashdata('tarik_saldo','saldo_kurang');
			redirect('owner/pemasukan');
		}else
		{
			$no_telp_admin = '085732777009';
			$message=urlencode("*****PENARIKAN SALDO RESTAURANT***** Admin, harap membuka user anda dikarenakan ada permintaan penarikan saldo dari restaurant dengan kode resto " .$koderesto." sejumlah Rp. ". number_format($jum_tarik).",00. Transfer ke bank ".$bank." dengan rekening ".$rekening.". Terima kasih. *pesan-meja-stts.com");
			$curlHandle = curl_init();
			$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$no_telp_admin&message=$message";
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);


			$data = array(
				'id_resto' => $koderesto,
				'jumlah_penarikan' => $jum_tarik,
				'bank' => $post['bank'],
				'rekening' => $post['rekening'],
				'status' => 0
			);
			$this->Model_penarikan_saldo->tambah_data($data);


			$this->session->set_flashdata('tarik_saldo','berhasil');
			redirect('owner/pemasukan');

		}

	}

}
