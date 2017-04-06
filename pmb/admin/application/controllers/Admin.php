<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/index.html';
            $config['first_url'] = base_url() . 'admin/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_model->total_rows($q);
        $admin = $this->Admin_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_data' => $admin,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Admin';
        $data['title'] = 'Admin';
        $data['assign_js'] = '';
        load_view('admin/tb_admin_list', $data);
    }

    public function read($id)
    {
        $row = $this->Admin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_admin' => $row->id_admin,
		'kode_admin' => $row->kode_admin,
		'username' => $row->username,
		'password' => $row->password,
		'kode_pegawai' => $row->kode_pegawai,
	    );
            $data['site_title'] = 'Admin';
            $data['title'] = 'Admin';
            $data['assign_js'] = '';
            load_view('admin/tb_admin_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('admin/create_action'),
	    'id_admin' => set_value('id_admin'),
	    'kode_admin' => set_value('kode_admin'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'kode_pegawai' => set_value('kode_pegawai'),
	);
   $tb_pegawai=$this->App_model->get_query("SELECT * FROM tb_pegawai ")->result();
                
   $data['tb_pegawai']=$tb_pegawai;      $data['site_title'] = 'Admin';
        $data['title'] = 'Admin';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('admin/tb_admin_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_admin' => $this->input->post('kode_admin',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
	    );

            $this->Admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin'));
        }
    }

    public function update($id)
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/update_action'),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'kode_admin' => set_value('kode_admin', $row->kode_admin),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'kode_pegawai' => set_value('kode_pegawai', $row->kode_pegawai),
	);
            $data['site_title'] = 'Admin';
            $data['title'] = 'Admin';
            $data['assign_js'] = '';
            load_view('admin/tb_admin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_admin', TRUE));
        } else {
            $data = array(
		'kode_admin' => $this->input->post('kode_admin',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
	    );

            $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin'));
        }
    }

    public function delete($id)
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $this->Admin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_admin', 'kode admin', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('kode_pegawai', 'kode pegawai', 'trim|required');

	$this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* PTT */