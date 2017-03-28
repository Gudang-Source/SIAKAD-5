<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Prodi_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'prodi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'prodi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'prodi/index.html';
            $config['first_url'] = base_url() . 'prodi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Prodi_model->total_rows($q);
        $prodi = $this->Prodi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'prodi_data' => $prodi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Prodi';
        $data['title'] = 'Prodi';
        $data['assign_js'] = '';
        load_view('prodi/tb_prodi_list', $data);
    }

    public function read($id)
    {
        $row = $this->Prodi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_prodi' => $row->id_prodi,
		'kode_prodi' => $row->kode_prodi,
		'nm_prodi' => $row->nm_prodi,
	    );
            $data['site_title'] = 'Prodi';
            $data['title'] = 'Prodi';
            $data['assign_js'] = '';
            load_view('prodi/tb_prodi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prodi'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('prodi/create_action'),
	    'id_prodi' => set_value('id_prodi'),
	    'kode_prodi' => set_value('kode_prodi'),
	    'nm_prodi' => set_value('nm_prodi'),
	);      $data['site_title'] = 'Prodi';
        $data['title'] = 'Prodi';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('prodi/tb_prodi_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_prodi' => $this->input->post('kode_prodi',TRUE),
		'nm_prodi' => $this->input->post('nm_prodi',TRUE),
	    );

            $this->Prodi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('prodi'));
        }
    }

    public function update($id)
    {
        $row = $this->Prodi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('prodi/update_action'),
		'id_prodi' => set_value('id_prodi', $row->id_prodi),
		'kode_prodi' => set_value('kode_prodi', $row->kode_prodi),
		'nm_prodi' => set_value('nm_prodi', $row->nm_prodi),
	);
            $data['site_title'] = 'Prodi';
            $data['title'] = 'Prodi';
            $data['assign_js'] = '';
            load_view('prodi/tb_prodi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prodi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_prodi', TRUE));
        } else {
            $data = array(
		'kode_prodi' => $this->input->post('kode_prodi',TRUE),
		'nm_prodi' => $this->input->post('nm_prodi',TRUE),
	    );

            $this->Prodi_model->update($this->input->post('id_prodi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('prodi'));
        }
    }

    public function delete($id)
    {
        $row = $this->Prodi_model->get_by_id($id);

        if ($row) {
            $this->Prodi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('prodi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prodi'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_prodi', 'kode prodi', 'trim|required');
	$this->form_validation->set_rules('nm_prodi', 'nm prodi', 'trim|required');

	$this->form_validation->set_rules('id_prodi', 'id_prodi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */