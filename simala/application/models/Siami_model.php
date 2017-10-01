<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siami_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $siami = $this->load->database('siami',TRUE);
    }

    // get all
    function get_all($table ,$field='',$order='')
    {
        $siami->db->order_by($field, $order);
        return $siami->db->get($table)->result();
    }

    // get data by id
    function get_by_id($table,$field, $id)
    {
        $siami->db->where($field, $id);
        return $siami->db->get($table)->row();
    }

    // get total rows
    function total_rows($table,$field,$q = NULL) {
        $siami->db->like($field, $q);
    	$siami->db->or_like($field, $q);
    	$siami->db->from($table);
        return $siami->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($table,$field,$order='',$limit, $start = 0, $q = NULL) {
        $siami->db->order_by($field, $order);
        $siami->db->like($field, $q);
	$siami->db->or_like($field, $q);
	$siami->db->limit($limit, $start);
        return $siami->db->get($table)->result();
    }

    // insert data
    function insert($table,$data)
    {
        $siami->db->insert($table, $data);
    }

    // update data
    function update($table,$id, $data)
    {
        $siami->db->where($siami->id, $id);
        $siami->db->update($table, $data);
    }

    // delete data
    function delete($table,$id)
    {
        $siami->db->where($siami->id, $id);
        $siami->db->delete($table);
    }

    function get_query($q)
    {
      return $siami->db->query($q);
    }

}
