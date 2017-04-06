<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			if (!$this->session->userdata('login')) {
				redirect('login');
			}
			else {
				$this->load->model('App_model');
				$this->load->library('form_validation');
			}
	}

	public function index()
	{
		$pengumuman = "Testing";
		$data['pengumuman']=$pengumuman;

		$data['breadcrumb']='Halaman Utama';
		$data['title']='SELAMAT DATANG DI PMB';
		$data['assign_js'] = 'beranda/js/index.js';
		load_view('beranda/beranda',$data);
	}
}
