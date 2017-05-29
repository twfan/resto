<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session'));
		$this->load->model('Db_model');
	}

	public function fancy()
	{
		$this->load->view('view_fancybox');
	}
	public function json()
	{
		$this->load->view('json');
		
	}
	public function json_proses()
	{
		$post = $this->input->post();
		$kodepelanggan = $post['kode_pelanggan'];
		$this->load->model('Db_model');
		$data = $this->Db_model->baca_seluruh_table('user_login');
		header('Content-Type:application/json');
		echo json_encode($data);

	}

	public function pesan_makan($kode_resto,$idpesanan)
	{
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('Db_model');
			$this->load->model('Model_review');
			$data = array(
				'kode_resto' => $kode_resto,
				'id_pesanan' => $idpesanan,
				'record_resto' =>  $this->Db_model->cari_data('about_resto',$kode_resto),
				'record_foto' => $this->Db_model->cari_data('foto_resto',$kode_resto),
				'record_review' => $this->Model_review->baca_data_review()
			);
			$this->load->view('pesan_makanan',$data);
		}else
		{
			redirect('utama/login');
		}
	}

	public function proses_pesan_makan($kode_resto,$idpesanan)
	{
		$post = $this->input->post();
		$idpelanggan = $this->session->userdata['id_pelanggan'];
		$harga_satuan = $post['harga_satuan'];
		$sub_total_harga = $post['sub_total_harga'];
		$nama_makanan = $post['nama_makanan'];
		$qty = $post['qty'];
		$jumlahdata = count($nama_makanan);
		$data_makanan_yang_dibeli = array();
		$jumlah_makanan_yang_dibeli = array();
		$subharga_makanan_yang_dibeli = array();
		$j=0;
		for($i=0;$i<$jumlahdata;$i++)
		{
			if($qty[$i]!="0")
			{
				$data_makanan_yang_dibeli[$j] = $nama_makanan[$i];
				$jumlah_makanan_yang_dibeli[$j] = $qty[$i];
				$subharga_makanan_yang_dibeli[$j] = $sub_total_harga[$i];
				$j++;
			}
		}
		
		$total = 0;
		
		$this->load->model('Model_pesanan_detail');
		
		for($i=0;$i<count($data_makanan_yang_dibeli);$i++)
		{
			$jumlahdata = $this->Model_pesanan_detail->jumlah_data();
			$iddetail = 'PPD' . ($jumlahdata+1);
			$data = array(
				'id_pesanan_detail' => $iddetail,
				'id_pesanan' =>$idpesanan,
				'kode_resto' =>$kode_resto,
				'id_pelanggan' =>$idpelanggan,
				'nama_makanan' =>$data_makanan_yang_dibeli[$i],
				'jumlah_makanan' =>$jumlah_makanan_yang_dibeli[$i],
				'sub_harga_makanan' =>$subharga_makanan_yang_dibeli[$i],
				'status' =>"true"
			);
			$this->Model_pesanan_detail->tambah_data($data);
		}
		redirect("utama/detail_page/".$idpesanan);
	}

	public function detail_page($idpesanan)
	{
		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_pesanan_detail');
		$harga = $this->Model_pesanan_detail->baca_harga($idpesanan);
		$total = 0;
		foreach ($harga as $row) {
			$total = $total+$row->sub_harga_makanan;
		}

		$data = array(
			'idpesanan' => $idpesanan,
			'total' => $total,
			'record_pesanan_makanan' => $this->Model_pesanan_detail->baca_data_pesanan_untuk_pelanggan($idpesanan),
			'record_pesanan_meja' => $this->Model_pesanan_pelanggan->baca_data_pesanan_untuk_pelanggan_idpesanan($idpesanan)
		);
		$this->load->view('detail_page',$data);
	}

	public function bayar($idpesanan)
	{
		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_saldo');
		/*$status_bayar = $this->Model_pesanan_pelanggan->baca_status_bayar($id_pesanan);*/
		$idpelanggan = $this->session->userdata('id_pelanggan');
		$saldo = $this->Model_saldo->baca_saldo($idpelanggan);
		$total = $this->Model_pesanan_pelanggan->baca_harga($idpesanan);
		foreach ($saldo as $row) {
			$saldo = $row->saldo;
		}
		foreach ($total as $row) {
			$total = $row->total_bayar;
		}
		
		$data = array(
			'idpesanan' => $idpesanan,
			'saldo' => $saldo,
			'total' => $total
		);
		$this->load->view('view_pilihan_bayar',$data);
	}

	public function bayar_saldo($idpesanan)
	{
		$post = $this->input->post();
		$saldo = $post['saldo'];
		$total_bayar = $post['totalbayar'];
		$potongan_website = (10/100*$total_bayar);
		$total_pendapatan_resto = $total_bayar - $potongan_website;
		$idpelanggan = $this->session->userdata('id_pelanggan');
		//CEK SUDAH BAYAR APA BELOM
		$this->load->model('Model_pesanan_pelanggan');
		$hasil_model_status =$this->Model_pesanan_pelanggan->baca_status_bayar($idpesanan);
		foreach ($hasil_model_status as $row) {
			$bukti_bayar = $row->bukti_bayar;
		}

		if($bukti_bayar==""){
			if($saldo>=$total_bayar)
			{
				$sisa_saldo = $saldo - $total_bayar;
				$this->load->model('Model_saldo');
				$data1 =array(
					'saldo' => $sisa_saldo
				);
				$this->Model_saldo->update_saldo($idpelanggan,$data1);
				$this->load->model('Model_saldo_resto');
				$this->load->model('Model_saldo_resto_detail');
				$this->load->model('Model_pembayaran_detail');
				
				$jumlahdata = $this->Model_pembayaran_detail->jumlah_data();
				$id_pembayaran = 'PD' . ($jumlahdata+1);
				$data2 = array(
						'id_pembayaran' =>$id_pembayaran,
						'id_pesanan' =>$idpesanan,
						'jumlah_transfer' =>$total_bayar,
						'cara_pembayaran' =>'saldo',
						'status' =>1
					);
				$this->Model_pembayaran_detail->insert_data($data2);
				$this->load->model('Model_pesanan_pelanggan');
				$data_foto = array(
						'bukti_bayar' => 'saldo',
						'status_pemesanan' => 'selesai'
					);
				$hasil = $this->Model_pesanan_pelanggan->baca_kode_resto($idpesanan);
				foreach ($hasil as $row) {
					$koderesto = $row->kode_resto;
				}
				$this->Model_pesanan_pelanggan->update_bukti($idpesanan,$data_foto);
				
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
				

				//SALDO WEBSITE

				$this->load->model('Model_saldo_website');
				$hasil_model = $this->Model_saldo_website->baca_saldo();
				foreach ($hasil_model as $row) {
					$saldo_website = $row->saldo;
				}
				$total_saldo_website = $saldo_website + $potongan_website;
				$data_saldo = array(
						'saldo' => $total_saldo_website
				);
				$this->Model_saldo_website->update_saldo($data_saldo);


				$this->load->model('Model_saldo_website_detail');
				$jumlahdata = $this->Model_saldo_website_detail->jumlah_data();
				$idsaldodetail = 'ISWD'.($jumlahdata+1);
				$data4 = array(
					'id_saldo_website_detail' => $idsaldodetail,
					'id_pesanan' => $idpesanan,
					'tanggal_terima' => date("Y-m-d"),
					'jumlah_terima' => $potongan_website
				);
				$this->Model_saldo_website_detail->tambah_data_terima_saldo($data4);
				
				//AKHIR SALDO WEBSITE
				$this->session->set_flashdata('pesan','berhasil_bayar');
				redirect("utama/bayar/".$idpesanan);

			}else{
				$this->session->set_flashdata('pesan','saldo_kurang');
				redirect('utama/bayar_saldo_kurang/'.$idpesanan);
			}
		}else
		{
			$this->session->set_flashdata('pesan','sudah_bayar');
			redirect('utama/bayar_saldo_kurang/'.$idpesanan);
		}
	}

	public function bayar_saldo_kurang($idpesanan)
	{
		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_saldo');
		$idpelanggan = $this->session->userdata('id_pelanggan');
		$saldo = $this->Model_saldo->baca_saldo($idpelanggan);
		$total = $this->Model_pesanan_pelanggan->baca_harga($idpesanan);
		foreach ($saldo as $row) {
			$saldo = $row->saldo;
		}
		foreach ($total as $row) {
			$total = $row->total_bayar;
		}
		
		$data = array(
			'idpesanan' => $idpesanan,
			'saldo' => $saldo,
			'total' => $total
		);
		$this->load->view('view_pilihan_bayar_saldo',$data);
	}

	public function proses_bayar_upload($idpesanan)
	{
		$this->load->model('Model_pembayaran_detail');
		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_owner');
		$this->load->model('Model_user');
		$this->session->userdata('id');
		$post = $this->input->post();
		$idpelanggan = $this->session->userdata('id_pelanggan');
		$koderesto=0;
		$no_telp_resto=0;

		//baca notelfon
		$hasil_koderesto = $this->Model_pesanan_pelanggan->baca_kode_resto($idpesanan);

		foreach ($hasil_koderesto as $row) {
			$koderesto= $row->kode_resto;
		}
			
		$hasil_telfon = $this->Model_owner->baca_telfon_resto($koderesto);
		foreach ($hasil_telfon as $row) {
			$no_telp_resto = $row->no_telp;
		}


		$hasil_telfon_pelanggan = $this->Model_user->baca_telfon_pelanggan($idpelanggan);
		foreach ($hasil_telfon_pelanggan as $row) {
			$no_telp_pelanggan = $row->no_handphone;
		}

		//cek status pesanan
		$hasil_model_status = $this->Model_pesanan_pelanggan->baca_status_bayar($idpesanan);
			foreach ($hasil_model_status as $row) {
			$bukti_bayar = $row->bukti_bayar;
		}

		if($bukti_bayar==""){
			$config['upload_path'] = './uploads/pembayaran/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 1025;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
			$config['overwrite'] = TRUE;
			$config['file_name'] = $idpesanan;
			$this->load->library('upload', $config);
			
			$jumlahdata = $this->Model_pembayaran_detail->jumlah_data();
			$id_pembayaran = 'PD' . ($jumlahdata+1);
			$upload_data = $this->upload->data();

			if($upload_data['file_name']!="")
			{
				if($this->upload->do_upload('userfile'))
				{
					$upload_data = $this->upload->data();
					$gambar_bukti = base_url()."uploads/pembayaran/". $upload_data['file_name'];
					$data = array(
						'id_pembayaran' =>$id_pembayaran,
						'id_pesanan' =>$idpesanan,
						'nama_rekening' =>$post['namarekening'],
						'jumlah_transfer' =>$post['jumlahtransfer'],
						'bank' =>$post['bank'],
						'bukti_transfer' =>$gambar_bukti,
						'cara_pembayaran' =>'transfer',
						'status' =>0
					);
					$this->Model_pembayaran_detail->insert_data($data);
					$data_foto = array(
						'bukti_bayar' => $gambar_bukti,
						'status_pemesanan' => 'pelanggan membayar'
					);
					$this->Model_pesanan_pelanggan->update_bukti($idpesanan,$data_foto);
					$this->session->set_flashdata('pesan','berhasil_bayar');

					//SMS PELANGGAN
					$message=urlencode("Hai, pesanan anda dan pembayaran anda berhasil masuk mohon di tunggu konfirmasi oleh pihak admin. Terimakasih. *pesan-meja-stts.com");
					$curlHandle = curl_init();
					$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$no_telp_pelanggan&message=$message";
					curl_setopt($curlHandle, CURLOPT_URL,$url);
					curl_setopt($curlHandle, CURLOPT_HEADER, 0);
					curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
					$hasil = curl_exec($curlHandle);
					curl_close($curlHandle);
					//SMS PELANGGAN

					//SMS ADMIN
					$no_telp_admin = '085732777009';
					$message=urlencode("Admin, harap membuka user anda dikarenakan ada pembayaran yang sedang berlangsung. Terimakasih. *pesan-meja-stts.com");
					$curlHandle = curl_init();
					$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$no_telp_admin&message=$message";
					curl_setopt($curlHandle, CURLOPT_URL,$url);
					curl_setopt($curlHandle, CURLOPT_HEADER, 0);
					curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
					$hasil = curl_exec($curlHandle);
					curl_close($curlHandle);
					//SMS PELANGGAN


					redirect("utama/bayar/".$idpesanan);
				}else
				{
					echo $this->upload->display_errors();
				}
			}else
			{
				$this->session->set_flashdata('pesan','Ukuran file gambar terlalu besar');
				$this->session->set_flashdata('pesan','berhasil_bayar');
				redirect('utama/bayar/'.$idpesanan);
				
			}
		}else{
			$this->session->set_flashdata('pesan','sudah_bayar');
			redirect('utama/bayar/'.$idpesanan);
		}

		
	}

	public function baca_menu()
	{
		$post = $this->input->post();
		$koderesto = $post['kode_resto'];
		$this->load->model('Db_model');
		$data = array(
			'kode_resto' => $koderesto
		);
		$data_hasil = $this->Db_model->cari_data_bener('menu_resto',$data);
		header('Content-Type:application/json');
		echo json_encode($data_hasil);
	}

	public function ajax_baca_harga()
	{
		$post = $this->input->post();
		$kode_menu = $post['kode_menu'];
		$this->load->model('Db_model');
		$data = $this->Db_model->cari_data_bener('menu_resto','kode_menu',$kode_menu);
		header('Content-Type:application/json');
		echo json_encode($data);
	}

	public function index()
	{
		$this->load->model('Db_model');
		$data = array(
			'record_resto' => $this->Db_model->baca_seluruh_table('about_resto')
		);
		$this->load->view('home',$data);
	}

	public function home()
	{
		redirect("utama/");
	}

	public function logged_in()
	{
		if($this->session->userdata('id_pelanggan')!="")
		{
			$this->load->model('Db_model');
			$this->load->model('Model_review');
			$hasil = $this->Model_review->baca_vote();
			$data = array(
				'record_resto' => $this->Db_model->baca_seluruh_table('about_resto'),
				'record_vote' => $this->Model_review->baca_vote()
			);
			$this->load->view('home_loggedin',$data);
		}else
		{
			redirect('utama/login');
		}
		
	}
	public function login()
	{
		if($this->session->userdata('user_pelanggan')==NULL)
		{
			$this->load->view('login_user');	
		}else
		{
			redirect('utama/logged_in');
		}
		
	}
	public function proses_login()
	{

		if($this->session->userdata('user_pelanggan')==NULL)
		{
			
			$this->load->model('Model_user');
			$this->load->library('encryption');

			$post = $this->input->post();
			$email = $post['email_login'];
			$password_login = $post['password_login'];
			$hasil = $this->Model_user->decrypt_password($email);
			
			$password_dec = $this->encryption->decrypt($hasil[0]['password']);
			
			if($password_login == $password_dec)
			{
				if( $hasil[0]['status_verifikasi']=="1")
				{
					$this->session->set_userdata('user_pelanggan', $hasil[0]['nama_user']);
					$this->session->set_userdata('id_pelanggan', $hasil[0]['id_user']);
					$this->session->set_userdata('email', $hasil[0]['email']);
					redirect('utama/logged_in');
				}else
				{
					$this->session->set_flashdata('pesan','verifikasi_0');
					redirect('utama/login');
				}
					
			}else
			{
				$this->session->set_flashdata('pesan','kombinasi_salah');
				redirect('utama/login');
			}
		}else
		{
			redirect('utama/logged_in');
		}

	}

	public function home_resto($kode_resto)
	{
		$query ="SELECT user_login.nama_user, review_pelanggan.judul_review, review_pelanggan.review_pelanggan, review_pelanggan.rating, review_pelanggan.tanggal_review FROM review_pelanggan, user_login WHERE review_pelanggan.id_resto='$kode_resto' AND user_login.id_user = review_pelanggan.id_pelanggan";
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('Db_model');
			$data = array(
				'record_resto' =>  $this->Db_model->cari_data('about_resto',$kode_resto),
				'record_foto' => $this->Db_model->cari_data('foto_resto',$kode_resto),
				'record_review' => $this->Db_model->baca_data_dengan_query_custom($query)
			);
			$this->load->view('home_resto',$data);
		}else
		{
			redirect('utama/login');
		}
		
	}


	public function pelanggan()
	{
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('Model_pesanan_pelanggan');
			$idpelanggan = $this->session->userdata('id_pelanggan');
			$data = array(
				'record_pesanan' =>  $this->Model_pesanan_pelanggan->list_pesanan($idpelanggan),
				'record_pesanan_berhasil' => $this->Model_pesanan_pelanggan->list_pesanan_berhasil($idpelanggan)
			);
			
			$this->load->view('homepage_user_pesanan',$data);
		}else
		{
			redirect('utama/login');
		}
		
	}

	public function pelanggan_data_diri()
	{
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('Db_model');
			$this->load->model('Model_user');
			$iduser = $this->session->userdata('id_pelanggan');
			
		
			
			$data = array(
				'record' => $this->Model_user->baca_data_table('user_login','id_user',$iduser)
			);
			 $this->load->view('homepage_user_data_diri',$data);
		}else
		{
			redirect('utama/login');
		}
		
	}
	public function update_data_diri()
	{
		$this->load->library('encryption');
		$this->load->model('Db_model');
		$post = $this->input->post();
		$password = $post['password'];
		$confpassword = $post['confpassword'];
		$iduser = $this->session->userdata('id_pelanggan');
		if($password==$confpassword)
		{
			if(!empty($post['namauser']) && !empty($post['nohp']) && !empty($post['email']) && !empty($post['password']))
			{
				$password= $this->input->post('password');
				$password_enc = $this->encryption->encrypt($password);

				$data=array(
					'nama_user' => $post['namauser'],
					'no_handphone' => $post['nohp'],
					'email' => $post['email'],
					'password' =>$password_enc
					);
				$this->Db_model->update_data_bener($iduser,'user_login','id_user',$data);
				$this->session->set_flashdata('berhasil','Update berhasil');
				redirect('utama/pelanggan_data_diri');
			}
		}else
		{
			$this->session->set_flashdata('password_tidak_kembar','Kombinasi password dan konfirmasi password tidak sama');
			redirect('utama/pelanggan_data_diri');
		}
	}

	


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('utama');
	}


	public function registerpelanggan()
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
		$post = $this->input->post();
		$this->load->library('encryption');
		$password= $this->input->post('password');
		$password_enc = $this->encryption->encrypt($password);


		$konfpassword= $this->input->post('konfpassword');
		if($konfpassword==$password)
		{
				
				if(!empty($post['namauser']) && !empty($post['tanggal']) && !empty($post['gender']) && !empty($post['nohp']) && !empty($post['email']) && !empty($post['password']) )
				{
					
					$cekemail = $this->Db_model->cek_email($post['email']);
					
					if(count($cekemail)>=1)
					{
						
						$this->session->set_flashdata('pesan','email_kembar');
						
					}else
					{
					
						$jumlahdata = $this->Db_model->jumlah_data('user_login');
						$iduser = 'UL' . ($jumlahdata+1);
						$jumlahdata = $this->Db_model->jumlah_data('user_login');
						$idsaldo = 'IS' . ($jumlahdata+1);

						$data=array(
							'id_user' => $iduser,
							'nama_user' => $post['namauser'],
							'jenis_kelamin' => $post['gender'],
							'tanggal_lahir' => $post['tanggal'],
							'no_handphone' => $post['nohp'],
							'email' => $post['email'],
							'password' => $password_enc,
							'status_verifikasi' => '0',
							);
						$this->Db_model->tambah_data('user_login',$data);
						
						
						$data = array(
							'id_saldo' => $idsaldo,
							'id_user' => $iduser,
							'saldo' => '0',
							'status' => 'TRUE'
							);
						$this->Db_model->tambah_data('user_saldo_pelanggan',$data);
						
						
						
						$this->email->initialize($config);
						$link = base_url('utama/verifikasi/').'/'. $iduser;
						$htmlContent = '<h3>Terima kasih telah mendaftar</h3>';
						$htmlContent .= "<div>Silahkan klik link berikut untuk melakukan verifikasi email </div> <a href='$link'>$link</a>";

						$this->email->from('resto.stts@gmail.com', 'Resto.com');
						$this->email->to($post['email']);
						$this->email->subject('Verifikasi email');
						$this->email->message($htmlContent);

						if ($this->email->send()) {
							$this->session->set_flashdata('email_sent','Email verifikasi telah dikirim, silahkan cek email anda untuk verifikasi email.');
						   	redirect('utama');
						} else {
						    show_error($this->email->print_debugger());
						}
						
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

	public function verifikasi($id)
	{
		$this->load->model('Model_user');
		$data =array(
			'status_verifikasi' => '1'
		);
		$this->Model_user->update_data_user($id,'id_user',$data);
		$this->session->set_flashdata('pesan', 'Terima kasih anda telah melakukan verifikasi email.');
		redirect('utama/login');
	}

	public function pesan_meja($id){
		$this->load->model('Db_model');
		$this->load->model('Model_pesanan_pelanggan');
		$this->load->model('Model_resto');
		$post = $this->input->post();
		$namapelanggan = $this->session->userdata['user_pelanggan'];
		$idpelanggan = $this->session->userdata['id_pelanggan'];

		if(!empty($post['jumlah_kursi']) && !empty($post['tanggal']) && !empty($post['jam_acara']))
		{
			$data = $this->Model_resto->baca_harga($id);
			foreach ($data as $row) {
				$harga_kursi = $row->biaya_kursi;
				
			}
			$total_bayar = $harga_kursi * $post['jumlah_kursi'];
			$jumlahdata = $this->Db_model->jumlah_data('pesanan_pelanggan');
			$idpesanan = 'PP' . ($jumlahdata+1);
			$data=array(
				'id_pesanan' => $idpesanan,
				'kode_resto' => $id,
				'id_pelanggan' => $idpelanggan,
				'jumlah_kursi' => $post['jumlah_kursi'],
				'tanggal_acara' => $post['tanggal'],
				'jam_acara' => $post['jam_acara'],
				'total_bayar' => $total_bayar,
				'status_pemesanan' => 'belum disetujui'
				);
			$this->Model_pesanan_pelanggan->tambah_data($data);
			redirect('utama/pesan_makan/'.$id.'/'.$idpesanan);
		}
	}


	public function tulis_review($kode_resto)
	{
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('Db_model');
			$idpelanggan = $this->session->userdata('id_pelanggan');
			$data = array(
				'record_pelanggan' => $this->Db_model->cari_data_bener('user_login','id_user',$idpelanggan),
				'record_resto' =>  $this->Db_model->cari_data('about_resto',$kode_resto),
				'record_foto' => $this->Db_model->cari_data('foto_resto',$kode_resto)
				
			);
			$this->load->view('tulis_review',$data);
		}else
		{
			redirect('utama/login');
		}
	}

	public function simpan_review()
	{
		$this->load->model('Db_model');
		$post = $this->input->post();
		$idpelanggan = $this->session->userdata('id_pelanggan');
		$koderesto = $post['koderesto'];
		$jumlahdata = $this->Db_model->jumlah_data('review_pelanggan');
		$review = 'RP' . ($jumlahdata+1);
		$data=array(
			'id_review' => $review,
			'id_resto' => $post['koderesto'],
			'id_pelanggan' => $idpelanggan,
			'judul_review' => $post['judulreview'],
			'review_pelanggan' => $post['isireview'],
			'rating' => $post['rating'],
			'status' => "TRUE"
			);
		$this->Db_model->tambah_data('review_pelanggan',$data);
		$this->session->set_flashdata("terima_kasih","Terima kasih telah memberikan review, review anda akan ditampilkan pada halaman resto ini.");
		redirect('utama/home_resto/'.$koderesto);
	}



	public function email()
	{
		$this->load->library('email');

		$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "resto.stts@gmail.com";
        $config['smtp_pass'] = "12041995";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

		$this->email->initialize($config);
		$link = base_url('utama/verifikasi');
		$htmlContent = '<h1>Terima kasih telah mendaftar</h1>';
		$htmlContent .= "<div>Silahkan klik link berikut untuk melakukan verifikasi email </div> <a href='$link'>$link</a>";
		
		$this->email->from('resto.stts@gmail.com', 'Resto.com');
		$this->email->to('taufan.stts@gmail.com');
		$this->email->subject('Verifikasi email');
		$this->email->message($htmlContent);

		if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
	}


	public function top_up_saldo()
	{
		$this->load->model('Model_saldo_detail');
		$this->load->model('Model_saldo');
		$table = 'user_saldo_pelanggan_detail';
		$id_pelanggan = $this->session->userdata['id_pelanggan'];
		$data = array(
			'record' => $this->Model_saldo_detail->baca_data_table($table,'id_user',$id_pelanggan),
			'record_combo' => $this->Model_saldo_detail->data_transaksi_belum_bayar($id_pelanggan),
			'saldo' => $this->Model_saldo->baca_saldo($id_pelanggan)
		);
		$this->load->view('pembayaran',$data);
	}

	public function request_top_up_saldo()
	{
		$post = $this->input->post();
		$this->load->model('Model_saldo_detail');
		$this->load->model('Model_user');
		if(!empty($post['topup'])){
			$topup = $post['topup'];
			$kodeunik = rand(191,499);
			$jumlahdata = $this->Model_saldo_detail->jumlahdata();
			$id_top_up = 'IT' . ($jumlahdata+1);
			$id_user = $this->session->userdata('id_pelanggan');
			$data=array(
				'id_top_up' => $id_top_up,
				'id_user' => $id_user,
				'jumlah_top_up_saldo' => $topup,
				'kode_unik' => $kodeunik,
				'status_transaksi' => 'belum dibayar'
			);
			$this->Model_saldo_detail->request_top_up($data);
			$this->session->set_flashdata('pesan','berhasil');
			

			//SMS PELANGGAN
			$hasil_telp_pelanggan = $this->Model_user-> baca_telfon_pelanggan($id_user);
			foreach ($hasil_telp_pelanggan as $row) {
				$hp_pelanggan = $row->no_handphone;
			}
			$message=urlencode("Hai, diharapkan melakukan pembayaran sesuai dengan yang tertulis di halaman pembayaran dan langsung melakukan konfirmasi kepada admin. Terimakasih. *pesan-meja-stts.com");
			$curlHandle = curl_init();
			$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$hp_pelanggan&message=$message";
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);

			redirect('utama/invoice_page/'.$id_top_up);
		}else{
			$this->session->set_flashdata('pesan','combo kosong');
			redirect('utama/top_up_saldo');
		}
	}

	public function invoice_page($idtopup)
	{
		$this->load->model('Model_saldo_detail');
		$iduser = $this->session->userdata('id_pelanggan');
		$data_baca = $this->Model_saldo_detail->data_invoice($idtopup,$iduser);
		foreach ($data_baca as $row) {
			$sub_total = $row->jumlah_top_up_saldo;
			$kodeunik = $row->kode_unik;
		}
		$total = $sub_total+$kodeunik;
		$data =array(
			'sub_total' => $sub_total,
			'kode_unik' => $kodeunik,
			'total' => $total,
			'record'=> $this->Model_saldo_detail->data_invoice($idtopup,$iduser)
		);
		$this->load->view('invoice_page',$data);
	}



	public function konfirmasi_top_up($idtopup)
	{
		$this->load->model('Model_saldo_detail');
		$iduser = $this->session->userdata('id_pelanggan');
		$data_baca = $this->Model_saldo_detail->data_invoice($idtopup,$iduser);
		foreach ($data_baca as $row) {
			$sub_total = $row->jumlah_top_up_saldo;
			$kodeunik = $row->kode_unik;
		}
		$total = $sub_total+$kodeunik;
		$data =array(
			'idtopup' => $idtopup,
			'sub_total' => $sub_total,
			'kode_unik' => $kodeunik,
			'total' => $total,
			'record'=> $this->Model_saldo_detail->data_invoice($idtopup,$iduser)
		);
		$this->load->view('view_konfirmasi_topup',$data);
		/*$post = $this->input->post();
		

		if(!empty($post['nama']) && !empty($post['nama']) && !empty($post['nama']) )
		$jumlahtransfer = $post['jumlahtransfer'];
		$namarekening = $post['namarekening'];
		$tanggal = $post['tanggal'];
		$iduser = $this->session->userdata('id_pelanggan');
		$jumlahdata = $this->Db_model->jumlah_data('user_saldo_pelanggan_detail');
		$id_topup = 'IT' . ($jumlahdata+1);
		$data = array(
			'id_top_up' => $id_topup,
			'id_user' => $iduser,
			'jumlah_top_up_saldo' => $post['topup'],
			'status_transaksi' => 'belum konfirmasi transfer'
		);
		$this->Db_model->tambah_data('user_saldo_pelanggan_detail',$data);
		$this->session->set_flashdata("terima_kasih","Terima kasih telah melakukan konfirmasi, top up anda akan di proses secepatnya.");
		redirect('utama/top_up_saldo');


		header('Content-Type:application/json');
		echo json_encode($data);*/
	}

	public function proses_top_up_saldo($idtopup){
		$post = $this->input->post();
		$config['upload_path'] = './uploads/pembayaran/top_up';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 1025;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['overwrite'] = TRUE;
		$config['file_name'] = $idtopup;
	
		$this->load->library('upload', $config);
		echo $this->upload->data('orig_name');     
		$namarekening = $post['namarekening'];
		$tanggal_transer = $post['tanggal'];
		
		if(!empty($post['namarekening'])&&!empty($post['tanggal'])){
			if($this->upload->do_upload('userfile'))
			{
				$upload_data = $this->upload->data();
				$gambar_bukti = base_url()."uploads/pembayaran/top_up/". $upload_data['file_name'];
				$this->load->model('Model_saldo_detail');
				$data = array(
					'nama_rekening' =>$namarekening,
					'tanggal_transfer' =>$post['tanggal'],
					'bukti_transfer' =>$gambar_bukti,
					'tanggal_konfirmasi' => date("Y-m-d"),
					'status_transaksi' => 'sudah dibayar'
				);
				$this->Model_saldo_detail->update_konfirmasi($idtopup,$data);
				$this->session->set_flashdata('pesan','konfirmasi berhasil');
				redirect('utama/top_up_saldo');
			}else
			{
				echo $this->upload->display_errors();
			}
		}else
		{
			echo $post['namarekening']. " ". $post['tanggal']. " " ;
		}

	}

	public function bayar_pesanan($id)
	{
		$post = $this->input->post();
		$this->load->view('bayar');
	}

	

	public function search()
	{
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
		
			$this->load->model('Model_resto');
			$data = array(
				'record_resto' =>$this->Model_resto->baca_data_resto()
			);
			$this->load->view('view_search',$data);
		}else
		{
			redirect('utama/login');
		}
		
	}

	public function proses_search()
	{
		$post = $this->input->post();
		if($this->session->userdata('id_pelanggan')!=NULL)

		{	   
			if(!empty($post['tanggal_acara']) && !empty($post['jumlah_kursi']) && !empty($post['jam_acara']) )
			{
				$this->load->model('Model_pesanan_pelanggan');
				$this->load->model('Model_resto');
				$this->load->model('Model_review');
				
				$keyword = $post['keyword'];
				$tanggal = $post['tanggal_acara'];
				$jam_acara = $post['jam_acara'];
				$jumlah_kursi = $post['jumlah_kursi'];
				if($keyword=="")
				{
					$data = array(
						'record_resto' =>$this->Model_resto->baca_data_resto(),
						'record_pesanan' => $this->Model_pesanan_pelanggan->baca_total_pesanan_perjam($tanggal,$jam_acara),
						'record_vote' => $this->Model_review->baca_vote()
					);
					$this->load->view('view_search',$data);
				}else
				{
					$data = array(
						'record_resto' =>$this->Model_resto->baca_data_resto_keyword($keyword),
						'record_pesanan' => $this->Model_pesanan_pelanggan->baca_total_pesanan_perjam($tanggal,$jam_acara),
						'record_vote' => $this->Model_review->baca_vote()
					);
					$this->session->set_flashdata('pesan',"Hasil pencarian dengan kata kunci '".$keyword." '");
					$this->load->view('view_search',$data);
				}
				/*$data = array(
					'record_resto' =>$this->Model_resto->baca_data_resto(),
					'record_pesanan' => $this->Model_pesanan_pelanggan->baca_total_pesanan_perjam($tanggal,$jam_acara)
				);
				$this->load->view('view_search',$data);*/
			}else
			{
				$this->session->set_flashdata('pesan','Tanggal, jam acara atau jumlah kursi harus ditentukan');
				redirect('utama/logged_in');
			}
			

		}else
		{
			redirect('utama/login');
		}

	}
	
}


