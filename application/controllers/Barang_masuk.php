<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_bpb');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/barang_masuk";
        $this->load->view('admin_view',$data);
    }

    public function prints(){
    	$tgl1 = $this->input->post('tgl1');
    	$tgl2 = $this->input->post('tgl2');
    	if ($tgl1 == null || $tgl2 == null) {
    		redirect(base_url().'Barang_masuk/index');
    	}
    	else{
        	$data['print'] = $this->Mdl_bpb->PrintBpbFilter($tgl1, $tgl2);
			$this->load->view('moduls/print_bpb',$data);
    	}
		// print_r($data['print']);
		// die();
    }
}	