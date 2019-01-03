<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_barang extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_kat_barang');
		$this->load->model('Mdl_barang');	
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/Barang/kategori_barang";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_kat_barang->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $produk) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $produk->fv_nama_kategori;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="javascript:void(0)" onclick="edit('."'".$produk->fc_id."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$produk->fc_id."'".')">Delete</a></li>
							<li class="divider"></li>
							<li><a href="barang/'.$produk->fc_id.'/detail">Detail</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_kat_barang->count_all(),
						"recordsFiltered" => $this->Mdl_kat_barang->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add() {
		$data = array(
				'fv_nama_kategori'         	=> $this->input->post('fv_nama_kategori'),
				'id_user' => $this->session->userdata('id_user')
				);	
		$insert = $this->Mdl_kat_barang->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_kat_barang->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'fv_nama_kategori'         	=> $this->input->post('fv_nama_kategori'),
				'id_user' => $this->session->userdata('id_user')
			);
		$this->Mdl_kat_barang->update(array('fc_id' => $this->input->post('fc_id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_kat_barang->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

    function barang_detail($key){
    	$row = $this->Mdl_barang->get_by($key);

    	if (!empty($row)) {
          
		$data['view_file']  = "moduls/Barang/barang";
        $this->load->view('admin_view',$data);
        } else {
            $data['view_file']  = "moduls/Barang/barang";
        	$this->load->view('admin_view',$data);
        } 	
    }
}	