<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencairanpoin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_pencairanpoin');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/pencairanpoin/pencairanpoin";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_pencairanpoin->get_datatables();
		// echo $this->db->last_query();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $poin) {
			if (@$poin->id_user) {
				$no++;
				$row = array();
				$row[] = '';
				$row[] = $no;
				$row[] = $poin->id_user;
				$row[] = $poin->nama;
				$row[] = $poin->sisa_poin;
				$row[] = '
				<div class="btn-group">
	                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
	                        <ul class="dropdown-menu" role="menu">
								<li><a href="Pencairanpoin/'.$poin->id_user.'/detail">Detail</a></li>
	                        </ul>
	            </div>';
				$data[] = $row;
			}
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_pencairanpoin->count_all(),
						"recordsFiltered" => $this->Mdl_pencairanpoin->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	function pencairanpoin_detail($key){
    	$row = $this->Mdl_pencairanpoin->get_by($key);

    	if (!empty($row)) {
            $data = array(
            	'id_user' => $row->id_user_dapat,
				'kode_cairpoin' => $row->kode_cairpoin,
				'halaman' => 1
            );
		$data['view_file']  = "moduls/pencairanpoin/pencairanpoin_detail";
        $this->load->view('admin_view',$data);
        } else {
            $data['view_file']  = "moduls/pencairanpoin/pencairanpoin_detail";
        	$this->load->view('admin_view',$data);
        } 	
    }
	
	public function ajax_add() {
		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('produk_utama').'.'.$olah[1];
		
		$gambar = str_replace(' ', '_', $nama_file);

		$judul = $this->input->post('produk_utama');
		$title_meta = $this->input->post('produk_title_meta');
		$deskripsi_meta = $this->input->post('produk_deskripsi_meta');
		$keyword_meta = $this->input->post('produk_keyword_meta');
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('assets/images');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $nama_file;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('userfile');

		if(empty($gambar)){
 			$data = array(
			'produk_utama' => $judul,
			'produk_title_meta' => $title_meta,
			'produk_deskripsi_meta' => $deskripsi_meta,
			'produk_keyword_meta' => $keyword_meta,
			'id_admin' => $this->session->userdata('id_admin')
			);
 		}else{
 			//unlink('../assets/galeri/'.$this->input->post('terserah'));
 			
			$data = array(
			'produk_utama' => $judul,
			'produk_title_meta' => $title_meta,
			'produk_deskripsi_meta' => $deskripsi_meta,
			'produk_keyword_meta' => $keyword_meta,
			'produk_gambar' => $gambar,
			'id_admin' => $this->session->userdata('id_admin')
			); 			
 		}	
 		

		$this->Mdl_pencairanpoin->add($data);
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_pencairanpoin->get_by_id($id);
		//print_r($this->db->last_query());
		echo json_encode($data);
	}
	
	public function update_kategori() {
		$data = array(
				'produk_utama'         	=> $this->input->post('produk_utama'),
				'produk_title_meta'     => $this->input->post('produk_title_meta'),
				'produk_deskripsi_meta' => $this->input->post('produk_deskripsi_meta'),
				'produk_keyword_meta'   => $this->input->post('produk_keyword_meta'),
				
			);
		$this->Mdl_pencairanpoin->update(array('id_produk' => $this->input->post('id_produk')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_pencairanpoin->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }
	
	public function create_load(){
		$this->load->view('moduls/load_produk');
	}
	
	function detail(){
       // $this->mdl_home->getsqurity();
	    $data['produk']       = $this->Mdl_pencairanpoin->get_produk();
        $data['view_file']    = "moduls/produk_det";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_listid() {
		$kdProduk = $this->uri->segment(3);
		$list = $this->Mdl_pencairanpoin->getTableDet($kdProduk)->result();
		// print_r($this->db->last_query());
		// print_r($list);
		$data = array();
		// $no = $_REQUEST['start'];
		foreach ($list as $produk_det) {
			$row = array();
            if ($produk_det->status_ambil == "0") {
                $datav = '<span class="label label-info">Belum diambil</span>';
                $ceklist = '<input type="checkbox" name="id[]" id="ck[]" value="'.$produk_det->kode_cairpoin.'" style="margin-left:8px"> ';
            } else if ($produk_det->status_ambil == "1") {
                $datav = '<span class="label label-success">Sudah diambil</span>';
                $ceklist = '<input type="checkbox" name="id[]" id="ck[]" value="'.$produk_det->kode_cairpoin.'" disabled>';
            }
            $nominal = '<input type="number" name="nominal" step="5000" >';
            $row['kosong'] = '';
            $row['ceklist'] = $ceklist;
			$row['fc_kdorder'] = $produk_det->fc_kdorder;
			$row['fd_tgl_order'] = $produk_det->fd_tgl_order;
			$row['fm_harga'] = $produk_det->fm_harga;
			$row['total_poin'] = $produk_det->total_poin;
			$row['stt'] = $datav;
			$row['nominal_poin'] = $nominal;
			$data[] = $row;
		}

		$output = array(
						// "draw" => $_REQUEST['draw'],
						// "recordsTotal" => $this->Mdl_pencairanpoin->count_allid($kdProduk),
						// "recordsFiltered" => $this->Mdl_pencairanpoin->count_filteredid($kdProduk),
						"data" => $data,
				);
		echo json_encode($output);
	}
	public function tukar()
	{
		$pencairan_poin = $this->input->post('id');
		$nominal_poin = $this->input->post('nominal');
        // $valid = $this->input->post('valid');
		$total_poin=0;
		$total_nominal=0;
        $ubah = array('status_ambil' => 1,
        			'tgl_ambil'=>date('Y-m-d'),
        			'id_user_pencair'=>$this->session->userdata('id_user') );



        foreach ($pencairan_poin as $idp) {
            $id = array('kode_cairpoin' => $idp );
			//echo $idp.'<br>';
            $this->Mdl_pencairanpoin->update_cairpoin($id,$ubah);
            $jum = $this->Mdl_pencairanpoin->getJumpoin($id)->row();
            $total_poin+=$jum->total_poin;
            $user = $jum->id_user_dapat;
            $poin = $jum->total_poin;
            $total_nominal +=  $nominal_poin;
            $data = array(
					'fc_user' => $user,
					'fm_nominal' => $nominal_poin,
					'fc_poin' => $poin,

				);
			$this->Mdl_pencairanpoin->addriwayat($data);
			//print_r($this->db->last_query());
        }
		$this->session->set_flashdata('berhasil','Berhasil menukar poin dari '.$this->input->post('id_user').' sebanyak '.$total_poin.' Poin, dengan nominal sebesar'.$total_nominal);
        redirect('Pencairanpoin');
	}
	
	public function ajax_addproduk() {
		$olah = explode('.', $_FILES['userfile']['name']);
		$nama_file = $this->input->post('detail_judul').'.'.$olah[1];
		
		$gambar = str_replace(' ', '_', $nama_file);

		$id_produk = $this->input->post('id_produk');
		$judul = $this->input->post('detail_judul');
		$deskripsi = $this->input->post('detail_deskripsi');
		$title_meta = $this->input->post('detail_title_meta');
		$deskripsi_meta = $this->input->post('detail_deskripsi_meta');
		$keyword_meta = $this->input->post('detail_keyword_meta');
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('assets/images');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $nama_file;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('userfile');

		if(empty($gambar)){
 			$data = array(
			'id_produk' => $id_produk,
			'detail_judul' => $judul,
			'detail_deskripsi' => $deskripsi,
			'detail_title_meta' => $title_meta,
			'detail_deskripsi_meta' => $deskripsi_meta,
			'detail_keyword_meta' => $keyword_meta,
			'id_admin' => $this->session->userdata('id_admin')
			);
 		}else{
 			//unlink('../assets/galeri/'.$this->input->post('terserah'));
 			
			$data = array(
			'id_produk' => $id_produk,
			'detail_judul' => $judul,
			'detail_deskripsi' => $deskripsi,
			'detail_title_meta' => $title_meta,
			'detail_deskripsi_meta' => $deskripsi_meta,
			'detail_keyword_meta' => $keyword_meta,
			'detail_gambar' => $gambar,
			'id_admin' => $this->session->userdata('id_admin')
			); 			
 		}	
 		

		$this->Mdl_pencairanpoin->addproduk($data);
		
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_editproduk($id) {
		$data = $this->Mdl_pencairanpoin->get_by_prod($id);
		//print_r($this->db->last_query());
		echo json_encode($data);
	}
	
	public function update() {
		
		$judul = $this->input->post('detail_judul');
		$deskripsi = $this->input->post('detail_deskripsi');
		$title_meta = $this->input->post('detail_title_meta');
		$deskripsi_meta = $this->input->post('detail_deskripsi_meta');
		$keyword_meta = $this->input->post('detail_keyword_meta');
		
		$data = array(
				'detail_judul' => $judul,
				'detail_deskripsi' => $deskripsi,
				'detail_title_meta' => $title_meta,
				'detail_deskripsi_meta' => $deskripsi_meta,
				'detail_keyword_meta' => $keyword_meta,
				'id_admin' => $this->session->userdata('id_admin')
			);
		$this->Mdl_pencairanpoin->update_produk(array('id_detail' => $this->input->post('id_detail')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function upload() {
        //if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
		$gambar = $_FILES['file-upload']['name'];
		//$nama_file = $this->input->post('slider_judul').'.'.$olah[1];

		$nama = $this->input->post('slider_judul');
		$deskripsi = $this->input->post('slider_deskripsi');
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('assets/images');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');
 			
			$data = array(
			'detail_gambar' => $gambar,
			'id_admin' => $this->session->userdata('id_admin')
			); 			
 		
 		

		$where = array('id_detail' => $this->input->post('id_detail'));			 
		$this->Mdl_pencairanpoin->update_data($where,$data,'tb_produk');	
		
		echo json_encode(array('status' => TRUE));
    }
	
	public function upload_kat() {
        //if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}
		$gambar = $_FILES['file-upload']['name'];
		//$nama_file = $this->input->post('slider_judul').'.'.$olah[1];

		$nama = $this->input->post('slider_judul');
		$deskripsi = $this->input->post('slider_deskripsi');
		//$gambar = str_replace(' ', '_', $nama_file);

		$config['upload_path'] = realpath('assets/images');
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size'] = '2000000';
        $config['max_width'] = '2024';
        $config['max_height']= '1468';
		$config['file_name'] = $gambar;	
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
		$this->upload->do_upload('file-upload');
 			
			$data = array(
			'produk_gambar' => $gambar,
			'id_admin' => $this->session->userdata('id_admin')
			); 			
 		
 		

		$where = array('id_produk' => $this->input->post('id_produk'));			 
		$this->Mdl_pencairanpoin->update_kat($where,$data,'tb_kategori_produk');	
		
		echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_delproduk($id) {
      $this->Mdl_pencairanpoin->delete_by($id);
      echo json_encode(array("status" => TRUE));
    }
}