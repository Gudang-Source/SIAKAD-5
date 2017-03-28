<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Angkatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Angkatan_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'angkatan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'angkatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'angkatan/index.html';
            $config['first_url'] = base_url() . 'angkatan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Angkatan_model->total_rows($q);
        $angkatan = $this->Angkatan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'angkatan_data' => $angkatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Angkatan';
        $data['title'] = 'Angkatan';
        $data['assign_js'] = '';
        load_view('angkatan/tb_angkatan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Angkatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_angkatan' => $row->id_angkatan,
		'kode_angkatan' => $row->kode_angkatan,
		'thn_akademik' => $row->thn_akademik,
		'tahun' => $row->tahun,
		'status_aktif' => $row->status_aktif,
	    );
            $data['site_title'] = 'Angkatan';
            $data['title'] = 'Angkatan';
            $data['assign_js'] = '';
            load_view('angkatan/tb_angkatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('angkatan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('angkatan/create_action'),
	    'id_angkatan' => set_value('id_angkatan'),
	    'kode_angkatan' => set_value('kode_angkatan'),
	    'thn_akademik' => set_value('thn_akademik'),
	    'tahun' => set_value('tahun'),
	    'status_aktif' => set_value('status_aktif'),
	);      $data['site_title'] = 'Angkatan';
        $data['title'] = 'Angkatan';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('angkatan/tb_angkatan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_angkatan' => $this->input->post('kode_angkatan',TRUE),
		'thn_akademik' => $this->input->post('thn_akademik',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'status_aktif' => $this->input->post('status_aktif',TRUE),
	    );

            $this->Angkatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('angkatan'));
        }
    }

    public function update($id)
    {
        $row = $this->Angkatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('angkatan/update_action'),
		'id_angkatan' => set_value('id_angkatan', $row->id_angkatan),
		'kode_angkatan' => set_value('kode_angkatan', $row->kode_angkatan),
		'thn_akademik' => set_value('thn_akademik', $row->thn_akademik),
		'tahun' => set_value('tahun', $row->tahun),
		'status_aktif' => set_value('status_aktif', $row->status_aktif),
	);
            $data['site_title'] = 'Angkatan';
            $data['title'] = 'Angkatan';
            $data['assign_js'] = '';
            load_view('angkatan/tb_angkatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('angkatan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_angkatan', TRUE));
        } else {
            $data = array(
		'kode_angkatan' => $this->input->post('kode_angkatan',TRUE),
		'thn_akademik' => $this->input->post('thn_akademik',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'status_aktif' => $this->input->post('status_aktif',TRUE),
	    );

            $this->Angkatan_model->update($this->input->post('id_angkatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('angkatan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Angkatan_model->get_by_id($id);

        if ($row) {
            $this->Angkatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('angkatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('angkatan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_angkatan', 'kode angkatan', 'trim|required');
	$this->form_validation->set_rules('thn_akademik', 'thn akademik', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('status_aktif', 'status aktif', 'trim|required');

	$this->form_validation->set_rules('id_angkatan', 'id_angkatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */