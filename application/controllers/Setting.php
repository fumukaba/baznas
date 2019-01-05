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
        $data['view_file']    = "moduls/setting";
        $this->load->view('admin_view',$data);
    }
	
	
	public function update() {
        $tahun = $this->input->post('tahun');
        $nominal = $this->input->post('nominal');
        $query = $this->db->query("SELECT * FROM tb_setting WHERE tahun=$tahun AND meta_key='nominal_zakat_fitrah'")->result_array();
        if(count($query)>0){
            $this->db->update('tb_setting', 
            array('tahun'=>$tahun,
                  'meta_key'=>'nominal_zakat_fitrah',
                  'meta_value'=>$nominal
        ), array('meta_key'=>'nominal_zakat_fitrah','tahun'=>$tahun));

        }
        else {
            $this->db->insert('tb_setting', 
            array('id_setting'=>'',
                  'tahun'=>$tahun,
                  'meta_key'=>'nominal_zakat_fitrah',
                  'meta_value'=>$nominal
        ));
        }
		echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit() {
        $tahun = date('Y');
        $query = $this->db->query("SELECT * FROM tb_setting WHERE tahun = $tahun AND meta_key='nominal_zakat_fitrah'")->result_array();
        
        if(count($query) == 0) {
            $data['tahun'] = $tahun;
            $data['meta_value'] = '';
        } else {
            $data['tahun'] = $query[0]['tahun'];
            $data['meta_value'] = $query[0]['meta_value'];
        }
		echo json_encode($data);
	}
	

}	