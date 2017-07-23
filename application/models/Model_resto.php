<?php


class Model_resto extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function baca_data_resto()
	{
		$hasil_data = $this->db->get('about_resto');
		return $hasil_data->result();
	}

	public function nama_resto($kode_resto)
	{
		$query = $this->db->query("SELECT `nama_resto` FROM about_resto WHERE `kode_resto`='$kode_resto'");
		
		return $query->result();
	}

	public function baca_data_resto_keyword($keyword)
	{
		$query = $this->db->query("SELECT * FROM about_resto WHERE `nama_resto` LIKE '%$keyword%'");
		return $query->result();
	}

	public function baca_harga($id)
	{
		$query = $this->db->query("SELECT `biaya_kursi` FROM about_resto WHERE `kode_resto` = '$id'");
		return $query->result();
	}

	public function baca_selected($id)
	{
		$query = $this->db->query("SELECT `tipe_sajian` FROM about_resto WHERE `kode_resto` = '$id'");
		$data= $query->result();
		if($data[0]->tipe_sajian!="")
		{
			return json_decode($data[0]->tipe_sajian);
		}else
		{
			$temp = [];
			return $temp;
		}

	}

	public function filter($data)
	{
		$ctr = 0;
		$where_kota = "";
		if(isset($data['kota'])){
			$ctr++;
			for ($i=0; $i < count($data['kota']) ; $i++) { 
				if($i != count($data['kota'])-1){
					$where_kota .= "kota='".$data['kota'][$i]."' OR ";
				}else{
					$where_kota .= "kota='".$data['kota'][$i]."'";
				}
			}
			//return $where_kota;
		}
		$where_halal = "";
		if(isset($data['halal'])){
			$ctr++;
			if($ctr!=1)
			{
				$where_halal .=" AND ";
			}
			
			for ($i=0; $i < count($data['halal']) ; $i++) { 
				if($i != count($data['halal'])-1){
					$where_halal .= "halal='".$data['halal'][$i]."' OR ";
				}else{
					$where_halal .= "halal='".$data['halal'][$i]."'";
				}
			}
			//return $where_kota;
		}
		$where_masakan = "";
		if(isset($data['masakan'])){$ctr++;
			if($ctr!=1)
			{
				$where_masakan .=" AND ";
			}
			for ($i=0; $i < count($data['masakan']) ; $i++) { 
				if($i != count($data['masakan'])-1){
					$where_masakan .= "tipe_sajian LIKE '%".$data['masakan'][$i]."%' OR ";
				}else{
					$where_masakan .= "tipe_sajian LIKE '%".$data['masakan'][$i]."%'";
				}
			}
			//return $where_kota;
		}
		$qwhere =  $where_kota.$where_halal.$where_masakan;

		
		$query = $this->db->query("SELECT * FROM about_resto WHERE ". $qwhere);
		return $query->result();
	}



}


?>