<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status_mhs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Status_mhs_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'status_mhs/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'status_mhs/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'status_mhs/index.html';
            $config['first_url'] = base_url() . 'status_mhs/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Status_mhs_model->total_rows($q);
        $status_mhs = $this->Status_mhs_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'status_mhs_data' => $status_mhs,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Status_mhs';
        $data['title'] = 'Status_mhs';
        $data['assign_js'] = '';
        load_view('status_mhs/tb_status_mhs_list', $data);
    }

    public function read($id)
    {
        $row = $this->Status_mhs_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_status_mhs' => $row->id_status_mhs,
		'kode_status_mhs' => $row->kode_status_mhs,
		'nm_status_mhs' => $row->nm_status_mhs,
	    );
            $data['site_title'] = 'Status_mhs';
            $data['title'] = 'Status_mhs';
            $data['assign_js'] = '';
            load_view('status_mhs/tb_status_mhs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status_mhs'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('status_mhs/create_action'),
	    'id_status_mhs' => set_value('id_status_mhs'),
	    'kode_status_mhs' => set_value('kode_status_mhs'),
	    'nm_status_mhs' => set_value('nm_status_mhs'),
	);      $data['site_title'] = 'Status_mhs';
        $data['title'] = 'Status_mhs';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('status_mhs/tb_status_mhs_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_status_mhs' => $this->input->post('kode_status_mhs',TRUE),
		'nm_status_mhs' => $this->input->post('nm_status_mhs',TRUE),
	    );

            $this->Status_mhs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('status_mhs'));
        }
    }

    public function update($id)
    {
        $row = $this->Status_mhs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('status_mhs/update_action'),
		'id_status_mhs' => set_value('id_status_mhs', $row->id_status_mhs),
		'kode_status_mhs' => set_value('kode_status_mhs', $row->kode_status_mhs),
		'nm_status_mhs' => set_value('nm_status_mhs', $row->nm_status_mhs),
	);
            $data['site_title'] = 'Status_mhs';
            $data['title'] = 'Status_mhs';
            $data['assign_js'] = '';
            load_view('status_mhs/tb_status_mhs_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status_mhs'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_status_mhs', TRUE));
        } else {
            $data = array(
		'kode_status_mhs' => $this->input->post('kode_status_mhs',TRUE),
		'nm_status_mhs' => $this->input->post('nm_status_mhs',TRUE),
	    );

            $this->Status_mhs_model->update($this->input->post('id_status_mhs', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('status_mhs'));
        }
    }

    public function delete($id)
    {
        $row = $this->Status_mhs_model->get_by_id($id);

        if ($row) {
            $this->Status_mhs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('status_mhs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status_mhs'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_status_mhs', 'kode status mhs', 'trim|required');
	$this->form_validation->set_rules('nm_status_mhs', 'nm status mhs', 'trim|required');

	$this->form_validation->set_rules('id_status_mhs', 'id_status_mhs', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */