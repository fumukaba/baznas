<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_user');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
		// $this->load->library("phpqrcode/qrlib");
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
			if($user->user_type_name != 'Super') {
				$no++;
				$row = array();
				// $row[] = '';
				$row[] = $no;
				$row[] = $user->id_user;
				$row[] = $user->nama;
				$row[] = $user->nomor_hp . "<br />" . $user->email;
				$row[] = $user->nama_rek_user . "<br />" . $user->no_rek_user . "<br />" . $user->bank_rek_user;
				$row[] = $user->user_type_name;
				$row[] = '<img src="' . base_url('uploads/user/' . $user->foto) . '" alt="" width="100" />';
				$row[] = '
				<div class="btn-group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
							<li><a href="javascript:void(0)" onclick="edit('."'".$user->id."'".')">Edit</a></li>
								<li><a href="javascript:void(0)" onclick="hapus('."'".$user->id."'".')">Delete</a></li>
							</ul>
				</div>';
				$data[] = $row;
			}
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
		$gambar = $_FILES['admin_foto']['name'];
		$config['upload_path'] = './uploads/user/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '2000000';
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('admin_foto');

		if(empty($gambar)){
			$data = array(
				'id_user'         => $this->input->post('admin_username'),
				'password' 	     => md5($this->input->post('admin_password')),
				'nama'       		 => $this->input->post('admin_nama'),
				'nomor_hp' => $this->input->post('nomor_hp'),
				'email'       		 => $this->input->post('admin_email'),
				'nama_rek_user'		=> $this->input->post('admin_nm_rek'),
				'no_rek_user'	=> $this->input->post('admin_no_rek'),
				'bank_rek_user'		=> $this->input->post('admin_nm_bank'),
				'admin_level'        	 => $this->input->post('admin_level'),
				'view_password'        	 => $this->input->post('admin_password'),
			);
 		}else{
			$data = array(
				'id_user'         => $this->input->post('admin_username'),
				'password' 	     => md5($this->input->post('admin_password')),
				'nama'       		 => $this->input->post('admin_nama'),
				'nomor_hp' => $this->input->post('nomor_hp'),
				'email'       		 => $this->input->post('admin_email'),
				'nama_rek_user'		=> $this->input->post('admin_nm_rek'),
				'no_rek_user'	=> $this->input->post('admin_no_rek'),
				'bank_rek_user'		=> $this->input->post('admin_nm_bank'),
				'admin_level'        	 => $this->input->post('admin_level'),
				'view_password'        	 => $this->input->post('admin_password'),
				'foto' => $gambar
			); 			
		}
		
		$insert = $this->Mdl_user->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_user->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$gambar = $_FILES['admin_foto']['name'];
		$config['upload_path'] = './uploads/user/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '2000000';
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('admin_foto');

		if(empty($gambar)){
			$data = array(
				'id_user'         => $this->input->post('admin_username'),
				'password' 	     => md5($this->input->post('admin_password')),
				'nama'       		 => $this->input->post('admin_nama'),
				'nomor_hp' => $this->input->post('nomor_hp'),
				'email'       		 => $this->input->post('admin_email'),
				'nama_rek_user'		=> $this->input->post('admin_nm_rek'),
				'no_rek_user'	=> $this->input->post('admin_no_rek'),
				'bank_rek_user'		=> $this->input->post('admin_nm_bank'),
				'admin_level'        	 => $this->input->post('admin_level'),
				'view_password'        	 => $this->input->post('admin_password'),
			);
 		}else{
			$data = array(
				'id_user'         => $this->input->post('admin_username'),
				'password' 	     => md5($this->input->post('admin_password')),
				'nama'       		 => $this->input->post('admin_nama'),
				'nomor_hp' => $this->input->post('nomor_hp'),
				'email'       		 => $this->input->post('admin_email'),
				'nama_rek_user'		=> $this->input->post('admin_nm_rek'),
				'no_rek_user'	=> $this->input->post('admin_no_rek'),
				'bank_rek_user'		=> $this->input->post('admin_nm_bank'),
				'admin_level'        	 => $this->input->post('admin_level'),
				'view_password'        	 => $this->input->post('admin_password'),
				'foto' => $gambar
			); 			
		}
		
		$this->Mdl_user->update(array('id' => $this->input->post('id_admin')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_user->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}	