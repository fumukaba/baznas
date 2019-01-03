<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_video');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/video";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_video->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $user) {
			$row2 = $user->frame_video;
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->video_judul;
			$row[] = $user->video_deskripsi;
			$row[] = '
					  <a href="#modal-table'.$user->id_video.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
						<span class="green">
							<i class="ace-icon fa fa-eye bigger-120"></i>
						</span>
					  </a>
					  <div id="modal-table'.$user->id_video.'" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header no-padding">
									<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Gambar
									</div>
								</div>

								<div class="modal-body no-padding">
								<div align="center">
									'.$row2.'
								</div>		
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
						</div>	
					 ';
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$user->id_video."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$user->id_video."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_video->count_all(),
						"recordsFiltered" => $this->Mdl_video->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {
		$data = array(
				'video_judul'         => $this->input->post('video_judul'),
				'video_deskripsi' 	     => $this->input->post('video_deskripsi'),
				'frame_video'       		 => $this->input->post('frame_video'),
				'video_title_meta'        	 => $this->input->post('video_title_meta'),
				'video_keyword_meta'       		 => $this->input->post('video_keyword_meta'),
				'video_deskripsi_meta'        	 => $this->input->post('video_deskripsi_meta'),
			);
		$insert = $this->Mdl_video->add($data);
		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_video->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$data = array(
				'video_judul'         => $this->input->post('video_judul'),
				'video_deskripsi' 	     => $this->input->post('video_deskripsi'),
				'frame_video'       		 => $this->input->post('frame_video'),
				'video_title_meta'        	 => $this->input->post('video_title_meta'),
				'video_keyword_meta'       		 => $this->input->post('video_keyword_meta'),
				'video_deskripsi_meta'        	 => $this->input->post('video_deskripsi_meta'),
			);
		$this->Mdl_video->update(array('id_video' => $this->input->post('id_video')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_video->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }
}	