<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agama extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Agama_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'agama/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'agama/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'agama/index.html';
            $config['first_url'] = base_url() . 'agama/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Agama_model->total_rows($q);
        $agama = $this->Agama_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'agama_data' => $agama,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Agama';
        $data['title'] = 'Agama';
        $data['assign_js'] = '';
        load_view('agama/tb_agama_list', $data);
    }

    public function read($id)
    {
        $row = $this->Agama_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_agama' => $row->id_agama,
		'kode_agama' => $row->kode_agama,
		'nm_agama' => $row->nm_agama,
	    );
            $data['site_title'] = 'Agama';
            $data['title'] = 'Agama';
            $data['assign_js'] = '';
            load_view('agama/tb_agama_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agama'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('agama/create_action'),
	    'id_agama' => set_value('id_agama'),
	    'kode_agama' => set_value('kode_agama'),
	    'nm_agama' => set_value('nm_agama'),
	);      $data['site_title'] = 'Agama';
        $data['title'] = 'Agama';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('agama/tb_agama_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_agama' => $this->input->post('kode_agama',TRUE),
		'nm_agama' => $this->input->post('nm_agama',TRUE),
	    );

            $this->Agama_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('agama'));
        }
    }

    public function update($id)
    {
        $row = $this->Agama_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('agama/update_action'),
		'id_agama' => set_value('id_agama', $row->id_agama),
		'kode_agama' => set_value('kode_agama', $row->kode_agama),
		'nm_agama' => set_value('nm_agama', $row->nm_agama),
	);
            $data['site_title'] = 'Agama';
            $data['title'] = 'Agama';
            $data['assign_js'] = '';
            load_view('agama/tb_agama_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agama'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_agama', TRUE));
        } else {
            $data = array(
		'kode_agama' => $this->input->post('kode_agama',TRUE),
		'nm_agama' => $this->input->post('nm_agama',TRUE),
	    );

            $this->Agama_model->update($this->input->post('id_agama', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('agama'));
        }
    }

    public function delete($id)
    {
        $row = $this->Agama_model->get_by_id($id);

        if ($row) {
            $this->Agama_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('agama'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('agama'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_agama', 'kode agama', 'trim|required');
	$this->form_validation->set_rules('nm_agama', 'nm agama', 'trim|required');

	$this->form_validation->set_rules('id_agama', 'id_agama', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */