<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peserta_ujian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Peserta_ujian_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'peserta_ujian/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'peserta_ujian/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'peserta_ujian/index.html';
            $config['first_url'] = base_url() . 'peserta_ujian/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Peserta_ujian_model->total_rows($q);
        $peserta_ujian = $this->Peserta_ujian_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'peserta_ujian_data' => $peserta_ujian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Peserta_ujian';
        $data['title'] = 'Peserta_ujian';
        $data['assign_js'] = '';
        load_view('peserta_ujian/tb_peserta_ujian_list', $data);
    }

    public function read($id)
    {
        $row = $this->Peserta_ujian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ujian' => $row->id_ujian,
		'kode_ujian' => $row->kode_ujian,
		'kode_cmhs' => $row->kode_cmhs,
		'kode_ruangan' => $row->kode_ruangan,
		'n_wawancara' => $row->n_wawancara,
		'n_psikotes' => $row->n_psikotes,
		'n_bhs' => $row->n_bhs,
		'n_umum' => $row->n_umum,
		'status_ujian' => $row->status_ujian,
	    );
            $data['site_title'] = 'Peserta_ujian';
            $data['title'] = 'Peserta_ujian';
            $data['assign_js'] = '';
            load_view('peserta_ujian/tb_peserta_ujian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta_ujian'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('peserta_ujian/create_action'),
	    'id_ujian' => set_value('id_ujian'),
	    'kode_ujian' => set_value('kode_ujian'),
	    'kode_cmhs' => set_value('kode_cmhs'),
	    'kode_ruangan' => set_value('kode_ruangan'),
	    'n_wawancara' => set_value('n_wawancara'),
	    'n_psikotes' => set_value('n_psikotes'),
	    'n_bhs' => set_value('n_bhs'),
	    'n_umum' => set_value('n_umum'),
	    'status_ujian' => set_value('status_ujian'),
	);
   $tb_cmhs=$this->App_model->get_query("SELECT * FROM tb_cmhs ")->result();
                
   $data['tb_cmhs']=$tb_cmhs;
   $tb_ruangan=$this->App_model->get_query("SELECT * FROM tb_ruangan ")->result();
                
   $data['tb_ruangan']=$tb_ruangan;      $data['site_title'] = 'Peserta_ujian';
        $data['title'] = 'Peserta_ujian';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('peserta_ujian/tb_peserta_ujian_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_ujian' => $this->input->post('kode_ujian',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'kode_ruangan' => $this->input->post('kode_ruangan',TRUE),
		'n_wawancara' => $this->input->post('n_wawancara',TRUE),
		'n_psikotes' => $this->input->post('n_psikotes',TRUE),
		'n_bhs' => $this->input->post('n_bhs',TRUE),
		'n_umum' => $this->input->post('n_umum',TRUE),
		'status_ujian' => $this->input->post('status_ujian',TRUE),
	    );

            $this->Peserta_ujian_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('peserta_ujian'));
        }
    }

    public function update($id)
    {
        $row = $this->Peserta_ujian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('peserta_ujian/update_action'),
		'id_ujian' => set_value('id_ujian', $row->id_ujian),
		'kode_ujian' => set_value('kode_ujian', $row->kode_ujian),
		'kode_cmhs' => set_value('kode_cmhs', $row->kode_cmhs),
		'kode_ruangan' => set_value('kode_ruangan', $row->kode_ruangan),
		'n_wawancara' => set_value('n_wawancara', $row->n_wawancara),
		'n_psikotes' => set_value('n_psikotes', $row->n_psikotes),
		'n_bhs' => set_value('n_bhs', $row->n_bhs),
		'n_umum' => set_value('n_umum', $row->n_umum),
		'status_ujian' => set_value('status_ujian', $row->status_ujian),
	);
            $data['site_title'] = 'Peserta_ujian';
            $data['title'] = 'Peserta_ujian';
            $data['assign_js'] = '';
            load_view('peserta_ujian/tb_peserta_ujian_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta_ujian'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ujian', TRUE));
        } else {
            $data = array(
		'kode_ujian' => $this->input->post('kode_ujian',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'kode_ruangan' => $this->input->post('kode_ruangan',TRUE),
		'n_wawancara' => $this->input->post('n_wawancara',TRUE),
		'n_psikotes' => $this->input->post('n_psikotes',TRUE),
		'n_bhs' => $this->input->post('n_bhs',TRUE),
		'n_umum' => $this->input->post('n_umum',TRUE),
		'status_ujian' => $this->input->post('status_ujian',TRUE),
	    );

            $this->Peserta_ujian_model->update($this->input->post('id_ujian', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('peserta_ujian'));
        }
    }

    public function delete($id)
    {
        $row = $this->Peserta_ujian_model->get_by_id($id);

        if ($row) {
            $this->Peserta_ujian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('peserta_ujian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta_ujian'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_ujian', 'kode ujian', 'trim|required');
	$this->form_validation->set_rules('kode_cmhs', 'kode cmhs', 'trim|required');
	$this->form_validation->set_rules('kode_ruangan', 'kode ruangan', 'trim|required');
	$this->form_validation->set_rules('n_wawancara', 'n wawancara', 'trim|required');
	$this->form_validation->set_rules('n_psikotes', 'n psikotes', 'trim|required');
	$this->form_validation->set_rules('n_bhs', 'n bhs', 'trim|required');
	$this->form_validation->set_rules('n_umum', 'n umum', 'trim|required');
	$this->form_validation->set_rules('status_ujian', 'status ujian', 'trim|required');

	$this->form_validation->set_rules('id_ujian', 'id_ujian', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_peserta_ujian.xls";
        $judul = "tb_peserta_ujian";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ujian");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Cmhs");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ruangan");
	xlsWriteLabel($tablehead, $kolomhead++, "N Wawancara");
	xlsWriteLabel($tablehead, $kolomhead++, "N Psikotes");
	xlsWriteLabel($tablehead, $kolomhead++, "N Bhs");
	xlsWriteLabel($tablehead, $kolomhead++, "N Umum");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Ujian");

	foreach ($this->Peserta_ujian_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ujian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_cmhs);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ruangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->n_wawancara);
	    xlsWriteLabel($tablebody, $kolombody++, $data->n_psikotes);
	    xlsWriteLabel($tablebody, $kolombody++, $data->n_bhs);
	    xlsWriteLabel($tablebody, $kolombody++, $data->n_umum);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_ujian);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */