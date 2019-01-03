<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_promo');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/promo";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_promo->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $produk) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $produk->tgl_promo;
			$row[] = $produk->nama_produk;
			$row[] = $produk->harga_promo;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="javascript:void(0)" onclick="edit('."'".$produk->id_promo."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$produk->id_promo."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_promo->count_all(),
						"recordsFiltered" => $this->Mdl_promo->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add() {
		$data = array(
				'tgl_promo'         	=> $this->input->post('tgl_promo'),
				'id_produk'         	=> $this->input->post('id_produk'),
				'harga_promo'         	=> $this->input->post('harga_promo'),
				);	
		$insert = $this->Mdl_promo->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_promo->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'tgl_promo'         	=> $this->input->post('tgl_promo'),
				'id_produk'         	=> $this->input->post('id_produk'),
				'harga_promo'         	=> $this->input->post('harga_promo'),
			);
		$this->Mdl_promo->update(array('id_promo' => $this->input->post('id_promo')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_promo->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}	