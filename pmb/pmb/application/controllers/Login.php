<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	private $user;
	private $pass;
	private $nama_cmhs;
	private $kode_formulir;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('App_model','app_model');

	}

	public function index()
	{
		//$this->login();
		if ($this->session->userdata('login')) {
				redirect('beranda');
		}
		else {
			$data['site_title'] = 'Please Login';
			$this->load->view('layout/template0',$data);
		}
	}

	public function login()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('username','Username Feeder','trim|required');
			$this->form_validation->set_rules('password','Password Feeder','required');

			if ($this->form_validation->run() == TRUE) {
				$data = array('username' => $this->input->post('username', TRUE),'password' => $this->input->post('password', TRUE));

				$hasil = $this->app_model->cek_user($data);
				echo json_encode($hasil->row());
				if ($hasil->num_rows() == 1) {
					foreach ($hasil->result() as $sess){
						$this->user = $sess->username;
						$this->nama_cmhs = $sess->nm_pendaftar;
						$this->kode_formulir = $sess->kode_formulir;
					}

					$session = array(
						'login' => TRUE,
						'username' => $this->user,
						'nm_mhs' => $this->nama_cmhs,
						'kode_formulir' => $this->kode_formulir
					);
						$this->session->sess_expiration = '1800'; //session timeout 15 minute
						$this->session->set_userdata($session);
						redirect('beranda');
				}
				else {
					redirect('login');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
