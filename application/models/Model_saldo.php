<?php


class Model_saldo extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	public function baca_data_table($table,$kolom,$data_pembanding)
	{
		$hasil_data =  $this->db->get_where($table, array($kolom => $data_pembanding));
		return $hasil_data->result();
	}
	
	function read_data_bener($table,$data)
	{
		$hasil_data = $this->db->get_where($table, $data);
		if($hasil_data->num_rows() > 0)
		{
			return $hasil_data->result();
		}else
		{
			return "data tidak ada";
		}
	}

}


?>