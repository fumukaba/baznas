<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_produk extends CI_Model {
	
	var $table = 'td_barang';
	var $column_orderid = array('fc_id','fc_kdbarang','fc_kdkategori','	fv_nama_barang','fv_deskripsi','fc_img_1','fc_img_2','fc_img_3','fc_img_4','fd_harga_barang_publish	','fd_harga_barang_min','fv_jenis_poin','fv_berat','fv_dimensi','fc_status_stok',null); //set column field database for datatable orderable
	var $column_searchid = array('fc_id','fc_kdbarang','fc_kdkategori','	fv_nama_barang','fv_deskripsi','fc_img_1','fc_img_2','fc_img_3','fc_img_4','fd_harga_barang_publish	','fd_harga_barang_min','fv_jenis_poin','fv_berat','fv_dimensi','fc_status_stok'); //set column field database for datatable searchable just title , author , category are searchable
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

	public function get_datatablesid($id) {
		$this->_get_datatables_queryid();
		$this->db->where('fc_kdkategori',$id);

		if ($_REQUEST['length'] != -1) {
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		}

		$query = $this->db->get();
		return $query->result();
	}
	
	private function _get_datatables_queryid() {
		$this->db->from($this->table);
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
		$this->db->where('fc_kdkategori',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_allid($id) {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	
	
	function add($data) {

		$this->db->insert('td_barang', $data);

	}



	

	function get_last_ai(){

    	$query = $this->db->query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'k4991560_neo' AND TABLE_NAME = 'td_barang'");

    	return $query->last_row();

    }



      function edit($a) {

		$d = $this->db->get_where('td_barang', array('fc_id'=> $a))->row();

		return $d;

	}



	function get_by_id($id){

        $this->db->where('fc_id', $id);

        return $this->db->get('td_barang')->result();

    }

    public function get_by($key) {
		$this->db->where('fc_kdkategori', $key);
        return $this->db->get('td_barang')->row();
	}


    function update($id,$data) {

		$this->db->where('fc_id', $id);

		$this->db->update('td_barang', $data);

	}



	function delete($a) {

		$this->db->delete('td_barang', array('fc_id' => $a));

		 return;

	}

	public function getnomor(){
		$this->db->from('t_nomor');
		$this->db->where('kode','BRG');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
}