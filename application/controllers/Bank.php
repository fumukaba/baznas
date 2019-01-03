<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_bank');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/bank";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_bank->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $produk) {
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $produk->jenis_bank;
			$row[] = $produk->atas_nama_bank;
			$row[] = $produk->no_rekening;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="javascript:void(0)" onclick="edit('."'".$produk->id_data."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$produk->id_data."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_bank->count_all(),
						"recordsFiltered" => $this->Mdl_bank->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add() {
		$data = array(
				'jenis_bank'         	=> $this->input->post('jenis_bank'),
				'atas_nama_bank'         	=> $this->input->post('atas_nama_bank'),
				'no_rekening'         	=> $this->input->post('no_rekening'),
				);	
		$insert = $this->Mdl_bank->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_bank->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
					'jenis_bank'         	=> $this->input->post('jenis_bank'),
				'atas_nama_bank'         	=> $this->input->post('atas_nama_bank'),
				'no_rekening'         	=> $this->input->post('no_rekening'),
			);
		$this->Mdl_bank->update(array('id_data' => $this->input->post('id_data')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_bank->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}	