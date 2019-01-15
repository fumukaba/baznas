<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_zis extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }	
	function index_get() {
        $get_data = "";
        if($this->get('id_zis') != ''){
            $get_data =$this->db->get_where('tb_zis', array('id_zis' => $this->get('id_zis')))->result();
        }else{
            $get_data =$this->db->get('tb_zis')->result();
        }
        
        if ($get_data){
            $this->response(array('status'=>'success','result' =>
                $get_data,"message"=>'Data Zis Berhasil ditampilkan!'));
        }
        else {
            $this->response(array('status'=>'fail',"message"=>'Data Zis gagal ditampilkan!'));
        }
    }

}
