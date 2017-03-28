<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penghasilan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Penghasilan_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'penghasilan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penghasilan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penghasilan/index.html';
            $config['first_url'] = base_url() . 'penghasilan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penghasilan_model->total_rows($q);
        $penghasilan = $this->Penghasilan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penghasilan_data' => $penghasilan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Penghasilan';
        $data['title'] = 'Penghasilan';
        $data['assign_js'] = '';
        load_view('penghasilan/tb_penghasilan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Penghasilan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_penghasilan' => $row->id_penghasilan,
		'kode_penghasilan' => $row->kode_penghasilan,
		'penghasilan' => $row->penghasilan,
	    );
            $data['site_title'] = 'Penghasilan';
            $data['title'] = 'Penghasilan';
            $data['assign_js'] = '';
            load_view('penghasilan/tb_penghasilan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penghasilan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('penghasilan/create_action'),
	    'id_penghasilan' => set_value('id_penghasilan'),
	    'kode_penghasilan' => set_value('kode_penghasilan'),
	    'penghasilan' => set_value('penghasilan'),
	);      $data['site_title'] = 'Penghasilan';
        $data['title'] = 'Penghasilan';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('penghasilan/tb_penghasilan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_penghasilan' => $this->input->post('kode_penghasilan',TRUE),
		'penghasilan' => $this->input->post('penghasilan',TRUE),
	    );

            $this->Penghasilan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('penghasilan'));
        }
    }

    public function update($id)
    {
        $row = $this->Penghasilan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penghasilan/update_action'),
		'id_penghasilan' => set_value('id_penghasilan', $row->id_penghasilan),
		'kode_penghasilan' => set_value('kode_penghasilan', $row->kode_penghasilan),
		'penghasilan' => set_value('penghasilan', $row->penghasilan),
	);
            $data['site_title'] = 'Penghasilan';
            $data['title'] = 'Penghasilan';
            $data['assign_js'] = '';
            load_view('penghasilan/tb_penghasilan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penghasilan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penghasilan', TRUE));
        } else {
            $data = array(
		'kode_penghasilan' => $this->input->post('kode_penghasilan',TRUE),
		'penghasilan' => $this->input->post('penghasilan',TRUE),
	    );

            $this->Penghasilan_model->update($this->input->post('id_penghasilan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penghasilan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Penghasilan_model->get_by_id($id);

        if ($row) {
            $this->Penghasilan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penghasilan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penghasilan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_penghasilan', 'kode penghasilan', 'trim|required');
	$this->form_validation->set_rules('penghasilan', 'penghasilan', 'trim|required');

	$this->form_validation->set_rules('id_penghasilan', 'id_penghasilan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */