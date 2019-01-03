<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_setting');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/setting";
        $this->load->view('admin_view',$data);
    }
    
    public function ajax_edit() {
		$data = $this->Mdl_setting->get_by_id();
		//print_r($this->db->last_query());
		echo json_encode($data);
	}

	public function update_link() {
		$data1 = array('fc_isi' => $this->input->post('waktu'));
		$this->Mdl_setting->update_link($data1,array('fc_param' => 'WAKTU'));
	}
}	