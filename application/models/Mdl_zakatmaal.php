<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_zakatmaal extends CI_Model {
	
	var $table = 'tb_zakat_maal';
	var $column_order = array('id_maal','nama_pengirim','jumlah_maal','tanggal_maal','status_maal','status_uang','jenis_maal',null); //set column field database for datatable orderable
	var $column_search = array('id_maal','nama_pengirim','jumlah_maal','tanggal_maal','status_maal','status_uang','jenis_maal'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('id_maal' => 'asc'); // default order

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
		$this->db->where('id_maal',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id) {
		$this->db->where('id_maal', $id);
		$this->db->delete($this->table);
	}

	public function getTable()
	{
		return $this->db->get($this->table);
	}
}