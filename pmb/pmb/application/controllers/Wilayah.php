<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wilayah_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'wilayah/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'wilayah/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'wilayah/index.html';
            $config['first_url'] = base_url() . 'wilayah/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Wilayah_model->total_rows($q);
        $wilayah = $this->Wilayah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'wilayah_data' => $wilayah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Wilayah';
        $data['title'] = 'Wilayah';
        $data['assign_js'] = '';
        load_view('wilayah/tb_wilayah_list', $data);
    }

    public function read($id)
    {
        $row = $this->Wilayah_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_wilayah' => $row->id_wilayah,
		'kode_wilayah' => $row->kode_wilayah,
		'nm_wilayah' => $row->nm_wilayah,
	    );
            $data['site_title'] = 'Wilayah';
            $data['title'] = 'Wilayah';
            $data['assign_js'] = '';
            load_view('wilayah/tb_wilayah_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wilayah'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('wilayah/create_action'),
	    'id_wilayah' => set_value('id_wilayah'),
	    'kode_wilayah' => set_value('kode_wilayah'),
	    'nm_wilayah' => set_value('nm_wilayah'),
	);      $data['site_title'] = 'Wilayah';
        $data['title'] = 'Wilayah';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('wilayah/tb_wilayah_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_wilayah' => $this->input->post('kode_wilayah',TRUE),
		'nm_wilayah' => $this->input->post('nm_wilayah',TRUE),
	    );

            $this->Wilayah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('wilayah'));
        }
    }

    public function update($id)
    {
        $row = $this->Wilayah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('wilayah/update_action'),
		'id_wilayah' => set_value('id_wilayah', $row->id_wilayah),
		'kode_wilayah' => set_value('kode_wilayah', $row->kode_wilayah),
		'nm_wilayah' => set_value('nm_wilayah', $row->nm_wilayah),
	);
            $data['site_title'] = 'Wilayah';
            $data['title'] = 'Wilayah';
            $data['assign_js'] = '';
            load_view('wilayah/tb_wilayah_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wilayah'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_wilayah', TRUE));
        } else {
            $data = array(
		'kode_wilayah' => $this->input->post('kode_wilayah',TRUE),
		'nm_wilayah' => $this->input->post('nm_wilayah',TRUE),
	    );

            $this->Wilayah_model->update($this->input->post('id_wilayah', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wilayah'));
        }
    }

    public function delete($id)
    {
        $row = $this->Wilayah_model->get_by_id($id);

        if ($row) {
            $this->Wilayah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wilayah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wilayah'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_wilayah', 'kode wilayah', 'trim|required');
	$this->form_validation->set_rules('nm_wilayah', 'nm wilayah', 'trim|required');

	$this->form_validation->set_rules('id_wilayah', 'id_wilayah', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */