<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cmhs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cmhs_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'cmhs/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'cmhs/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'cmhs/index.html';
            $config['first_url'] = base_url() . 'cmhs/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Cmhs_model->total_rows($q);
        $cmhs = $this->Cmhs_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'cmhs_data' => $cmhs,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Cmhs';
        $data['title'] = 'Cmhs';
        $data['assign_js'] = '';
        load_view('cmhs/tb_cmhs_list', $data);
    }

    public function read($id)
    {
        $row = $this->Cmhs_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_mhs' => $row->id_mhs,
		'kode_cmhs' => $row->kode_cmhs,
		'kode_pendaftar' => $row->kode_pendaftar,
		'no_ktp' => $row->no_ktp,
		'kode_agama' => $row->kode_agama,
		'tpt_lhr' => $row->tpt_lhr,
		'tgl_lhr' => $row->tgl_lhr,
		'jenkel' => $row->jenkel,
		'alamat' => $row->alamat,
		'asal_sekolah' => $row->asal_sekolah,
		'email' => $row->email,
		'kode_prodi' => $row->kode_prodi,
		'file_foto' => $row->file_foto,
		'status_ujian' => $row->status_ujian,
	    );
            $data['site_title'] = 'Cmhs';
            $data['title'] = 'Cmhs';
            $data['assign_js'] = '';
            load_view('cmhs/tb_cmhs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cmhs'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('cmhs/create_action'),
	    'id_mhs' => set_value('id_mhs'),
	    'kode_cmhs' => set_value('kode_cmhs'),
	    'kode_pendaftar' => set_value('kode_pendaftar'),
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
		'kode_pendaftar' => $this->input->post('kode_pendaftar',TRUE),
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

    public function update($id)
    {
        $row = $this->Cmhs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cmhs/update_action'),
		'id_mhs' => set_value('id_mhs', $row->id_mhs),
		'kode_cmhs' => set_value('kode_cmhs', $row->kode_cmhs),
		'kode_pendaftar' => set_value('kode_pendaftar', $row->kode_pendaftar),
		'no_ktp' => set_value('no_ktp', $row->no_ktp),
		'kode_agama' => set_value('kode_agama', $row->kode_agama),
		'tpt_lhr' => set_value('tpt_lhr', $row->tpt_lhr),
		'tgl_lhr' => set_value('tgl_lhr', $row->tgl_lhr),
		'jenkel' => set_value('jenkel', $row->jenkel),
		'alamat' => set_value('alamat', $row->alamat),
		'asal_sekolah' => set_value('asal_sekolah', $row->asal_sekolah),
		'email' => set_value('email', $row->email),
		'kode_prodi' => set_value('kode_prodi', $row->kode_prodi),
		'file_foto' => set_value('file_foto', $row->file_foto),
		'status_ujian' => set_value('status_ujian', $row->status_ujian),
	);
            $data['site_title'] = 'Cmhs';
            $data['title'] = 'Cmhs';
            $data['assign_js'] = '';
            load_view('cmhs/tb_cmhs_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cmhs'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mhs', TRUE));
        } else {
            $data = array(
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'kode_pendaftar' => $this->input->post('kode_pendaftar',TRUE),
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

            $this->Cmhs_model->update($this->input->post('id_mhs', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cmhs'));
        }
    }

    public function delete($id)
    {
        $row = $this->Cmhs_model->get_by_id($id);

        if ($row) {
            $this->Cmhs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cmhs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cmhs'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_cmhs', 'kode cmhs', 'trim|required');
	$this->form_validation->set_rules('kode_pendaftar', 'kode pendaftar', 'trim|required');
	$this->form_validation->set_rules('no_ktp', 'no ktp', 'trim|required');
	$this->form_validation->set_rules('kode_agama', 'kode agama', 'trim|required');
	$this->form_validation->set_rules('tpt_lhr', 'tpt lhr', 'trim|required');
	$this->form_validation->set_rules('tgl_lhr', 'tgl lhr', 'trim|required');
	$this->form_validation->set_rules('jenkel', 'jenkel', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('asal_sekolah', 'asal sekolah', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('kode_prodi', 'kode prodi', 'trim|required');
	$this->form_validation->set_rules('file_foto', 'file foto', 'trim|required');
	$this->form_validation->set_rules('status_ujian', 'status ujian', 'trim|required');

	$this->form_validation->set_rules('id_mhs', 'id_mhs', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_cmhs.xls";
        $judul = "tb_cmhs";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Cmhs");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pendaftar");
	xlsWriteLabel($tablehead, $kolomhead++, "No Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Tpt Lhr");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lhr");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenkel");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Asal Sekolah");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Prodi");
	xlsWriteLabel($tablehead, $kolomhead++, "File Foto");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Ujian");

	foreach ($this->Cmhs_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_cmhs);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pendaftar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tpt_lhr);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lhr);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenkel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->asal_sekolah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_prodi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->file_foto);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_ujian);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */