<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_kontak');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/kontak";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_edit() {
		$data = $this->Mdl_kontak->get_by_id();
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'kontak_lat'         	=> $this->input->post('kontak_lat'),
				'kontak_long'           => $this->input->post('kontak_long'),
				'kontak_deskripsi'      => $this->input->post('kontak_deskripsi'),
				'kontak_judul'         	=> $this->input->post('kontak_judul'),
			);
		$this->Mdl_kontak->update(array('id_kontak' => $this->input->post('id_kontak')), $data);
		//print_r($this->db->last_query());
		echo json_encode(array("status" => TRUE));
    }
	
}