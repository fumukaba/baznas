<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_setup');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/setup";
        $this->load->view('admin_view',$data);
    }
    
    public function ajax_edit() {
		$data = $this->Mdl_setup->get_by_id();
		//print_r($this->db->last_query());
		echo json_encode($data);
	}
	
	public function update_link() {
	
	    $data1 = array('fc_isi' => $this->input->post('sekilas'));
		$this->Mdl_setup->update_link($data1,array('fc_param' => 'SEKILAS'));
		print_r($this->db->last_query());
	}

	public function update_banner(){
		$data1 = array('fc_isi' => $this->input->post('banner_1'));
		$this->Mdl_setup->update_banner($data1,array('fc_param' => 'GAMBAR 1', 'fc_kode'=>'2'));
		$data2 = array('fc_isi' => $this->input->post('banner_2'));
		$this->Mdl_setup->update_banner($data2,array('fc_param' => 'GAMBAR 2', 'fc_kode'=>'2'));
		$data3 = array('fc_isi' => $this->input->post('banner_3'));
		$this->Mdl_setup->update_banner($data3,array('fc_param' => 'GAMBAR 3', 'fc_kode'=>'2'));
	}
	
	public function upload(){
		$gambar = $_FILES['file-upload']['name'];
		$config['upload_path'] = realpath('../assets/images/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');	
			
		$data = array('fc_isi' => str_replace(' ', '_', $gambar) );
	
			$this->Mdl_setup->update_data($data,array('fc_param' => 'GAMBAR 1','fc_kode' => '1'));
		
		
		//print_r($this->db->last_query());
	}	

	public function upload2(){
		$gambar = $_FILES['file-upload2']['name'];
		$config['upload_path'] = realpath('../assets/images/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload2');	
			
		$data = array('fc_isi' => str_replace(' ', '_', $gambar) );
	
			$this->Mdl_setup->update_data2($data,array('fc_param' => 'GAMBAR 2','fc_kode' => '1'));
		
		
		//print_r($this->db->last_query());
	}		

	public function upload3(){
		$gambar = $_FILES['file-upload3']['name'];
		$config['upload_path'] = realpath('../assets/images/');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload3');	
			
		$data = array('fc_isi' => str_replace(' ', '_', $gambar) );
	
			$this->Mdl_setup->update_data3($data,array('fc_param' => 'GAMBAR 3','fc_kode' => '1'));
		
		
		//print_r($this->db->last_query());
	}		
}    