<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->model('Auth_model');
	}
		
	public function index() {
		$this->load->view('login');
	}

	function getlogin() {
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$user = $this->auth->log_admin($user,$pass);
		
		//print_r($this->db->last_query());
			if($user==true){
				// $this->session->set_userdata($user);
				$this->session->set_userdata('id_user',$user->id_user);
				$this->session->set_userdata('nama',$user->nama);
				$this->session->set_userdata('email',$user->email);
				// $this->session->set_userdata('level',$user->level);
				// $this->session->set_userdata('status',$user->status);
				$this->session->set_userdata('foto',$user->foto);
				// $this->session->set_userdata('provinsi',$user->provinsi);
				// $this->session->set_userdata('kota',$user->kota);
				// $this->session->set_userdata('id_ongkir',$user->id_ongkir);
				// $this->session->set_userdata('aktif_user',$user->aktif_user);
				$this->session->set_userdata('nama_rek_user',$user->nama_rek_user);
				$this->session->set_userdata('no_rek_user',$user->no_rek_user);
				$this->session->set_userdata('bank_rek_user',$user->bank_rek_user);				
				$this->session->set_userdata('view_password',$user->view_password);
				$this->session->set_userdata('admin_level',$user->admin_level);
				$this->session->set_userdata('id',$user->id);


				$data['hasil']=1;
				echo json_encode($data);	
			}else{
				$data['hasil'] = 0;
				echo json_encode($data);	
			}
		
	}

	function logout(){
		//helper_log("logout", "Logout");
		$this->session->sess_destroy();
		redirect('Login','refresh');
    }
}
