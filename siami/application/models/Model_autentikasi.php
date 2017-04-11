<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_autentikasi extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

  public function ceklogin($username, $password){
    $this->db->where("username", $username);
    $this->db->where("password", $password);
    $query = $this->db->get("administrator");
    if($query->num_rows() > 0){
      return $query->result_array();
    }
    else{
      return false;
    }
  }
}
