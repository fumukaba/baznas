<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_pencairanpoin');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
       // $this->mdl_home->getsqurity();
       // 
        $data['user'] = $this->Mdl_pencairanpoin->user();
        $data['view_file']    = "moduls/laporan_point";
        // print_r($data['user']);
        // die();
        $this->load->view('admin_view',$data);
    }

    public function prints(){
    	$nama = $this->input->post('nama');
    	if ($nama == null) {
    		redirect(base_url().'Point/index');
    	}
    	else{
        	$data['print'] = $this->Mdl_pencairanpoin->PrintPointFilter($nama);
		// print_r($data['print']);
		// die();
            
            $this->load->view('moduls/print_pencairanpoint',$data);
        }
    }
}	