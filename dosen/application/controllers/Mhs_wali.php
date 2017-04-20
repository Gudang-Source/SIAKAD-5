<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mhs_wali extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
          redirect('auth');
        }
        else if($this->session->userdata('level') != 'dosen'){
            redirect('auth/logout');
        }
        else{
          $this->load->model('Mhs_wali_model');
          $this->load->model('App_model','app_model');
          $this->load->library('form_validation');
        }
    }

    public function index()
    {
      //$mhs_wali = $this->Mhs_wali_model->get_all();
        $mhs_wali = $this->app_model->get_query("SELECT * FROM v_mhs_wali WHERE id_dosen='". $this->session->userdata('nidn')."'")->result();

        $data = array(
            'mhs_wali_data' => $mhs_wali
        );
        $data['site_title'] = 'Dosen';
		$data['title_page'] = 'Olah Data Perwalian Anda';
		$data['assign_js'] = 'mhs_wali/js/index.js';
        load_view('mhs_wali/tb_mhs_wali_list', $data);
    }

    public function read($id)
    {
        $row = $this->Mhs_wali_model->get_by_id($id);
        if ($row) {
            $data = array(
          		'id_mhs_wali' => $row->id_mhs_wali,
          		'id_dosen_wali' => $row->id_dosen_wali,
          		'id_mhs' => $row->id_mhs,
          	);
            $data['site_title'] = 'SIMALA';
            $data['title_page'] = 'Olah Data Perwalian Mahasiswa';
            $data['assign_js'] = 'mhs_wali/js/index.js';
            load_view('mhs_wali/tb_mhs_wali_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mhs_wali'));
        }
    }

    public function periodeData($nim='',$kd_prodi='')
    {
        $data_mhs_krs = $this->app_model->get_query("SELECT * FROM v_mhs_krs WHERE nim=".$nim." AND kd_prodi=".$kd_prodi." ORDER BY ta,status_ambil DESC")->result();
        $data_mhs = $this->app_model->get_query("SELECT * FROM v_mhs_krs WHERE nim=".$nim." AND kd_prodi=".$kd_prodi." ORDER BY ta,status_ambil DESC")->row();
        // echo json_encode($data_mhs_krs);
        // $count_mhs_krs = $this->app_model->get_query("SELECT COUNT(*) as jml_ambil FROM v_mhs_krs WHERE nim=".$nim)->row();
        //
        // $data_periode = $this->app_model->get_query("SELECT * FROM tb_kurikulum WHERE kd_prodi=".$kd_prodi)->row();
        $data = array(
            'data_mhs_krs' => $data_mhs_krs,
            'data_mhs' => $data_mhs,
        );
        $data['site_title'] = 'SIMALA';
        $data['kode_prodi'] = $kd_prodi;
        $data['nim'] = $nim;
        $data['title_page'] = 'Kumpulan Periode Mahasiswa Terkait';
        $data['assign_js'] = 'mhs_wali/js/index.js';
        load_view('mhs_wali/tb_mhs_data_krs_list', $data);
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('id_dosen_wali', 'id dosen wali', 'trim|required');
    	$this->form_validation->set_rules('id_mhs', 'id mhs', 'trim|required');

    	$this->form_validation->set_rules('id_mhs_wali', 'id_mhs_wali', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function buka_periode_krs($id,$nim='',$kd_prodi='')
    {
        $data = array(
            'status_buka' => 'Y'
        );
        $status = $this->app_model->update('tb_mhs_krs','id_krs',$id, $data);
        if (!$status) {
            $this->session->set_flashdata('message', 'Periode KRS Gagal Dibuka');
            redirect(site_url('mhs_wali/periodedata/'.$nim.'/'.$kd_prodi));
        }
        else {

            $this->session->set_flashdata('message', 'Periode KRS Telah Dibuka');
            redirect(site_url('mhs_wali/periodedata/'.$nim.'/'.$kd_prodi));
        }
    }


}
