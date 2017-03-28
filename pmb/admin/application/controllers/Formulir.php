<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formulir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Formulir_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'formulir/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'formulir/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'formulir/index.html';
            $config['first_url'] = base_url() . 'formulir/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Formulir_model->total_rows($q);
        $formulir = $this->Formulir_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'formulir_data' => $formulir,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['site_title'] = 'Formulir';
        $data['title'] = 'Formulir';
        $data['assign_js'] = '';
        load_view('formulir/tb_formulir_list', $data);
    }

    public function read($id)
    {
        $row = $this->Formulir_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'id_formulir' => $row->id_formulir,
        		'kode_formulir' => $row->kode_formulir,
        		'username' => $row->username,
        		'password' => $row->password,
        		'nm_pendaftar' => $row->nm_pendaftar,
        		'kode_pegawai' => $row->kode_pegawai,
        		'kode_angkatan' => $row->kode_angkatan,
        		'biaya' => $row->biaya,
        	  );
            $data['site_title'] = 'Formulir';
            $data['title'] = 'Formulir';
            $data['assign_js'] = '';
            load_view('formulir/tb_formulir_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('formulir'));
        }
    }

    public function create()
    {
      $data_terakhir = $this->App_model->get_query("SELECT m1.kode_formulir  FROM tb_formulir m1 ORDER BY m1.kode_formulir DESC LIMIT 1")->row();

      $kode_terakhir = $data_terakhir->kode_formulir + 1;
      $kode_formulir =0;
      if ($kode_terakhir >= 10 && $kode_terakhir <=100) {
          $kode_formulir = '000'.$kode_terakhir;
      }
      elseif ($kode_terakhir >= 100 && $kode_terakhir <=1000) {
          $kode_formulir ='000'.$kode_terakhir;
      }
      else {
          $kode_formulir ='0000'.$kode_terakhir;
      }

        $data = array(
            'button' => 'Create',
            'action' => site_url('formulir/create_action'),
            'id_formulir' => set_value('id_formulir'),
            'kode_formulir' => $kode_formulir,
            'username' => $kode_formulir,
            'password' => 'pmb@'.rand(100000,999999),
            'nm_pendaftar' => set_value('nm_pendaftar'),
            'kode_pegawai' => set_value('kode_pegawai'),
            'kode_angkatan' => set_value('kode_angkatan'),
            'biaya' => '2500000'
        );
        $tb_pegawai=$this->App_model->get_query("SELECT * FROM tb_pegawai ")->result();

        $data['tb_pegawai']=$tb_pegawai;
        $tb_angkatan=$this->App_model->get_query("SELECT * FROM tb_angkatan WHERE status_aktif=1")->result();
        $data['tb_angkatan']=$tb_angkatan;
        $data['site_title'] = 'Formulir';
        $data['title'] = 'Formulir';
        $data['assign_js'] = '';
        $data['assign_js'] = '';
        load_view('formulir/tb_formulir_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'kode_formulir' => $this->input->post('kode_formulir',TRUE),
        		'username' => $this->input->post('username',TRUE),
        		'password' => $this->input->post('password',TRUE),
        		'nm_pendaftar' => $this->input->post('nm_pendaftar',TRUE),
        		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
        		'kode_angkatan' => $this->input->post('kode_angkatan',TRUE),
        		'biaya' => $this->input->post('biaya',TRUE),
    	    );
            $this->Formulir_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('formulir'));
        }
    }

    public function update($id)
    {
        $row = $this->Formulir_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('formulir/update_action'),
		'id_formulir' => set_value('id_formulir', $row->id_formulir),
		'kode_formulir' => set_value('kode_formulir', $row->kode_formulir),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'nm_pendaftar' => set_value('nm_pendaftar', $row->nm_pendaftar),
		'kode_pegawai' => set_value('kode_pegawai', $row->kode_pegawai),
		'kode_angkatan' => set_value('kode_angkatan', $row->kode_angkatan),
		'biaya' => set_value('biaya', $row->biaya),
	);
            $data['site_title'] = 'Formulir';
            $data['title'] = 'Formulir';
            $data['assign_js'] = '';
            load_view('formulir/tb_formulir_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('formulir'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_formulir', TRUE));
        } else {
            $data = array(
		'kode_formulir' => $this->input->post('kode_formulir',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'nm_pendaftar' => $this->input->post('nm_pendaftar',TRUE),
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
		'kode_angkatan' => $this->input->post('kode_angkatan',TRUE),
		'biaya' => $this->input->post('biaya',TRUE),
	    );

            $this->Formulir_model->update($this->input->post('id_formulir', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('formulir'));
        }
    }

    public function delete($id)
    {
        $row = $this->Formulir_model->get_by_id($id);

        if ($row) {
            $this->Formulir_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('formulir'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('formulir'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_formulir', 'kode formulir', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('nm_pendaftar', 'nm pendaftar', 'trim|required');
	$this->form_validation->set_rules('kode_pegawai', 'kode pegawai', 'trim|required');
	$this->form_validation->set_rules('kode_angkatan', 'kode angkatan', 'trim|required');
	$this->form_validation->set_rules('biaya', 'biaya', 'trim|required');

	$this->form_validation->set_rules('id_formulir', 'id_formulir', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_formulir.xls";
        $judul = "tb_formulir";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Formulir");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Pendaftar");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Angkatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Biaya");

	foreach ($this->Formulir_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_formulir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_pendaftar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pegawai);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_angkatan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->biaya);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */
