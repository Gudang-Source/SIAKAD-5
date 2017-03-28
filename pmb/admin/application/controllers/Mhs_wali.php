<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mhs_wali extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mhs_wali_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'mhs_wali/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'mhs_wali/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'mhs_wali/index.html';
            $config['first_url'] = base_url() . 'mhs_wali/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Mhs_wali_model->total_rows($q);
        $mhs_wali = $this->Mhs_wali_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'mhs_wali_data' => $mhs_wali,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Mhs_wali';
        $data['title'] = 'Mhs_wali';
        $data['assign_js'] = '';
        load_view('mhs_wali/tb_mhs_wali_list', $data);
    }

    public function read($id)
    {
        $row = $this->Mhs_wali_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_mhs_wali' => $row->id_mhs_wali,
		'kode_mhs_wali' => $row->kode_mhs_wali,
		'kode_cmhs' => $row->kode_cmhs,
		'nm_wali' => $row->nm_wali,
		'kode_hubungan' => $row->kode_hubungan,
	    );
            $data['site_title'] = 'Mhs_wali';
            $data['title'] = 'Mhs_wali';
            $data['assign_js'] = '';
            load_view('mhs_wali/tb_mhs_wali_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mhs_wali'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('mhs_wali/create_action'),
	    'id_mhs_wali' => set_value('id_mhs_wali'),
	    'kode_mhs_wali' => set_value('kode_mhs_wali'),
	    'kode_cmhs' => set_value('kode_cmhs'),
	    'nm_wali' => set_value('nm_wali'),
	    'kode_hubungan' => set_value('kode_hubungan'),
	);
   $tb_hubungan=$this->App_model->get_query("SELECT * FROM tb_hubungan ")->result();
                
   $data['tb_hubungan']=$tb_hubungan;      $data['site_title'] = 'Mhs_wali';
        $data['title'] = 'Mhs_wali';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('mhs_wali/tb_mhs_wali_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_mhs_wali' => $this->input->post('kode_mhs_wali',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'nm_wali' => $this->input->post('nm_wali',TRUE),
		'kode_hubungan' => $this->input->post('kode_hubungan',TRUE),
	    );

            $this->Mhs_wali_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mhs_wali'));
        }
    }

    public function update($id)
    {
        $row = $this->Mhs_wali_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mhs_wali/update_action'),
		'id_mhs_wali' => set_value('id_mhs_wali', $row->id_mhs_wali),
		'kode_mhs_wali' => set_value('kode_mhs_wali', $row->kode_mhs_wali),
		'kode_cmhs' => set_value('kode_cmhs', $row->kode_cmhs),
		'nm_wali' => set_value('nm_wali', $row->nm_wali),
		'kode_hubungan' => set_value('kode_hubungan', $row->kode_hubungan),
	);
            $data['site_title'] = 'Mhs_wali';
            $data['title'] = 'Mhs_wali';
            $data['assign_js'] = '';
            load_view('mhs_wali/tb_mhs_wali_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mhs_wali'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mhs_wali', TRUE));
        } else {
            $data = array(
		'kode_mhs_wali' => $this->input->post('kode_mhs_wali',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'nm_wali' => $this->input->post('nm_wali',TRUE),
		'kode_hubungan' => $this->input->post('kode_hubungan',TRUE),
	    );

            $this->Mhs_wali_model->update($this->input->post('id_mhs_wali', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mhs_wali'));
        }
    }

    public function delete($id)
    {
        $row = $this->Mhs_wali_model->get_by_id($id);

        if ($row) {
            $this->Mhs_wali_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mhs_wali'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mhs_wali'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_mhs_wali', 'kode mhs wali', 'trim|required');
	$this->form_validation->set_rules('kode_cmhs', 'kode cmhs', 'trim|required');
	$this->form_validation->set_rules('nm_wali', 'nm wali', 'trim|required');
	$this->form_validation->set_rules('kode_hubungan', 'kode hubungan', 'trim|required');

	$this->form_validation->set_rules('id_mhs_wali', 'id_mhs_wali', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_mhs_wali.xls";
        $judul = "tb_mhs_wali";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Mhs Wali");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Cmhs");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Wali");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Hubungan");

	foreach ($this->Mhs_wali_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_mhs_wali);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_cmhs);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_wali);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_hubungan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */