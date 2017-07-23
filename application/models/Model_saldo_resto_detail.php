<?php


class Model_saldo_resto_detail extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function jumlah_data(){
		return $this->db->count_all('user_saldo_resto_detail');
	}

	function tambah_data($data){
		$this->db->insert('user_saldo_resto_detail', $data);
	}

	public function get_data($koderesto)
	{
		$hasil_data = $this->db->get_where('user_saldo_resto_detail', array('id_resto' => $koderesto));
		return $hasil_data->result();
	}
}


?>