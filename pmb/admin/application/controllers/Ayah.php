<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ayah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ayah_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'ayah/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ayah/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ayah/index.html';
            $config['first_url'] = base_url() . 'ayah/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ayah_model->total_rows($q);
        $ayah = $this->Ayah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ayah_data' => $ayah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Ayah';
        $data['title'] = 'Ayah';
        $data['assign_js'] = '';
        load_view('ayah/tb_ayah_list', $data);
    }

    public function read($id)
    {
        $row = $this->Ayah_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ayah' => $row->id_ayah,
		'kode_ayah' => $row->kode_ayah,
		'kode_cmhs' => $row->kode_cmhs,
		'nm_ayah' => $row->nm_ayah,
		'kode_pekerjaan' => $row->kode_pekerjaan,
		'kode_penghasilan' => $row->kode_penghasilan,
	    );
            $data['site_title'] = 'Ayah';
            $data['title'] = 'Ayah';
            $data['assign_js'] = '';
            load_view('ayah/tb_ayah_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ayah'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('ayah/create_action'),
	    'id_ayah' => set_value('id_ayah'),
	    'kode_ayah' => set_value('kode_ayah'),
	    'kode_cmhs' => set_value('kode_cmhs'),
	    'nm_ayah' => set_value('nm_ayah'),
	    'kode_pekerjaan' => set_value('kode_pekerjaan'),
	    'kode_penghasilan' => set_value('kode_penghasilan'),
	);
   $tb_cmhs=$this->App_model->get_query("SELECT * FROM tb_cmhs ")->result();
                
   $data['tb_cmhs']=$tb_cmhs;
   $tb_pekerjaan=$this->App_model->get_query("SELECT * FROM tb_pekerjaan ")->result();
                
   $data['tb_pekerjaan']=$tb_pekerjaan;
   $tb_penghasilan=$this->App_model->get_query("SELECT * FROM tb_penghasilan ")->result();
                
   $data['tb_penghasilan']=$tb_penghasilan;      $data['site_title'] = 'Ayah';
        $data['title'] = 'Ayah';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('ayah/tb_ayah_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_ayah' => $this->input->post('kode_ayah',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'nm_ayah' => $this->input->post('nm_ayah',TRUE),
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'kode_penghasilan' => $this->input->post('kode_penghasilan',TRUE),
	    );

            $this->Ayah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ayah'));
        }
    }

    public function update($id)
    {
        $row = $this->Ayah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ayah/update_action'),
		'id_ayah' => set_value('id_ayah', $row->id_ayah),
		'kode_ayah' => set_value('kode_ayah', $row->kode_ayah),
		'kode_cmhs' => set_value('kode_cmhs', $row->kode_cmhs),
		'nm_ayah' => set_value('nm_ayah', $row->nm_ayah),
		'kode_pekerjaan' => set_value('kode_pekerjaan', $row->kode_pekerjaan),
		'kode_penghasilan' => set_value('kode_penghasilan', $row->kode_penghasilan),
	);
            $data['site_title'] = 'Ayah';
            $data['title'] = 'Ayah';
            $data['assign_js'] = '';
            load_view('ayah/tb_ayah_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ayah'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ayah', TRUE));
        } else {
            $data = array(
		'kode_ayah' => $this->input->post('kode_ayah',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'nm_ayah' => $this->input->post('nm_ayah',TRUE),
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'kode_penghasilan' => $this->input->post('kode_penghasilan',TRUE),
	    );

            $this->Ayah_model->update($this->input->post('id_ayah', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ayah'));
        }
    }

    public function delete($id)
    {
        $row = $this->Ayah_model->get_by_id($id);

        if ($row) {
            $this->Ayah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ayah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ayah'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_ayah', 'kode ayah', 'trim|required');
	$this->form_validation->set_rules('kode_cmhs', 'kode cmhs', 'trim|required');
	$this->form_validation->set_rules('nm_ayah', 'nm ayah', 'trim|required');
	$this->form_validation->set_rules('kode_pekerjaan', 'kode pekerjaan', 'trim|required');
	$this->form_validation->set_rules('kode_penghasilan', 'kode penghasilan', 'trim|required');

	$this->form_validation->set_rules('id_ayah', 'id_ayah', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */