<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_bpb_new extends CI_Model {
	
	var $table = 't_bpbdtl_temp';
	var $column_order = array('a.fc_id','a.fc_nobpb','a.fc_kdbarang','a.fc_kdgudang','a.fn_qtyterima','a.fm_harsat','a.fm_subtot','a.id_user',null); //set column field database for datatable orderable
	var $column_search = array('a.fc_id','a.fc_nobpb','a.fc_kdbarang','a.fc_kdgudang','a.fn_qtyterima','a.fm_harsat','a.fm_subtot','a.id_user'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('a.fc_id' => 'asc'); // default order

	private function _get_datatables_query() {
		$this->db->select('a.fc_id as id,a.fc_nobpb,a.fc_kdbarang,a.fc_kdgudang,a.fn_qtyterima,a.fm_harsat,a.fm_subtot,c.*');
		$this->db->from('t_bpbdtl_temp a');
		$this->db->join('td_barang c','c.fc_kdbarang=a.fc_kdbarang','left outer');
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
		$this->db->where('a.fc_nobpb',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all($id) {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_datatables($id) {
		$this->_get_datatables_query();
		$this->db->where('a.fc_nobpb',$id);
		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function select_data($id){
		$this->db->where('fc_nobpb', $id);
		$query = $this->db->get('t_bpbdtl_temp');
		return $query->result();	
	}

	 function get_data($where) {
        $this->db->where($where);
        $query = $this->db->get('t_bpbdtl_temp');
        return $query->result_array();
    }

    function get_data_bpb($where){
		$this->db->select('a.*,b.*');
		$this->db->from('t_bpbmst a');
		$this->db->join('t_bpbdtl b','b.fc_nobpb=a.fc_nobpb');
		$this->db->where('a.fc_nobpb', $where);
		$query = $this->db->get();
		return $query->result_array();
    }
}