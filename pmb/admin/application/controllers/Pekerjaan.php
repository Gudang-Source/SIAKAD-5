<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pekerjaan_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pekerjaan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pekerjaan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pekerjaan/index.html';
            $config['first_url'] = base_url() . 'pekerjaan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pekerjaan_model->total_rows($q);
        $pekerjaan = $this->Pekerjaan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pekerjaan_data' => $pekerjaan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Pekerjaan';
        $data['title'] = 'Pekerjaan';
        $data['assign_js'] = '';
        load_view('pekerjaan/tb_pekerjaan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Pekerjaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pekerjaan' => $row->id_pekerjaan,
		'kode_pekerjaan' => $row->kode_pekerjaan,
		'nm_pekerjaan' => $row->nm_pekerjaan,
	    );
            $data['site_title'] = 'Pekerjaan';
            $data['title'] = 'Pekerjaan';
            $data['assign_js'] = '';
            load_view('pekerjaan/tb_pekerjaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('pekerjaan/create_action'),
	    'id_pekerjaan' => set_value('id_pekerjaan'),
	    'kode_pekerjaan' => set_value('kode_pekerjaan'),
	    'nm_pekerjaan' => set_value('nm_pekerjaan'),
	);      $data['site_title'] = 'Pekerjaan';
        $data['title'] = 'Pekerjaan';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('pekerjaan/tb_pekerjaan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'nm_pekerjaan' => $this->input->post('nm_pekerjaan',TRUE),
	    );

            $this->Pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pekerjaan'));
        }
    }

    public function update($id)
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pekerjaan/update_action'),
		'id_pekerjaan' => set_value('id_pekerjaan', $row->id_pekerjaan),
		'kode_pekerjaan' => set_value('kode_pekerjaan', $row->kode_pekerjaan),
		'nm_pekerjaan' => set_value('nm_pekerjaan', $row->nm_pekerjaan),
	);
            $data['site_title'] = 'Pekerjaan';
            $data['title'] = 'Pekerjaan';
            $data['assign_js'] = '';
            load_view('pekerjaan/tb_pekerjaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pekerjaan', TRUE));
        } else {
            $data = array(
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'nm_pekerjaan' => $this->input->post('nm_pekerjaan',TRUE),
	    );

            $this->Pekerjaan_model->update($this->input->post('id_pekerjaan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pekerjaan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_pekerjaan', 'kode pekerjaan', 'trim|required');
	$this->form_validation->set_rules('nm_pekerjaan', 'nm pekerjaan', 'trim|required');

	$this->form_validation->set_rules('id_pekerjaan', 'id_pekerjaan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */