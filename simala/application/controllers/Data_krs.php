<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_krs extends CI_Controller
{
    private $template;
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
          redirect('auth');
        }
        else if($this->session->userdata('level') != 'baak'){
            redirect('auth/logout');
        }
        else {
          $this->load->model('Data_krs_model');
          $this->load->model('App_model');
          $this->load->library('excel');
          $this->template = './template/krs_khs_template.xlsx';
          // $this->load->model('Kelas_kuliah_model','kelas');
          $this->load->model('mhs_krs_model','mhs_krs');
          $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $data_mhs_krs_periode = $this->App_model->get_query("SELECT * FROM tb_kurikulum m1 ORDER BY m1.ta DESC ")->result();
        // if ($filter == '') {
        //     $data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs ORDER BY ta DESC LIMIT 0,50 ")->result();
        // }
        // else {
        //     $data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs WHERE ".$filter." LIKE '%".$nm_filter."%' ")->result();
        // }
        // // $data_krs = $this->Data_krs_model->get_all_view();
        //
        // $data = array(
        //   'data_mhs_krs' => $data_mhs_krs
        // );
        $data['data_mhs_krs_periode'] = $data_mhs_krs_periode;
        $data['site_title'] = 'SIMALA';
        $data['title_page'] = 'Periode KRS Berdasarkan Periode';
        $data['assign_js'] = 'data_krs/js/index.js';
        load_view('data_krs/data_krs_index', $data);
    }
    public function periodeData($periode='',$kd_prodi='')
    {
        $data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs WHERE ta=".$periode." AND kd_prodi=".$kd_prodi." ORDER BY ta,status_ambil DESC")->result();
        $count_mhs_krs = $this->App_model->get_query("SELECT COUNT(*) as jml_ambil FROM v_mhs_krs WHERE ta=".$periode)->row();

        $data_periode = $this->App_model->get_query("SELECT * FROM tb_kurikulum WHERE ta=".$periode." AND kd_prodi=".$kd_prodi)->row();

        $data_rasio_mhs = $this->App_model->get_query("SELECT * FROM v_rasio_mhs_aktif m1 WHERE ta=".$periode." AND kd_prodi=".$kd_prodi)->result();
        // if ($filter == '') {
        //     $data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs WHERE ta=".$periode." ORDER BY ta DESC LIMIT 0,50 ")->result();
        // }
        // else {
        //     $data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs WHERE ".$filter." LIKE '%".$nm_filter."%' ")->result();
        // }
        // $data_krs = $this->Data_krs_model->get_all_view();
        $data = array(
            'data_mhs_krs' => $data_mhs_krs,
            'data_periode' => $data_periode,
            'count_mhs_krs' => $count_mhs_krs->jml_ambil,
            'rasio_mhs' => $data_rasio_mhs
        );
        $data['site_title'] = 'SIMALA';
        $data['kode_prodi'] = $kd_prodi;
        $data['periode'] = $periode;
        $data['title_page'] = 'KRS Berdasarkan Periode';
        $data['assign_js'] = 'data_krs/js/index.js';
        load_view('data_krs/tb_mhs_data_krs_list', $data);
    }
    public function getKelas(){
      $kelas='';
      $cari = $this->input->post('q');
      $temp_cari = $cari==''?'':$cari;
      $page = $this->input->post('page');
      if ($page=='') {
        $kelas = $this->Data_krs_model->get_query("SELECT * FROM v_kelas_kuliah")->result();
      }
      else {
        $kelas = $this->Data_krs_model->get_limit_query_kls('v_kelas_kuliah',$page,0,$cari);
      }
      $temps = array();
      foreach ($kelas as $key) {
        $temps[] = array(
          'id_kelas' => $key->id_kelas,
          'nm_kelas' => $key->nm_kelas,
          'id_matkul' => $key->kode_mk,
          'nm_mk' => $key->nm_mk,
          'ta'=> $key->ta,
          'nm_prodi' => $key->nm_prodi
        );
      }
      echo json_encode($temps);
    }

    public function getMhsKrs(){
      $mhs_krs='';
      $cari = $this->input->post('q');
      $temp_cari = $cari==''?'':$cari;
      $page = $this->input->post('page');
      if ($page=='') {
        $mhs_krs = $this->Data_krs_model->get_query("SELECT * FROM v_mhs_krs")->result();
      }
      else {
        $mhs_krs = $this->Data_krs_model->get_limit_query('v_mhs_krs',$page,0,$cari);
      }
      $temps = array();
      foreach ($mhs_krs as $key) {
        $temps[] = array(
          'id_krs' => $key->id_krs,
          'id_mhs' => $key->nim,
          'nm_mhs' => $key->nama,
          'ta' => $key->ta,
        );
      }
      echo json_encode($temps);
    }

    public function read($id)
    {
        $row = $this->Data_krs_model->get_by_id_view($id)->result();;
        if ($row) {
            $data['data_krs'] = $row;
            $data['site_title'] = 'SIMALA';
            $data['title_page'] = 'Olah Kartu Rencana Studi Mahasiswa';
            $data['assign_js'] = 'data_krs/js/index.js';
            load_view('data_krs/tb_mhs_data_krs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_krs'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_krs/create_action'),
      	    'id_data_krs' => set_value('id_data_krs'),
      	    'id_krs' => set_value('id_krs'),
      	    'id_kelas' => set_value('id_kelas'),
      	);
        $data['site_title'] = 'SIMALA';
        $data['title_page'] = 'Olah Kartu Rencana Studi Mahasiswa';
        $data['assign_js'] = 'data_krs/js/index.js';
        load_view('data_krs/tb_mhs_data_krs_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'id_krs' => $this->input->post('id_krs',TRUE),
        		'id_kelas' => $this->input->post('id_kelas',TRUE),
        	  );
            $this->Data_krs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_krs'));
        }
    }

    public function update($id)
    {
        $row = $this->Data_krs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_krs/update_action'),
        		'id_data_krs' => set_value('id_data_krs', $row->id_data_krs),
        		'id_krs' => set_value('id_krs', $row->id_krs),
        		'id_kelas' => set_value('id_kelas', $row->id_kelas),
            );
            $data['site_title'] = 'SIMALA';
            $data['title_page'] = 'Olah Kartu Rencana Studi Mahasiswa';
            $data['assign_js'] = 'data_krs/js/index.js';
            load_view('data_krs/tb_mhs_data_krs_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_krs'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_data_krs', TRUE));
        } else {
            $data = array(
        		'id_krs' => $this->input->post('id_krs',TRUE),
        		'id_kelas' => $this->input->post('id_kelas',TRUE),
        	  );

            $this->Data_krs_model->update($this->input->post('id_data_krs', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_krs'));
        }
    }

    public function delete($id,$periode='',$kd_prodi='')
    {
        $row = $this->Data_krs_model->get_by_id($id);

        if ($row) {
            $this->Data_krs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_krs/periodeData/'.$periode.'/'.$kd_prodi));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_krs/periodeData/'.$periode.'/'.$kd_prodi));
        }
    }

    public function _rules()
    {
      	$this->form_validation->set_rules('id_krs', 'id krs', 'trim|required');
      	$this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required');

      	$this->form_validation->set_rules('id_data_krs', 'id_data_krs', 'trim');
      	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_mhs_data_krs.xls";
        $judul = "tb_mhs_data_krs";
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
      	xlsWriteLabel($tablehead, $kolomhead++, "NIM");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Mahasiswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Mata Kuliah");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Mata Kuliah");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Kelas");
        xlsWriteLabel($tablehead, $kolomhead++, "Periode Semester");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Program Studi");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nama Program Studi");

      	foreach ($this->Data_krs_model->get_all_view() as $key) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
      	    xlsWriteLabel($tablebody, $kolombody++, $key->nim);
            xlsWriteLabel($tablebody, $kolombody++, $key->nm_mhs);
            xlsWriteLabel($tablebody, $kolombody++, $key->id_matkul);
            xlsWriteLabel($tablebody, $kolombody++, $key->nm_mk);
            xlsWriteLabel($tablebody, $kolombody++, $key->nm_kelas);
            xlsWriteLabel($tablebody, $kolombody++, $key->ta);
            xlsWriteLabel($tablebody, $kolombody++, $key->id_prodi);
            xlsWriteLabel($tablebody, $kolombody++, $key->nm_prodi);

      	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tb_mhs_data_krs.doc");

        $data = array(
            'tb_mhs_data_krs_data' => $this->Data_krs_model->get_all(),
            'start' => 0
        );
        $data['site_title'] = 'SIMALA';
        $data['title_page'] = 'Olah Kartu Rencana Studi Mahasiswa';
        $data['assign_js'] = 'data_krs/js/index.js';
        load_view('data_krs/tb_mhs_data_krs_doc',$data);
    }

    // public function proses_krs($nim,$ta)
    // {
    //   $beli_mk = $this->Data_krs_model->get_query("SELECT * FROM v_data_krs WHERE nim='".$nim."' AND ta='".$ta."'")->result();
    //   $data['data_krs_data']= $beli_mk;
    //   $data['site_title'] = 'SIMALA';
    //   $data['title_page'] = 'Pembelian Mata Kuliah Mahasiswa Bersangkutan';
    //   $data['assign_js'] = 'data_krs/js/index.js';
    //   load_view('data_krs/tb_mhs_data_krs_proses',$data);
    // }
    public function getKelasData($a='',$id_kurikulum,$filter='')
    {
        // echo "SELECT * FROM v_kelas_kuliah WHERE ta='".$a."' and id_kurikulum='".$id_kurikulum."'";
        if ($filter=='') {
            $mata_kuliah = $this->App_model->get_query("SELECT * FROM v_kelas_kuliah WHERE ta='".$a."' and id_kurikulum='".$id_kurikulum."'")->result();
        }
        else {
            $mata_kuliah = $this->App_model->get_query("SELECT * FROM v_kelas_kuliah WHERE ta='".$a."' and (id_kurikulum='".$id_kurikulum."' AND nm_kelas LIKE '%".$filter."%')")->result();
        }

        return $mata_kuliah;
    }

    public function ceklis($nim='',$id_kelas='')
    {
        $mata_kuliah = $this->App_model->get_query("SELECT * FROM v_data_krs WHERE id_kelas='".$id_kelas."' and nim='".$nim."'")->num_rows();
        return $mata_kuliah;
    }

    public function ceklisData($nim='',$kode_mk='')
      {
          // $mata_kuliah = $this->App_model->get_query("SELECT * FROM v_data_krs WHERE id_kelas='".$id_kelas."' and nim='".$nim."'")->num_rows();
          $mata_kuliah = $this->App_model->get_query("SELECT * FROM v_data_krs WHERE id_matkul='".$kode_mk."' and nim='".$nim."'")->row();
          return $mata_kuliah;
      }

    public function proses_krs($nim,$ta,$id_krs,$id_kurikulum,$kd_prodi){
      $cek_ta = $this->App_model->get_query("SELECT ta,status FROM tb_kurikulum WHERE ta='".$ta."'")->row();
      $beli_mk = $this->App_model->get_query("SELECT * FROM v_data_krs WHERE nim='".$nim."' AND ta='".$ta."'")->result();
      $data['data_krs_data']= $beli_mk;
      $data['nim']=$nim;
      $data['ta']=$ta;
      $data['kd_prodi']=$kd_prodi;
      $data['id_krs']= $id_krs;
      $data['id_kurikulum'] = $id_kurikulum;
      $data['data_mhs_aktif'] = $this->App_model->get_query("SELECT * FROM v_mhs_aktif WHERE nim='".$nim."'")->row();
      if ($this->input->post('filter_kelas')=='') {
          $matkul = $this->getKelasData($ta,$id_kurikulum);
          $temps = array();
          foreach ($matkul as $key) {
            //   echo json_encode($this->ceklisData($nim,$key->kode_mk))."<br><br>";
              $data_temps=$this->ceklis($nim,$key->id_kelas);
              if (!$data_temps) {
                  $temps[] = array(
                           'id_kelas' => $key->id_kelas,
                           'id_kurikulum' => $key->id_kurikulum,
                           'kode_mk' => $key->kode_mk,
                           'nm_mk' => $key->nm_mk,
                           'sks' => $key->sks,
                           'ta' => $key->ta,
                           'nm_kelas' => $key->nm_kelas,
                           'id_prodi' => $key->id_prodi,
                           'nm_prodi' => $key->nm_prodi,
                           'status_pesan' => false
                         );
              }
              else {
                  $temps[] = array(
                           'id_kelas' => $key->id_kelas,
                           'id_kurikulum' => $key->id_kurikulum,
                           'kode_mk' => $key->kode_mk,
                           'nm_mk' => $key->nm_mk,
                           'sks' => $key->sks,
                           'ta' => $key->ta,
                           'nm_kelas' => $key->nm_kelas,
                           'id_prodi' => $key->id_prodi,
                           'nm_prodi' => $key->nm_prodi,
                           'status_pesan' => true
                         );
              }
          }
      //echo json_encode($temps);
      $data['krs_data'] = $temps;
    }
    else {
        $matkul = $this->getKelasData($ta,$id_kurikulum,$this->input->post('filter_kelas'));
        $temps = array();
        foreach ($matkul as $key) {
            // echo json_encode($this->ceklis($nim,$key->id_kelas))."<br><br>";
            $data_temps=$this->ceklis($nim,$key->id_kelas);
            if (!$data_temps) {
                $temps[] = array(
                         'id_kelas' => $key->id_kelas,
                         'id_kurikulum' => $key->id_kurikulum,
                         'kode_mk' => $key->kode_mk,
                         'nm_mk' => $key->nm_mk,
                         'sks' => $key->sks,
                         'ta' => $key->ta,
                         'nm_kelas' => $key->nm_kelas,
                         'id_prodi' => $key->id_prodi,
                         'nm_prodi' => $key->nm_prodi,
                         'status_pesan' => false
                       );
            }
            else {
                $temps[] = array(
                         'id_kelas' => $key->id_kelas,
                         'id_kurikulum' => $key->id_kurikulum,
                         'kode_mk' => $key->kode_mk,
                         'nm_mk' => $key->nm_mk,
                         'sks' => $key->sks,
                         'ta' => $key->ta,
                         'nm_kelas' => $key->nm_kelas,
                         'id_prodi' => $key->id_prodi,
                         'nm_prodi' => $key->nm_prodi,
                         'status_pesan' => true
                       );
                }
            }
            //echo json_encode($temps);
            $data['krs_data'] = $temps;
        }
        $data['site_title'] = 'SIMALA';
        $data['title_page'] = 'Olah Data KRS Mahasiswa';
        $data['assign_js'] = 'data_krs/js/krs.js';
        $data['ta'] = $ta;
        $data['kode_prodi'] = $kd_prodi;
        load_view('data_krs/tb_mhs_data_krs_proses1',$data);
      }

      public function add_baru()
      {

          $jumlah = count($_POST["item"]);
          echo $jumlah = count($_POST["ulang"]);
          $id_krs = $this->input->post('id_krs');
          $id_kurikulum = $this->input->post('id_kurikulum');
          $nim = $this->input->post('nim');
          $ta = $this->input->post('ta');
          $kode_prodi = $this->input->post('kode_prodi');

          $data = array();
          $sks_arr = array();
          $gagal = 0;

          for($i=0; $i < $jumlah; $i++)
          {
              $id_kelas=$_POST["item"][$i];
              $cek = $this->App_model->get_query("SELECT * FROM v_data_krs WHERE id_kelas='".$id_kelas."' AND id_krs='".$id_krs."'")->num_rows();
              $temps_sks = $this->App_model->get_query("SELECT * FROM v_kelas_kuliah WHERE id_kelas='".$id_kelas."'")->row();
              if ($cek==true) {
                  $gagal= $gagal+$i;
              }
              else{
                  $sks_arr[] = array('sks' => $temps_sks->sks, );
                  $data[] = array(
                      'id_krs' => $id_krs,
                      'id_kelas' =>$id_kelas,
                      'status_upload' => "N",
                      'status_nilai' => "N"
                  );
              }

          }
          $sks=0;
          foreach ($sks_arr as $cek_sks => $ceking) {
              $sks = $sks+$ceking['sks'];
          }
          if ($sks > 24) {
              $this->session->set_flashdata('message', '<span class="label label-danger">SKS MAKSIMAL ADALAH 24 SKS SILAHKAN PILIH LAGI</span>');
              redirect(site_url('data_krs/proses_krs/'.$nim.'/'.$ta.'/'.$id_krs."/".$id_kurikulum."/".$kode_prodi));
          }
          else {
              $berhasil=0;
              foreach ($data as $key => $value) {
                  $insert = 1;//$this->App_model->insertRecord('tb_mhs_data_krs',$value);
                  if ($insert==true) {
                      $berhasil++;

                  }
              }
              $this->session->set_flashdata('message', '<span class="label label-success">'.$berhasil.' Belanja Mata Kuliah Berhasil dan '.$gagal.' Belanja Mata Kuliah Gagal</span>');
              //redirect(site_url('data_krs/proses_krs/'.$nim.'/'.$ta.'/'.$id_krs."/".$id_kurikulum."/".$kode_prodi));
          }
    }
    public function getKelasMataKuliah($ta='',$kode_prodi=''){
        $cari = $this->input->post('q');
        $temp_cari = $cari==''?'':$cari;
        $page = $this->input->post('page');
        if ($page=='') {
          $mata_kuliah = $this->App_model->get_query("SELECT nm_kelas,ta FROM v_kelas_kuliah WHERE ta='".$ta."' AND id_prodi='".$kode_prodi."' GROUP BY nm_kelas")->result();
        }
        else {
          $mata_kuliah = $this->App_model->get_query("SELECT nm_kelas,ta FROM v_kelas_kuliah WHERE ta='".$ta."' AND (id_prodi='".$kode_prodi."' AND nm_kelas LIKE '%".$cari."%') GROUP BY nm_kelas")->result();
        }
        $temps = array();
        //$mata_kuliah = $this->mata_kuliah->get_all();
        foreach ($mata_kuliah as $key) {
          $temps[] = array(
            'nm_kelas' => $key->nm_kelas,
            'ta' => $key->ta
          );
        }
        echo json_encode($temps);
    }

    public function cetak_krs($nim,$ta,$id_krs){

      $this->benchmark->mark('mulai');
      $data_mhs = $this->App_model->get_query("SELECT * FROM tb_mhs WHERE nim='".$nim."'")->row();
      $data_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs WHERE nim='".$nim."' AND id_krs='".$id_krs."'")->row();
      //var_dump($temp_data);
      $objPHPExcel = PHPExcel_IOFactory::load($this->template);

      //SET SHEET KRS
      $objPHPExcel->setActiveSheetIndex(0);
      $objPHPExcel->getActiveSheet()->setCellValue('D6', $ta);
      $objPHPExcel->getActiveSheet()->setCellValue('D7', 'S1 '.$data_krs->nm_prodi);
      $objPHPExcel->getActiveSheet()->setCellValue('H6', $data_krs->nim);
      $objPHPExcel->getActiveSheet()->setCellValue('H7', $data_krs->nama);
      $objPHPExcel->getActiveSheet()->setCellValue('D8', '......');

      $baseRow = 13;
      $temp_data = $this->App_model->get_query("SELECT * FROM v_data_krs WHERE id_krs='".$id_krs."'")->result();
      $temp_row=0;
      $ttd_row=0;
      foreach($temp_data as $r => $dataRow) {
        $row = $baseRow + $r;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+1)
                  ->setCellValue('B'.$row, $dataRow->id_matkul)
                  ->setCellValue('C'.$row, $dataRow->nm_mk)
                  ->setCellValue('F'.$row, 'A / U')
                  ->setCellValue('G'.$row, $dataRow->sks)
                  ->setCellValue('I'.$row, $dataRow->nm_dosen);
        $temp_row = 1+$row;
        $ttd_row = 5+$temp_row;
      }

      $objPHPExcel->getActiveSheet()->setCellValue('H'.$temp_row, date('d F Y'));
      $objPHPExcel->getActiveSheet()->setCellValue('G'. $ttd_row, $data_mhs->nm_mhs);
      $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

      $nimd = $string = preg_replace('/\s+/', '', $nim);
      $filename = $nimd."-".time().'-krs.xlsx';

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      //$objWriter->save('php://output');
      $temp_tulis = $objWriter->save('temps/'.$filename);
      $this->benchmark->mark('selesai');
      $time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
      if ($temp_tulis==NULL) {
          $ubah_status_cetak  = array('status_cetak' => 'Y');
          $status = $this->mhs_krs->update($id_krs, $ubah_status_cetak);
          if (!$status) {
                $this->session->set_flashdata('message', "<div class=\"bs-callout bs-callout-success\">
                    File berhasil digenerate dalam waktu <strong>".$time_eks." detik</strong>. <br />Klik <a href=\"".base_url()."index.php/file/download/".$filename."\">disini</a> untuk download file
                  </div>");
          }
          else {
              $this->session->set_flashdata('message', "<div class=\"bs-callout bs-callout-warning\">
                  File berhasil digenerate dalam waktu Status Gagal Di Ubah <strong>".$time_eks." detik</strong>. <br />Klik <a href=\"".base_url()."index.php/file/download/".$filename."\">disini</a> untuk download file
                </div>");
          }
          //redirect(site_url('data_krs'));
      } else {
          $this->session->set_flashdata('message',"<div class=\"bs-callout bs-callout-danger\">
              <h4>Error</h4>File tidak bisa digenerate. Folder 'temps' tidak ada atau tidak bisa ditulisi.
            </div>" );
      }
    }

    public function cetak_uas($nim,$ta,$id_krs)
    {
      $this->load->library('ciqrcode');
      $this->load->library('fpdf_gen');
      $row_mhs = $this->App_model->get_query("SELECT * FROM v_mhs_aktif WHERE nim='".$nim."'")->row();
      $data_krs = $this->Data_krs_model->get_query("SELECT * FROM v_data_krs WHERE nim='".$nim."' AND (ta='".$ta."' AND id_krs='".$id_krs."')")->result();
      // echo json_encode($data_krs);
      // echo "SELECT * FROM v_data_krs WHERE nim='".$nim."' AND (ta='".$ta."' AND id_krs='".$id_krs."')";
      //qr
      header("Content-Type: image/png");
      $params['data'] = $row_mhs->nim;
      $params['level']='H';
      $params['size']=2;
      $params['savename']=FCPATH."/assets/qrcode/".$nim.'_uas.png';
      $this->ciqrcode->generate($params);

      //tampil
      $data['qr']=FCPATH."/assets/qrcode/".$nim.'_uas.png';
      $data['mhs']=$row_mhs;
      $data['data_krs']=$data_krs;
      $data['assign_css'] = 'kartu/css/app.css';
      $data['assign_js'] = 'kartu/js/index.js';
      load_pdf('kartu/uas', $data);

      //passing pdf
      $html = $this->output->get_output();
      $this->dompdf->set_paper('A4', 'potrait');
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream(date('D-M-Y').$nim.".pdf",array('Attachment'=>0));
    }

    public function cetak_uts($nim,$ta,$id_krs)
    {
      $this->load->library('ciqrcode');
      $this->load->library('fpdf_gen');
      $row_mhs = $this->App_model->get_query("SELECT * FROM v_mhs_aktif WHERE nim='".$nim."'")->row();
      $data_krs = $this->Data_krs_model->get_query("SELECT * FROM v_data_krs WHERE nim='".$nim."' AND (ta='".$ta."' AND id_krs='".$id_krs."')")->result();
      //qr
      header("Content-Type: image/png");
      $params['data'] = $row_mhs->nim;
      $params['level']='H';
      $params['size']=2;
      $params['savename']=FCPATH."/assets/qrcode/".$nim.'_uts.png';
      $this->ciqrcode->generate($params);

      //tampil
      $data['qr']=FCPATH."/assets/qrcode/".$nim.'_uts.png';
      $data['mhs']=$row_mhs;
      $data['data_krs']=$data_krs;
      $data['assign_css'] = 'kartu/css/app.css';
      $data['assign_js'] = 'kartu/js/index.js';
      load_pdf('kartu/uts', $data);

      //passing pdf
      $html = $this->output->get_output();
      $this->dompdf->set_paper("A4", 'potrait');
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream(date('D-M-Y').$nim.".pdf",array('Attachment'=>0));
    }

    public function graphRasio($periode='',$kd_prodi='')
    {
        $data_rasio_mhs = $this->App_model->get_query("SELECT * FROM v_rasio_mhs_aktif m1 WHERE ta=".$periode." AND kd_prodi=".$kd_prodi)->result();
        echo json_encode($data_rasio_mhs);
    }
}
