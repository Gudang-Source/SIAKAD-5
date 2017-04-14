<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $user;
	private $pass;
	private $level;
	private $nama;

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
			$data['site_title'] = 'Please Login';
			$this->load->view('tpl/login_view',$data);
		}
	}

	public function login()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('username','Username Feeder','trim|required');
			$this->form_validation->set_rules('password','Password Feeder','required');

			if ($this->form_validation->run() == TRUE) {
				$data = array('username' => $this->input->post('username', TRUE),'password' => $this->input->post('password', TRUE));
				//echo json_encode($data);
				$temp_db = $this->input->post('db_ws',TRUE);

				$hasil = $this->app_model->cek_user($data);
				if ($hasil->num_rows() == 1) {
					foreach ($hasil->result() as $sess){
						$this->user = $sess->username;
						$this->pass = $sess->password;
						$this->level = $sess->level;
						$this->nama = $sess->nama;
					}

					$sessi = array('login' => TRUE,
										'mode' => $temp_db,
										 'url' => base_url(),
									 'user' => $this->user,
									 'level' => $this->level,
									 'nama' => $this->nama
						);

						$this->session->sess_expiration = '1800'; //session timeout 15 minute
						$this->session->set_userdata($sessi);

						if($this->level == 'baak'){
							redirect('Index');
						}
						else {
							redirect('auth');
						}
				}
				else {
					echo "Not Macth";
				}
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth');
	}

	public function set_mode_kunci(){
    $id_smt = $this->input->get('id_smt');
    $nim_c = $this->input->get('nim');
    $kode_bayar_c = $this->input->get('kode_bayar');
    //$id_smt = base64_decode($id_smt_c);//$id_smt_c;//base64_decode($id_smt_c);
    $nim = base64_decode($nim_c);
    $kode_bayar = base64_decode($kode_bayar_c);
    $temp_db_mhs_krs = array('id_krs' => NULL,
                        'id_mhs' =>$nim,
                        'kode_pembayaran' =>$kode_bayar,
                        'id_kurikulum' =>$id_smt,
                        'status_ambil'=>'T',
                        'status_cek'=>'Y',
                      );
    //echo json_encode($temp_db_mhs_krs);
    $cek_bayar = $this->app_model->get_where_data('v_bayar_smt','kode_bayar',$kode_bayar);
    $validasi_bayar = $this->app_model->get_where_data('tb_mhs_krs','kode_pembayaran',$kode_bayar);
    if ($cek_bayar->num_rows() == 1) {
      if ($validasi_bayar->num_rows() == 1) {
        echo "Data Sama";
      }
      else {
        $result = $this->app_model->insertRecord('tb_mhs_krs',$temp_db_mhs_krs);
        if ($result==true) {
          echo true;
        }
        else {
          echo "not oke";
        }
      }
    }
    else {
      echo "Macam-macam Ente";
    }
  }

	public function set_mode_kunci2(){
    $id_smt = $this->input->get('id_smt');
    $nim_c = $this->input->get('nim');
    $kode_bayar_c = $this->input->get('kode_bayar');
    //$id_smt = base64_decode($id_smt_c);//$id_smt_c;//base64_decode($id_smt_c);
    $nim = base64_decode($nim_c);
    $kode_bayar =   $kode_bayar_c;
    $temp_db_mhs_krs = array('id_krs' => NULL,
                        'id_mhs' =>$nim,
                        'kode_pembayaran' =>$kode_bayar,
                        'id_kurikulum' =>$id_smt,
                        'status_ambil'=>'T',
                        'status_cek'=>'Y',
                      );
    //echo json_encode($temp_db_mhs_krs);
    $cek_bayar = $this->app_model->get_where_data('v_bayar_smt','kode_bayar',$kode_bayar);
    $validasi_bayar = $this->app_model->get_where_data('tb_mhs_krs','kode_pembayaran',$kode_bayar);
    if ($cek_bayar->num_rows() == 1) {
      if ($validasi_bayar->num_rows() == 1) {
        echo "Data Sama";
      }
      else {
        $result = $this->app_model->insertRecord('tb_mhs_krs',$temp_db_mhs_krs);
        if ($result==true) {
          echo true;
        }
        else {
          echo "not oke";
        }
      }
    }
    else {
      echo "Macam-macam Ente";
    }
  }

	public function konfirmasiEmail($kode_bayar,$nim,$periode,$token)
	{

		$data_validasi = $this->app_model->get_query("SELECT * FROM tb_mhs_krs WHERE kode_pembayaran='".$kode_bayar."'AND (token='".$token."' AND id_mhs='".$nim."')
			")->row();

		if ($data_validasi != NULL || $data_validasi != '') {
			$data = array(
					'status_ambil' => 'Y'
			);
			$token = str_shuffle("12345abcdefghijklmnop");

			//$this->Mhs_krs_model->update($id_krs, $data);
			$dataUser = array(
				'id_user' => NULL,
				'id_krs' => $data_validasi->id_krs,
				'username' => $nim,
				'password' => $nim,
				'level' =>'mhs',
				'val_periode' => 'Y'
			);
			$insertUser=  1;//$this->app_model->insertRecord('login_mhs',$dataUser);
			if ($insertUser==true) {
				$isi = "<p>Terimakasih Atas Verifikasi Yang anda Lakukan</p>";
				$isi .= "<p>
							NIM : ".$nim." <br>
							USERNAME : ".$username." <br>
							PASSWORD : ".$token."

				</p>";
				$isi .= "<p>Silahkan Login Di  : <a href='http://siakad.stmikadhiguna.ac.id/siakad/simala/auth/'>Disini</a></p>";
				$isi .= "<p>Terima kasih atas perhatiannya<br>- Best Regard,<br>Admin</p>";
				$this->sendEmail('meongbego@gmail.com',$isi);
			}
			else {
				$isi = "<p>Mohon Maaf Verifikasi Yang anda Lakukan Gagal Tersimpan</p>";
				$isi .= "<p>Silahkan Berhubungan Dengan ADMIN Atau Lakukan Validasi Manual di BAAK</p>";
				$isi .= "<p>Terima kasih atas perhatiannya<br>- Best Regard,<br>Admin</p>";
				$this->sendEmail($email='',$token,$username='',$isi);
			}

		}
		else {
			echo "Data Anda Tidak Ditemukan";
		}
	}

	private function sendEmail($email='',$isi)
	{
		$this->load->library('email');
		$subject = 'Akun Pembayaran Periode Berjalan';
		//lib email 1
		$result = $this->email
        ->from("siakad.sagp@gmail.com")
        ->to($email)
        ->subject($subject)
        ->message($isi)
        ->send();
		// if ($result) {
		// 	return TRUE;
		// }
		// else {
		// 	return FALSE;
		// }

	}
}
