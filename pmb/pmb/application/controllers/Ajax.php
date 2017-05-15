<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			if (!$this->session->userdata('login')) {
				redirect('login');
			}
			else {
				$this->load->model('App_model');
			}
	}

	public function cek_kode_ayah()
	{
		$data= $this->App_model->get_query("SELECT * FROM tb_ayah ORDER BY id_ayah DESC LIMIT 0,1")->row();
		if ($data) {
			echo json_encode($data);
		}
		else {
			$data_fix['result']=0;
			echo json_encode($data_fix);
		}
	}

	public function cek_kode_ibu()
	{
		$data= $this->App_model->get_query("SELECT * FROM tb_ibu ORDER BY id_ibu DESC LIMIT 0,1")->row();
		if ($data) {
			echo json_encode($data);
		}
		else {
			$data_fix['result']=0;
			echo json_encode($data_fix);
		}
	}
}
