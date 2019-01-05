<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_fitrah extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_setting_fitrah');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	 function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/setting_fitrah";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_setting_fitrah->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $setting_fitrah) {
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $setting_fitrah->tahun_fitrah;
			$row[] = $setting_fitrah->nominal_fitrah;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$setting_fitrah->id_set_fitrah."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$setting_fitrah->id_set_fitrah."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_setting_fitrah->count_all(),
						"recordsFiltered" => $this->Mdl_setting_fitrah->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'tahun_fitrah'         => $this->input->post('tahun_fitrah'),
				'nominal_fitrah'         => $this->input->post('nominal_fitrah'),
			);
		$insert = $this->Mdl_setting_fitrah->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_setting_fitrah->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'tahun_fitrah'         => $this->input->post('tahun_fitrah'),
				'nominal_fitrah'         => $this->input->post('nominal_fitrah'),
			);
		$this->Mdl_setting_fitrah->update(array('id_set_fitrah' => $this->input->post('id_set_fitrah')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_setting_fitrah->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}