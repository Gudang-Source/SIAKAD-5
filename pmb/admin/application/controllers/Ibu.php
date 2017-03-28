<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ibu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ibu_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'ibu/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ibu/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ibu/index.html';
            $config['first_url'] = base_url() . 'ibu/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ibu_model->total_rows($q);
        $ibu = $this->Ibu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ibu_data' => $ibu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Ibu';
        $data['title'] = 'Ibu';
        $data['assign_js'] = '';
        load_view('ibu/tb_ibu_list', $data);
    }

    public function read($id)
    {
        $row = $this->Ibu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ibu' => $row->id_ibu,
		'kode_ibu' => $row->kode_ibu,
		'kode_cmhs' => $row->kode_cmhs,
		'nm_ibu' => $row->nm_ibu,
		'kode_pekerjaan' => $row->kode_pekerjaan,
		'kode_penghasilan' => $row->kode_penghasilan,
	    );
            $data['site_title'] = 'Ibu';
            $data['title'] = 'Ibu';
            $data['assign_js'] = '';
            load_view('ibu/tb_ibu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ibu'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('ibu/create_action'),
	    'id_ibu' => set_value('id_ibu'),
	    'kode_ibu' => set_value('kode_ibu'),
	    'kode_cmhs' => set_value('kode_cmhs'),
	    'nm_ibu' => set_value('nm_ibu'),
	    'kode_pekerjaan' => set_value('kode_pekerjaan'),
	    'kode_penghasilan' => set_value('kode_penghasilan'),
	);
   $tb_pekerjaan=$this->App_model->get_query("SELECT * FROM tb_pekerjaan ")->result();
                
   $data['tb_pekerjaan']=$tb_pekerjaan;
   $tb_penghasilan=$this->App_model->get_query("SELECT * FROM tb_penghasilan ")->result();
                
   $data['tb_penghasilan']=$tb_penghasilan;      $data['site_title'] = 'Ibu';
        $data['title'] = 'Ibu';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('ibu/tb_ibu_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_ibu' => $this->input->post('kode_ibu',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'nm_ibu' => $this->input->post('nm_ibu',TRUE),
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'kode_penghasilan' => $this->input->post('kode_penghasilan',TRUE),
	    );

            $this->Ibu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ibu'));
        }
    }

    public function update($id)
    {
        $row = $this->Ibu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ibu/update_action'),
		'id_ibu' => set_value('id_ibu', $row->id_ibu),
		'kode_ibu' => set_value('kode_ibu', $row->kode_ibu),
		'kode_cmhs' => set_value('kode_cmhs', $row->kode_cmhs),
		'nm_ibu' => set_value('nm_ibu', $row->nm_ibu),
		'kode_pekerjaan' => set_value('kode_pekerjaan', $row->kode_pekerjaan),
		'kode_penghasilan' => set_value('kode_penghasilan', $row->kode_penghasilan),
	);
            $data['site_title'] = 'Ibu';
            $data['title'] = 'Ibu';
            $data['assign_js'] = '';
            load_view('ibu/tb_ibu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ibu'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ibu', TRUE));
        } else {
            $data = array(
		'kode_ibu' => $this->input->post('kode_ibu',TRUE),
		'kode_cmhs' => $this->input->post('kode_cmhs',TRUE),
		'nm_ibu' => $this->input->post('nm_ibu',TRUE),
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'kode_penghasilan' => $this->input->post('kode_penghasilan',TRUE),
	    );

            $this->Ibu_model->update($this->input->post('id_ibu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ibu'));
        }
    }

    public function delete($id)
    {
        $row = $this->Ibu_model->get_by_id($id);

        if ($row) {
            $this->Ibu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ibu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ibu'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_ibu', 'kode ibu', 'trim|required');
	$this->form_validation->set_rules('kode_cmhs', 'kode cmhs', 'trim|required');
	$this->form_validation->set_rules('nm_ibu', 'nm ibu', 'trim|required');
	$this->form_validation->set_rules('kode_pekerjaan', 'kode pekerjaan', 'trim|required');
	$this->form_validation->set_rules('kode_penghasilan', 'kode penghasilan', 'trim|required');

	$this->form_validation->set_rules('id_ibu', 'id_ibu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_ibu.xls";
        $judul = "tb_ibu";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ibu");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Cmhs");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Ibu");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pekerjaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Penghasilan");

	foreach ($this->Ibu_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ibu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_cmhs);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_ibu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pekerjaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_penghasilan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */