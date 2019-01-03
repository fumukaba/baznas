<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Voucher extends CI_Controller {

	

	public function __construct() {

		parent::__construct();

		$this->load->model('Mdl_voucher');

		$this->load->model('Mdl_barang');

		$this->auth->restrict();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->library("session");

	}

	

	function index(){

       // $this->mdl_home->getsqurity();

       	$data['barang'] = $this->Mdl_barang->get_all();

        $data['view_file']    = "moduls/voucher";

        $this->load->view('admin_view',$data);

    }

	

	public function ajax_list() {

		$list = $this->Mdl_voucher->get_datatables();

		// echo $this->db->last_query();

		$data = array();

		$no = $_REQUEST['start'];

		foreach ($list as $poin) {

			if (@$poin->fc_id_voucher) {

				$no++;

				$row = array();
				$row[] = '';
				$row[] = $no;

				$row[] = $poin->fv_nama_barang;

				$row[] = $poin->fm_nominal;

				$row[] = $poin->fd_tgl_exp_voucher;

				$row[] = $poin->f_kode_voucher;

				$row[] = $poin->fd_tgl_terbit_voucher;

				if($poin->fc_status == 0){

					$row[] = 'Belum dipakai';

				}

				else if($poin->fc_status == 1) {

					$row[] = 'Sudah dipakai';

				}

				$row[] = '

				<div class="btn-group">

	                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>

	                        <ul class="dropdown-menu" role="menu">
	                        	<li><a href="javascript:void(0)" onclick="update('."'".$poin->fc_id_voucher."'".')">Edit</a></li>
								<li><a href="Voucher/ajax_delete/'.$poin->fc_id_voucher.'">Hapus</a></li>

	                        </ul>

	            </div>';

				$data[] = $row;

			}

		}



		$output = array(

						"draw" => $_REQUEST['draw'],

						"recordsTotal" => $this->Mdl_voucher->count_all(),

						"recordsFiltered" => $this->Mdl_voucher->count_filtered(),

						"data" => $data,

				);

		echo json_encode($output);

	}

	

	// function voucher_detail($key){

 //    	$row = $this->Mdl_voucher->get_by($key);



 //    	if (!empty($row)) {

 //            $data = array(

 //            	'id_user' => $row->id_user_dapat,

	// 			'kode_cairpoin' => $row->kode_cairpoin,

	// 			'halaman' => 1

 //            );

	// 	$data['view_file']  = "moduls/pencairanpoin/pencairanpoin_detail";

 //        $this->load->view('admin_view',$data);

 //        } else {

 //            $data['view_file']  = "moduls/pencairanpoin/pencairanpoin_detail";

 //        	$this->load->view('admin_view',$data);

 //        } 	

 //    }

	

	public function ajax_add() {
	    
	    $rows = $this->Mdl_voucher->getnomor();
		
					$y = date('Y');
        foreach ($rows as $row) {
            $kode_voucher = $row['awalan'].str_pad($row['nomor'], 5, "0", STR_PAD_LEFT);
        }

		$barang = $this->input->post('barang');

		$id_user = $this->session->userdata('id_user');

		$nominal = $this->input->post('nominal');

		$expired = $this->input->post('expired');

		$terbit = date('Y-m-d');

		//$gambar = str_replace(' ', '_', $nama_file);



 			$data = array(

			'fc_kdbarang' => $barang,

			'id_user' => $id_user,

			'fm_nominal' => $nominal,

			'fd_tgl_exp_voucher' => $expired,

			'f_kode_voucher' => $kode_voucher,

			'fd_tgl_terbit_voucher' => $terbit,

			'fc_status' => '0'

			);



		$this->Mdl_voucher->add($data);
		
		$rows = $this->db->query('select * from t_nomor where kode="NEO"')->result_array();
		foreach ($rows as $row) {
			$no = $row['nomor'] + 1;
			$aksi = $this->db->update('t_nomor',array('nomor' => $no),array('kode' => 'NEO'));
		}

		echo json_encode(array('status' => TRUE));

	}

	

	public function ajax_edit($id) {

		$data = $this->Mdl_voucher->get_by_id($id);

		//print_r($this->db->last_query());

		echo json_encode($data);

	}

	

	// public function update_kategori() {

	// 	$data = array(

	// 			'produk_utama'         	=> $this->input->post('produk_utama'),

	// 			'produk_title_meta'     => $this->input->post('produk_title_meta'),

	// 			'produk_deskripsi_meta' => $this->input->post('produk_deskripsi_meta'),

	// 			'produk_keyword_meta'   => $this->input->post('produk_keyword_meta'),

	// 			'id_admin' => $this->session->userdata('id_admin')

	// 		);

	// 	$this->Mdl_voucher->update(array('id_produk' => $this->input->post('id_produk')), $data);

	// 	echo json_encode(array("status" => TRUE));

 //    }

	

	public function ajax_delete($id) {

      $this->Mdl_voucher->delete_by_id($id);

      // echo json_encode(array("status" => TRUE));

      redirect(base_url().'Voucher');

    }

	

	// public function create_load(){

	// 	$this->load->view('moduls/load_produk');

	// }

	

	function detail(){

       // $this->mdl_home->getsqurity();

	    $data['produk']       = $this->Mdl_voucher->get_produk();

        $data['view_file']    = "moduls/produk_det";

        $this->load->view('admin_view',$data);

    }

	

	public function ajax_listid() {

		$kdProduk = $this->uri->segment(3);

		$list = $this->Mdl_voucher->getTableDet($kdProduk)->result();

		// print_r($this->db->last_query());

		// print_r($list);

		$data = array();

		// $no = $_REQUEST['start'];

		foreach ($list as $produk_det) {

			$row = array();

            if ($produk_det->status_ambil == "0") {

                $datav = '<span class="label label-info">Belum di Proses</span>';

                $ceklist = '<input type="checkbox" name="id[]" value="'.$produk_det->kode_cairpoin.'"> ';

            } else if ($produk_det->status_ambil == "1") {

                $datav = '<span class="label label-success">disetujui</span>';

                $ceklist = '<input type="checkbox" name="id[]" value="'.$produk_det->kode_cairpoin.'" disabled>';

            }

            $row['ceklist'] = $ceklist;

			$row['fc_kdorder'] = $produk_det->fc_kdorder;

			$row['fd_tgl_order'] = $produk_det->fd_tgl_order;

			$row['fm_harga'] = $produk_det->fm_harga;

			$row['total_poin'] = $produk_det->total_poin;

			$data[] = $row;

		}



		$output = array(

						// "draw" => $_REQUEST['draw'],

						// "recordsTotal" => $this->Mdl_voucher->count_allid($kdProduk),

						// "recordsFiltered" => $this->Mdl_voucher->count_filteredid($kdProduk),

						"data" => $data,

				);

		echo json_encode($output);

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

		$this->Mdl_voucher->update_produk(array('id_detail' => $this->input->post('id_detail')), $data);

		echo json_encode(array("status" => TRUE));

    }

	public function ajax_edit_status($id) {

        $data = $this->Mdl_voucher->get_by_id($id);

     //  print_r($this->db->last_query());

        echo json_encode($data);

    }

    public function ajax_update_status() {

        $data = array(

                'fc_status'              => $this->input->post('fc_status'),

            );

            

      

        $this->Mdl_voucher->update_status($this->input->post('fc_id_voucher'), $data);

        

        

        //print_r($this->db->last_query());

        echo json_encode(array("status" => TRUE));

    }

}