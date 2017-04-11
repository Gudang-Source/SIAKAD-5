<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$datalog = $this->session->get_userdata();
		if(!$datalog['status_login']){
			$this->session->set_flashdata("error","Anda tidak diizinkan mengakses halaman ini. Harap login terlebih dahulu");
			redirect(site_url()."login");
		}
	}

	public function index(){
		$this->load->view('view_home');
	}

}

?>
