<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cmhs_model extends CI_Model
{

    public $table = 'tb_cmhs';
    public $id = 'id_mhs';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_mhs', $q);
	$this->db->or_like('kode_cmhs', $q);
	$this->db->or_like('kode_formulir', $q);
	$this->db->or_like('no_ktp', $q);
	$this->db->or_like('kode_agama', $q);
	$this->db->or_like('tpt_lhr', $q);
	$this->db->or_like('tgl_lhr', $q);
	$this->db->or_like('jenkel', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('asal_sekolah', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('file_foto', $q);
	$this->db->or_like('status_ujian', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_mhs', $q);
	$this->db->or_like('kode_cmhs', $q);
	$this->db->or_like('kode_formulir', $q);
	$this->db->or_like('no_ktp', $q);
	$this->db->or_like('kode_agama', $q);
	$this->db->or_like('tpt_lhr', $q);
	$this->db->or_like('tgl_lhr', $q);
	$this->db->or_like('jenkel', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('asal_sekolah', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('file_foto', $q);
	$this->db->or_like('status_ujian', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_query($q)
    {
      return $this->db->query($q);
    }

}
