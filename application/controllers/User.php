<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_user');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	 function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/user";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_user->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $user) {
			if($user->id=='18'){
				$link = '';
			}else{
				$link = '<li><a href="javascript:void(0)" onclick="hapus('."'".$user->id."'".')">Delete</a></li>';
			}
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $user->id_user;
			$row[] = $user->nama;
			$row[] = $user->user_type_name;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$user->id."'".')">Edit</a></li>
                            '.$link.'
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_user->count_all(),
						"recordsFiltered" => $this->Mdl_user->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'id_user'         => $this->input->post('admin_username'),
				'password' 	     => md5($this->input->post('admin_password')),
				'nama'       		 => $this->input->post('admin_nama'),
				'admin_level'        	 => $this->input->post('admin_level'),
				'view_password'        	 => $this->input->post('admin_password'),
			);
		$insert = $this->Mdl_user->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_user->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'id_user'         => $this->input->post('admin_username'),
				'password' 	     => md5($this->input->post('admin_password')),
				'nama'       		 => $this->input->post('admin_nama'),
				'admin_level'        	 => $this->input->post('admin_level'),
			);
		$this->Mdl_user->update(array('id' => $this->input->post('id_admin')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_user->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}