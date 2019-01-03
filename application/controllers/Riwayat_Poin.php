<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Riwayat_Poin extends CI_Controller {

    public function __Construct() {

	  parent::__construct();

	  $this->load->model('Mdl_Riwayat');

	  $this->auth->restrict();

	 }





	public function index()

	{

           

         $data['view_file']    = "moduls/pencairanpoin/riwayat_poin";

        $this->load->view('admin_view',$data);

	}

	 function create_load(){

          $this->load->view('moduls/pencairanpoin/tampil_riwayat_poin');

    }

    public function ajax_listid() {

        $kdPos = $this->uri->segment(3);

        $list = $this->Mdl_Riwayat->get_datatablesid($kdPos);

        //print_r($this->db->last_query());

        $data = array();

        $no = $_REQUEST['start'];

        foreach ($list as $foto) {

            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $foto->fc_user;

            $row[] = $foto->fc_poin;

            $row[] = $foto->fm_nominal;

            $data[] = $row;

        }



        $output = array(

                        "draw" => $_REQUEST['draw'],

                        "recordsTotal" => $this->Mdl_Riwayat->count_allid($kdPos),

                        "recordsFiltered" => $this->Mdl_Riwayat->count_filteredid($kdPos),

                        "data" => $data,

                );

        echo json_encode($output);

    }
}	