<?php


class Model_saldo_website extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	

	public function baca_saldo()
	{
		$query = $this->db->query("SELECT `saldo` FROM `saldo_website` WHERE `id_saldo_website`='ISW1'");
		return $query->result();
	}

	public function update_saldo($data)
	{
		$this->db->where('id_saldo_website','ISW1');
		$this->db->update('saldo_website',$data);
	}

	public function tambah_data_terima_saldo($data){
		$this->db->insert('saldo_website', $data);
	}

}


?>