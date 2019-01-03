<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_m extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function sidebar_lv1(){
    $table = 'sidebar';
    $query = $this->db->query("SELECT * FROM sidebar where sidebar_level = 1;");
    return $query;
  }

  public function sidebar_lv2($sidebar_lv1, $user_type){
    $table = 'sidebar';
    $query = $this->db->query("SELECT a.*, b.* FROM sidebar a
                               JOIN permits b on b.sidebar = a.sidebar_id
                               where sidebar_level = 2 and sidebar_parent = '$sidebar_lv1'
                               and b.permit_access != '' and b.user_type = '$user_type' group by a.sidebar_id");
    return $query;
  }

  public function create_config($table, $data){
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  function select_config($table, $where){
    $query = $this->db->query("SELECT * FROM $table $where");
    return $query;
  }


  function select_config_array($table, $where){
    $this->db->select('*');
    $this->db->where($where);
    $query = $this->db->get($table);
    return $query;
  }

  function select_config_one($table, $val, $where){
    $this->db->select($val);
    $this->db->where($where);
    $query = $this->db->get($table)->row();
    return $query;
  }

  function update_config($table, $data, $where){
    $this->db->where($where);
		$this->db->update($table,$data);
    if($this->db->affected_rows() >=0){
      return $data = '200'; // your code
    }else{
      return $data = '204'; // your code.
    }
  }

  function delete_config($table, $where){
    $this->db->where($where);
    $this->db->delete($table);
  }

  function globalselect($select = NULL, $table = NULL, $join = NULL, $where = NULL, $where2 = NULL, $like = NULL, $order = NULL, $limit = NULL) {
      $this->db->select($select);
      $this->db->from($table);
      if ($join) {
          for ($i=0; $i<sizeof($join['data']) ; $i++) {
              $this->db->join($join['data'][$i]['table'],$join['data'][$i]['join'],$join['data'][$i]['type']);
          }
      }
      if ($where) {
          for ($i=0; $i<sizeof($where['data']) ; $i++) {
              $this->db->where($where['data'][$i]['column'],$where['data'][$i]['param']);
          }
      }
      if ($where2) {
          $this->db->where($where2);
      }
      if ($like) {
          for ($i=0; $i<sizeof($like['data']) ; $i++) {
              $this->db->like('CONCAT_WS(" ", '.$like['data'][$i]['column'].')',$like['data'][$i]['param']);
          }
      }
      if ($limit) {
          $this->db->limit($limit['finish'],$limit['start']);
      }
      if ($order) {
          for ($i=0; $i<sizeof($order['data']) ; $i++) {
              $this->db->order_by($order['data'][$i]['column'], $order['data'][$i]['type']);
          }
      }

      $query = $this->db->get();
      if($query->num_rows() > 0)
          return $query;
      else
          return false;
  }


}
