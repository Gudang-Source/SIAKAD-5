<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai_trans extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Nilai_trans_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        //$nilai_trans = $this->Nilai_trans_model->get_all();
        $nilai_trans = $this->App_model->get_query("SELECT * FROM v_nilai_transfer")->result();
        $data = array(
            'nilai_trans_data' => $nilai_trans
        );
        $data['site_title'] = 'SIPAD';
        $data['title_page'] = 'Olah Data Nilai Mahasiswa Transfer';
        $data['assign_js'] = 'nilai_trans/js/index.js';
        load_view('nilai_trans/tb_nilai_trans_list', $data);
    }

    public function read($id)
    {
        $row = $this->Nilai_trans_model->get_by_id($id);
        if ($row) {
          $data = array(
        		'id_nilai_trans' => $row->id_nilai_trans,
        		'id_mhs_trans' => $row->id_mhs_trans,
        		'id_mk' => $row->id_mk,
        		'kode_mk_asal' => $row->kode_mk_asal,
        		'nm_mk_asal' => $row->nm_mk_asal,
        		'sks_asal' => $row->sks_asal,
        		'sks_diakui' => $row->sks_diakui,
        		'nilai_huruf_asal' => $row->nilai_huruf_asal,
        		'nilai_huruf_diakui' => $row->nilai_huruf_diakui,
        		'nilai_angka_diakui' => $row->nilai_angka_diakui,
	        );
          $data['site_title'] = 'SIPAD';
          $data['title_page'] = 'Olah Data Nilai Mahasiswa Transfer';
          $data['assign_js'] = 'nilai_trans/js/index.js';
          load_view('nilai_trans/tb_nilai_trans_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_trans'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('nilai_trans/create_action'),
      	    'id_nilai_trans' => set_value('id_nilai_trans'),
      	    'id_mhs_trans' => set_value('id_mhs_trans'),
      	    'id_mk' => set_value('id_mk'),
      	    'kode_mk_asal' => set_value('kode_mk_asal'),
      	    'nm_mk_asal' => set_value('nm_mk_asal'),
      	    'sks_asal' => set_value('sks_asal'),
      	    'sks_diakui' => set_value('sks_diakui'),
      	    'nilai_huruf_asal' => set_value('nilai_huruf_asal'),
      	    'nilai_huruf_diakui' => set_value('nilai_huruf_diakui'),
      	    'nilai_angka_diakui' => set_value('nilai_angka_diakui'),
      	);
        $data['site_title'] = 'SIPAD';
        $data['title_page'] = 'Olah Data Nilai Mahasiswa Transfer';
        $data['assign_js'] = 'nilai_trans/js/index.js';
        load_view('nilai_trans/tb_nilai_trans_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_mhs_trans' => $this->input->post('id_mhs_trans',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
		'kode_mk_asal' => $this->input->post('kode_mk_asal',TRUE),
		'nm_mk_asal' => $this->input->post('nm_mk_asal',TRUE),
		'sks_asal' => $this->input->post('sks_asal',TRUE),
		'sks_diakui' => $this->input->post('sks_diakui',TRUE),
		'nilai_huruf_asal' => $this->input->post('nilai_huruf_asal',TRUE),
		'nilai_huruf_diakui' => $this->input->post('nilai_huruf_diakui',TRUE),
		'nilai_angka_diakui' => $this->input->post('nilai_angka_diakui',TRUE),
	    );

            $this->Nilai_trans_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('nilai_trans'));
        }
    }

    public function update($id)
    {
        $row = $this->Nilai_trans_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('nilai_trans/update_action'),
            		'id_nilai_trans' => set_value('id_nilai_trans', $row->id_nilai_trans),
            		'id_mhs_trans' => set_value('id_mhs_trans', $row->id_mhs_trans),
            		'id_mk' => set_value('id_mk', $row->id_mk),
            		'kode_mk_asal' => set_value('kode_mk_asal', $row->kode_mk_asal),
            		'nm_mk_asal' => set_value('nm_mk_asal', $row->nm_mk_asal),
            		'sks_asal' => set_value('sks_asal', $row->sks_asal),
            		'sks_diakui' => set_value('sks_diakui', $row->sks_diakui),
            		'nilai_huruf_asal' => set_value('nilai_huruf_asal', $row->nilai_huruf_asal),
            		'nilai_huruf_diakui' => set_value('nilai_huruf_diakui', $row->nilai_huruf_diakui),
            		'nilai_angka_diakui' => set_value('nilai_angka_diakui', $row->nilai_angka_diakui),
            );
            $data['site_title'] = 'SIPAD';
            $data['title_page'] = 'Olah Data Nilai Mahasiswa Transfer';
            $data['assign_js'] = 'nilai_trans/js/index.js';
            load_view('nilai_trans/tb_nilai_trans_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_trans'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nilai_trans', TRUE));
        } else {
            $data = array(
		'id_mhs_trans' => $this->input->post('id_mhs_trans',TRUE),
		'id_mk' => $this->input->post('id_mk',TRUE),
		'kode_mk_asal' => $this->input->post('kode_mk_asal',TRUE),
		'nm_mk_asal' => $this->input->post('nm_mk_asal',TRUE),
		'sks_asal' => $this->input->post('sks_asal',TRUE),
		'sks_diakui' => $this->input->post('sks_diakui',TRUE),
		'nilai_huruf_asal' => $this->input->post('nilai_huruf_asal',TRUE),
		'nilai_huruf_diakui' => $this->input->post('nilai_huruf_diakui',TRUE),
		'nilai_angka_diakui' => $this->input->post('nilai_angka_diakui',TRUE),
	    );

            $this->Nilai_trans_model->update($this->input->post('id_nilai_trans', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nilai_trans'));
        }
    }

    public function delete($id)
    {
        $row = $this->Nilai_trans_model->get_by_id($id);

        if ($row) {
            $this->Nilai_trans_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('nilai_trans'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_trans'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_mhs_trans', 'id mhs trans', 'trim|required');
	$this->form_validation->set_rules('id_mk', 'id mk', 'trim|required');
	$this->form_validation->set_rules('kode_mk_asal', 'kode mk asal', 'trim|required');
	$this->form_validation->set_rules('nm_mk_asal', 'nm mk asal', 'trim|required');
	$this->form_validation->set_rules('sks_asal', 'sks asal', 'trim|required');
	$this->form_validation->set_rules('sks_diakui', 'sks diakui', 'trim|required');
	$this->form_validation->set_rules('nilai_huruf_asal', 'nilai huruf asal', 'trim|required');
	$this->form_validation->set_rules('nilai_huruf_diakui', 'nilai huruf diakui', 'trim|required');
	$this->form_validation->set_rules('nilai_angka_diakui', 'nilai angka diakui', 'trim|required');

	$this->form_validation->set_rules('id_nilai_trans', 'id_nilai_trans', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_nilai_trans.xls";
        $judul = "tb_nilai_trans";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Induk Mahasiswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Mata Kuliah");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mata Kuliah Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Kode Mk Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nm Mk Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Sks Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Sks Diakui");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Huruf Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Huruf Diakui");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Angka Diakui");

      	foreach ($this->App_model->get_query("SELECT * FROM v_nilai_transfer")->result() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->nim);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_mk);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_mk_now);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_mk_asal);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_mk_asal);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->sks_asal);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->sks_diakui);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_huruf_asal);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_huruf_diakui);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai_angka_diakui);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function get_mhs_trans()
    {
      $cari = $this->input->post('q');
      $temp_cari = $cari==''?'':$cari;
      $page = $this->input->post('page');
      if ($page=='') {
        $data_krs = $this->App_model->get_query("SELECT * FROM v_mhs_transfer")->result();
      }
      else {
        $data_krs = $this->App_model->get_query("SELECT * FROM v_mhs_transfer WHERE nim LIKE '%".$cari."%' ")->result();
      }

      $temps = array();
      foreach ($data_krs as $key) {
        $temps[] = array(
          'id_trans' => $key->id_trans,
          'nim' => $key->nim,
          'nm_mhs' => $key->nama
        );
      }
      echo json_encode($temps);
    }

    public function get_mata_kuliah()
    {
      $cari = $this->input->post('q');
      $temp_cari = $cari==''?'':$cari;
      $page = $this->input->post('page');
      if ($page=='') {
        $data_krs = $this->App_model->get_query("SELECT * FROM tb_mata_kuliah")->result();
      }
      else {
        $data_krs = $this->App_model->get_query("SELECT * FROM tb_mata_kuliah WHERE nm_mk LIKE '%".$cari."%' OR semester LIKE '%".$cari."%' ")->result();
      }

      $temps = array();
      foreach ($data_krs as $key) {
        $temps[] = array(
          'id_mk' => $key->kode_mk,
          'nm_mk' => $key->nm_mk,
          'smt' => $key->semester
        );
      }
      echo json_encode($temps);
    }

    public function excelone()
    {
        $nim_mhs = $this->input->post('nim');
        $this->load->helper('exportexcel');
        $namaFile = $nim_mhs."_nilai_konversi.xls";
        $judul = "Hasil Konversi Mahasiswa";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Induk Mahasiswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Mata Kuliah");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mata Kuliah Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Kode Mk Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nm Mk Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Sks Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Sks Diakui");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Huruf Asal");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Huruf Diakui");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Angka Diakui");

      	foreach ($this->App_model->get_query("SELECT * FROM v_nilai_transfer WHERE nim='".$nim_mhs."'")->result() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->nim);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_mk);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_mk_now);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_mk_asal);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_mk_asal);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->sks_asal);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->sks_diakui);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_huruf_asal);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_huruf_diakui);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai_angka_diakui);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
