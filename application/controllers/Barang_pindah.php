<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_pindah extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_brg_pindah');
		$this->load->model('Mdl_bpb');
		$this->load->model('Mdl_barang');
		$this->load->model('Mdl_gudang');
		$this->load->model('Mdl_bpb_new');
		$this->load->model('Mdl_ordere');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/barang_pindah";
        $this->load->view('admin_view',$data);
    }
	
	

	public function ajax_list() {
		// $list = $this->Mdl_article->get_datatables();
		$list = $this->Mdl_brg_pindah->getTable()->result();
		// echo $this->db->last_query();
		$data = array();
		foreach ($list as $l) {
			if (@$l->fd_tgl_barang_pindah!="") {
				$row = array();
				$row['fd_tgl_barang_pindah'] = $l->fd_tgl_barang_pindah;
				$data[] = $row;
			}
		}

		$output = array(
						// "draw" => $_REQUEST['draw'],
						// "recordsTotal" => $this->Mdl_article->count_all(),
						// "recordsFiltered" => $this->Mdl_article->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function JsonBrg_Pindah($id) {
		// $list = $this->Mdl_article->get_datatables();
		$list = $this->Mdl_brg_pindah->get_json_bpb($id);
		//print_r($this->db->last_query());
		$data = array();
		foreach ($list as $l) {
			if (@$l->fc_kdbarang_pindah!="") {
				$row = array();
				$row['fc_kdbarang_pindah'] = $l->fc_kdbarang_pindah;
				$row['fd_tgl_barang_pindah'] = $l->fd_tgl_barang_pindah;
				$row['nmasal'] = $l->nmasal;
				$row['nmtujuan'] = $l->nmtujuan;
				$row['fv_nama_barang'] = $l->fv_nama_barang;
				$row['f_jumlah_barang'] = $l->f_jumlah_barang;
				$data[] = $row;
			}
		}

		// $output = array(
		// 				// "draw" => $_REQUEST['draw'],
		// 				// "recordsTotal" => $this->Mdl_article->count_all(),
		// 				// "recordsFiltered" => $this->Mdl_article->count_filtered(),
		// 				"data" => $data,
		// 		);
		echo json_encode($data);
	}
	
	function getNomor(){
		  $rows = $this->Mdl_brg_pindah->getnomor();
			//print_r($this->db->last_query());
					$y = date('Y');
          foreach ($rows as $row) {
             echo $row['awalan'].str_pad($row['nomor'], 5, "0", STR_PAD_LEFT);
          }
	}
	
	function add(){
		 $rows = $this->Mdl_brg_pindah->getnomor();
			//print_r($this->db->last_query());
					$y = date('Y');
          foreach ($rows as $row) {
             $idne =  $row['awalan'].str_pad($row['nomor'], 5, "0", STR_PAD_LEFT);
          }

		 $data['id']	= $idne;	
		 $data['view_file']    = "moduls/barang_pindah/add_barang_pindah";
        $this->load->view('admin_view',$data);
	}
	
	function save(){
	    $fc_kdbarang_pindah = $this->input->post('fc_kdbarang_pindah');
	    $fd_tgl_barang_pindah = $this->input->post('fd_tgl_barang_pindah');
	    $fc_kdgudang_asal = $this->input->post('fc_kdgudang_asal');
	    $fv_nmgudang = $this->input->post('fv_nmgudang');
	    $fc_kdgudang_tujuan = $this->input->post('fc_kdgudang_tujuan'); 
	    $fv_nmgudang2 = $this->input->post('fv_nmgudang2');
	    $fc_kdbarang = $this->input->post('fc_kdbarang');
	    $f_jumlah_barang = $this->input->post('f_jumlah_barang');
	    $id_user = $this->input->post('id_user');
	    
	    $ambil_barang = $this->Mdl_brg_pindah->get_ambil_lama($fc_kdgudang_asal,$fc_kdbarang);
	    
	    
	    $query3 =  $this->db->query(
	                        '
	                        SELECT COUNT(*) as jml_ada
	                        FROM td_stok_barang_gudang
	                        WHERE fc_kdgudang ="'.$fc_kdgudang_tujuan.'" and fc_kdbarang ="'.$fc_kdbarang.'"  
	                        '
	   )->row();
	   
	   
	   
	    if($query3->jml_ada>0){
	    
	    foreach ($ambil_barang as $value) { 
            $quantity_update = $value['fc_qty_barang'] - $f_jumlah_barang;
            $data_qty = array(
            	'fc_qty_barang' => $quantity_update,
            );
            $update_qty = $this->Mdl_brg_pindah->update_table('td_stok_barang_gudang',$data_qty, array('fc_kdbarang' => $value['fc_kdbarang'] , 'fc_kdgudang' => $fc_kdgudang_asal));
		    print_r($this->db->last_query());
	        
	    }
		
		
		$ambil_barang2 = $this->Mdl_brg_pindah->get_ambil_lama2($fc_kdgudang_tujuan,$fc_kdbarang);
		 foreach ($ambil_barang2 as $value) { 
            $quantity_update2 = $value['fc_qty_barang'] + $f_jumlah_barang;
            $data_qty2 = array(
            	'fc_qty_barang' => $quantity_update2,
            );
            $update_qtye = $this->Mdl_brg_pindah->update_table('td_stok_barang_gudang',$data_qty2, array('fc_kdbarang' => $value['fc_kdbarang'] , 'fc_kdgudang' =>  $fc_kdgudang_tujuan));
		    print_r($this->db->last_query());
		     
		 }
		
	    }else{
	        
	            foreach ($ambil_barang as $value) { 
                    $quantity_update = $value['fc_qty_barang'] - $f_jumlah_barang;
                    $data_qty = array(
                    	'fc_qty_barang' => $quantity_update,
                    );
                    $update_qty = $this->Mdl_brg_pindah->update_table('td_stok_barang_gudang',$data_qty, array('fc_kdbarang' => $value['fc_kdbarang'] , 'fc_kdgudang' => $fc_kdgudang_asal));
        		}
	        
	        	$data = array(
                	'fc_kdbarang' 	=>  $fc_kdbarang,
                	'fc_kdgudang'		=>  $fc_kdgudang_tujuan,
                	'fc_qty_barang'		=> $f_jumlah_barang,
                );	
                					
                $insert_data = $this->Mdl_brg_pindah->insert_table('td_stok_barang_gudang',$data);
	    }
	    
	    
	    $data_brg = array(
                	'fc_kdbarang_pindah' 	=>  $fc_kdbarang_pindah,
                	'fd_tgl_barang_pindah'		=>  $fd_tgl_barang_pindah,
                	'fc_kdgudang_asal'		=> $fc_kdgudang_asal,
                	'fc_kdgudang_tujuan'		=>  $fc_kdgudang_tujuan,
                	'fc_kdbarang'		=> $fc_kdbarang,
                	'f_jumlah_barang'		=> $f_jumlah_barang,
                	'id_user'		=> $id_user,
        );
         $insert_datane = $this->Mdl_brg_pindah->insert_table('t_barang_pindah',$data_brg);
         
         $rows = $this->db->query('select * from t_nomor where kode="BRGP"')->result_array();
		foreach ($rows as $row) {
			$no = $row['nomor'] + 1;
			$aksi = $this->db->update('t_nomor',array('nomor' => $no),array('kode' => 'BRGP'));
		}
	}
}	