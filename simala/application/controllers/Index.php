<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends CI_Controller
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
        $this->load->model('App_model','app_model');
      }
  }
  public function index()
  {

    $count_mhs = $this->app_model->total_rows("v_sync_mhs");
    $count_mhs_lulus = $this->app_model->total_rows("v_sync_mhs_lulus");
    $count_mk_kur = $this->app_model->total_rows("v_sync_mk_kurikulum");
    $count_nilai = $this->app_model->total_rows("v_sync_nilai");
    $count_kelas_kuliah = $this->app_model->total_rows("v_sync_kelas_kuliah");
    $count_kelas_dosen = $this->app_model->total_rows("v_sync_kelas_dosen");
    $count_data_krs = $this->app_model->total_rows("v_sync_data_krs");
    $count_data_krs = $this->app_model->total_rows("v_sync_data_krs");
    $count_kurikulum = $this->app_model->total_rows_where("tb_kurikulum","status_upload","N");
    $count_mata_kuliah = $this->app_model->total_rows_where("tb_mata_kuliah","status_upload","N");

    $data_akm = $this->app_model->get_query("SELECT * FROM v_akm_mhs GROUP BY id_prodi,angkatan ORDER BY angkatan DESC")->result();
    $data['data_akm'] = $data_akm;
    $data['count_mhs'] =$count_mhs ;
    $data['count_kurikulum'] =$count_kurikulum ;
    $data['count_mata_kuliah'] =$count_mata_kuliah ;
    $data['count_mhs_lulus'] =$count_mhs_lulus;
    $data['count_mk_kur'] =$count_mk_kur;
    $data['count_nilai'] = $count_nilai;
    $data['count_kelas_kuliah'] = $count_kelas_kuliah;
    $data['count_kelas_dosen'] = $count_kelas_dosen;
    $data['count_data_krs'] = $count_data_krs;


    $data['site_title'] = 'SIMALA';
    $data['title_page'] = 'SELAMAT DATANG DI SIMALA || SISTEM INFORMASI MAHASISWA ALMAMATER ADHI GUNA';
    $data['assign_js'] = 'beranda/js/index.js';

    load_view('beranda/beranda', $data);
  }
  public function graphMhs()
  {
    $data_masuk = $this->app_model->get_query("SELECT
            COUNT(IF(m1.smt_masuk='20161',1, NULL)) AS item_2016,
            COUNT(IF(m1.smt_masuk='20151',1, NULL)) AS item_2015,
            COUNT(IF(m1.smt_masuk='20141',1, NULL)) AS item_2014,
            COUNT(IF(m1.smt_masuk='20131' OR m1.smt_masuk='2013',1, NULL)) AS item_2013,
            COUNT(IF(m1.smt_masuk='20121',1, NULL)) AS item_2012,
            COUNT(IF(m1.smt_masuk='20111',1, NULL)) AS item_2011,
            COUNT(IF(m1.smt_masuk='20101',1, NULL)) AS item_2010,
            COUNT(IF(m1.smt_masuk='20091',1, NULL)) AS item_2009,
            COUNT(IF(m1.smt_masuk='20081',1, NULL)) AS item_2008,
            COUNT(IF(m1.smt_masuk='20071',1, NULL)) AS item_2007
            FROM tb_mhs m1")->result();
    $data_keluar = $this->app_model->get_query("SELECT
            COUNT(IF(m1.smt_masuk='20071' AND m1.status_mhs=3,1, NULL)) AS item_2007,
            COUNT(IF(m1.smt_masuk='20081' AND m1.status_mhs=3,1, NULL)) AS item_2008,
            COUNT(IF(m1.smt_masuk='20091' AND m1.status_mhs=3,1, NULL)) AS item_2009,
            COUNT(IF(m1.smt_masuk='20101' AND m1.status_mhs=3,1, NULL)) AS item_2010,
            COUNT(IF(m1.smt_masuk='20111' AND m1.status_mhs=3,1, NULL)) AS item_2011,
            COUNT(IF(m1.smt_masuk='20121' AND m1.status_mhs=3,1, NULL)) AS item_2012,
            COUNT(IF(m1.smt_masuk='20131' AND m1.status_mhs=3,1, NULL)) AS item_2013,
            COUNT(IF(m1.smt_masuk='20141' AND m1.status_mhs=3,1, NULL)) AS item_2014,
            COUNT(IF(m1.smt_masuk='20151' AND m1.status_mhs=3,1, NULL)) AS item_2015,
            COUNT(IF(m1.smt_masuk='20161' AND m1.status_mhs=3,1, NULL)) AS item_2016
            FROM tb_mhs m1")->result();
    $data_angkatan_masuk=array();
    foreach ($data_masuk as $key) {
      array_push($data_angkatan_masuk,$key->item_2016);
      array_push($data_angkatan_masuk,$key->item_2015);
      array_push($data_angkatan_masuk,$key->item_2014);
      array_push($data_angkatan_masuk,$key->item_2013);
      array_push($data_angkatan_masuk,$key->item_2012);
      array_push($data_angkatan_masuk,$key->item_2011);
      array_push($data_angkatan_masuk,$key->item_2010);
      array_push($data_angkatan_masuk,$key->item_2009);
      array_push($data_angkatan_masuk,$key->item_2008);
      array_push($data_angkatan_masuk,$key->item_2007);
    }
    $data_angkatan_keluar=array();
    foreach ($data_keluar as $key) {
      array_push($data_angkatan_keluar, $key->item_2016);
      array_push($data_angkatan_keluar, $key->item_2015);
      array_push($data_angkatan_keluar, $key->item_2014);
      array_push($data_angkatan_keluar, $key->item_2013);
      array_push($data_angkatan_keluar, $key->item_2012);
      array_push($data_angkatan_keluar, $key->item_2011);
      array_push($data_angkatan_keluar, $key->item_2010);
      array_push($data_angkatan_keluar, $key->item_2009);
      array_push($data_angkatan_keluar, $key->item_2008);
      array_push($data_angkatan_keluar, $key->item_2007);
    }
    $data_result = array(
          'data_masuk' => $data_angkatan_masuk,
          'data_keluar'=> $data_angkatan_keluar
    );
    echo json_encode($data_result);
  }


}
