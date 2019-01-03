<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mdl_gudang_tjn extends CI_Model {

	

	var $table = 'tm_gudang';

	var $column_order = array('fc_kdgudang','fv_nmgudang','fv_alamat','id_user',null); //set column field database for datatable orderable

	var $column_search = array('fc_kdgudang','fv_nmgudang','fv_alamat','id_user'); //set column field database for datatable searchable just title , author , category are searchable

	var $order = array('fc_kdgudang' => 'asc'); // default order

	

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

	

	function getGudang() {

		$this->db->from($this->table);

		$query = $this->db->get();

		return $query->result_array();

	}

	

	// public function add($data) {

	// 	$this->db->insert($this->table, $data);

	// 	return $this->db->insert_id();

	// }

	

	public function get_by_id($id) {

		$this->db->from($this->table);

		$this->db->where('fc_kdgudang',$id);

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

	

	public function cekGudang($gdg) {

		$this->db->select('*, SUM(td_stok_barang_gudang.fc_qty_barang) as stok');

		$this->db->from('td_stok_barang_gudang');

		$this->db->join('tm_gudang', 'td_stok_barang_gudang.fc_kdgudang=tm_gudang.fc_kdgudang');

		$this->db->join('td_barang', 'td_stok_barang_gudang.fc_kdbarang=td_barang.fc_kdbarang');

		$this->db->where('td_stok_barang_gudang.fc_kdgudang', $gdg);

		$this->db->group_by('td_stok_barang_gudang.fc_kdgudang, td_stok_barang_gudang.fc_kdbarang');

		$query = $this->db->get();

		return $query->result_array();

	}



	public function get_by($key) {

		$this->db->where('fc_kdgudang', $key);

        return $this->db->get($this->table)->row();

	}



	public function getTableDet($id)

	{

		return  $this->db->from($this->table." gdng")

				 ->join('td_stok_barang_gudang stk','gdng.fc_kdgudang = stk.fc_kdgudang')

				 ->join('td_barang brg','brg.fc_kdbarang = stk.fc_kdbarang')

				 ->where('gdng.fc_kdgudang',$id)

				 ->get();

	}



	public function updateStok($where, $data) {

		$this->db->update('td_stok_barang_gudang', $data, $where);

		return $this->db->affected_rows();

	}

}