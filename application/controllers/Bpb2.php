<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpb2 extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_bpb2');
		$this->load->model('Mdl_barang');
		$this->load->model('Mdl_gudang');
		$this->load->model('Mdl_gudang_tjn');
		$this->load->model('Mdl_bpb_new');
		$this->load->model('Mdl_ordere');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/bpb2";
        $this->load->view('admin_view',$data);
    }
	
	

	public function ajax_list() {
		// $list = $this->Mdl_article->get_datatables();
		$list = $this->Mdl_bpb2->get_json_bpb()->result();
		//print_r($this->db->last_query());
		//$no = $_REQUEST['start'];
		$data = array();
		foreach ($list as $l) {
			//$no++;	
			if (@$l->fc_nobpb!="") {
				$row = array();
				$row['no'] = '';
				$row['fc_nobpb'] = $l->fc_nobpb;
				$row['fd_tglbpb'] = $l->fd_tglbpb;
				$row['fv_nama_barang'] = $l->fv_nama_barang;
				$row['fn_qtyterima'] = $l->fn_qtyterima;
				$row['fm_harsat'] = $l->fm_harsat;
				$row['fm_subtot'] = $l->fm_subtot;
				$row['aksi'] = '
				<div class="btn-group">
	                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
	                        <ul class="dropdown-menu" role="menu">
	                            <li><a href="'.base_url().'Bpb/Hapus_bpb/'.$l->fc_nobpb.'/'.$l->fc_kdbarang.'/'.$l->fc_kdgudang.'" >Hapus</a></li>
	                            
	                        </ul>
	            </div>';
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