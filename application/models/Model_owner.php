<?php


class Model_owner extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function decrypt_password($email)
	{
		$q = $this->db-> get_where ('owner_resto',array('email'=>$email));
		$hasil_data = $q->result_array();
		return $hasil_data;
	}

	public function update_data_user($parameter,$parameter_pembanding,$data)
	{
		$this->db->where($parameter_pembanding,$parameter);
		$this->db->update('owner_resto',$data);
	}
}


?>