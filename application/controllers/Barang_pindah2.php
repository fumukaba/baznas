<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_pindah2 extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_brg_pindah2');
		$this->load->model('Mdl_bpb');
		$this->load->model('Mdl_barang');
		$this->load->model('Mdl_gudang');
		$this->load->model('Mdl_bpb_new');
		$this->load->model('Mdl_ordere');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/barang_pindah2";
        $this->load->view('admin_view',$data);
    }



    public function ajax_list() {
		// $list = $this->Mdl_article->get_datatables();
		$list = $this->Mdl_brg_pindah2->get_json_bpb()->result();
		//print_r($this->db->last_query());
		//$no = $_REQUEST['start'];
		$data = array();
		foreach ($list as $l) {
			//$no++;	
			if (@$l->fc_kdbarang_pindah!="") {
				$row = array();
				$row['no'] = '';
				$row['fc_kdbarang_pindah'] = $l->fc_kdbarang_pindah;
				$row['fd_tgl_barang_pindah'] = $l->fd_tgl_barang_pindah;
				$row['nmasal'] = $l->nmasal;
				$row['nmtujuan'] = $l->nmtujuan;
				$row['fv_nama_barang'] = $l->fv_nama_barang;
				$row['f_jumlah_barang'] = $l->f_jumlah_barang;
				$data[] = $row;
			}
		}

		$output = array(
						// "draw" => $_REQUEST['draw'],
						// "recordsTotal" => $this->Mdl_article->count_all(),
						// "recordsFiltered" => $this->Mdl_article->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
}    