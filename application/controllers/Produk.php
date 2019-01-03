<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_produk');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/produk";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$kdProduk = $this->uri->segment(3);
		$list = $this->Mdl_produk->get_datatablesid($kdProduk);
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $produk) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $produk->kode_produk;
			$row[] = $produk->nama_produk;
			$row[] = $produk->harga;
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = $produk->deskripsi;
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="'.base_url().'Produk/edit/'.$produk->id_produk.'">Edit</a></li>
             <li><a href="'.base_url().'Produk/delete/'.$produk->id_produk.'/'.$produk->kategori_produk.'">Hapus</a></li>   
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_produk->count_allid($kdProduk),
						"recordsFiltered" => $this->Mdl_produk->count_filteredid($kdProduk),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function add(){

		$data['view_file']    = "moduls/produk/produk_add";
        $this->load->view('admin_view',$data);
	}

	function alerts(){
		echo "<script> alert('Upload Gagal (Ukuran File atau Tipe File Tidak Sesuai)');
		window.history.back();</script>";
	}
	function set_upload_type(){
		$types[0] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		$types[1] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		$types[2] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		$types[3] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		$types[4] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		$types[5] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		$types[6] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		$types[7] = array("0" => "tes",".jpg" => 1,".jpeg" => 1,".png" => 1,
);
		$types[8] = array("0" => "tes",".jpg" => 1,".png" => 1,".jpeg" => 1,
);
		return $types;
	}
	function set_upload_location($idd=""){
			$loc[0] = "../assets/images/";

			$loc[1] = "../assets/images/";

			$loc[2] = "../assets/images/";

			$loc[3] = "../assets/images/";

			$loc[4] = "../assets/images/";

			$loc[5] = "../assets/images/";

			$loc[6] = "../assets/images/";

			$loc[7] = "../assets/images/";

			$loc[8] = "../assets/images/";

		return $loc;
	}
	function set_upload_size(){
		$size[0] = 2000000;

		$size[1] = 2000000;

		$size[2] = 2000000;

		$size[3] = 2000000;

		$size[4] = 2000000;

		$size[5] = 2000000;

		$size[6] = 2000000;

		$size[7] = 2000000;

		$size[8] = 2000000;

		return $size;
	}
	function save() {
	    $i = $this->input->post('kategori_produk');
		if ($this->input->post('mit')) {
				$this->db->order_by('id_produk','DESC');
				$this->db->limit(1);
				$idd=$this->db->get("produk")->row();
				// $swd="";
				// if ($this->input->post('swd')=="SWD 1") {
				// 	$swd="1";
				// }else{
				// 	$swd="2";
				// }
				$files = $this->upload_save($idd->id_produk+1);
			if($files!=NULL){

				$data_foto=explode(".",$files[1]);
				//rename("../data/img/bangunan/".$files[2], "../data/img/bangunan/".$files[1]);
			$data = array(
					'id_produk' => $idd->id_produk+1,
					'kode_produk' => $this->input->post('kode_produk'),
					'kategori_produk' => $this->input->post('kategori_produk'),
					'harga' => $this->input->post('harga'),


					'jumlah_stok' => $this->input->post('jumlah_stok'),
					'nama_produk' => $this->input->post('nama_produk'),


					'foto_produk1' =>  $files[1],

					'foto_produk2' => $files[2],

					'foto_produk3' => $files[3],

					'deskripsi' => $this->input->post('deskripsi'),
					'status' => $this->input->post('status'),
					'id_user' => $this->session->userdata('id_user')

				);
			$this->Mdl_produk->add($data);
			//print_r($this->db->last_query());
			}
			   redirect('produk/'.$i.'/detail','refresh');
		} else{
			   redirect('produk/'.$i.'/detail','refresh');
		}
	}

	function upload_save($idd=""){
		$files = array();
		$ii=1;
		foreach ($_FILES['up_line_patok']['name'] as $key) {
			$files[$ii] = "";
			$ii++;
		}
		$id = $this->Mdl_produk->get_last_ai()->AUTO_INCREMENT;
		$syarat = 0;
		foreach ($_FILES['up_line_patok']['name'] as $arr_file) {
			if($arr_file!=NULL){
				$syarat++;
			}
		}
		if($syarat > 0){
			$types = $this->set_upload_type();
			$size_up = $this->set_upload_size();
			$loc = $this->set_upload_location($idd);
			$syarat = 0;
		    $j=0;
		    $error=0;
		    for($i=0; $i<count($_FILES['up_line_patok']['name']); $i++) {

		        $tmpFilePath = $_FILES['up_line_patok']['tmp_name'][$i];
		        $filename = $_FILES['up_line_patok']['name'][$i];
		        $file_ext = substr($filename, strripos($filename, '.'));
		        $file_ext = strtolower($file_ext);
		        $filesize = $_FILES['up_line_patok']['size'][$i];
				$allowed_file_types = $types[$i];

		        $j = $j + 1;
		        if($tmpFilePath!=""){
			        if($filesize > $size_up[$j-1]){
			        	$error++;
			        }else if($allowed_file_types[0] =="" || !array_key_exists($file_ext, $allowed_file_types)){
			        	$error++;
			        }
		    	}
		    }
		    $j=0;
		    if($error==0){
			    for($i=0; $i<count($_FILES['up_line_patok']['name']); $i++) {

			        $tmpFilePath = $_FILES['up_line_patok']['tmp_name'][$i];
			        $filename = $_FILES['up_line_patok']['name'][$i];
			        $file_basename = substr($filename, 0, strripos($filename, '.'));
			        $file_ext = substr($filename, strripos($filename, '.'));
			        $file_ext = strtolower($file_ext);
			        $j = $j + 1;
			        if($tmpFilePath!=""){
				            $shortname = "Produk-".$id."_"."file". $j.'-'.$file_ext;
				            if(!file_exists($loc[$j-1])){
				            	mkdir($loc[$j-1], 0755, true);
				            }
				            $filePath = $loc[$j-1] . $shortname;
				        if(move_uploaded_file($tmpFilePath, $filePath)) {
				            	chmod($filePath, 0644);
				               $files[$j] = $shortname;
				        }
			    	}
			    }
			}else{
				$this->alerts();
				return NULL;
			//	break;
			}
		}
		return $files;
	}

	function edit($idd="") {
		$data['loc'] = $this->set_upload_location($idd);
		$kd = $this->uri->segment(3);
		if ($kd == NULL) {
			redirect('Produk');
		}
		$dt = $this->Mdl_produk->edit($kd);
		$data['id_produk'] = $dt->id_produk;
		$data['kode_produk'] = $dt->kode_produk;
		$data['nama_produk'] = $dt->nama_produk;
		$data['harga'] = $dt->harga;
		$data['jumlah_stok'] = $dt->jumlah_stok;
		$data['foto_produk1'] = $dt->foto_produk1;
		$data['foto_produk2'] = $dt->foto_produk2;
		$data['foto_produk3'] = $dt->foto_produk3;
		$data['deskripsi'] = $dt->deskripsi;
		$data['status'] = $dt->status;
		$data['id'] = $kd;
		$data['produk']=$dt;
		$data['view_file']    = "moduls/produk/produk_edit";
        $this->load->view('admin_view',$data);
		
	}

	function upload_upd($data_up){
		$files = array();
		$ii=1;
		foreach ($_FILES['up_bg']['name'] as $key) {
			$files[$ii] = "";
			$ii++;
		}
		$id = $this->input->post('id');
		//ambil data gambar, agar tidak replace nama di database
		$data_tbl = $this->Mdl_produk->get_by_id($id);
		foreach ($data_tbl as $row) {$dt[1] = $row->foto_produk1;$dt[2] = $row->foto_produk2;$dt[3] = $row->foto_produk3;
			$xx = 0;
       		foreach ($_FILES['up_bg']['name'] as $key) {
       			$xx++;
       			if($key==""){
       				$files[$xx] = $dt[$xx];
       			}
       		}
		}
		if(count($_FILES['up_bg']['name']) > 0){
		    //Loop through each file
		    $types = $this->set_upload_type();
		    $loc = $this->set_upload_location();
		    $size_up = $this->set_upload_size();
		    $j=0;
		    $error = 0;
		    for($i=0; $i<count($_FILES['up_bg']['name']); $i++) {

		        $tmpFilePath = $_FILES['up_bg']['tmp_name'][$i];
		        $filename = $_FILES['up_bg']["name"][$i];
		        $file_ext = substr($filename, strripos($filename, '.'));
		        $file_ext = strtolower($file_ext);
		        $filesize = $_FILES['up_bg']["size"][$i];
				$allowed_file_types = $types[$i];
		        $j = $j + 1;
		        if($tmpFilePath!=""){
			        if($filesize > $size_up[$j-1]){
			        	$error++;
			        }else if($allowed_file_types[0] =="" || !array_key_exists($file_ext, $allowed_file_types)){
			        	$error++;
			        }
		    	}
		    }
		    $j=0;
		    if($error==0){
		    	for($i=0; $i<count($_FILES['up_bg']['name']);$i++) {

			        $tmpFilePath = $_FILES['up_bg']['tmp_name'][$i];
			        $filename = $_FILES['up_bg']["name"][$i];
			        $file_basename = substr($filename, 0, strripos($filename, '.'));
			        $file_ext = substr($filename, strripos($filename, '.'));
			        $file_ext = strtolower($file_ext);
			        $j = $j + 1;
			        if($tmpFilePath!=""){
				            $shortname = "Produk-".$id."_"."file". $j.'-'.$file_ext;
				        if(!file_exists($loc[$j-1])){
				            	mkdir($loc[$j-1], 0755, true);
				            }
				        $filePath = $loc[$j-1].$shortname;

				 		if(file_exists($loc[$j-1].$data_up[$j-1])){
				        	unlink($loc[$j-1].$data_up[$j-1]);
				        }
				        if(move_uploaded_file($tmpFilePath, $filePath)) {
				            	chmod($filePath, 0644);
				                $files[$j] = $shortname;
				        }
			    	}
			    }
		    }else{
		    	$this->alerts();
				return NULL;
				//break;
		    }

		}
		return $files;
	}

	function update() {
		if ($this->input->post('mit')) {
			$data_up = $this->input->post('edit_bg');
			$files = $this->upload_upd($data_up);
			if($files!=NULL){
			$id = $this->input->post('id');
		$id_new = $this->input->post('id_produk');
		if($id!=$id_new){
			$loc = $this->set_upload_location();
			rename("./".$loc[0].$files[1],"./".$loc[0].str_replace($id,$id_new,$files[1]));
			$files[1] = str_replace($id,$id_new,$files[1]);
			rename("./".$loc[1].$files[2],"./".$loc[1].str_replace($id,$id_new,$files[2]));
			$files[2] = str_replace($id,$id_new,$files[2]);
			rename("./".$loc[2].$files[3],"./".$loc[2].str_replace($id,$id_new,$files[3]));
			$files[3] = str_replace($id,$id_new,$files[3]);
			rename("./".$loc[3].$files[4],"./".$loc[3].str_replace($id,$id_new,$files[4]));
			$files[4] = str_replace($id,$id_new,$files[4]);
		}
		
		$i =  $this->input->post('kategori_produk');
		
		$data = array(

					'id_produk' => $this->input->post('id_produk'),
					'kode_produk' => $this->input->post('kode_produk'),
					'harga' => $this->input->post('harga'),


					'jumlah_stok' => $this->input->post('jumlah_stok'),
					'nama_produk' => $this->input->post('nama_produk'),


					'foto_produk1' =>  $files[1],

					'foto_produk2' => $files[2],

					'foto_produk3' => $files[3],

					'deskripsi' => $this->input->post('deskripsi'),
					
					'status' => $this->input->post('status'),
					
					'id_user' => $this->session->userdata('id_user')
			);
			$this->Mdl_produk->update($id,$data);
			//print_r($this->db->last_query());
			}
			   redirect('produk/'.$i.'/detail','refresh');
		}else{
			redirect('Produk/edit/'.$id,'refresh');
		}
	}

	function delete($confirm) {
		$u = $this->uri->segment(3);
			$i = $this->uri->segment(4);
		if($confirm||$u==0){
		$this->Mdl_produk->delete($u);
		}
	    redirect('produk/'.$i.'/detail','refresh');
	}
}