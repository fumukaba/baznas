<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_pencairanpoin extends CI_Model {
	
	var $table = 'tm_user';
	var $column_order = array('id_user','nama','sisa_poin',null); //set column field database for datatable orderable
	var $column_search = array('id_user','nama','sisa_poin'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('sisa_poin' => 'desc'); // default order
	
	var $table2 = 'pencairan_poin';
	var $column_orderid = array('kode_cairpoin','fc_id_order_detail','nama','selisih_harga','keuntungan_harga','persentasi','total_poin','status_ambil','tgl_ambil', 'fm_harga','fd_tgl_order',null); //set column field database for datatable orderable
	var $column_searchid = array('kode_cairpoin','fc_id_order_detail','nama','selisih_harga','keuntungan_harga','persentasi','total_poin','status_ambil','tgl_ambil', 'fm_harga','fd_tgl_order'); 
	var $orderid = array('fc_kdorder' => 'DESC');
	
	private function _get_datatables_query() {
		$this->db->select('u.*, sum(pp.total_poin) as sisa_poin')
				 ->from($this->table.' u')
				 ->join('pencairan_poin pp','pp.id_user_dapat = u.id_user')
				 ->where('pp.status_ambil',0);

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

	function PrintPointFilter($id) {
		$this->db->select('u.*, sum(pp.total_poin) as sisa_poin')
				 ->from($this->table.' u')
				 ->join('pencairan_poin pp','pp.id_user_dapat = u.id_user')
				 ->where('pp.id_user_dapat', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function user() {
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result_array();
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
		$this->db->where('id_user',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function update($where, $data) {
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id) {
		$this->db->where('id_user_dapat', $id);
		$this->db->delete($this->table);
	}
	
	function get_cairpoin() {
	  	$query = $this->db->get($this->table);
	  	return $query->result();
    }
	
	public function get_datatablesid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('id_user_dapat',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	private function _get_datatables_queryid() {
		$this->db->from($this->table2." pp")
				 ->join('td_order do','pp.fc_id_order_detail = do.fc_id_order_detail')
				 ->join('tm_order mo','do.fc_kdorder = mo.fc_kdorder');
		$i = 0;
	
        foreach ($this->column_searchid as $item) {
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

                if(count($this->column_searchid) - 1 == $i); //last loop
                    // $this->db->group_end(); //close bracket


            }

			$i++;
		}

		if (isset($_REQUEST['order'])) {
			$this->db->order_by($this->column_orderid[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
		} else if (isset($this->orderid)) {
			$order = $this->orderid;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function count_filteredid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('id_user',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_allid($id) {
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}
	
	public function addcairpoin($data) {
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}

	public function addriwayat($data) {
		$this->db->insert('riwayat_pencairan_poin', $data);
		return $this->db->insert_id();
	}
	
	public function get_by_prod($id) {
		$this->db->from($this->table2);
		$this->db->where('kode_cairpoin',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	function update_kat($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	public function update_cairpoin($where, $data) {
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by($id) {
		$this->db->where('kode_cairpoin', $id);
		$this->db->delete($this->table2);
	}
	
	public function get_by($key) {
		$this->db->where('id_user_dapat', $key);
        return $this->db->get($this->table2)->row();
	}
	public function getTableDet($id)
	{
		return  $this->db->from($this->table2." pp")
				 ->join('td_order do','pp.fc_id_order_detail = do.fc_id_order_detail')
				 ->join('tm_order mo','do.fc_kdorder = mo.fc_kdorder')
				 ->where('pp.id_user_dapat',$id)
				 ->get();
	}
	public function getJumpoin($id)
	{
		return $this->db->where($id)->get($this->table2);
	}
}