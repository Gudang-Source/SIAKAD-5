<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_ulang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Daftar_ulang_model');
        $this->load->model('App_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->create();
    }

    public function create()
    {
        $row = $this->App_model->get_query("SELECT * FROM v_daftar_ulang WHERE kode_formulir ='". $this->session->userdata('kode_formulir')."'")->row();
        if ($row) {
            $data = array(
          		'id_daftar_ulang' => $row->id_daftar_ulang,
          		'kode_daftar_ulang' => $row->kode_daftar_ulang,
          		'kode_ujian' => $row->kode_ujian,
          		'c_nim' => $row->c_nim,
          		'no_telp' => $row->no_telp,
                'tgl_masuk' => $row->tgl_masuk,
                'file_ijasah' => $row->file_ijasah ,
                'id_ujian' => $row->id_ujian,
                'kode_ujian' => $row->kode_ujian,
                'id_mhs' => $row->id_mhs,
                'kode_cmhs' => $row->kode_cmhs,
                'kode_formulir' => $row->kode_formulir ,
                'nm_pendaftar' => $row->nm_pendaftar ,
                'smt_masuk' => $row->smt_masuk ,
                'ta_angkatan' => $row->ta_angkatan ,
                'thn_akademik' => $row->thn_akademik ,
                'no_ktp' => $row->no_ktp,
                'tpt_lhr' => $row->tpt_lhr,
                'tgl_lhr' => $row->tgl_lhr,
                'jenkel' => $row->jenkel,
                'alamat' => $row->alamat,
                'asal_sekolah' => $row->asal_sekolah,
                'email' => $row->email,
                'file_foto' => $row->file_foto,
                'kode_prodi' => $row->kode_prodi,
                'nm_prodi' => $row->nm_prodi,
                'kode_agama' => $row->kode_agama,
                'nm_agama' => $row->nm_agama,
                'kode_ayah' => $row->kode_ayah,
                'nm_ayah' => $row->nm_ayah,
                'kode_peker_ayah' => $row->kode_peker_ayah,
                'nm_peker_ayah' => $row->nm_peker_ayah,
                'kode_hasil_ayah' => $row->kode_hasil_ayah,
                'penghasilan_ayah' => $row->penghasilan_ayah,
                'tgl_lahir_ayah' => $row->tgl_lahir_ayah,
                'tpt_lahir_ayah' => $row->tpt_lahir_ayah,

                'kode_ibu' => $row->kode_ibu,
                'nm_ibu' => $row->nm_ibu,
                'kode_peker_ibu' => $row->kode_peker_ibu,
                'nm_peker_ibu' => $row->nm_peker_ibu,
                'tgl_lahir_ibu' => $row->tgl_lahir_ibu,
                'tpt_lahir_ibu' => $row->tpt_lahir_ibu,

                'kode_hasil_ibu' => $row->kode_hasil_ibu,
                'penghasilan_ibu' => $row->penghasilan_ibu,
                'kode_wilayah' => $row->kode_wilayah,
                'nm_wilayah' => $row->nm_wilayah,
                'kode_status_awal' => $row->kode_status_awal,
                'nm_status_awal' => $row->nm_status_awal,
                'kode_status_mhs' => $row->kode_status_mhs,
                'nm_status_mhs' => $row->nm_status_mhs,
                'status_sync' => $row->status_sync,
                'cek_data' => True
      	    );
            //echo json_encode($data);
            $data['site_title'] = 'Pendaftaran Ulang';
            $data['title'] = 'Data Pendaftaran Ulang';
            $data['assign_js'] = 'daftar_ulang/js/index.js';
            load_view('daftar_ulang/tb_daftar_ulang_read', $data);
        }
        else {
            $cmhs = $this->App_model->get_query("SELECT * FROM v_cmhs WHERE kode_formulir ='". $this->session->userdata('kode_formulir')."'")->row();

            $peserta = $this->App_model->get_query("SELECT * FROM v_peserta_ujian WHERE kode_formulir ='". $this->session->userdata('kode_formulir')."'")->row();

            $hasil = $this->App_model->get_query("SELECT * FROM v_hasil_ujian WHERE kode_cmhs='".$cmhs->kode_cmhs."'")->row();

            $data_cek = $this->App_model->get_query("SELECT c_nim,kode_daftar_ulang FROM v_daftar_ulang ORDER BY kode_daftar_ulang DESC LIMIT 0,1")->row();

            $tb_ayah =$this->App_model->get_query("SELECT * FROM tb_ayah WHERE kode_cmhs='".$cmhs->kode_cmhs."'")->row();
            if ($tb_ayah) {
                $data_ayah= $tb_ayah->kode_ayah;
            }
            else {
                $data_ayah= "";
            }

            $tb_ibu=$this->App_model->get_query("SELECT * FROM tb_ibu WHERE kode_cmhs='".$cmhs->kode_cmhs."'")->row();
            if ($tb_ibu) {
                $data_ibu=$tb_ibu->kode_ibu;
            }
            else {
                $data_ibu="";
            }

            $nim = "";
            if ($data_cek) {
                $nim = $data_cek->c_nim + 1;
            }
            else {
                $nim = $cmhs->kode_prodi.substr($cmhs->kode_angkatan, 2,2)."001";
            }
            //echo $nim;
            if ($cmhs && $cmhs->status_ujian =='Y' && $hasil->status_ujian=='L') {
                $data = array(
                    'id_daftar_ulang' => set_value('id_daftar_ulang'),
            	    'kode_daftar_ulang' => $peserta->kode_ujian.".".$nim,
            	    'kode_ujian' => $peserta->kode_ujian,
            	    'c_nim' => $nim,
            	    'no_telp' => set_value('no_telp'),
            	    'kode_ayah' => $data_ayah,
            	    'kode_ibu' => $data_ibu,
            	    'tgl_masuk' => set_value('tgl_masuk'),
            	    'kode_wilayah' => set_value('kode_wilayah'),
            	    'kode_status_awal' => set_value('kode_status_awal'),
            	    // 'kode_status_mhs' => set_value('kode_status_mhs'),
            	    'file_ijasah' => set_value('file_ijasah'),
                    'button' => 'Registrasi',
                    // 'uri' => 'create',
                    'kode_cmhs' => $cmhs->kode_cmhs,
                    'action' => site_url('daftar_ulang/create_action'),
                );
                $tb_pekerjaan=$this->App_model->get_query("SELECT * FROM tb_pekerjaan ")->result();
                $tb_penghasilan=$this->App_model->get_query("SELECT * FROM tb_penghasilan ")->result();
                $tb_wilayah=$this->App_model->get_query("SELECT * FROM tb_wilayah ")->result();
                $tb_status_awal=$this->App_model->get_query("SELECT * FROM tb_status_awal ")->result();

                $data['tb_status_awal']=$tb_status_awal;
                $data['tb_wilayah']=$tb_wilayah;
                $data['tb_penghasilan']=$tb_penghasilan;
                $data['tb_pekerjaan']=$tb_pekerjaan;
                $data['site_title'] = 'Pendaftaran Ulang';
                $data['title'] = 'Formulir Data Pendaftaran Ulang';
                $data['assign_js'] = 'daftar_ulang/js/index.js';
                load_view('daftar_ulang/tb_daftar_ulang_form', $data);
            }
            else {
                echo "Anda Belum Terdaftar Sama Sekali";
            }
        }
    }
    public function create_action()
    {
        $this->_rules();
        $t=time();
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
    		'kode_daftar_ulang' => $this->input->post('kode_daftar_ulang',TRUE),
    		'kode_ujian' => $this->input->post('kode_ujian',TRUE),
    		'c_nim' => $this->input->post('c_nim',TRUE),
    		'no_telp' => $this->input->post('no_telp',TRUE),
    		'kode_ayah' => $this->input->post('kode_ayah',TRUE),
    		'kode_ibu' => $this->input->post('kode_ibu',TRUE),
    		'tgl_masuk' => date("Y-m-d",$t),
    		'kode_wilayah' => $this->input->post('kode_wilayah',TRUE),
    		'kode_status_awal' => $this->input->post('kode_status_awal',TRUE),
    		'kode_status_mhs' => "3",
    		'file_ijasah' => $this->input->post('file_ijasah',TRUE),
    	    );

            $this->Daftar_ulang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function update($id)
    {
        $row = $this->Daftar_ulang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('daftar_ulang/update_action'),
        		'id_daftar_ulang' => set_value('id_daftar_ulang', $row->id_daftar_ulang),
        		'kode_daftar_ulang' => set_value('kode_daftar_ulang', $row->kode_daftar_ulang),
        		'kode_ujian' => set_value('kode_ujian', $row->kode_ujian),
        		'c_nim' => set_value('c_nim', $row->c_nim),
        		'no_telp' => set_value('no_telp', $row->no_telp),
        		'kode_ayah' => set_value('kode_ayah', $row->kode_ayah),
        		'kode_ibu' => set_value('kode_ibu', $row->kode_ibu),
        		'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
        		'kode_wilayah' => set_value('kode_wilayah', $row->kode_wilayah),
        		'kode_status_awal' => set_value('kode_status_awal', $row->kode_status_awal),
        		'kode_status_mhs' => set_value('kode_status_mhs', $row->kode_status_mhs),
        		'file_ijasah' => set_value('file_ijasah', $row->file_ijasah),
                'uri' => 'edit',
        	);
            $data['site_title'] = 'Daftar_ulang';
            $data['title'] = 'Daftar_ulang';
            $data['assign_js'] = '';
            load_view('daftar_ulang/tb_daftar_ulang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_daftar_ulang', TRUE));
        } else {
            $data = array(
		'kode_daftar_ulang' => $this->input->post('kode_daftar_ulang',TRUE),
		'kode_ujian' => $this->input->post('kode_ujian',TRUE),
		'c_nim' => $this->input->post('c_nim',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'kode_ayah' => $this->input->post('kode_ayah',TRUE),
		'kode_ibu' => $this->input->post('kode_ibu',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'kode_wilayah' => $this->input->post('kode_wilayah',TRUE),
		'kode_status_awal' => $this->input->post('kode_status_awal',TRUE),
		'kode_status_mhs' => $this->input->post('kode_status_mhs',TRUE),
		'file_ijasah' => $this->input->post('file_ijasah',TRUE),
	    );

            $this->Daftar_ulang_model->update($this->input->post('id_daftar_ulang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function delete($id)
    {
        $row = $this->Daftar_ulang_model->get_by_id($id);

        if ($row) {
            $this->Daftar_ulang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('daftar_ulang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_ulang'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_daftar_ulang', 'kode daftar ulang', 'trim|required');
	$this->form_validation->set_rules('kode_ujian', 'kode ujian', 'trim|required');
	$this->form_validation->set_rules('c_nim', 'c nim', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('kode_ayah', 'kode ayah', 'trim|required');
	$this->form_validation->set_rules('kode_ibu', 'kode ibu', 'trim|required');
	// $this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
	$this->form_validation->set_rules('kode_wilayah', 'kode wilayah', 'trim|required');
	$this->form_validation->set_rules('kode_status_awal', 'kode status awal', 'trim|required');
	// $this->form_validation->set_rules('kode_status_mhs', 'kode status mhs', 'trim|required');
	// $this->form_validation->set_rules('file_ijasah', 'file ijasah', 'trim|required');

	$this->form_validation->set_rules('id_daftar_ulang', 'id_daftar_ulang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_daftar_ulang.xls";
        $judul = "tb_daftar_ulang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Daftar Ulang");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ujian");
	xlsWriteLabel($tablehead, $kolomhead++, "C Nim");
	xlsWriteLabel($tablehead, $kolomhead++, "No Telp");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ayah");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Ibu");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Wilayah");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Status Awal");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Status Mhs");
	xlsWriteLabel($tablehead, $kolomhead++, "File Ijasah");

	foreach ($this->Daftar_ulang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_daftar_ulang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ujian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->c_nim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ayah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_ibu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_wilayah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_status_awal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_status_mhs);
	    xlsWriteNumber($tablebody, $kolombody++, $data->file_ijasah);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function create_ayah()
    {
        $this->_rules();
        $this->load->model('Ayah_model');
        $data = array(
            'kode_ayah' => $this->input->post('kode_ayah_1',TRUE),
            'kode_cmhs' => $this->input->post('kode_cmhs_1',TRUE),
            'nm_ayah' => $this->input->post('nm_ayah',TRUE),
            'kode_pekerjaan' => $this->input->post('kode_peker_ayah',TRUE),
            'kode_penghasilan' => $this->input->post('kode_penghasilan_ayah',TRUE),
            'tgl_lahir_ayah' => $this->input->post('tgl_lahir_ayah',TRUE),
            'tpt_lahir_ayah' => $this->input->post('tpt_lhr_ayah',TRUE),
        );
        $cek = $this->Ayah_model->insert($data);
        if (!$cek) {
            echo 0;
        }
        else {
            // echo 1;
            $row = $this->App_model->get_query("SELECT kode_ayah FROM tb_ayah WHERE kode_cmhs='".$this->input->post('kode_cmhs_1',TRUE)."'")->row();
            echo json_encode($row);
        }
    }


    public function create_ibu()
    {
        $this->_rules();
        $this->load->model('Ibu_model');
        $data = array(
            'kode_ibu' => $this->input->post('kode_ibu_1',TRUE),
            'kode_cmhs' => $this->input->post('kode_cmhs_2',TRUE),
            'nm_ibu' => $this->input->post('nm_ibu',TRUE),
            'kode_pekerjaan' => $this->input->post('kode_peker_ibu',TRUE),
            'kode_penghasilan' => $this->input->post('kode_penghasilan_ibu',TRUE),
            'tgl_lahir_ibu' => $this->input->post('tgl_lahir_ibu',TRUE),
            'tpt_lahir_ibu' => $this->input->post('tpt_lhr_ibu',TRUE),
        );
        $cek = $this->Ibu_model->insert($data);
        if (!$cek) {
            echo 0;
        }
        else {
            // echo 1;
            $row = $this->App_model->get_query("SELECT kode_ibu FROM tb_ibu WHERE kode_cmhs='".$this->input->post('kode_cmhs_2',TRUE)."'")->row();
            echo json_encode($row);
        }
    }

}

/* PTT */
