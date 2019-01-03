<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_type extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_user_type');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	 function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/user_type";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_user_type->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $user->user_type_name;
			$row[] = $user->nama;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$user->user_type_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$user->user_type_id."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_user_type->count_all(),
						"recordsFiltered" => $this->Mdl_user_type->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'user_type_name'         => $this->input->post('user_type_name'),
				'nama'         => $this->input->post('nama'),
			);
		$insert = $this->Mdl_user_type->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_user_type->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'user_type_name'         => $this->input->post('user_type_name'),
				'nama'         => $this->input->post('nama'),
			);
		$this->Mdl_user_type->update(array('user_type_id' => $this->input->post('user_type_id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_user_type->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}