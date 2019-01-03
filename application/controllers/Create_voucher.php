<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_voucher extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/create_voucher";
        $this->load->view('admin_view',$data);
    }

    function getNomor(){
		$rows = $this->db->query('select * from t_nomor where kode="INV"')->result_array();
		foreach ($rows as $row) {
			 echo $row['awalan'].str_pad($row['nomor'], 5, "0", STR_PAD_LEFT);
		}     
	}		
}	