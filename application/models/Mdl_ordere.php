<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_ordere extends CI_Model {
	
	var $table = 'tm_order';
	var $column_order = array('fc_kdorder','fd_tgl_order','fv_nama_order','fm_total',null); //set column field database for datatable orderable
	var $column_search = array('fc_kdorder','fd_tgl_order','fv_nama_order','fm_total'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('a.fc_kdorder' => 'asc'); // default order
	
	private function _get_datatables_query() {
		$this->db->select('a.*, b.*, c.*');
		$this->db->from('tm_order a');
		$this->db->join('td_order b','b.fc_kdorder=a.fc_kdorder','left outer');
		$this->db->join('td_barang c','c.fc_kdbarang=b.fc_kdbarang','left outer');
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

	function count_filtered($id) {
		$this->_get_datatables_query();
		$this->db->where('a.fc_kdorder',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all($id) {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_datatables($id) {
		$this->_get_datatables_query();
		$this->db->where('a.fc_kdorder',$id);
		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	 function update_table($table, $data, $where) {
        $this->db->where($where);
        $query = $this->db->update($table, $data);
    }

    function get_table_where($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        // if ($this->db->_error_message()) header('Location: ../');
        return $query->result_array();
    }

     function get_table_join_where($table1, $table2, $on, $where) {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $on);
        $this->db->where($where);

        $query = $this->db->get();

        return $query->result_array();
    }
}	