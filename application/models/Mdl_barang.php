<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_barang extends CI_Model {
	
	var $table = 'td_barang';
	var $column_order = array('fc_id','fc_kdbarang','fc_kdkategori','fv_nama_barang','fv_deskripsi','fc_img_1','fc_img_2','fc_img_3','fc_img_4','fd_harga_barang_publish','fd_harga_barang_min','fv_jenis_poin','fv_berat','fv_dimensi','fc_user','fc_status_stok',null); //set column field database for datatable orderable
	var $column_search = array('fc_id','fc_kdbarang','fc_kdkategori','fv_nama_barang','fv_deskripsi','fc_img_1','fc_img_2','fc_img_3','fc_img_4','fd_harga_barang_publish','fd_harga_barang_min','fv_jenis_poin','fv_berat','fv_dimensi','fc_user','fc_status_stok');
	var $order = array('fc_id' => 'asc');
	
	private function _get_datatables_query() {
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    // $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i); //last loop
                    // $this->db->group_end(); //close bracket


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

	function count_filteredid() {
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_allid() {
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


	// public function get_datatablesid($id) {
	// 	$this->_get_datatables_queryid();
	// 	$this->db->where('fc_kdkategori',$id);

	// 	if ($_REQUEST['length'] != -1) {
	// 		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
	// 	}

	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function add($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by($id) {
		$this->db->from($this->table);
		$this->db->where('fc_id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	public function delete_by_id($id) {
		$this->db->where('fc_id', $id);
		$this->db->delete($this->table);
	}

	public function get_by_id($id) {
	 	$this->db->from($this->table);
		$this->db->where('fc_id',$id);
		$query = $this->db->get();
	 	return $query->row();
	}

	public function get_all(){
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
}