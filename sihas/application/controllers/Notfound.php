<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maintainance extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      $this->load->model('App_model','app_model');
  }
  public function index()
  {
    $data['site_title'] = 'SIMALA';
    $data['title_page'] = 'SIHAS IS Maintained';
    $data['isi_page'] = 'MAAF!!! Atas Ketidak Nyamanan Ini';
    $data['assign_js'] = 'beranda/js/index.js';
    $this->load->view('beranda/maintain', $data);
  }
}
