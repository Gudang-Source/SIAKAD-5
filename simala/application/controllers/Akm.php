<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Akm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
          redirect('auth');
        }
        else if($this->session->userdata('level') != 'baak'){
            redirect('auth/logout');
        }
        else {
          $this->load->model('App_model');
          $this->load->library('form_validation');
        }
    }

    public function index()
    {
      
      $data_akm = $this->App_model->get_query("SELECT * FROM v_akm_mhs GROUP BY id_prodi,angkatan ORDER BY angkatan DESC")->result();
      $data['data_akm'] = $data_akm;

      $data['site_title'] = 'SIMALA';
      $data['title_page'] = 'Hitung Aktifitas Mahasiswa';
      $data['assign_js'] = 'akm/js/index.js';
      load_view('akm/tb_akm_index', $data);
    }

  }
