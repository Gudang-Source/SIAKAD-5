<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khs extends CI_Controller
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
          $this->load->model('App_model');
          $this->load->model('Data_krs_model');
          $this->load->model('mhs_krs_model','mhs_krs');
          $this->load->library('excel');
          $this->template = './template/krs_khs_template.xlsx';
        }
    }

    public function index(){
      $data_mhs_krs = $this->App_model->get_query("SELECT * FROM v_mhs_krs")->result();
      $data = array(
        'data_mhs_krs' => $data_mhs_krs
      );
      $data['site_title'] = 'SIMALA';
      $data['title_page'] = 'Olah Kartu Hasil Studi Mahasiswa';
      $data['assign_js'] = 'khs/js/index.js';
      load_view('khs/list_krs', $data);
    }

    public function proses_khs($nim,$ta,$id_krs){
      $t=time();
      // $status_tutup=false;
      // $status_buka_1 = false;
      // $status_buka = false;
      // $count_down = date("Y-m-d H:i:s",$t); //komen dibuka setelah selesai semua $this->session->userdata('kode_prodi')."'";
      // $count_masa_isi = $this->App_model->get_query("SELECT * FROM v_count_down_khs WHERE ta='". $this->session->userdata('ta') ."' AND kd_prodi='". $this->session->userdata('kode_prodi')."'")->row();
      $status_tutup=false;
      $beli_mk = $this->App_model->get_query("SELECT * FROM v_nilai WHERE ta='".$ta."'")->result();
      $data['data_krs_data']= $beli_mk;
      $data['id_krs']= $id_krs;
      // $data['tgl_tutup'] = $count_masa_isi->waktu_tutup;
      // $data['tgl_buka'] = $count_masa_isi->waktu_buka;
      // $data['status_tutup'] = $status_tutup;
      // $data['status_buka_1'] = $status_buka_1;
      // $data['status_buka'] = $status_buka;
      $data['site_title'] = 'SIMALA';
      $data['nim'] = $nim;
      $data['ta'] = $ta;
      $data['title_page'] = 'Olah Kartu Hasil Studi';
      $data['assign_js'] = 'khs/js/index.js';
      load_view('khs/tb_mhs_data_krs_proses',$data);
    }

    public function transkrip_nilai($nim,$ta)
    {
      $this->load->library('fpdf_gen');
      // $nim = $this->session->userdata('nim');
      $data_nilai = $this->App_model->get_query("SELECT * FROM v_nilai WHERE nim='".$nim."' AND ta='".$ta."'")->result();
      $data['nilai_data'] = $data_nilai;
      // echo "SELECT * FROM v_nilai WHERE nim='".$nim."' AND ta='".$ta."'";
      // echo json_encode($data_nilai);
      $data_mhs = $this->App_model->get_view_by_id('v_mhs_aktif','nim',$nim);
      $data['nim'] = $data_mhs->nim;
      $data['nm_mhs'] =$data_mhs->nm_mhs;
      $data['tpt_lhr'] =$data_mhs->tpt_lhr;
      $data['nm_prodi'] =$data_mhs->nm_prodi;
      $data['angkatan'] =$data_mhs->smt_masuk;
      //$data['tgl_lhr'] =$data_mhs->tgl_lhr;

      //data total
      $data_nilai_lengkap = $this->App_model->get_query("SELECT * FROM v_nilai WHERE nim='".$nim."'")->result();
      //echo json_encode($data_nilai_lengkap)."<br> <br>";
      $kredit=0;
      $kredit_lulus=0;
      $n_k=0;
      $t_nk = 0;
      $t_sks =0;
      foreach ($data_nilai_lengkap as $key) {
        if ($key->nilai_huruf == 'E' ){
          $kredit += $key->sks;
        }
        else{
          $kredit += $key->sks;
          $kredit_lulus += $key->sks;
        }
        $n_k = $key->nilai_index * $key->sks;
        $t_nk = $t_nk+ $n_k;
        $t_sks = $t_sks+ $key->sks;
      }
      // echo "Kredit Kumulatif Diambil : ".$kredit;
      // echo "<br>";
      // echo "Kredit Lulus Kumulatif : ".$kredit_lulus;
      // echo "<br>";
      // echo "N * K Kumulatif : ".$t_nk ;
      $ipk_kumulatif = $t_nk/$t_sks;
      $data['kredit_kum'] =$kredit;
      $data['kredit_lulus']=$kredit_lulus;
      $data['n_k_kumulatif']=$t_nk;
      $data['ipk_kumulatif']=$ipk_kumulatif;
      $data['ta']=$ta;

      $data['assign_css'] = 'khs/css/app.css';
      $data['assign_js'] = 'khs/js/index.js';
      load_pdf('khs/lap_transkrip_nilai', $data);

      $html = $this->output->get_output();
      $this->dompdf->set_paper('A4', 'potrait');
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream("khs".$data_mhs->nim.".pdf",array('Attachment'=>0));
    }

    public function khsCetak($nim,$ta,$id_krs)
    {
        $this->benchmark->mark('mulai');
        $data_mhs = $this->App_model->get_query("SELECT * FROM v_mhs_aktif WHERE nim='".$nim."'")->row();
        // echo json_encode($data_mhs);
        $objPHPExcel = PHPExcel_IOFactory::load($this->template);

        //SET SHEET KRS
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('D6', $data_mhs->nm_mhs);
        $objPHPExcel->getActiveSheet()->setCellValue('D7', $data_mhs->nim);
        $objPHPExcel->getActiveSheet()->setCellValue('D8', $data_mhs->nm_prodi);
        $objPHPExcel->getActiveSheet()->setCellValue('H7', $data_mhs->smt_masuk);

        $baseRow = 13;
        $temp_data = $this->App_model->get_query("SELECT * FROM v_nilai WHERE id_krs='".$id_krs."'")->result();

        $n_k=0;
        $t_nk = 0;
        $t_sks =0;

        $temp_row=0;
        $temp_row1=0;
        $temp_row2=0;


        foreach($temp_data as $r => $dataRow) {
            $row = $baseRow + $r;
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+1)
                      ->setCellValue('B'.$row, $dataRow->kode_mk)
                      ->setCellValue('C'.$row, $dataRow->nm_mk)
                      ->setCellValue('F'.$row, $dataRow->sks)
                      ->setCellValue('G'.$row, $dataRow->nilai_huruf)
                      ->setCellValue('H'.$row, $dataRow->nilai_index)
                      ->setCellValue('I'.$row, $dataRow->nilai_index * $dataRow->sks);
            $temp_row = 6+$row;
            $temp_row1 = 4+$row;
            $temp_row2 = 5+$row;

            if ($dataRow->nilai_huruf == 'E' ){
              $kredit += $dataRow->sks;
            }
            else{
              $kredit += $dataRow->sks;
              $kredit_lulus += $dataRow->sks;
            }
            $n_k = $dataRow->nilai_index * $dataRow->sks;
            $t_nk = $t_nk+ $n_k;
            $t_sks = $t_sks+ $dataRow->sks;
        }

        $data_nilai_lengkap = $this->App_model->get_query("SELECT * FROM v_nilai WHERE nim='".$nim."'")->result();
        //echo json_encode($data_nilai_lengkap)."<br> <br>";
        $kredit=0;
        $kredit_lulus=0;
        $n_k_p=0;
        $t_nk_p = 0;
        $t_sks_p =0;
        foreach ($data_nilai_lengkap as $keyRow) {
          if ($keyRow->nilai_huruf == 'E' ){
            $kredit += $keyRow->sks;
          }
          else{
            $kredit += $keyRow->sks;
            $kredit_lulus += $keyRow->sks;
          }
          $n_k_p = $keyRow->nilai_index * $keyRow->sks;
          $t_nk_p = $t_nk_p+ $n_k_p;
          $t_sks_p = $t_sks_p+ $keyRow->sks;
        }

        $ipk_s = $t_nk/$t_sks;
        $ipk_kumulatif = $t_nk_p/$t_sks_p;
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$temp_row1, number_format($ipk_s,2));
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$temp_row2, number_format($ipk_kumulatif,2));
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$temp_row2, $t_nk_p);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$temp_row2, $t_sks_p);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$temp_row2, number_format($ipk_kumulatif,2));
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$temp_row, date('d F Y'));
        $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

        $nimd = $string = preg_replace('/\s+/', '', $nim);
        $filename = $nimd."-".time().'-khs.xlsx';

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $temp_tulis = $objWriter->save('temps/'.$filename);
        $this->benchmark->mark('selesai');
        $time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
        if ($temp_tulis==NULL) {
          $this->session->set_flashdata('message', "<div class=\"bs-callout bs-callout-success\">
              File berhasil digenerate dalam waktu <strong>".$time_eks." detik</strong>. <br />Klik <a href=\"".base_url()."index.php/file/download/".$filename."\">disini</a> untuk download file
            </div>");
          redirect(site_url('khs'));
        } else {
          $this->session->set_flashdata('message',"<div class=\"bs-callout bs-callout-danger\">
              <h4>Error</h4>File tidak bisa digenerate. Folder 'temps' tidak ada atau tidak bisa ditulisi.
            </div>" );
        }
    }
}
