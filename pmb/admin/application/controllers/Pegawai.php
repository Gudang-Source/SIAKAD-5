<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pegawai/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pegawai/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pegawai/index.html';
            $config['first_url'] = base_url() . 'pegawai/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pegawai_model->total_rows($q);
        $pegawai = $this->Pegawai_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pegawai_data' => $pegawai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Pegawai';
        $data['title'] = 'Pegawai';
        $data['assign_js'] = '';
        load_view('pegawai/tb_pegawai_list', $data);
    }

    public function read($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pegawai' => $row->id_pegawai,
		'kode_pegawai' => $row->kode_pegawai,
		'nm_pegawai' => $row->nm_pegawai,
	    );
            $data['site_title'] = 'Pegawai';
            $data['title'] = 'Pegawai';
            $data['assign_js'] = '';
            load_view('pegawai/tb_pegawai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/create_action'),
	    'id_pegawai' => set_value('id_pegawai'),
	    'kode_pegawai' => set_value('kode_pegawai'),
	    'nm_pegawai' => set_value('nm_pegawai'),
	);      $data['site_title'] = 'Pegawai';
        $data['title'] = 'Pegawai';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('pegawai/tb_pegawai_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
		'nm_pegawai' => $this->input->post('nm_pegawai',TRUE),
	    );

            $this->Pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai'));
        }
    }

    public function update($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/update_action'),
		'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
		'kode_pegawai' => set_value('kode_pegawai', $row->kode_pegawai),
		'nm_pegawai' => set_value('nm_pegawai', $row->nm_pegawai),
	);
            $data['site_title'] = 'Pegawai';
            $data['title'] = 'Pegawai';
            $data['assign_js'] = '';
            load_view('pegawai/tb_pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pegawai', TRUE));
        } else {
            $data = array(
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
		'nm_pegawai' => $this->input->post('nm_pegawai',TRUE),
	    );

            $this->Pegawai_model->update($this->input->post('id_pegawai', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $this->Pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_pegawai', 'kode pegawai', 'trim|required');
	$this->form_validation->set_rules('nm_pegawai', 'nm pegawai', 'trim|required');

	$this->form_validation->set_rules('id_pegawai', 'id_pegawai', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */