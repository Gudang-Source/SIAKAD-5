<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('App_model');
	}

	public function index()
	{
		$jadwal = $this->App_model->get_query("SELECT * FROM v_jadwal")->result();
		$data['jadwal']=$jadwal;
		$data['breadcrumb']='jadwal';
		$data['title']='Jadwal Mata Kuliah';
		$data['assign_js'] = 'jadwal/js/index.js';
		load_view('jadwal/jadwal',$data);
	}
}
