<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_bpb2 extends CI_Model {

	function get_json_bpb(){
		$this->db->select('a.*, b.*,c.*');
		$this->db->from('t_bpbmst a');
		$this->db->join('t_bpbdtl b','b.fc_nobpb=a.fc_nobpb');
		$this->db->join('td_barang c','c.fc_kdbarang=b.fc_kdbarang');
		$query = $this->db->get();
		return $query;
	}
}	