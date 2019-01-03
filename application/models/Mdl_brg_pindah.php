<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_brg_pindah extends CI_Model {
	
	var $table = 't_barang_pindah';
	var $column_order = array('fc_kdbarang_pindah','fd_tgl_barang_pindah','fc_kdgudang_asal','fc_kdgudang_tujuan','fc_kdbarang','f_jumlah_barang',null); //set column field database for datatable orderable
	var $column_search = array('fc_kdbarang_pindah','fd_tgl_barang_pindah','fc_kdgudang_asal','fc_kdgudang_tujuan','fc_kdbarang','f_jumlah_barang'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('fc_kdbarang_pindah' => 'asc'); // default order

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
	    $this->db->select('a.*,b.fv_nmgudang AS nmasal,	c.fv_nmgudang AS nmtujuan,d.*');
	    $this->db->from('t_barang_pindah a');
	    $this->db->join('tm_gudang b','a.fc_kdgudang_asal = b.fc_kdgudang');
	    $this->db->join('tm_gudang c','a.fc_kdgudang_tujuan = c.fc_kdgudang');
	    $this->db->join('td_barang d','a.fc_kdbarang=d.fc_kdbarang');
		$this->db->where('a.fd_tgl_barang_pindah',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getTable()
	{
		return $this->db->group_by('fd_tgl_barang_pindah')
						->order_by('fd_tgl_barang_pindah','DESC')
						->get($this->table);
	}
	
	public function getnomor(){
		$this->db->from('t_nomor');
		$this->db->where('kode','BRGP');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_ambil_lama($fc_kdgudang_asal,$fc_kdbarang){
	    $this->db->where('fc_kdgudang',$fc_kdgudang_asal);
	    $this->db->where('fc_kdbarang',$fc_kdbarang);
	    $query = $this->db->get('td_stok_barang_gudang');
	    return $query->result_array();
	}
	
	public function get_ambil_lama2($fc_kdgudang_tujuan,$fc_kdbarang){
	    $this->db->where('fc_kdgudang',$fc_kdgudang_tujuan);
	    $this->db->where('fc_kdbarang',$fc_kdbarang);
	    $query = $this->db->get('td_stok_barang_gudang');
	    return $query->result_array();
	}
	
	function update_table($table, $data, $where) {
        $this->db->where($where);
        $query = $this->db->update($table, $data);
    }
    
    function insert_table($table, $data) {
        $query = $this->db->insert($table, $data);
        return $query;
    }

     function PrintBpbFilter($tgl1, $tgl2){
		$this->db->select('a.*, b.*,c.fv_nmgudang AS nmasal,d.fv_nmgudang AS nmtujuan');
		$this->db->from('t_barang_pindah a');
		$this->db->join('td_barang b','a.fc_kdbarang=b.fc_kdbarang');
		 $this->db->join('tm_gudang c','a.fc_kdgudang_asal = c.fc_kdgudang');
	    $this->db->join('tm_gudang d','a.fc_kdgudang_tujuan = d.fc_kdgudang');
		$this->db->where('a.fd_tgl_barang_pindah >=', $tgl1);
		$this->db->where('a.fd_tgl_barang_pindah <=', $tgl2);
		$query = $this->db->get();
		return $query->result_array();
	}
}