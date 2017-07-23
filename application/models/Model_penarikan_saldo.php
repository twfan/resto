<?php


class Model_penarikan_saldo extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	public function get_data()
	{
		$hasil_data = $this->db->get('penarikan_saldo');
		return $hasil_data->result();
	}

	public function get_databycode($id)
	{
		$hasil_data = $this->db->get_where ('penarikan_saldo',array('id'=>$id));
		return $hasil_data->result();
	}

	function tambah_data($data){
		$this->db->insert('penarikan_saldo', $data);
	}

	function update_data($id,$data){
		$this->db->where('id_resto',$id);
		$this->db->update('penarikan_saldo',$data);
	}
	public function update_databyid($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('penarikan_saldo',$data);
	}

	

}


?>