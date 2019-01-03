<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zis extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_zis');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/zis";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_zis->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $zis) {
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $zis->nama_zis;
			$row[] = $zis->alamat_zis;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="javascript:void(0)" onclick="edit('."'".$zis->id_zis."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$zis->id_zis."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_zis->count_all(),
						"recordsFiltered" => $this->Mdl_zis->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add() {
		$data = array(
                'id_zis' => md5(time()),
				'nama_zis' => $this->input->post('nama_zis'),
				'alamat_zis' => $this->input->post('alamat_zis'),
                'kelurahan_zis' => $this->input->post('kelurahan_zis'),
                'kecamatan_zis' => $this->input->post('kecamatan_zis')
				);	
		$insert = $this->Mdl_zis->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_zis->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
					'jenis_bank'         	=> $this->input->post('jenis_bank'),
				'atas_nama_bank'         	=> $this->input->post('atas_nama_bank'),
				'no_rekening'         	=> $this->input->post('no_rekening'),
			);
		$this->Mdl_zis->update(array('id_data' => $this->input->post('id_data')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_zis->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}	