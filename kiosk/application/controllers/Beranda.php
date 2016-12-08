<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('App_model');
	}

	public function index()
	{
		$pengumuman = $this->App_model->get_query("SELECT * FROM tb_pengumuman WHERE status='Y' ORDER BY id_pengumuman ASC")->result();
		$data['pengumuman']=$pengumuman;

		$data['breadcrumb']='Halaman Utama';
		$data['title']='WELCOME TO STMIK ADHI GUNA';
		$data['assign_js'] = 'beranda/js/index.js';
		load_view('beranda/beranda',$data);
	}
}
