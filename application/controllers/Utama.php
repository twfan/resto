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
		$query ="SELECT user_login.nama_user, review_pelanggan.judul_review, review_pelanggan.review_pelanggan, review_pelanggan.rating, review_pelanggan.tanggal_review FROM review_pelanggan, user_login WHERE review_pelanggan.id_resto='$kode_resto' AND user_login.id_user = review_pelanggan.id_pelanggan";

		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('Db_model');
			$data = array(
				'kode_resto' => $kode_resto,
				'id_pesanan' => $idpesanan,
				'record_resto' =>  $this->Db_model->cari_data('about_resto',$kode_resto),
				'record_foto' => $this->Db_model->cari_data('foto_resto',$kode_resto),
				'record_review' => $this->Db_model->baca_data_dengan_query_custom($query)
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
		$total = $this->Model_pesanan_pelanggan->baca_harga($idpesanan);
		
		foreach ($total as $row) {
			$total = $row->total_bayar;
		}
		
		$data = array(
			'idpesanan' => $idpesanan,
			'total' => $total
		);
		$this->load->view('view_pilihan_bayar',$data);
	}

	public function proses_bayar_upload($idpesanan)
	{
		$this->load->model('Model_pembayaran_detail');
		$this->load->model('Model_pesanan_pelanggan');
		$post = $this->input->post();

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
					'bukti_bayar' => $gambar_bukti
				);
				$this->Model_pesanan_pelanggan->update_bukti($idpesanan,$data_foto);
				$this->session->set_flashdata('pesan','Konfirmasi pembayaran anda berhasil');
				redirect("utama/bayar/".$idpesanan);
			}else
			{
				echo $this->upload->display_errors();
			}
		}else
		{
			$this->session->set_flashdata('pesan','Ukuran file gambar terlalu besar');
			redirect("utama/bayar/".$idpesanan);
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
		$this->load->model('Db_model');
		$this->load->model('Model_review');
		$hasil = $this->Model_review->baca_vote();
		$data = array(
			'record_resto' => $this->Db_model->baca_seluruh_table('about_resto'),
			'record_vote' => $this->Model_review->baca_vote()
		);
		$this->load->view('home_loggedin',$data);
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
					$this->session->set_flashdata('pesan','User belum verifikasi email');
					redirect('utama/login');
				}
					
			}else
			{
				echo "beda";
			}


			/*$this->load->view('login_user');
			$this->load->model('Db_model');
			$post = $this->input->post();
			if(!empty($post['email_login']) && !empty($post['password_login']))
			{
				$data=array(
					'email' => $post['email_login'],
					'password' => $post['password_login']
					);
				$hasil = $this->Db_model->login('user_login',$data);
				echo count($hasil);
				
				if(count($hasil)==1)
				{
					
					$this->session->set_userdata('user_pelanggan', $hasil[0]['nama_user']);
					$this->session->set_userdata('id_pelanggan', $hasil[0]['id_user']);
					$this->session->set_userdata('email', $hasil[0]['email']);
					redirect('utama/logged_in');
				}else
				{
					
					$this->session->set_flashdata('pesan','Kombinasi email / password anda salah');
					redirect('utama/login');
				}
			}*/
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
				'record_pesanan' =>  $this->Model_pesanan_pelanggan->baca_data_pesanan_untuk_pelanggan($idpelanggan)
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
        $config['smtp_pass'] = "12041995";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

		$this->email->initialize($config);

		/*$this->email->from('taufan.stts@gmail.com', 'Taufan Erlangga');
		$this->email->to('taufan.erlangga@gmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }*/


		$this->load->model('Db_model');
		$post = $this->input->post();
		$this->load->library('encryption');
		$password= $this->input->post('password');
		$password_enc = $this->encryption->encrypt($password);



		/*echo "password enc = ". $password_enc;
		$password_dec = $this->encryption->decrypt($password_enc);
		echo "password_dec = ".$password_dec;*/

		$konfpassword= $this->input->post('konfpassword');
		if($konfpassword==$password)
		{
				
				if(!empty($post['namauser']) && !empty($post['tanggal']) && !empty($post['gender']) && !empty($post['nohp']) && !empty($post['email']) && !empty($post['password']) )
				{
					
					$cekemail = $this->Db_model->cek_email($post['email']);
					//echo count($cekemail);
					if(count($cekemail)>=1)
					{
						$this->session->set_flashdata('email_kembar','Email telah terdaftar silahkan gunakan email lain');
						redirect('utama/registerpelanggan');
					}else
					{
						//echo "masuk siniiiiiiiiiii";
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
					echo "masuk bawah sini";
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
			$this->Db_model->tambah_data('pesanan_pelanggan',$data);

			 $record_resto = $this->Db_model->cari_data_resto($id);
			 foreach ($record_resto as $row){
			 	$no_handphone_resto = $row->no_telp;
			 	$nama_owner = $row->nama_depan;
			 }

			/*$userkey="gq6ivk"; // userkey lihat di zenziva
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

			

			$record_pelanggan = $this->Db_model->cari_data_pelanggan($idpelanggan);
			 foreach ($record_pelanggan as $row){
			 	$no_handphone_pelanggan = $row->no_handphone;
			 }
			 
			 $nohptujuan = $no_handphone_pelanggan;
			// Script http API SMS Reguler Zenziva

			/*$userkey="gq6ivk"; // userkey lihat di zenziva
			$passkey="taufan1204"; // set passkey di zenziva
			$telepon=$no_handphone_pelanggan;
			$message="Hai ". $namapelanggan ." pesanan anda berhasil masuk, mohon di tunggu konfirmasinya. Zenziva";
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
			/*$telepon=$no_handphone_pelanggan;
			$message="pesanan anda berhasil masuk, mohon di tunggu konfirmasinya. Raja SMS";
			$curlHandle = curl_init();
			$url="http://128.199.232.241/sms/smsreguler.php?username=taufanerlangga95&key=69e376c0d072538ba7c068a48426785e&number=$no_handphone_pelanggan&message=$message";
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);*/


			/*$this->session->set_flashdata('pesanan_berhasil','Pesanan berhasil, mohon di tunggu konfirmasinya.');*/
			redirect('utama/pesan_makan/'.$id.'/'.$idpesanan);
		}
		else{
			echo $post['jumlah_kursi']. " ".$post['tanggal']. " " .$post['jam_acara'] ;
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
		$table = 'user_saldo_pelanggan_detail';
		$id_pelanggan = $this->session->userdata['id_pelanggan'];
		$data = array(
			'record' => $this->Model_saldo_detail->baca_data_table($table,'id_user',$id_pelanggan)
		);

		$this->load->view('pembayaran',$data);
	}

	public function proses_top_up_saldo()
	{
		
		$post = $this->input->post();
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
			'jumlah_top_up_saldo' => $post['jumlahtransfer'],
			'nama_rekening' => $post['namarekening'],
			'tanggal_transfer' => $post['tanggal'],
			'status_transaksi' => 'belum konfirmasi admin'
		);
		$this->Db_model->tambah_data('user_saldo_pelanggan_detail',$data);
		$this->session->set_flashdata("terima_kasih","Terima kasih telah melakukan konfirmasi, top up anda akan di proses secepatnya.");
		redirect('utama/top_up_saldo');
		/*header('Content-Type:application/json');
		echo json_encode($data);*/
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