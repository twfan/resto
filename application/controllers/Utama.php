<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		$this->load->library(array('session'));
	}

	public function json()
	{
		$this->load->view('json');
		
	}
	public function json_proses()
	{
		$post = $this->input->post();
		$kodepelanggan = $post['kode_pelanggan'];
		$this->load->model('db_model');
		$data = $this->db_model->baca_seluruh_table('user_login');
		header('Content-Type:application/json');
		echo json_encode($data);

	}

	public function pesan_makan($kode_resto)
	{
		$query ="SELECT user_login.nama_user, review_pelanggan.judul_review, review_pelanggan.review_pelanggan, review_pelanggan.rating, review_pelanggan.tanggal_review FROM review_pelanggan, user_login WHERE review_pelanggan.id_resto='$kode_resto' AND user_login.id_user = review_pelanggan.id_pelanggan";
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('db_model');
			$data = array(
				'record_resto' =>  $this->db_model->cari_data('about_resto',$kode_resto),
				'record_foto' => $this->db_model->cari_data('foto_resto',$kode_resto),
				'record_review' => $this->db_model->baca_data_dengan_query_custom($query)
			);
			$this->load->view('pesan_makanan',$data);
		}else
		{
			redirect('utama/login');
		}
		
	}

	public function baca_menu()
	{
		$post = $this->input->post();
		$koderesto = $post['kode_resto'];
		$this->load->model('db_model');
		$data = $this->db_model->cari_data_bener('menu_resto','kode_resto',$koderesto);
		header('Content-Type:application/json');
		echo json_encode($data);
	}
	public function ajax_baca_harga()
	{
		$post = $this->input->post();
		$kode_menu = $post['kode_menu'];
		$this->load->model('db_model');
		$data = $this->db_model->cari_data_bener('menu_resto','kode_menu',$kode_menu);
		header('Content-Type:application/json');
		echo json_encode($data);
	}


	public function index()
	{
		$this->load->model('db_model');
		$data = array(
			'record_resto' => $this->db_model->baca_seluruh_table('about_resto')
		);
		$this->load->view('home',$data);
	}

	public function home()
	{
		redirect("utama/");
	}

	public function logged_in()
	{
		$this->load->model('db_model');
		$data = array(
			'record_resto' => $this->db_model->baca_seluruh_table('about_resto')
		);
		$this->load->view('home_loggedin',$data);
	}

	public function login()
	{
		if($this->session->userdata('user_pelanggan')==NULL)
		{
			$this->load->view('login_user');
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
				$hasil = $this->db_model->login('user_login',$data);
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
			$this->load->model('db_model');
			$data = array(
				'record_resto' =>  $this->db_model->cari_data('about_resto',$kode_resto),
				'record_foto' => $this->db_model->cari_data('foto_resto',$kode_resto),
				'record_review' => $this->db_model->baca_data_dengan_query_custom($query)
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
			$this->load->model('db_model');
			$idpelanggan = $this->session->userdata('id_pelanggan');
			$data = array(
				'record_pesanan' =>  $this->db_model->baca_data_pesanan_untuk_pelanggan($idpelanggan)
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
			$this->load->model('db_model');
			$iduser = $this->session->userdata('id_pelanggan');
			$data = array(
				'record' => $this->db_model->cari_data_bener('user_login','id_user',$iduser)
			);
			 $this->load->view('homepage_user_data_diri',$data);
		}else
		{
			redirect('utama/login');
		}
		
	}
	public function update_data_diri()
	{
		$this->load->model('db_model');
		$post = $this->input->post();
		$password = $post['password'];
		$confpassword = $post['confpassword'];
		$iduser = $this->session->userdata('id_pelanggan');
		if($password==$confpassword)
		{
			if(!empty($post['namauser']) && !empty($post['nohp']) && !empty($post['email']) && !empty($post['password']))
			{
				$data=array(
					'nama_user' => $post['namauser'],
					'no_handphone' => $post['nohp'],
					'email' => $post['email'],
					'password' => $post['password']
					);
				$this->db_model->update_data_bener($iduser,'user_login','id_user',$data);
				$this->session->set_flashdata('berhasil','Update berhasil');
				redirect('utama/pelanggan_data_diri');
			}
		}else
		{
			$this->session->set_flashdata('password_tidak_kembar','Kombinasi password dan konfirmasi password tidak sama');
			redirect('utama/pelanggan_data_diri');
		}
	}

	public function top_up_saldo()
	{
		$this->load->view('pembayaran');
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
							'email' => $post['email'],
							'password' => $post['password'],
							'status_verifikasi' => '0',
							);
						$this->db_model->tambah_data('user_login',$data);
						
						
						
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
		$this->load->model('db_model');
		$data =array(
			'status_verifikasi' => '1'
		);
		$this->db_model->update_data_bener($id,'user_login','id_user',$data);
		$this->session->set_flashdata('berhasil_verifikasi', 'Terima kasih anda telah melakukan verifikasi email.');
		redirect('utama');
	}

	public function pesan_meja($id){
		$this->load->model('db_model');
		$post = $this->input->post();
		$namapelanggan = $this->session->userdata['user_pelanggan'];
		$idpelanggan = $this->session->userdata['id_pelanggan'];

		if(!empty($post['jumlah_kursi']) && !empty($post['tanggal']) && !empty($post['jam_acara']))
		{
			
			//echo "masuk siniiiiiiiiiii";
			$jumlahdata = $this->db_model->jumlah_data('pesanan_pelanggan');
			$idpesanan = 'PP' . ($jumlahdata+1);
			$data=array(
				'id_pesanan' => $idpesanan,
				'kode_resto' => $id,
				'id_pelanggan' => $idpelanggan,
				'jumlah_kursi' => $post['jumlah_kursi'],
				'tanggal_acara' => $post['tanggal'],
				'jam_acara' => $post['jam_acara'],
				'status_pemesanan' => 'belum disetujui'
				);
			$this->db_model->tambah_data('pesanan_pelanggan',$data);

			 $record_resto = $this->db_model->cari_data_resto($id);
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

			

			$record_pelanggan = $this->db_model->cari_data_pelanggan($idpelanggan);
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


			$this->session->set_flashdata('pesanan_berhasil','Pesanan berhasil, mohon di tunggu konfirmasinya.');
			redirect('utama/logged_in');
		}
		else{
			echo "masuk bawah";
		}

	}


	public function tulis_review($kode_resto)
	{
		if($this->session->userdata('id_pelanggan')!=NULL)
		{
			$this->load->model('db_model');
			$idpelanggan = $this->session->userdata('id_pelanggan');
			$data = array(
				'record_pelanggan' => $this->db_model->cari_data_bener('user_login','id_user',$idpelanggan),
				'record_resto' =>  $this->db_model->cari_data('about_resto',$kode_resto),
				'record_foto' => $this->db_model->cari_data('foto_resto',$kode_resto)
				
			);
			$this->load->view('tulis_review',$data);
		}else
		{
			redirect('utama/login');
		}
	}

	public function simpan_review()
	{
		$this->load->model('db_model');
		$post = $this->input->post();
		$koderesto = $post['koderesto'];
		$jumlahdata = $this->db_model->jumlah_data('review_pelanggan');
		$review = 'RP' . ($jumlahdata+1);
		$data=array(
			'id_review' => $review,
			'id_resto' => $post['koderesto'],
			'id_pelanggan' => $post['kodepelanggan'],
			'judul_review' => $post['judulreview'],
			'review_pelanggan' => $post['isireview'],
			'rating' => $post['rating'],
			'status' => "TRUE"
			);
		$this->db_model->tambah_data('review_pelanggan',$data);
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