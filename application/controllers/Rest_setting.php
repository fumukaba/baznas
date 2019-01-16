<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_setting extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

   // show data setting
    function setting_get(){
        $get_setting = $this->db->query("
            SELECT
                id_setting,
                tahun,
                meta_key,
                meta_value
            FROM tb_setting")->result();
       $this->response(
           array(
               "status" => "success",
               "result" => $get_setting
           )
       );
    }

}
