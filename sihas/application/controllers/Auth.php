<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('App_model','app_model');

	}

	public function index()
	{
		//$this->login();
		if ($this->session->userdata('login')) {
				redirect('Index');
		}
		else {
			$pengumuman = $this->app_model->get_query("SELECT * FROM tb_pengumuman WHERE status='Y'")->result();
			$kurikulum = $this->app_model->get_query("SELECT * FROM tb_kurikulum GROUP BY ta ORDER BY ta DESC")->result();
			$data['pengumuman']=$pengumuman;
			$data['kurikulum']=$kurikulum;
			$data['site_title'] = 'Please Login';
			$this->load->view('tpl/login_view',$data);
		}
	}

	public function login()
	{
		$cp_as = htmlspecialchars($this->input->post('isi_capca'),ENT_QUOTES);
		$cp_kt = htmlspecialchars($this->input->post('isi_capca2'),ENT_QUOTES);
		if($cp_as == $cp_kt){
			if ($this->input->post()) {
				$this->form_validation->set_rules('username','Username Feeder','trim|required');
				$this->form_validation->set_rules('password','Password Feeder','required');

				if ($this->form_validation->run() == TRUE) {
					$username = $this->input->post('username', TRUE); //base64_encode();
					$password = $this->input->post('password', TRUE); // base64_encode();
					$ta = $this->input->post('ta', TRUE); // base64_encode();

					$hasil = $this->app_model->get_query("SELECT * FROM z_login_mhs WHERE username='".$username."' AND password='".$password."' AND ta='".$ta."'");
					if ($hasil->num_rows() == 1) {
						$hasil = $hasil->row();
						$session_prodi = array('login' => TRUE,
										 'url' => base_url(),
										 'user' => $hasil->username,
										 'level' => $hasil->level,
										 'nim' => $hasil->nim,
										 'nm_mhs'=> $hasil->nm_mhs,
										 'cheking' => $hasil->status_cek,
										 'status_mhs' => $hasil->status_mhs,
										 'ta' => $hasil->ta,
										 'kode_prodi'=>$hasil->id_prodi,
										 'id_kurikulum'=>$hasil->id_kurikulum
							);

							$this->session->sess_expiration = '1800'; //session timeout 15 minute
							$this->session->set_userdata($session_prodi);

							//cek validasi baak
							if($hasil->level == 'mhs' && $hasil->val_periode=='N' && $hasil->status_cek=='Y'){
								$data = array('val_periode' => "Y");
								$update = $this->app_model->update("login_mhs",'id_user',$hasil->id_user,$data);
								if ($update==true) {
									redirect('Index');
								}
								else {
									echo "Database bermasalah Hubungi Pihak Admin";
								}
							}
							else if ($hasil->level == 'mhs' && $hasil->val_periode=='Y' && $hasil->status_cek=='Y') {
								redirect('Index');
								//echo $this->session->userdata('ta');
							}
							else if ($hasil->level == 'mhs' && $hasil->val_periode=='N' && $hasil->status_cek=='Y') {
								echo "Segera Validasikan Pembayaran Anda Ke BAAK";
							}
							else{
								redirect('auth', 'refresh');
							}
					}
					else {
						echo "Anda Belum Terdaftar Pada Periode Ini Segera Selesaikan Administrasi Anda";
					}
				}
			}
			else {
				redirect('auth', 'refresh');
			}
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth');
	}

	public function get_capcha() {
			$capcha = $this->captcha();
			$data['img'] = $capcha['img'];
			$data['word'] = $capcha['word'];
			$this->load->view('tpl/isi_capcha', $data);
	}

	public function deleteCaptcha()
	{
		$this->deleteImage();
	}

	function captcha() {
			// $this->load->plugin('captcha');
			$str = 'ABCDEFGHJKLMNOPQRSTUVWXYZ';
			$random_word = str_shuffle($str);
			$random_word = substr($random_word, 0, 5);
			$vals = array(
					'word' => $random_word,
					'img_path' => './captcha/',
					'img_url' => base_url().'captcha/',
					'img_width' => '250',
					'img_height' => "40",
					'expiration' => 1000
			);
			// echo json_encode($vals);
			$cap = create_captcha($vals);
			$data = array(
					'captcha_time' => $cap['time'],
					'ip_address' => $this->input->ip_address(),
					'word' => $cap['word']
			);
			$cap_conf = array(
					'img' => $cap['image'],
					'word' => $cap['word']
			);
			return $cap_conf;
	}
}
