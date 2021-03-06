<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model extends CI_Model
{
  public $order = 'DESC';
  public $where_id_prodi = 'id_prodi';

  function __construct()
  {
      parent::__construct();
  }

  function cek_user($data) {
			$query = $this->db->get_where('login_peg', $data);
			return $query;
		}

  function get_limit_prodi($t,$limit, $start = 0, $q = NULL,$where_prodi) {
    $this->db->order_by("", $this->order);
    $this->db->like('id_prodi', $q);
    $this->db->or_like('nm_prodi', $q);
    $this->db->or_like('nm_ketua', $q);
    $this->db->limit($limit, $start);
    $this->db->where($this->where_id_prodi,$where_prodi);
    return $this->db->get($t)->result();
  }

  function get_limit_mhs_krs($t,$limit, $start = 0, $q = NULL,$where_prodi) {
      $this->db->order_by("", $this->order);
      $this->db->like('id_krs', $q);
      $this->db->or_like('nim', $q);
      $this->db->or_like('nama', $q);
      $this->db->or_like('ta', $q);
      $this->db->limit($limit, $start);
      $this->db->where($this->where_id_prodi,$where_prodi);
      return $this->db->get($t)->result();
  }

  function get_limit_kurikulum($t,$limit, $start = 0, $q = NULL,$where_prodi) {
    $this->db->order_by("", $this->order);
    $this->db->like('id_kurikulum', $q);
    $this->db->or_like('nm_kurikulum', $q);
    $this->db->or_like('ta', $q);
    $this->db->or_like('kd_prodi', $q);
    $this->db->limit($limit, $start);
    $this->db->where('kd_prodi',$where_prodi);
    return $this->db->get($t)->result();
  }

  function get_limit_mk_kurikulum($t,$limit, $start = 0, $q = NULL,$where_prodi) {
    $this->db->order_by("", $this->order);
    $this->db->like('id_kur_mk', $q);
    $this->db->or_like('kode_mk', $q);
    $this->db->or_like('nm_mk', $q);
    $this->db->or_like('nm_kurikulum', $q);
    $this->db->or_like('ta', $q);
    $this->db->limit($limit, $start);
    $this->db->where('kd_prodi',$where_prodi);
    return $this->db->get($t)->result();
  }

  function get_limit_data_krs($t,$limit, $start = 0, $q = NULL,$where_prodi) {
    $this->db->order_by("", $this->order);
    $this->db->like('nim', $q);
    $this->db->or_like('nm_mhs', $q);
    $this->db->or_like('id_matkul', $q);
    $this->db->or_like('nm_mk', $q);
    $this->db->or_like('nm_kelas', $q);
    $this->db->or_like('ta', $q);
    $this->db->or_like('nm_prodi', $q);
    $this->db->limit($limit, $start);
    $this->db->where('id_prodi',$where_prodi);
    return $this->db->get($t)->result();
  }

  function get_limit_query_kelas($t,$limit, $start = 0, $q = NULL,$where_prodi)
  {
    $this->db->order_by('', $this->order);
    $this->db->like('id_kelas', $q);
    $this->db->or_like('nm_kelas', $q);
    $this->db->or_like('kode_mk', $q);
    $this->db->or_like('id_kurikulum', $q);
    $this->db->or_like('ta', $q);
    $this->db->or_like('id_prodi', $q);
    $this->db->limit($limit, $start);
    $this->db->where('id_prodi',$where_prodi);
    return $this->db->get('v_kelas_kuliah')->result();
  }

  function get_all_view_mk_kur($where_prodi)
  {
      $this->db->order_by("", $this->order);
      $this->db->where('kd_prodi',$where_prodi);
      return $this->db->get("v_mk_kurikulum")->result();
  }

  function get_all_view_nilai($where_prodi)
  {
      $this->db->order_by("", $this->order);
      $this->db->where('id_prodi',$where_prodi);
      return $this->db->get("v_nilai")->result();
  }

  function get_all_view_val_krs()
  {
      $this->db->where('kd_prodi',$where_prodi);
      $this->db->order_by("", $this->order);
      return $this->db->get("v_mhs_krs")->result();
  }

  function get_query($q)
  {
      return $this->db->query($q);
  }

  function count_table($t,$where_id,$where_prodi) {
      $this->db->from($t);
      $this->db->where($where_id,$where_prodi);
      return $this->db->count_all_results();
  }

  function get_all_view($t,$where_prodi)
  {
      $this->db->where('kd_prodi',$where_prodi);
      $this->db->order_by("", $this->order);
      return $this->db->get($t)->result();
  }

  function get_view_by_id($table,$field,$sort)
  {
      $this->db->where($field, $sort);
      return $this->db->get($table)->row();
  }

  function update($table,$field,$id, $data)
  {
      $this->db->set($data);
      $this->db->where($field, $id);
      $this->db->update($table, $data);
      return ($this->db->affected_rows() != 1) ? false : true;
  }

  public function insertRecord($table, $data){
      $this->db->insert($table,$data);
      return ($this->db->affected_rows() != 1) ? false : true;
  }
  public function insertRecordMahasiswa($data){
      $this->db->insert('tb_mhs',$data);
      return ($this->db->affected_rows() != 1) ? false : true;
  }

  public function get_mahasiswa($nim){
    $this->db->select("*");
    $this->db->from("tb_mhs");
    $this->db->where("nim", $nim);
    return $this->db->get();
  }
  public function get_dosen($nidn){
    $this->db->select("*");
    $this->db->from("tb_dosen");
    $this->db->where("nidn", $nidn);
    return $this->db->get();
  }
  public function get_mk($k){
    $this->db->select("*");
    $this->db->from("tb_mata_kuliah");
    $this->db->where("kode_mk", $k);
    return $this->db->get();
  }
  public function get_kurikulum($k){
    $this->db->select("*");
    $this->db->from("tb_kurikulum");
    $this->db->where("nm_kurikulum", $k);
    return $this->db->get();
  }

  public function get_mk_kurikulum($k){
    $this->db->select("*");
    $this->db->from("tb_mk_kurikulum");
    $this->db->where("kode_mk", $k);
    return $this->db->get();
  }

  function total_rows($table) {
      $this->db->from($table);
      return $this->db->count_all_results();
  }
  function total_rows_where($table,$field,$data) {
      $this->db->where($field, $data);
      $this->db->from($table);
      return $this->db->count_all_results();
  }
}
