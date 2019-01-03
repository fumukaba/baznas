<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_voucher extends CI_Model {
	
	var $table = 'tm_voucher';
	var $column_order = array('v.fc_id_voucher','v.fc_kdbarang','v.id_user','v.fm_nominal','v.fd_tgl_exp_voucher','v.f_kode_voucher','v.fd_tgl_terbit_voucher','v.fc_status'); //set column field database for datatable orderable
	var $column_search = array('v.fc_id_voucher','v.fc_kdbarang','v.id_user','v.fm_nominal','v.fd_tgl_exp_voucher','v.f_kode_voucher','v.fd_tgl_terbit_voucher','v.fc_status'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('v.fm_nominal' => 'desc'); // default order
	
	private function _get_datatables_query() {
		$this->db->select('*')
				 ->from($this->table.' v')
				 ->join('td_barang b','b.fc_kdbarang = v.fc_kdbarang');

		$i = 0;
		foreach ($this->column_search as $item) {
			if ($_REQUEST['search']["value"]) {
				if ($i===0) {
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_REQUEST['search']["value"]);
				} else {
					$this->db->or_like($item, $_REQUEST['search']["value"]);
			}
			
			if (count($this->column_search) - 1 == $i)
				$this->db->group_end();
			}

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db->order_by($this->column_order[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function count_filtered() {
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_datatables() {
		$this->_get_datatables_query();

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	public function add($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('fc_id_voucher',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id) {
		$this->db->where('fc_id_voucher', $id);
		$this->db->delete($this->table);
	}
	
	function get_voucher() {
	  	$query = $this->db->get($this->table);
	  	return $query->result();
    }
	
	public function get_datatablesid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('fc_id_voucher',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	public function getnomor(){
		$this->db->from('t_nomor');
		$this->db->where('kode','NEO');
		$query = $this->db->get();
		return $query->result_array();
	}

	function update_status($id,$data) {

		$this->db->where('fc_id_voucher', $id);

		$this->db->update('tm_voucher', $data);

	}
}