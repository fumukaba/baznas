<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Zis extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_zis');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
		// $this->load->library("phpqrcode/qrlib");
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

			$id1 = $zis->pengurus_zis;			
            $pengurus = $this->db->query("SELECT * FROM tm_user");
			foreach($pengurus->result() as $row_pengurus)	{	
				$id2 = $row_pengurus->id; 		
				if($id1==$id2){						
						$convert_pengurus=$row_pengurus->nama;
						$data_rekening1=$row_pengurus->nama_rek_user;
						$data_rekening2=$row_pengurus->no_rek_user;
						$data_rekening3=$row_pengurus->bank_rek_user;
					}
				}

				$btn_download = "";

				if($zis->qrcode_zis != '') {
					$btn_download = '<br><a download="' . $zis->nama_zis . '.png" href="'. base_url('uploads/qrcode/' . $zis->qrcode_zis) .'" title="' . $zis->nama_zis . '.png">Download QRCode</a>';
				}


			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $zis->nama_zis . "<br>" . $zis->alamat_zis;
			$row[] = $convert_pengurus;
			$row[] = $data_rekening1 . "<br>" . $data_rekening2 . "<br>" . $data_rekening3;
			$row[] = '<img src="'.base_url('uploads/qrcode/'.$zis->qrcode_zis).'" alt="">' . $btn_download;
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
		include('./application/libraries/phpqrcode/qrlib.php');
		$tempDir = './uploads/qrcode/';

		$id_zis = "t1" . md5(time());
		$codeContents = $id_zis;
    
    	$fileName = $id_zis . '.png';
    	$pngAbsoluteFilePath = $tempDir.$fileName;
    
		if (!file_exists($pngAbsoluteFilePath)) {
			QRcode::png($codeContents, $pngAbsoluteFilePath);
		}
		
		$dibuat_oleh = $this->session->userdata('id');

		$data = array(
			'id_zis' => $id_zis,
			'nama_zis' => $this->input->post('nama_zis'),
			'alamat_zis' => $this->input->post('alamat_zis'),
			'kelurahan_zis' => $this->input->post('kelurahan_zis'),
			'kecamatan_zis' => $this->input->post('kecamatan_zis'),
			'qrcode_zis' => $fileName,
			'pengurus_zis' => $this->input->post('pengurus_zis'),
			'dibuat_oleh' => $dibuat_oleh
		);	
		$insert = $this->Mdl_zis->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => $this->input->post('pengurus_zis')));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_zis->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$dibuat_oleh = $this->session->userdata('id');

		$data = array(
			'nama_zis' => $this->input->post('nama_zis'),
			'alamat_zis' => $this->input->post('alamat_zis'),
			'kelurahan_zis' => $this->input->post('kelurahan_zis'),
			'kecamatan_zis' => $this->input->post('kecamatan_zis'),
			'pengurus_zis' => $this->input->post('pengurus_zis'),
			'dibuat_oleh' => $dibuat_oleh
		);
		$this->Mdl_zis->update(array('id_zis' => $this->input->post('id_zis')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_zis->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}	