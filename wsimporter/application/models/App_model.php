<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($table, $order='');
        return $this->db->get($table)->result();
    }

    // get data by id
    function get_by_id($table,$field,$id='')
    {
        $this->db->where($field, $id);
        return $this->db->get($table)->row();
    }

    // get total rows
    function total_rows($table,$field, $q = NULL) {
        $this->db->like($field, $q);
      	$this->db->from($table);
        return $this->db->count_all_results();
    }

    // insert data
    function insert($table,$data)
    {
        $this->db->insert($table, $data);
    }

    // update data
    function update($table, $field, $id, $data)
    {
        $this->db->where($field, $id);
        $this->db->update($table, $data);
    }

    // delete data
    function delete($table, $field, $id)
    {
        $this->db->where($field, $id);
        $this->db->delete($table);
    }

    function get_query($q)
    {
      return $this->db->query($q);
    }

}
