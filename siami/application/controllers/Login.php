<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Model_autentikasi");
	}

	public function index(){
		$this->load->view('view_login');
	}

	public function proseslogin(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$this->form_validation->set_rules("username","Username","required|trim");
		$this->form_validation->set_rules("password","Password","required|trim");
		if($this->form_validation->run()){
			$cekdata = $this->Model_autentikasi->ceklogin($username, $password);
			// echo json_encode($cekdata);
			if($cekdata){
				foreach($cekdata as $cek){
					$nama = $cek ['nama_admin'];
				}
				$dlogin['nama'] = $nama;
				$dlogin['status_login'] = TRUE;
				$this->session->set_userdata($dlogin);
				redirect(site_url()."home");
			}
			else{
				$this->session->set_flashdata("error","Username dan Password yang dimasukkan salah.");
				redirect(site_url()."login");
			}
		}
		else{
			$this->session->set_flashdata("error","Username dan Password yang dimasukkan salah.");
			redirect(site_url()."login");
		}
	}

	public function logout(){
		$dlogin['nama'] = "";
		$dlogin['status_login'] = FALSE;
		$this->session->unset_userdata($dlogin);
		$this->session->sess_destroy();
		$this->session->set_flashdata("pesan","Terima kasih telah menggunakan sistem ini. Semoga anda sehat selalu.");
		redirect(site_url()."login");
	}
}

?>
