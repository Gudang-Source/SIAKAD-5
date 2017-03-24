<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Krs extends CI_Controller
{
    private $template;
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
          redirect('auth');
        }
        else if($this->session->userdata('level') != 'mhs'){
            redirect('auth/logout');
        }
        else {
          $this->load->model('App_model');
          $this->load->model('Data_krs_model');
          $this->load->model('mhs_krs_model','mhs_krs');
          $this->load->library('excel');
          $this->template = './template/krs_khs_template.xlsx';
        }
    }

    public function index(){
      $data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs WHERE nim='".$this->session->userdata('nim')."'")->result();
      $data = array(
        'data_mhs_krs' => $data_mhs_krs
      );
      $data['site_title'] = 'SIMALA';
      $data['title_page'] = 'Kartu Rencana Studi Anda';
      $data['assign_js'] = 'krs/js/index.js';
      load_view('krs/list_krs', $data);
    }

    public function proses_krs($nim,$ta,$id_krs,$id_kurikulum){
      $cek_ta = $this->App_model->get_query("SELECT ta,status FROM tb_kurikulum WHERE ta='".$ta."'")->row();
      if ($cek_ta->status == 1) {
        $t=time();
        $status_tutup=false;
        $status_buka_1 = false;
        $status_buka = false;
        $count_down = date("Y-m-d H:i:s",$t); //komen dibuka setelah selesai semua $this->session->userdata('kode_prodi')."'";
        $count_masa_isi = $this->App_model->get_query("SELECT * FROM v_count_down WHERE ta='". $this->session->userdata('ta') ."' AND kd_prodi='". $this->session->userdata('kode_prodi')."'")->row();
        if ($count_down>=$count_masa_isi->waktu_buka && $count_down<=$count_masa_isi->waktu_tutup) {
            $status_tutup=false;
            $status_buka=true;
            $data['title_page'] = 'Pembelian Mata Kuliah Anda Periode '.$this->session->userdata('ta');
        }
        elseif ($count_down<=$count_masa_isi->waktu_buka) {
            $status_tutup=false;
            $status_buka=false;
            $status_buka_1=true;
            $data['title_page'] = 'Pembelian Mata Kuliah Untuk KRS Periode '.$this->session->userdata('ta').' Belum Di Buka';

        }
        elseif ($count_down>=$count_masa_isi->waktu_tutup) {
            $status_tutup=false;
            $status_buka=false;
            $data['title_page'] = 'Pembelian Mata Kuliah Untuk KRS Periode '.$this->session->userdata('ta').' Telah Ditutup'."";
        }
        else {
            $status_tutup=false;
        }

        $beli_mk = $this->App_model->get_query("SELECT * FROM v_data_krs WHERE nim='".$nim."' AND ta='".$ta."'")->result();
        $data['data_krs_data']= $beli_mk;
        $data['tgl_tutup'] = $count_masa_isi->waktu_tutup;
        $data['tgl_buka'] = $count_masa_isi->waktu_buka;
        $data['status_tutup'] = $status_tutup;
        $data['status_buka_1'] = $status_buka_1;
        $data['status_buka'] = $status_buka;
        $data['nim']=$nim;
        $data['ta']=$ta;
        $data['id_krs']= $id_krs;
        $data['id_kurikulum'] = $id_kurikulum;

        $data['site_title'] = 'SIMALA';
        $data['assign_js'] = 'krs/js/index.js';
        if ($this->input->post('filter_kelas')=='') {
            $matkul = $this->getKelasData($ta,$id_kurikulum);
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
        load_view('krs/tb_mhs_data_krs_proses1',$data);
      }
      else {
        $data['ta'] = $cek_ta->ta;
        $data['site_title'] = 'SIMALA';
        $data['assign_js'] = 'krs/js/index.js';
        load_view('krs/warning',$data);
      }
    }
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

    public function getKelasMataKuliah(){
      $cari = $this->input->post('q');
      $temp_cari = $cari==''?'':$cari;
      $page = $this->input->post('page');
      if ($page=='') {
        $mata_kuliah = $this->App_model->get_query("SELECT nm_kelas,ta FROM v_kelas_kuliah WHERE ta='".$this->session->userdata('ta')."' AND id_prodi='".$this->session->userdata('kode_prodi')."' GROUP BY nm_kelas")->result();
      }
      else {
        $mata_kuliah = $this->App_model->get_query("SELECT nm_kelas,ta FROM v_kelas_kuliah WHERE ta='".$this->session->userdata('ta')."' AND (id_prodi='".$this->session->userdata('kode_prodi')."' AND nm_kelas LIKE '%".$cari."%') GROUP BY nm_kelas")->result();
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

    public function delete($id,$data,$id_kurikulum)
    {
        $row = $this->Data_krs_model->get_by_id($id);
        if ($row) {
            $this->Data_krs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('krs/proses_krs/'.$this->session->userdata('nim').'/'.$this->session->userdata('ta').'/'.$data."/".$id_kurikulum));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('krs/proses_krs/'.$this->session->userdata('nim').'/'.$this->session->userdata('ta').'/'.$data.'/'.$id_kurikulum));
        }
    }
    public function add_baru()
    {
        $jumlah = count($_POST["item"]);
        $id_krs = $this->input->post('id_krs');
        $id_kurikulum = $this->input->post('id_kurikulum');

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
            redirect(site_url('krs/proses_krs/'.$this->session->userdata('nim').'/'.$this->session->userdata('ta').'/'.$id_krs."/".$id_kurikulum));
        }
        else {
            $berhasil=0;
            foreach ($data as $key => $value) {
                $insert = $this->App_model->insertRecord('tb_mhs_data_krs',$value);
                if ($insert==true) {
                    $berhasil++;

                }
            }
            $this->session->set_flashdata('message', '<span class="label label-success">'.$berhasil.' Belanja Mata Kuliah Berhasil dan '.$gagal.' Belanja Mata Kuliah Gagal</span>');
            redirect(site_url('krs/proses_krs/'.$this->session->userdata('nim').'/'.$this->session->userdata('ta').'/'.$id_krs."/".$id_kurikulum));
        }

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
          $this->session->set_flashdata('message', "<div class=\"bs-callout bs-callout-success\">
              File berhasil digenerate dalam waktu <strong>".$time_eks." detik</strong>. <br />Klik <a href=\"".base_url()."index.php/file/download/".$filename."\">disini</a> untuk download file
            </div>");
          redirect(site_url('krs'));
      } else {
          $this->session->set_flashdata('message',"<div class=\"bs-callout bs-callout-danger\">
              <h4>Error</h4>File tidak bisa digenerate. Folder 'temps' tidak ada atau tidak bisa ditulisi.
            </div>" );
      }
    }

}
