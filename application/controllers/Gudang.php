<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Gudang extends CI_Controller {

	

	public function __construct() {

		parent::__construct();

		$this->load->model('Mdl_gudang');

		$this->auth->restrict();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->library("session");

	}

	

	function index(){

       // $this->mdl_home->getsqurity();

        $data['view_file']    = "moduls/gudang";

        $this->load->view('admin_view',$data);

    }

	

	public function ajax_list() {

		$list = $this->Mdl_gudang->get_datatables();

		$data = array();

		$no = $_REQUEST['start'];

		foreach ($list as $slider) {

			// if($slider->fc_slider_gambar==''){ $cover = 'no_image.jpg'; }else{ $cover = $slider->fc_slider_gambar; }

			// $row3 = '<img src="'.base_url().'assets/images/'.$cover.'" style="height: 500px; width: 600px;">';

			$no++;

			$row = array();

			$row[] = '';

			$row[] = $no;

			$row[] = $slider->fv_nmgudang;

			$row[] = $slider->fv_alamat;

			$row[] = '

			<div class="btn-group">

                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>

                        <ul class="dropdown-menu" role="menu">

                            <li><a href="javascript:void(0)" onclick="update('."'".$slider->fc_kdgudang."'".')">Edit</a></li

                            <li class="divider"></li>

                             <li><a href="Gudang/gudang_detail/'.$slider->fc_kdgudang.'">Detail</a></li>

                        </ul>

            </div>';

			$data[] = $row;

		}



		$output = array(

						"draw" => $_REQUEST['draw'],

						"recordsTotal" => $this->Mdl_gudang->count_all(),

						"recordsFiltered" => $this->Mdl_gudang->count_filtered(),

						"data" => $data,

				);

		echo json_encode($output);

	}

	


	

	public function ajax_edit($id) {

		$data = $this->Mdl_gudang->get_by_id($id);

		echo json_encode($data);

	}

	

	public function update() {

		$data = array(

				'fv_nmgudang'           => $this->input->post('fv_nmgudang'),

				'fv_alamat'       => $this->input->post('fv_alamat'),

				'id_user' => $this->session->userdata('id_user')

			);

		$this->Mdl_gudang->update(array('fc_kdgudang' => $this->input->post('fc_kdgudang')), $data);

		echo json_encode(array("status" => TRUE));

    }

	

	public function upload() {





		$config['upload_path'] = realpath('assets/images/');

		$config['allowed_types']        = 'gif|jpg|png';

		$config['max_size'] = '2000000';

        $config['max_width'] = '2024';

        $config['max_height']= '1468';	

		

		// $new_name = 'slider_'.time();

		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);

 		$this->upload->initialize($config);

		// if($this->upload->do_upload('file-upload')){	

		// 	$id_img1 = $this->input->post('fc_kdgudang');

		// 	$oldImage1 = $this->Mdl_gudang->get_by_id($id_img1);

		// 	if ($oldImage1->fc_slider_gambar != "") {

		// 	unlink('assets/images/'.$oldImage1->fc_slider_gambar);

		// 	}

		// 	$get_name = $this->upload->data();

	 //   		$nama_foto = $get_name['file_name'];

	 //   		$gambar1 = $nama_foto;

		// 	$data['fc_slider_gambar'] = $gambar1;

		// }

		$data['id_user'] = $this->session->userdata('id_user');

 		

		$where = array('fc_kdgudang' => $this->input->post('fc_kdgudang'));			 

		$this->Mdl_gudang->update_data($where,$data,'tm_gudang');	

		

		echo json_encode(array('status' => TRUE));

    }

	

	function gudang_detail($key){

    	$this->session->set_userdata('id_gudang',$key);

    	$row = $this->Mdl_gudang->get_by($key);



    	if (!empty($row)) {

            $data = array(

            	'fc_kdgudang' => $row->fc_kdgudang,

				'halaman' => 1

            );

		$data['view_file']  = "moduls/gudang_detail";

        $this->load->view('admin_view',$data);

        } else {

            $data['view_file']  = "moduls/gudang_detail";

        	$this->load->view('admin_view',$data);

        } 	

    }



    public function ajax_listid($id) {

		$kdGudang = $this->uri->segment(3);

		$list = $this->Mdl_gudang->getTableDet($id)->result();

		// print_r($this->db->last_query());

		// print_r($list);

		$data = array();

		// $no = $_REQUEST['start'];

		foreach ($list as $gudang_det) {

			$row = array();

			$row['ceklist'] = '';

			$row['fv_nmgudang'] = $gudang_det->fv_nmgudang;

			$row['fv_nama_barang'] = $gudang_det->fv_nama_barang;

			$row['fc_qty_barang'] = '<form method="POST" action="'.base_url().'Gudang/updateStok/'.$gudang_det->fc_kdstok_gudang.'"><input type="number" name="qty" value="'.$gudang_det->fc_qty_barang.'"><input type="submit" class="btn btn-primary" value="Update Stok" name="update"></form>';

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



	public function updateStok($id) {
		$qty = $this->input->post('qty');


		$data = array(

				'fc_qty_barang' =>  $qty

			);
		$this->Mdl_gudang->updateStok(array('fc_kdstok_gudang' => $id), $data);
		// $this->Mdl_gudang->updateStok($id);

		redirect(base_url().'Gudang/gudang_detail/'.$this->session->userdata('id_gudang'));

	}





}