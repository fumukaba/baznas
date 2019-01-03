<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_order extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_order');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/laporan_order";
        $this->load->view('admin_view',$data);
    }

    public function prints(){
    	$tgl1 = $this->input->post('tgl1');
    	$tgl2 = $this->input->post('tgl2');
    	if ($tgl1 == null || $tgl2 == null) {
    		redirect(base_url().'laporan_order/index');
    	}
    	else{
        	$data['print'] = $this->Mdl_order->PrintOrderFilter($tgl1, $tgl2);
		// print_r($data['print']);
		// die();
            
            $this->load->view('moduls/print_order',$data);
        }
    }
}	