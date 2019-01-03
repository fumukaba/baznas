<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_brg_pindah2 extends CI_Model {

	function get_json_bpb(){
	    $this->db->select('a.*,b.fv_nmgudang AS nmasal,	c.fv_nmgudang AS nmtujuan,d.*');
	    $this->db->from('t_barang_pindah a');
	    $this->db->join('tm_gudang b','a.fc_kdgudang_asal = b.fc_kdgudang');
	    $this->db->join('tm_gudang c','a.fc_kdgudang_tujuan = c.fc_kdgudang');
	    $this->db->join('td_barang d','a.fc_kdbarang=d.fc_kdbarang');
		$query = $this->db->get();
		return $query;
	}

}	