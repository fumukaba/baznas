<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	
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
			$row[] = '';
			$row[] = $no;
			$row[] = $produk->fc_kdbarang;
			$row[] = $produk->fv_nama_barang;
			$row[] = $produk->fd_harga_barang_publish;
			$row[] = $produk->fd_harga_barang_min;
			$row[] = $produk->fv_jenis_poin;
			$row[] = $produk->fv_berat;
			$row[] = $produk->fv_dimensi;
			$row[] = $produk->fc_status_stok;
			$row[] = $produk->fv_deskripsi;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="'.base_url().'Barang/edit/'.$produk->fc_id.'">Edit</a></li>
             <li><a href="'.base_url().'Barang/delete/'.$produk->fc_id.'/'.$produk->fc_kdkategori.'">Hapus</a></li>   
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
	    $i = $this->input->post('fc_kdkategori');
		if ($this->input->post('mit')) {
				$this->db->order_by('fc_id','DESC');
				$this->db->limit(1);
				$idd=$this->db->get("td_barang")->row();
				// $swd="";
				// if ($this->input->post('swd')=="SWD 1") {
				// 	$swd="1";
				// }else{
				// 	$swd="2";
				// }
				$files = $this->upload_save(@$idd->fc_id+1);
			if($files!=NULL){

				$data_foto=explode(".",$files[1]);
				//rename("../data/img/bangunan/".$files[2], "../data/img/bangunan/".$files[1]);
			$data = array(
					'fc_kdbarang' => $this->input->post('fc_kdbarang'),
					'fc_kdkategori' => $this->input->post('fc_kdkategori'),
					'fd_harga_barang_publish' => $this->input->post('fd_harga_barang_publish'),


					'fd_harga_barang_min' => $this->input->post('fd_harga_barang_min'),
					'fv_nama_barang' => $this->input->post('fv_nama_barang'),

					'fv_deskripsi' => $this->input->post('fv_deskripsi'),


					'fc_img_1' =>  $files[1],

					'fc_img_2' => $files[2],

					'fc_img_3' => $files[3],

					'fc_img_4' => $files[4],

					'fv_jenis_poin' => $this->input->post('fv_jenis_poin'),
					'fv_berat' => $this->input->post('fv_berat'),
					'fv_dimensi' => $this->input->post('fv_dimensi'),
					'fc_status_stok' => $this->input->post('fc_status_stok'),
					'fc_user' => 'TOKONEO'

				);
			$this->Mdl_produk->add($data);
			$rows = $this->db->query('select * from t_nomor where kode="BRG"')->result_array();
    		foreach ($rows as $row) {
    			$no = $row['nomor'] + 1;
    			$aksi = $this->db->update('t_nomor',array('nomor' => $no),array('kode' => 'BRG'));
    		}
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
			redirect('Kategori_produk');
		}
		$dt = $this->Mdl_produk->edit($kd);
		$data['fc_id'] = $dt->fc_id;
		$data['fc_kdbarang'] = $dt->fc_kdbarang;
		$data['fc_kdkategori'] = $dt->fc_kdkategori;
		$data['fv_nama_barang'] = $dt->fv_nama_barang;
		$data['fv_deskripsi'] = $dt->fv_deskripsi;
		$data['fc_img_1'] = $dt->fc_img_1;
		$data['fc_img_2'] = $dt->fc_img_2;
		$data['fc_img_3'] = $dt->fc_img_3;
		$data['fc_img_4'] = $dt->fc_img_4;
		$data['fd_harga_barang_publish'] = $dt->fd_harga_barang_publish;
		$data['fd_harga_barang_min'] = $dt->fd_harga_barang_min;

		$data['fv_jenis_poin'] = $dt->fv_jenis_poin;
		$data['fv_berat'] = $dt->fv_berat;
		$data['fv_dimensi'] = $dt->fv_dimensi;
		$data['fc_status_stok'] = $dt->fc_status_stok;
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
		foreach ($data_tbl as $row) {$dt[1] = $row->fc_img_1;$dt[2] = $row->fc_img_2;$dt[3] = $row->fc_img_3;$dt[4] = $row->fc_img_4;
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
				        	@unlink($loc[$j-1].$data_up[$j-1]);
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
		
		$i =  $this->input->post('fc_kdkategori');
		
		$data = array(
					
					'fc_kdbarang' => $this->input->post('fc_kdbarang'),
					'fc_kdkategori' => $this->input->post('fc_kdkategori'),
					'fd_harga_barang_publish' => $this->input->post('fd_harga_barang_publish'),


					'fd_harga_barang_min' => $this->input->post('fd_harga_barang_min'),
					'fv_nama_barang' => $this->input->post('fv_nama_barang'),

					'fv_deskripsi' => $this->input->post('fv_deskripsi'),


					'fc_img_1' =>  $files[1],

					'fc_img_2' => $files[2],

					'fc_img_3' => $files[3],

					'fc_img_4' => $files[4],

					'fv_jenis_poin' => $this->input->post('fv_jenis_poin'),
					'fv_berat' => $this->input->post('fv_berat'),
					'fv_dimensi' => $this->input->post('fv_dimensi'),
					'fc_status_stok' => $this->input->post('fc_status_stok'),
					 'fc_user' => 'TOKONEO'
			);
			$this->Mdl_produk->update($id,$data);
			//print_r($this->db->last_query());
			}
			  redirect('produk/'.$i.'/detail','refresh');
		}else{
			  redirect('Barang/edit/'.$id,'refresh');
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

	function getNomor(){
		  $rows = $this->Mdl_produk->getnomor();
			//print_r($this->db->last_query());
					$y = date('Y');
          foreach ($rows as $row) {
             echo $row['awalan'].str_pad($row['nomor'], 5, "0", STR_PAD_LEFT);
          }
	}

	function updateNomor(){
		$rows = $this->db->query('select * from t_nomor where kode="BRG"')->result_array();
		foreach ($rows as $row) {
			$no = $row['nomor'] + 1;
			$aksi = $this->db->update('t_nomor',array('nomor' => $no),array('kode' => 'BRG'));
		}
	}
	
}	