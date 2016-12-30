<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khs extends CI_Controller
{
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
}
