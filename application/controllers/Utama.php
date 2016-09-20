<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('array','form'));
		
		

	}
	public function index()
	{

	}

	public function registerpelanggan()
	{
		
		$this->load->view('register');
	}

	public function home()
	{
		$this->load->view('home');
	}
}
