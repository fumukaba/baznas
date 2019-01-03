<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_stock extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_gudang');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
        $data['gdg'] = $this->Mdl_gudang->getGudang();
        $data['view_file']    = "moduls/laporan_stock";
        $this->load->view('admin_view',$data);
    }

    public function prints(){
    	$gdg = $this->input->post('id_gdg');
    	if ($gdg == null) {
    		redirect(base_url().'Laporan_stock/index');
    	}
    	else{
        	$data['print'] = $this->Mdl_gudang->cekGudang($gdg);
		// print_r($data['print']);
		// die();
            $this->load->view('moduls/print_stock',$data);
        }
    }
}	