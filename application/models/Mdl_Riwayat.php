<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mdl_Riwayat extends CI_Model {



	var $table2 = 'riwayat_pencairan_poin';

	var $column_orderid = array('fc_id','fc_user','fm_nominal','fc_poin',null); //set column field database for datatable orderable

	var $column_searchid = array('fc_id','fc_user','fm_nominal','fc_poin');

	var $orderid = array('fc_id' => 'asc');



	



	public function get_datatablesid($id) {

		$this->_get_datatables_queryid();

		$this->db->where('fc_user',$id);



		if ($_REQUEST['length'] != -1) {

			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		}



		$query = $this->db->get();

		return $query->result();

	}

	

	private function _get_datatables_queryid() {

		$this->db->from($this->table2);

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

		$this->db->where('fc_user',$id);

		$query = $this->db->get();

		return $query->num_rows();

	}



	function count_allid($id) {

		$this->db->from($this->table2);

		return $this->db->count_all_results();

	}
}	