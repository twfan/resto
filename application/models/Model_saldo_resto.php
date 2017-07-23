<?php


class Model_saldo_resto extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function jumlah_data(){
		return $this->db->count_all('user_saldo_resto');
	}

	function tambah_data($data){
		$this->db->insert('user_saldo_resto', $data);
	}

	public function baca_saldo($idresto)
	{
		$hasil_data =  $this->db->get_where('user_saldo_resto', array('id_resto' => $idresto));
		$data = $hasil_data->result();
		return $data[0]->saldo;
	}

		public function update_saldo($koderesto,$data)
	{
		$this->db->where('id_resto',$koderesto);
		$this->db->update('user_saldo_resto',$data);
	}

}


?>