/*CEK session


if($this->session->userdata('user_login')!=NULL)
{

}else
{
	redirect('utama/login');
}

*/

 //SCRIPT API GRATISAN
/*$curl = curl_init();
curl_setopt_array ($curl, array( 
	    CURLOPT_RETURNTRANSFER => 1, 
	    CURLOPT_URL => 'http://www.sms-online.web.id/kirim', 
	    CURLOPT_USERAGENT => 'hadinug.net  Contoh cURL Request', 
	    CURLOPT_POST => 1, 
	    CURLOPT_POSTFIELDS => array( 
	        'Phonenumbers' => $no_handphone_pelanggan, 
	        'Text' => 'Hai '. $namapelanggan .' pesanan anda berhasil masuk, mohon di tunggu konfirmasinya.' 
	    )
    )); 
$resp = curl_exec($curl); 
curl_close($curl);*/


/*SCRIPT API ZENZIVA
$userkey="gq6ivk"; // userkey lihat di zenziva
$passkey="taufan1204"; // set passkey di zenziva
$telepon=$no_handphone_resto;
$message="Hai ". $nama_owner ." resto anda memiliki pesanan baru, mohon untuk login dan melakukan konfirmasi secepatnya";
$url ="https://reguler.zenziva.net/apps/smsapi.php";
$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
curl_setopt($curlHandle, CURLOPT_POST, 1);
$results = curl_exec($curlHandle);
curl_close($curlHandle);*/


/*RAJA SMS*/
			/*
			 $record_resto = $this->Db_model->cari_data_resto($id);
			 foreach ($record_resto as $row){
			 	$no_handphone_resto = $row->no_telp;
			 	$nama_owner = $row->nama_depan;
			 }

			

			

			$record_pelanggan = $this->Db_model->cari_data_pelanggan($idpelanggan);
			 foreach ($record_pelanggan as $row){
			 	$no_handphone_pelanggan = $row->no_handphone;
			 }
			 
			 $nohptujuan = $no_handphone_pelanggan;




			$telepon=$no_handphone_pelanggan;
			$message="pesanan anda berhasil masuk, mohon di tunggu konfirmasinya. Raja SMS";
			$curlHandle = curl_init();
			$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$no_handphone_pelanggan&message=$message";
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);*/