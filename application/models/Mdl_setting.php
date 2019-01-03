<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_setting extends CI_Model {
    
    var $table = 't_setup';
	
	public function get_by_id() {
		$this->db->select('a.fc_isi as set_data1');
		$this->db->from('t_setup a');
		$this->db->where('a.fc_param','WAKTU');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update_link($data1, $data2) {
		$this->db->update($this->table, $data1, $data2);
		return $this->db->affected_rows();
	}
	
	// public function update_data($data, $data2) {
	// 	$this->db->update($this->table, $data, $data2);
	// 	return $this->db->affected_rows();
	// }
}