<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_ulang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Daftar_ulang_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'daftar_ulang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'daftar_ulang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'daftar_ulang/index.html';
            $config['first_url'] = base_url() . 'daftar_ulang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Daftar_ulang_model->total_rows($q);
        $daftar_ulang = $this->Daftar_ulang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'daftar_ulang_data' => $daftar_ulang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Daftar_ulang';
        $data['title'] = 'Daftar_ulang';
        $data['assign_js'] = '';
        load_view('daftar_ulang/tb_daftar_ulang_list', $data);
    }

    public function read($id)
    {
        $row = $this->Daftar_ulang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_daftar_ulang' => $row->id_daftar_ulang,
		'kode_daftar_ulang' => $row->kode_daftar_ulang,
		'kode_ujian' => $row->kode_ujian,
		'c_nim' => $row->c_nim,
		'no_telp' => $row->no_telp,
		'kode_ayah' => $row->kode_ayah,
		'kode_ibu' => $row->kode_ibu,
		'tgl_masuk' => $row->tgl_masuk,
		'kode_wilayah' => $row->kode_wilayah,
		'kode_status_awal' => $row->kode_status_awal,
		'kode_status_mhs' => $row->kode_status_mhs,
		'file_ijasah' => $row->file_ijasah,
	    );
            $data['site_title'] = 'Daftar_ulang';
            $data['title'] = 'Daftar_ulang';
            $data['assign_js'] = '';
            load_view('daftar_ulang/tb_daftar_ulang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('daftar_ulang/create_action'),
	    'id_daftar_ulang' => set_value('id_daftar_ulang'),
	    'kode_daftar_ulang' => set_value('kode_daftar_ulang'),
	    'kode_ujian' => set_value('kode_ujian'),
	    'c_nim' => set_value('c_nim'),
	    'no_telp' => set_value('no_telp'),
	    'kode_ayah' => set_value('kode_ayah'),
	    'kode_ibu' => set_value('kode_ibu'),
	    'tgl_masuk' => set_value('tgl_masuk'),
	    'kode_wilayah' => set_value('kode_wilayah'),
	    'kode_status_awal' => set_value('kode_status_awal'),
	    'kode_status_mhs' => set_value('kode_status_mhs'),
	    'file_ijasah' => set_value('file_ijasah'),
	);
   $tb_ayah=$this->App_model->get_query("SELECT * FROM tb_ayah ")->result();
                
   $data['tb_ayah']=$tb_ayah;
   $tb_ibu=$this->App_model->get_query("SELECT * FROM tb_ibu ")->result();
                
   $data['tb_ibu']=$tb_ibu;
   $tb_wilayah=$this->App_model->get_query("SELECT * FROM tb_wilayah ")->result();
                
   $data['tb_wilayah']=$tb_wilayah;
   $tb_status_awal=$this->App_model->get_query("SELECT * FROM tb_status_awal ")->result();
                
   $data['tb_status_awal']=$tb_status_awal;
   $tb_status_mhs=$this->App_model->get_query("SELECT * FROM tb_status_mhs ")->result();
                
   $data['tb_status_mhs']=$tb_status_mhs;      $data['site_title'] = 'Daftar_ulang';
        $data['title'] = 'Daftar_ulang';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('daftar_ulang/tb_daftar_ulang_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_daftar_ulang' => $this->input->post('kode_daftar_ulang',TRUE),
		'kode_ujian' => $this->input->post('kode_ujian',TRUE),
		'c_nim' => $this->input->post('c_nim',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'kode_ayah' => $this->input->post('kode_ayah',TRUE),
		'kode_ibu' => $this->input->post('kode_ibu',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'kode_wilayah' => $this->input->post('kode_wilayah',TRUE),
		'kode_status_awal' => $this->input->post('kode_status_awal',TRUE),
		'kode_status_mhs' => $this->input->post('kode_status_mhs',TRUE),
		'file_ijasah' => $this->input->post('file_ijasah',TRUE),
	    );

            $this->Daftar_ulang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function update($id)
    {
        $row = $this->Daftar_ulang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('daftar_ulang/update_action'),
		'id_daftar_ulang' => set_value('id_daftar_ulang', $row->id_daftar_ulang),
		'kode_daftar_ulang' => set_value('kode_daftar_ulang', $row->kode_daftar_ulang),
		'kode_ujian' => set_value('kode_ujian', $row->kode_ujian),
		'c_nim' => set_value('c_nim', $row->c_nim),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'kode_ayah' => set_value('kode_ayah', $row->kode_ayah),
		'kode_ibu' => set_value('kode_ibu', $row->kode_ibu),
		'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
		'kode_wilayah' => set_value('kode_wilayah', $row->kode_wilayah),
		'kode_status_awal' => set_value('kode_status_awal', $row->kode_status_awal),
		'kode_status_mhs' => set_value('kode_status_mhs', $row->kode_status_mhs),
		'file_ijasah' => set_value('file_ijasah', $row->file_ijasah),
	);
            $data['site_title'] = 'Daftar_ulang';
            $data['title'] = 'Daftar_ulang';
            $data['assign_js'] = '';
            load_view('daftar_ulang/tb_daftar_ulang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_daftar_ulang', TRUE));
        } else {
            $data = array(
		'kode_daftar_ulang' => $this->input->post('kode_daftar_ulang',TRUE),
		'kode_ujian' => $this->input->post('kode_ujian',TRUE),
		'c_nim' => $this->input->post('c_nim',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'kode_ayah' => $this->input->post('kode_ayah',TRUE),
		'kode_ibu' => $this->input->post('kode_ibu',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'kode_wilayah' => $this->input->post('kode_wilayah',TRUE),
		'kode_status_awal' => $this->input->post('kode_status_awal',TRUE),
		'kode_status_mhs' => $this->input->post('kode_status_mhs',TRUE),
		'file_ijasah' => $this->input->post('file_ijasah',TRUE),
	    );

            $this->Daftar_ulang_model->update($this->input->post('id_daftar_ulang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function delete($id)
    {
        $row = $this->Daftar_ulang_model->get_by_id($id);

        if ($row) {
            $this->Daftar_ulang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('daftar_ulang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_daftar_ulang', 'kode daftar ulang', 'trim|required');
	$this->form_validation->set_rules('kode_ujian', 'kode ujian', 'trim|required');
	$this->form_validation->set_rules('c_nim', 'c nim', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('kode_ayah', 'kode ayah', 'trim|required');
	$this->form_validation->set_rules('kode_ibu', 'kode ibu', 'trim|required');
	$this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
	$this->form_validation->set_rules('kode_wilayah', 'kode wilayah', 'trim|required');
	$this->form_validation->set_rules('kode_status_awal', 'kode status awal', 'trim|required');
	$this->form_validation->set_rules('kode_status_mhs', 'kode status mhs', 'trim|required');
	$this->form_validation->set_rules('file_ijasah', 'file ijasah', 'trim|required');

	$this->form_validation->set_rules('id_daftar_ulang', 'id_daftar_ulang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_daftar_ulang.xls";
        $judul = "tb_daftar_ulang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Daftar Ulang");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ujian");
	xlsWriteLabel($tablehead, $kolomhead++, "C Nim");
	xlsWriteLabel($tablehead, $kolomhead++, "No Telp");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ayah");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ibu");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Wilayah");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Status Awal");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Status Mhs");
	xlsWriteLabel($tablehead, $kolomhead++, "File Ijasah");

	foreach ($this->Daftar_ulang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_daftar_ulang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ujian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->c_nim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ayah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ibu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_wilayah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_status_awal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_status_mhs);
	    xlsWriteNumber($tablebody, $kolombody++, $data->file_ijasah);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */