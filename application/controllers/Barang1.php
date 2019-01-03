<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_barang');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/Barang/barang";
        $this->load->view('admin_view',$data);
    }

	public function ajax_list() {
		$kdBarang = $this->uri->segment(3);
		$list = $this->Mdl_barang->get_datatables($kdBarang);
		// print_r($this->db->last_query());
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $foto) {
			if(@$foto->fc_id){
				if($foto->fc_img_1==''){ 
					$cover = 'no_image.jpg'; 
				}else{ 
					$cover = $foto->fc_img_1; 
				}
				$row1 = '<img src="'.base_url().'../assets/images/'.$cover.'" style="height: 500px; width: 600px;">';

				if($foto->fc_img_2==''){ 
					$cover = 'no_image.jpg'; 
				}else{
				 $cover = $foto->fc_img_2; 
				}
				$row2 = '<img src="'.base_url().'../assets/images/'.$cover.'" style="height: 500px; width: 600px;">';

				if($foto->fc_img_3==''){ 
					$cover = 'no_image.jpg'; 
				}else{ 
					$cover = $foto->fc_img_3; 
				}
				$row3 = '<img src="'.base_url().'../assets/images/'.$cover.'" style="height: 500px; width: 600px;">';

				if($foto->fc_img_4==''){ 
					$cover = 'no_image.jpg'; 
				}else{ 
					$cover = $foto->fc_img_4; 
				}
				$row4 = '<img src="'.base_url().'../assets/images/'.$cover.'" style="height: 500px; width: 600px;">';

				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $foto->fc_kdbarang;
				$row[] = $foto->fv_nama_barang;
				$row[] = $foto->fv_deskripsi;
				
				$row[] = '
						  
						  <a href="#modal-table'.$foto->fc_id.'" data-toggle="modal" class="tooltip-success" data-rel="tooltip" title="Edit">
							<span class="green">
								<i class="ace-icon fa fa-eye bigger-120"></i>
							</span>
						  </a>
						  <div id="modal-table'.$foto->fc_id.'" class="modal fade" tabindex="-1">
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

										<div id="myCarousel'.$foto->fc_id.'" class="carousel slide" data-ride="carousel">
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel'.$foto->fc_id.'" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel'.$foto->fc_id.'" data-slide-to="1"></li>
	      <li data-target="#myCarousel'.$foto->fc_id.'" data-slide-to="2"></li>
	    </ol>

	    <!-- Wrapper for slides -->
	    <div class="carousel-inner">
	      <div class="item active">
	        '.$row1.'
	      </div>

	      <div class="item">
	       '.$row2.'
	      </div>
	    
	      <div class="item">
	       '.$row3.'
	      </div>

	      <div class="item">
	       '.$row4.'
	      </div>
	    </div>

	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#myCarousel'.$foto->fc_id.'" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#myCarousel'.$foto->fc_id.'" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right"></span>
	      <span class="sr-only">Next</span>
	    </a>
	  </div>

									</div>		
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
							</div>
						  ';
				$row[] = $foto->fd_harga_barang_publish;
				$row[] = $foto->fd_harga_barang_min;

				$row[] = '
				<div class="btn-group">
	                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
	                        <ul class="dropdown-menu" role="menu">
	                            <li><a href="javascript:void(0)" onclick="edit('."'".$foto->fc_id."'".')">Edit</a></li>
	                            <li><a href="javascript:void(0)" onclick="hapus('."'".$foto->fc_id."'".')">Delete</a></li>
	                        </ul>
	            </div>';
				$data[] = $row;
			}
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_barang->count_allid($kdBarang),
						"recordsFiltered" => $this->Mdl_barang->count_filteredid($kdBarang),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	function ajax_add(){
		// $fc_img_1 = explode('.', $_FILES['userfile1']['name']);
		// $fc_img_2 = explode('.', $_FILES['userfile2']['name']);
		// $fc_img_3 = explode('.', $_FILES['userfile3']['name']);
		// $fc_img_4 = explode('.', $_FILES['userfile4']['name']);

		// $nama_file1 = $this->input->post('fc_kdbarang').'1'.$fc_img_1[1];
		// $nama_file2 = $this->input->post('fc_kdbarang').'2'.$fc_img_2[1];
		// $nama_file3 = $this->input->post('fc_kdbarang').'3'.$fc_img_3[1];
		// $nama_file4 = $this->input->post('fc_kdbarang').'4'.$fc_img_4[1];

		
		$fc_img_1 = "";
		$fc_img_2 = "";
		$fc_img_3 = "";
		$fc_img_4 = "";

		$config['upload_path'] = realpath('../assets/images');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		
		$new_name = 'Barang_1'.time();
		$config['file_name'] = $new_name;
			// $config['file_name'] = $nama_file1;	
			$this->load->library('upload', $config);
	 		$this->upload->initialize($config);
			if($this->upload->do_upload('userfile1')){
				$get_name = $this->upload->data();
	   			$nama_foto = $get_name['file_name'];
	 			// $gambar1 = str_replace(' ', '_', $nama_file1);
	 			$fc_img_1 = $nama_foto;
	 		}

	 		//gambar 22222222222222222222222222222
	 	$new_name = 'Barang_2'.time();
		$config['file_name'] = $new_name;
			// $config['file_name'] = $nama_file2;	
			$this->load->library('upload', $config);
	 		$this->upload->initialize($config);
			if($this->upload->do_upload('userfile2')){
				$get_name = $this->upload->data();
	   			$nama_foto = $get_name['file_name'];
	 			// $gambar1 = str_replace(' ', '_', $nama_file1);
	 			$fc_img_2 = $nama_foto;
	 		}

	 		//gambar 3333333333333333333333333333
	 	$new_name = 'Barang_3'.time();
		$config['file_name'] = $new_name;
			// $config['file_name'] = $nama_file3;	
			$this->load->library('upload', $config);
	 		$this->upload->initialize($config);
			if($this->upload->do_upload('userfile3')){
	 			$get_name = $this->upload->data();
	   			$nama_foto = $get_name['file_name'];
	 			// $gambar1 = str_replace(' ', '_', $nama_file1);
	 			$fc_img_3 = $nama_foto;
	 		}

	 	$new_name = 'Barang_4'.time();
		$config['file_name'] = $new_name;
			// $config['file_name'] = $nama_file3;	
			$this->load->library('upload', $config);
	 		$this->upload->initialize($config);
			if($this->upload->do_upload('userfile4')){
	 			$get_name = $this->upload->data();
	   			$nama_foto = $get_name['file_name'];
	 			// $gambar1 = str_replace(' ', '_', $nama_file1);
	 			$fc_img_4 = $nama_foto;
	 		}
 			
			$data = array(
			'fc_kdkategori' 			=> $this->input->post('fc_kdkategori'),
			'fc_kdbarang'				=> $this->input->post('fc_kdbarang'),
			'fv_nama_barang' 			=> $this->input->post('fv_nama_barang'),
			'fv_deskripsi'		 		=> $this->input->post('fv_deskripsi'),
			'fd_harga_barang_publish'	=> $this->input->post('fd_harga_barang_publish'),
			'fd_harga_barang_min' 		=> $this->input->post('fd_harga_barang_min'),
			'fv_jenis_poin' 			=> $this->input->post('fv_jenis_poin'),
			'fc_kdgudang' 				=> $this->input->post('fc_kdgudang'),
			'fv_berat' 					=> $this->input->post('fv_berat'),
			'fv_dimensi' 				=> $this->input->post('fv_dimensi'),
			'fc_status_stok' 			=> $this->input->post('fc_status_stok'),


			'fc_img_1' => $fc_img_1,
			'fc_img_2' => $fc_img_2,
			'fc_img_3' => $fc_img_3,
			'fc_img_4' => $fc_img_4,

			'fc_id' 	=> $this->input->post('fc_id'),
			'fc_user' 	=> $this->session->userdata('fc_user')
			); 			
 		// }	
 
		$this->Mdl_barang->add($data);
		echo json_encode(array('status' => TRUE));

	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_barang->get_by($id);
		echo json_encode($data);
	}
	
	public function update() {
		$fc_kdbarang 				= $this->input->post('fc_kdbarang');
		$fc_kdkategori 				= $this->input->post('fc_kdkategori');
		$fv_nama_barang 			= $this->input->post('fv_nama_barang');
		$fv_deskripsi 				= $this->input->post('fv_deskripsi');
		$fd_harga_barang_publish 	= $this->input->post('fd_harga_barang_publish');
		$fd_harga_barang_min 		= $this->input->post('fd_harga_barang_min');
		$fv_jenis_poin 				= $this->input->post('fv_jenis_poin');
		$fc_kdgudang 				= $this->input->post('fc_kdgudang');
		$fv_berat 					= $this->input->post('fv_berat');
		$fv_dimensi 				= $this->input->post('fv_dimensi');
		$fc_status_stok 			= $this->input->post('fc_status_stok');

		$data = array(
				'fc_kdbarang'				=> $fc_kdbarang,
				'fc_kdkategori' 			=> $fc_kdkategori,
				'fv_nama_barang' 			=> $fv_nama_barang,
				'fv_deskripsi' 				=> $fv_deskripsi,
				'fd_harga_barang_publish' 	=> $fd_harga_barang_publish,
				'fd_harga_barang_min'		=> $fd_harga_barang_min,
				'fv_jenis_poin' 			=> $fv_jenis_poin,
				'fc_kdgudang' 				=> $fc_kdgudang,
				'fv_berat' 					=> $fv_berat,
				'fv_dimensi'	 			=> $fv_dimensi,
				'fc_status_stok' 			=> $fc_status_stok,

				'fc_user' 					=> $this->session->userdata('fc_user')
			);

		$this->Mdl_barang->update(array('fc_id' => $this->input->post('fc_id')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function upload_barang() {
        //if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
		$id_img = $this->input->post('fc_id');
		$oldImage = $this->Mdl_barang->get_by_id($id_img);

		$fc_img_1 = explode('.', $_FILES['file-upload1']['name']);
		$nama_file1 = $this->input->post('fc_kdbarang').'1'.$fc_img_1[1];

		$fc_img_2 = explode('.', $_FILES['file-upload2']['name']);
		$nama_file2 = $this->input->post('fc_kdbarang').'2'.$fc_img_2[1];

		$fc_img_3 = explode('.', $_FILES['file-upload3']['name']);
		$nama_file3 = $this->input->post('fc_kdbarang').'3'.$fc_img_3[1];

		$fc_img_4 = explode('.', $_FILES['file-upload3']['name']);
		$nama_file4 = $this->input->post('fc_kdbarang').'4'.$fc_img_4[1];

		$fc_img_1="";
		$fc_img_2="";
		$fc_img_3="";
		$fc_img_4="";

		$config['upload_path'] = realpath('assets/images');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		
		$new_name = 'Barang_1'.time();
		$config['file_name'] = $new_name;
		// $config['file_name'] = str_replace(' ', '_', $nama_file1);
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
 			
		if($this->upload->do_upload('file-upload1')){	
			$get_name = $this->upload->data();
	   		$nama_foto = $get_name['file_name'];
	 		$fc_img_1 = $nama_foto;
			if($oldImage->fc_img_1!=""){
		unlink('assets/images/'.$oldImage->fc_img_1);
		}
			// $gambar1 = str_replace(' ', '_', $nama_file1);
			$data['fc_img_1'] = $fc_img_1;
		}

		$new_name = 'Barang_2'.time();
		$config['file_name'] = $new_name;
		// $config['file_name'] = str_replace(' ', '_', $nama_file2);
		$this->load->library('upload', $config);
 		$this->upload->initialize($config); 			
		if($this->upload->do_upload('file-upload2')){
			$get_name = $this->upload->data();
	   		$nama_foto = $get_name['file_name'];
	 		$fc_img_2 = $nama_foto;	
			if($oldImage->fc_img_2!=""){
		unlink('assets/images/'.$oldImage->fc_img_2);
		}
			// $gambar2 = str_replace(' ', '_', $nama_file2);
			$data['fc_img_2'] = $fc_img_2;
		}

		$new_name = 'Barang_3'.time();
		$config['file_name'] = $new_name;
		// $config['file_name'] = str_replace(' ', '_', $nama_file3);
		$this->load->library('upload', $config);
 		$this->upload->initialize($config); 			
 		if($this->upload->do_upload('file-upload3')){
 			$get_name = $this->upload->data();
	   		$nama_foto = $get_name['file_name'];
	 		$fc_img_3 = $nama_foto;		
 			if($oldImage->fc_img_3!=""){
		unlink('assets/images/'.$oldImage->fc_img_3);
		}
			// $gambar3 = str_replace(' ', '_', $nama_file3);
			$data['fc_img_3'] = $fc_img_3;
		}

		$new_name = 'Barang_4'.time();
		$config['file_name'] = $new_name;
		// $config['file_name'] = str_replace(' ', '_', $nama_file3);
		$this->load->library('upload', $config);
 		$this->upload->initialize($config); 			
 		if($this->upload->do_upload('file-upload4')){
 			$get_name = $this->upload->data();
	   		$nama_foto = $get_name['file_name'];
	 		$fc_img_3 = $nama_foto;		
 			if($oldImage->fc_img_4!=""){
		unlink('assets/images/'.$oldImage->fc_img_4);
		}
			// $gambar3 = str_replace(' ', '_', $nama_file3);
			$data['fc_img_4'] = $fc_img_4;
		}	

		$data['fc_user'] = $this->session->userdata('fc_user');
						
		$where = array('fc_id'=> $this->input->post('fc_id'));			 
		$this->Mdl_barang->update_data($where,$data,'td_barang');	
		
		echo json_encode(array('status' => TRUE));
    }

   	public function ajax_delete($id) {
      $this->Mdl_barang->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }
    
    function detail_barang($key){
    	$row = $this->Mdl_barang->get_by($key);

    	if (!empty($row)) {
            $data = array(
            	'fc_id' => $row->fc_id,
            	'fc_id' => $row->fc_id,
            );
		$data['view_file']  = "moduls/Barang/barang";
        $this->load->view('admin_view',$data);
        } else {
            $data['view_file']  = "moduls/Barang/barang";
        	$this->load->view('admin_view',$data);
        } 	
    }

}