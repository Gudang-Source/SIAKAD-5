<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ruangan_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'ruangan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ruangan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ruangan/index.html';
            $config['first_url'] = base_url() . 'ruangan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ruangan_model->total_rows($q);
        $ruangan = $this->Ruangan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ruangan_data' => $ruangan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Ruangan';
        $data['title'] = 'Ruangan';
        $data['assign_js'] = '';
        load_view('ruangan/tb_ruangan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Ruangan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ruangan' => $row->id_ruangan,
		'kode_ruangan' => $row->kode_ruangan,
		'nm_ruangan' => $row->nm_ruangan,
	    );
            $data['site_title'] = 'Ruangan';
            $data['title'] = 'Ruangan';
            $data['assign_js'] = '';
            load_view('ruangan/tb_ruangan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('ruangan/create_action'),
	    'id_ruangan' => set_value('id_ruangan'),
	    'kode_ruangan' => set_value('kode_ruangan'),
	    'nm_ruangan' => set_value('nm_ruangan'),
	);      $data['site_title'] = 'Ruangan';
        $data['title'] = 'Ruangan';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('ruangan/tb_ruangan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_ruangan' => $this->input->post('kode_ruangan',TRUE),
		'nm_ruangan' => $this->input->post('nm_ruangan',TRUE),
	    );

            $this->Ruangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ruangan'));
        }
    }

    public function update($id)
    {
        $row = $this->Ruangan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ruangan/update_action'),
		'id_ruangan' => set_value('id_ruangan', $row->id_ruangan),
		'kode_ruangan' => set_value('kode_ruangan', $row->kode_ruangan),
		'nm_ruangan' => set_value('nm_ruangan', $row->nm_ruangan),
	);
            $data['site_title'] = 'Ruangan';
            $data['title'] = 'Ruangan';
            $data['assign_js'] = '';
            load_view('ruangan/tb_ruangan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ruangan', TRUE));
        } else {
            $data = array(
		'kode_ruangan' => $this->input->post('kode_ruangan',TRUE),
		'nm_ruangan' => $this->input->post('nm_ruangan',TRUE),
	    );

            $this->Ruangan_model->update($this->input->post('id_ruangan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ruangan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Ruangan_model->get_by_id($id);

        if ($row) {
            $this->Ruangan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ruangan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_ruangan', 'kode ruangan', 'trim|required');
	$this->form_validation->set_rules('nm_ruangan', 'nm ruangan', 'trim|required');

	$this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */