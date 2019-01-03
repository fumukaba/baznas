<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_bpb extends CI_Model {
	
	var $table = 't_bpbmst';
	var $column_order = array('fc_id','fc_nobpb','fd_tglbpb','fv_nama_supplier','fd_tglinput','fn_qtytot',null); //set column field database for datatable orderable
	var $column_search = array('fc_id','fc_nobpb','fd_tglbpb','fv_nama_supplier','fd_tglinput','fn_qtytot'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('fc_id' => 'asc'); // default order

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

	function get_json_bpb($id){
		$this->db->select('a.*, b.*,c.*');
		$this->db->from('t_bpbmst a');
		$this->db->join('t_bpbdtl b','b.fc_nobpb=a.fc_nobpb');
		$this->db->join('td_barang c','c.fc_kdbarang=b.fc_kdbarang');
		$this->db->where('a.fd_tglbpb',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getTable()
	{
		return $this->db->group_by('fd_tglbpb')
						->order_by('fc_nobpb','DESC')
						->get($this->table);
	}

	public function getnomor(){
		$this->db->from('t_nomor');
		$this->db->where('kode','BPB');
		$query = $this->db->get();
		return $query->result_array();
	}

	function insert_table($table, $data) {
        $query = $this->db->insert($table, $data);
        return $query;
    }

     function get_table_where($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        // if ($this->db->_error_message()) header('Location: ../');
        return $query->result_array();
    }

    function sum_qty_terima($user){
    	$this->db->select_sum('fn_qtyterima');
    	$this->db->where('fc_nobpb', $user);
    	$query = $this->db->get('t_bpbdtl_temp');
    	return $query->result_array();
    }

    function sum_tot_terima($user){
    	$this->db->select_sum('fm_harsat');
    	$this->db->where('fc_nobpb', $user);
    	$query = $this->db->get('t_bpbdtl_temp');
    	return $query->result_array();
    }

    function PrintBpbFilter($tgl1, $tgl2){
		$this->db->select('a.*, b.*,c.*');
		$this->db->from('t_bpbmst a');
		$this->db->join('t_bpbdtl b','b.fc_nobpb=a.fc_nobpb');
		$this->db->join('td_barang c','c.fc_kdbarang=b.fc_kdbarang');
		$this->db->where('a.fd_tglbpb >=', $tgl1);
		$this->db->where('a.fd_tglbpb <=', $tgl2);
		$query = $this->db->get();
		return $query->result_array();
	}


	function get_by_id($id){
		$this->db->select('a.*,b.*');
		$this->db->from('t_bpbmst a');
		$this->db->join('t_bpbdtl b','b.fc_nobpb=a.fc_nobpb');
		$this->db->where('a.fc_nobpb', $id);
		$query = $this->db->get();
		return $query->row();
	}

	function delete_mst($a) {

		$this->db->delete('t_bpbmst', array('fc_nobpb' => $a));

		 return;

	}

	function delete_dtl($a) {

		$this->db->delete('t_bpbdtl', array('fc_nobpb' => $a));

		 return;

	}

}