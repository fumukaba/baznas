<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_order extends CI_Model {
	
	var $table = 'tm_order';
	var $column_order = array('fc_kdorder','fd_tgl_order','fm_total','fv_nama_order','fv_email_order','fv_alamat_order','fc_telp','fc_kode_pos_order','fv_provinsi_order','fv_kota_order','fm_ongkir_order','fm_grandtotal_order',null); //set column field database for datatable orderable
	var $column_search = array('fc_kdorder','fd_tgl_order','fm_total','fv_nama_order','fv_email_order','fv_alamat_order','fc_telp','fc_kode_pos_order','fv_provinsi_order','fv_kota_order','fm_ongkir_order','fm_grandtotal_order'); //set column field database for datatable searchable just title , author , category are searchable
	var $order = array('fc_kdorder' => 'asc'); // default order
	
	
	
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

	function get_by_id($id){

        $this->db->where('fc_kdorder', $id);

        return $this->db->get('tm_order')->row();

    }

    function update_status($id,$data) {

		$this->db->where('fc_kdorder', $id);

		$this->db->update('tm_order', $data);

	}

	function PrintOrderFilter($tgl1, $tgl2){
    	$this->db->where('fd_tgl_order >=', $tgl1);
		$this->db->where('fd_tgl_order <=', $tgl2);
        return $this->db->get('tm_order')->result_array();

    }
}