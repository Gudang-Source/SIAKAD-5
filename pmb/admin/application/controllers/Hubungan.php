<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hubungan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Hubungan_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'hubungan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'hubungan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'hubungan/index.html';
            $config['first_url'] = base_url() . 'hubungan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Hubungan_model->total_rows($q);
        $hubungan = $this->Hubungan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'hubungan_data' => $hubungan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Hubungan';
        $data['title'] = 'Hubungan';
        $data['assign_js'] = '';
        load_view('hubungan/tb_hubungan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Hubungan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_hubungan' => $row->id_hubungan,
		'kode_hubungan' => $row->kode_hubungan,
		'nm_hubungan' => $row->nm_hubungan,
	    );
            $data['site_title'] = 'Hubungan';
            $data['title'] = 'Hubungan';
            $data['assign_js'] = '';
            load_view('hubungan/tb_hubungan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hubungan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('hubungan/create_action'),
	    'id_hubungan' => set_value('id_hubungan'),
	    'kode_hubungan' => set_value('kode_hubungan'),
	    'nm_hubungan' => set_value('nm_hubungan'),
	);      $data['site_title'] = 'Hubungan';
        $data['title'] = 'Hubungan';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('hubungan/tb_hubungan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_hubungan' => $this->input->post('kode_hubungan',TRUE),
		'nm_hubungan' => $this->input->post('nm_hubungan',TRUE),
	    );

            $this->Hubungan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('hubungan'));
        }
    }

    public function update($id)
    {
        $row = $this->Hubungan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hubungan/update_action'),
		'id_hubungan' => set_value('id_hubungan', $row->id_hubungan),
		'kode_hubungan' => set_value('kode_hubungan', $row->kode_hubungan),
		'nm_hubungan' => set_value('nm_hubungan', $row->nm_hubungan),
	);
            $data['site_title'] = 'Hubungan';
            $data['title'] = 'Hubungan';
            $data['assign_js'] = '';
            load_view('hubungan/tb_hubungan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hubungan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_hubungan', TRUE));
        } else {
            $data = array(
		'kode_hubungan' => $this->input->post('kode_hubungan',TRUE),
		'nm_hubungan' => $this->input->post('nm_hubungan',TRUE),
	    );

            $this->Hubungan_model->update($this->input->post('id_hubungan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hubungan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Hubungan_model->get_by_id($id);

        if ($row) {
            $this->Hubungan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hubungan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hubungan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_hubungan', 'kode hubungan', 'trim|required');
	$this->form_validation->set_rules('nm_hubungan', 'nm hubungan', 'trim|required');

	$this->form_validation->set_rules('id_hubungan', 'id_hubungan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */