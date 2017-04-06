<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cmhs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
          redirect('login');
        }
        else {
          $this->load->model('Cmhs_model');
          $this->load->model('App_model');
          $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $row = $this->App_model->get_query("SELECT * FROM v_cmhs WHERE kode_formulir ='". $this->session->userdata('kode_formulir')."'")->row();
        if ($row) {
            $data = array(
          		'id_mhs' => $row->id_mhs,
          		'kode_cmhs' => $row->kode_cmhs,
          		'kode_formulir' => $row->kode_formulir,
          		'no_ktp' => $row->no_ktp,
          		'nm_agama' => $row->nm_agama,
          		'tpt_lhr' => $row->tpt_lhr,
          		'tgl_lhr' => $row->tgl_lhr,
          		'jenkel' => $row->jenkel,
          		'alamat' => $row->alamat,
          		'asal_sekolah' => $row->asal_sekolah,
          		'email' => $row->email,
               'kode_prodi' => $row->kode_prodi,
          		'nm_prodi' => $row->nm_prodi,
          		'file_foto' => $row->file_foto,
          		'status_ujian' => $row->status_ujian,
      	    );
            $data['site_title'] = 'Biodata';
            $data['title'] = 'Data Diri Anda';
            $data['assign_js'] = '';
            load_view('cmhs/tb_cmhs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cmhs/create'));
        }
    }

    public function create()
    {
      $cmhs_terakhir = $this->App_model->get_query("SELECT m1.kode_cmhs FROM tb_cmhs m1 ORDER BY m1.kode_cmhs DESC LIMIT 1")->row();
      $kode_terakhir = $cmhs_terakhir->kode_cmhs + 1;
      $kode_cmhs =0;
      if ($kode_terakhir >= 10 && $kode_terakhir <=100) {
          $kode_cmhs = 'pmb000'.$kode_terakhir;
      }
      elseif ($kode_terakhir >= 100 && $kode_terakhir <=1000) {
          $kode_cmhs ='pmb000'.$kode_terakhir;
      }
      else {
          $kode_cmhs ='pmb0000'.$kode_terakhir;
      }

      $data = array(
            'button' => 'Create',
            'action' => site_url('cmhs/create_action'),
            'id_mhs' => set_value('id_mhs'),
            'kode_cmhs' => $kode_cmhs,
            'kode_formulir' => $this->session->userdata('kode_formulir'),
            'no_ktp' => set_value('no_ktp'),
            'kode_agama' => set_value('kode_agama'),
            'tpt_lhr' => set_value('tpt_lhr'),
            'tgl_lhr' => set_value('tgl_lhr'),
            'jenkel' => set_value('jenkel'),
            'alamat' => set_value('alamat'),
            'asal_sekolah' => set_value('asal_sekolah'),
            'email' => set_value('email'),
            'kode_prodi' => set_value('kode_prodi'),
            'file_foto' => set_value('file_foto'),
            'status_ujian' => set_value('status_ujian'),
   	);

      $tb_formulir=$this->App_model->get_query("SELECT * FROM tb_formulir ")->result();
      $data['tb_formulir']=$tb_formulir;
      $tb_agama=$this->App_model->get_query("SELECT * FROM tb_agama ")->result();
      $data['tb_agama']=$tb_agama;
      $tb_prodi=$this->App_model->get_query("SELECT * FROM tb_prodi ")->result();

      $data['tb_prodi']=$tb_prodi;      $data['site_title'] = 'Cmhs';
      $data['title'] = 'Cmhs';
      $data['assign_js'] = '';
      $data['assign_js'] = '';
      load_view('cmhs/tb_cmhs_form', $data);
   }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
         		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
         		'kode_formulir' => $this->input->post('kode_formulir',TRUE),
         		'no_ktp' => $this->input->post('no_ktp',TRUE),
         		'kode_agama' => $this->input->post('kode_agama',TRUE),
         		'tpt_lhr' => $this->input->post('tpt_lhr',TRUE),
         		'tgl_lhr' => $this->input->post('tgl_lhr',TRUE),
         		'jenkel' => $this->input->post('jenkel',TRUE),
         		'alamat' => $this->input->post('alamat',TRUE),
         		'asal_sekolah' => $this->input->post('asal_sekolah',TRUE),
         		'email' => $this->input->post('email',TRUE),
         		'kode_prodi' => $this->input->post('kode_prodi',TRUE),
         		'file_foto' => $this->input->post('file_foto',TRUE),
         		'status_ujian' => $this->input->post('status_ujian',TRUE),
         	    );

            $this->Cmhs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cmhs'));
        }
    }


    public function _rules()
    {
   	$this->form_validation->set_rules('kode_cmhs', 'kode cmhs', 'trim|required');
   	$this->form_validation->set_rules('kode_formulir', 'kode formulir', 'trim|required');
   	$this->form_validation->set_rules('no_ktp', 'no ktp', 'trim|required');
   	$this->form_validation->set_rules('kode_agama', 'kode agama', 'trim|required');
   	$this->form_validation->set_rules('tpt_lhr', 'tpt lhr', 'trim|required');
   	$this->form_validation->set_rules('tgl_lhr', 'tgl lhr', 'trim|required');
   	$this->form_validation->set_rules('jenkel', 'jenkel', 'trim|required');
   	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
   	$this->form_validation->set_rules('asal_sekolah', 'asal sekolah', 'trim|required');
   	$this->form_validation->set_rules('email', 'email', 'trim|required');
   	$this->form_validation->set_rules('kode_prodi', 'kode prodi', 'trim|required');
   	$this->form_validation->set_rules('file_foto', 'file foto', 'trim');
   	$this->form_validation->set_rules('status_ujian', 'status ujian', 'trim');
   	$this->form_validation->set_rules('id_mhs', 'id_mhs', 'trim');
   	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */
