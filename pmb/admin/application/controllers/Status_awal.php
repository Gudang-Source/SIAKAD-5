<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status_awal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Status_awal_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'status_awal/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'status_awal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'status_awal/index.html';
            $config['first_url'] = base_url() . 'status_awal/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Status_awal_model->total_rows($q);
        $status_awal = $this->Status_awal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'status_awal_data' => $status_awal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Status_awal';
        $data['title'] = 'Status_awal';
        $data['assign_js'] = '';
        load_view('status_awal/tb_status_awal_list', $data);
    }

    public function read($id)
    {
        $row = $this->Status_awal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_status' => $row->id_status,
		'kode_status_awal' => $row->kode_status_awal,
		'nm_status_awal' => $row->nm_status_awal,
	    );
            $data['site_title'] = 'Status_awal';
            $data['title'] = 'Status_awal';
            $data['assign_js'] = '';
            load_view('status_awal/tb_status_awal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status_awal'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('status_awal/create_action'),
	    'id_status' => set_value('id_status'),
	    'kode_status_awal' => set_value('kode_status_awal'),
	    'nm_status_awal' => set_value('nm_status_awal'),
	);      $data['site_title'] = 'Status_awal';
        $data['title'] = 'Status_awal';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('status_awal/tb_status_awal_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_status_awal' => $this->input->post('kode_status_awal',TRUE),
		'nm_status_awal' => $this->input->post('nm_status_awal',TRUE),
	    );

            $this->Status_awal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('status_awal'));
        }
    }

    public function update($id)
    {
        $row = $this->Status_awal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('status_awal/update_action'),
		'id_status' => set_value('id_status', $row->id_status),
		'kode_status_awal' => set_value('kode_status_awal', $row->kode_status_awal),
		'nm_status_awal' => set_value('nm_status_awal', $row->nm_status_awal),
	);
            $data['site_title'] = 'Status_awal';
            $data['title'] = 'Status_awal';
            $data['assign_js'] = '';
            load_view('status_awal/tb_status_awal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status_awal'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_status', TRUE));
        } else {
            $data = array(
		'kode_status_awal' => $this->input->post('kode_status_awal',TRUE),
		'nm_status_awal' => $this->input->post('nm_status_awal',TRUE),
	    );

            $this->Status_awal_model->update($this->input->post('id_status', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('status_awal'));
        }
    }

    public function delete($id)
    {
        $row = $this->Status_awal_model->get_by_id($id);

        if ($row) {
            $this->Status_awal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('status_awal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status_awal'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_status_awal', 'kode status awal', 'trim|required');
	$this->form_validation->set_rules('nm_status_awal', 'nm status awal', 'trim|required');

	$this->form_validation->set_rules('id_status', 'id_status', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */