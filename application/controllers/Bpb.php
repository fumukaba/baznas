<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpb extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_bpb');
		$this->load->model('Mdl_barang');
		$this->load->model('Mdl_gudang');
		$this->load->model('Mdl_gudang_tjn');
		$this->load->model('Mdl_bpb_new');
		$this->load->model('Mdl_ordere');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}

	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/bpb";
        $this->load->view('admin_view',$data);
    }
	
	

	public function ajax_list() {
		// $list = $this->Mdl_article->get_datatables();
		$list = $this->Mdl_bpb->getTable()->result();
		// echo $this->db->last_query();
		$data = array();
		foreach ($list as $l) {
			if (@$l->fc_nobpb!="") {
				$row = array();
				$row['fd_tglbpb'] = $l->fd_tglbpb;
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

	// function JsonBpb($id){
	// 	echo json_encode($this->Mdl_bpb->get_json_bpb($id));
	// }

	public function JsonBpb($id) {
		// $list = $this->Mdl_article->get_datatables();
		$list = $this->Mdl_bpb->get_json_bpb($id);
		//print_r($this->db->last_query());
		$data = array();
		foreach ($list as $l) {
			if (@$l->fc_nobpb!="") {
				$row = array();
				$row['fc_nobpb'] = $l->fc_nobpb;
				$row['fc_kdbarang'] = $l->fv_nama_barang;
				$row['fn_qtyterima'] = $l->fn_qtyterima;
				$row['fm_harsat'] = $l->fm_harsat;
				$row['fm_subtot'] = $l->fm_subtot;
				$row['aksi'] = '
				<div class="btn-group">
	                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
	                        <ul class="dropdown-menu" role="menu">
	                            <li><a href="'.base_url().'Bpb/Hapus_bpb/'.$l->fc_nobpb.'/'.$l->fc_kdbarang.'/'.$l->fc_kdgudang.'" >Hapus</a></li>
	                            
	                        </ul>
	            </div>';
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
		  $rows = $this->Mdl_bpb->getnomor();
			//print_r($this->db->last_query());
					$y = date('Y');
          foreach ($rows as $row) {
             echo $row['awalan'].str_pad($row['nomor'], 5, "0", STR_PAD_LEFT);
          }
	}

	function updateNomor(){
		$rows = $this->db->query('select * from t_nomor where kode="BPB"')->result_array();
		foreach ($rows as $row) {
			$no = $row['nomor'] + 1;
			$aksi = $this->db->update('t_nomor',array('nomor' => $no),array('kode' => 'BPB'));
		}
	}

	public function ajax_list_bar() {
		$list = $this->Mdl_barang->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $pesanan) {
			$no++;
			$row = array();
			$row[] = "";
			$row[] = $pesanan->fv_nama_barang;
			$row[] = '<button type="button" class="label label-info" onclick="pilihDatastok(\''.$pesanan->fc_kdbarang.'\',\''.$pesanan->fv_nama_barang.'\')">Ambil Data</button>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_barang->count_allid(),
						"recordsFiltered" => $this->Mdl_barang->count_filteredid(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	function ajax_list_gdg(){
		$list = $this->Mdl_gudang->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $pesanan) {
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $pesanan->fv_nmgudang;
			$row[] = '<button type="button" class="label label-info" onclick="pilihDatagudang('.$pesanan->fc_kdgudang.',\''.$pesanan->fv_nmgudang.'\')">Ambil Data</button>';
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
	
	function ajax_list_gdg_tjn(){
		$list = $this->Mdl_gudang_tjn->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $pesanan) {
			$no++;
			$row = array();
			$row[] ='';
			$row[] = $pesanan->fc_kdgudang;
			$row[] = $pesanan->fv_nmgudang;
			$row[] = '<button type="button" class="label label-info" onclick="pilihDatagudangtjn('.$pesanan->fc_kdgudang.',\''.$pesanan->fv_nmgudang.'\')">Ambil Data</button>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_gudang_tjn->count_all(),
						"recordsFiltered" => $this->Mdl_gudang_tjn->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	function add(){
		 $rows = $this->Mdl_bpb->getnomor();
			//print_r($this->db->last_query());
					$y = date('Y');
          foreach ($rows as $row) {
             $idne =  $row['awalan'].str_pad($row['nomor'], 5, "0", STR_PAD_LEFT);
          }

		 $data['id']	= $idne;	
		 $data['view_file']    = "moduls/bpb/add_bpb";
        $this->load->view('admin_view',$data);
	}

	function ajax_list_bpb(){
		@$kodene = $this->uri->segment(3);
		$list = $this->Mdl_bpb_new->get_datatables($kodene);
		//print_r($this->db->last_query()); 
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $pesanan) {
			if(@$pesanan->fc_kdbarang){
			$no++;
			$row = array();
			$row[] = '';
			$row[] = '
			<input type="hidden" name="fc_id" value="'.$pesanan->id.'">
			<input type="checkbox" name="cb_data[]" id="cb_data[]" value="'.$pesanan->id.'" >';
			$row[] = $no;
			$row[] = $pesanan->fc_kdbarang;
			$row[] = $pesanan->fv_nama_barang;
			$row[] = $pesanan->fn_qtyterima;
			$row[] = $pesanan->fm_harsat;
			$row[] = $pesanan->fm_subtot;
			$data[] = $row;
		 }
		}
		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_bpb_new->count_all($kodene),
						"recordsFiltered" => $this->Mdl_bpb_new->count_filtered($kodene),
						"data" => $data,
				);
		echo json_encode($output);
	}

	function save(){
		$id_user =$this->session->userdata('id_user');
		$no_bpb = $this->input->post('no_bpb');
		$tgl_bpb = $this->input->post('tgl_bpb');
		$tgl_input = $this->input->post('tgl_input');
		$nama_supplier = $this->input->post('nama_supplier');
		$fc_kdgudang = $this->input->post('fc_kdgudang');
		$fc_kdbarang = $this->input->post('fc_kdbarang');
		$fv_nama_barang = $this->input->post('fv_nama_barang');
		$qty_terima = $this->input->post('qty_terima');
		$harga_beli = $this->input->post('harga_beli');
		$subtotal = $this->input->post('subtotal');

		$data = array(
						'fc_nobpb'		=> $id_user,
						'fc_kdbarang' 	=> $fc_kdbarang,
						'fc_kdgudang'		=> $fc_kdgudang,
						'fn_qtyterima'	=> $qty_terima,
						'fm_harsat'	=> $harga_beli,
						'fm_subtot'			=> $subtotal,
						'fd_tglbpb'		=> $tgl_bpb,
						'fv_nama_supplier'    => $nama_supplier,
						'fd_tglinput'    => $tgl_input,
						);
		$insert_data = $this->Mdl_bpb->insert_table('t_bpbdtl_temp',$data);

		//print_r($this->db->last_query());
	}

	public function generate_act(){
         for($i=0; $i<sizeof($this->input->post('cb_data', TRUE)); $i++){
         	 $fc_id = $this->input->post('fc_id');

         	  $delete_keranjang = $this->db->query('delete from  t_bpbdtl_temp where fc_id="'.$fc_id.'"');  
         	 print_r($this->db->last_query());
         }
    } 

    public function generate_act_simpan(){
    	$user = $this->input->post('fc_user');
    	$fc_nobpb = $this->input->post('fc_nobpb');
    	$data = $this->Mdl_bpb_new->select_data($user);

    	$data_sum = $this->Mdl_bpb->sum_qty_terima($user);
    	//print_r($this->db->last_query());
    	$data_sum_tot = $this->Mdl_bpb->sum_tot_terima($user);
    	//print_r($this->db->last_query());
    	$qty_total = $data_sum[0]['fn_qtyterima'];
    	//print_r($qty_total);
    	$subtotal  = $data_sum_tot[0]['fm_harsat'];
    	//print_r($subtotal);
    	foreach ($data as $value) {
    	
    		$tgl_bpb = $value->fd_tglbpb;
    		$nama_supplier = $value->fv_nama_supplier;
    		$tgl_input = $value->fd_tglinput;
    	}	
    		
    	$datane = array(
    			'fc_nobpb' => $fc_nobpb,	
    			'fd_tglbpb' => $tgl_bpb,
    			'fv_nama_supplier' => $nama_supplier,
    			'fd_tglinput' => $tgl_input,
    			'id_user' => $user,
    			'fn_qtytot' =>  $qty_total,
    			'fm_total' => $subtotal
    	);

    	$insert_order = $this->Mdl_bpb->insert_table('t_bpbmst', $datane);
    	
    	if($insert_order){
    		$data_tran  = $this->Mdl_bpb_new->get_data(array('fc_nobpb'=> $user));
    		//print_r($this->db->last_query());
    		foreach ($data_tran as $d) {
                
    // 			$where = array(
				// 	'fc_nobpb' 		=> $fc_nobpb,
				// );
				// $cek_data = $this->Mdl_bpb->get_table_where('t_bpbdtl', $where);
						$data = array(
						'fc_nobpb'		=> $fc_nobpb,
						'fc_kdbarang' 	=> $d['fc_kdbarang'],
						'fc_kdgudang'		=> $d['fc_kdgudang'],
						'fn_qtyterima'	=> $d['fn_qtyterima'],
						'fm_harsat'	=> $d['fm_harsat'],
						'fm_subtot'			=> $d['fm_subtot'],
						);	
						$insert_data = $this->Mdl_bpb->insert_table('t_bpbdtl',$data);
						//print_r($this->db->last_query());


						 $query2 = $this->db->query(
	                        '
	                        SELECT *
	                        FROM td_stok_barang_gudang
	                        WHERE fc_kdgudang ="'.$d['fc_kdgudang'].'" and fc_kdbarang ="'.$d['fc_kdbarang'].'"  
	                        '
	                    );
                        
                        $query3 =  $this->db->query(
	                        '
	                        SELECT COUNT(*) as jml_ada
	                        FROM td_stok_barang_gudang
	                        WHERE fc_kdgudang ="'.$d['fc_kdgudang'].'" and fc_kdbarang ="'.$d['fc_kdbarang'].'"  
	                        '
	                    )->row();
                       
					
						    
						    
						    if($query3->jml_ada>0){
						        	foreach ($query2->result() as $value) { 
            							$quantity_update = $value->fc_qty_barang + $d['fn_qtyterima'];
            	                        $data_qty = array(
            	                         'fc_qty_barang' => $quantity_update,
            	                        );
            	                        $update_qty = $this->Mdl_ordere->update_table('td_stok_barang_gudang',$data_qty, array('fc_kdbarang' => $value->fc_kdbarang , 'fc_kdgudang' => $value->fc_kdgudang));
						        	}
						    }else{
						        	$data = array(
                						'fc_kdbarang' 	=>  $d['fc_kdbarang'],
                						'fc_kdgudang'		=> $d['fc_kdgudang'],
                						'fc_qty_barang'		=> $d['fn_qtyterima'],
                					);	
                					
                					$insert_data = $this->Mdl_bpb->insert_table('td_stok_barang_gudang',$data);
						    }
	                         
			}	

    	}

    	$delete_keranjang = $this->db->query('delete from  t_bpbdtl_temp where fc_nobpb="'.$user.'"');  	

    	$rows = $this->db->query('select * from t_nomor where kode="BPB"')->result_array();
		foreach ($rows as $row) {
			$no = $row['nomor'] + 1;
			$aksi = $this->db->update('t_nomor',array('nomor' => $no),array('kode' => 'BPB'));
		}
    } 

    function Hapus_bpb($id, $id2, $id3){
    	

    	$data_tran  = $this->Mdl_bpb_new->get_data_bpb($id);

    	foreach ($data_tran as $d) {

    		 $query2 = $this->db->query(
	                        '
	                        SELECT *
	                        FROM td_stok_barang_gudang
	                        WHERE fc_kdgudang ="'.$id3.'" and fc_kdbarang ="'.$id2.'"  
	                        '
	          );
    		foreach ($query2->result() as $value) { 

	    	$quantity_update = $value->fc_qty_barang - $d['fn_qtyterima'];
	           	$data_qty = array(
	            	'fc_qty_barang' => $quantity_update,
	            );


	        $update_qty = $this->Mdl_ordere->update_table('td_stok_barang_gudang',$data_qty, array('fc_kdbarang' => $value->fc_kdbarang , 'fc_kdgudang' => $value->fc_kdgudang));

	        print_r($this->db->last_query());
	    	}
	    } 

	    // $this->Mdl_bpb->delete_mst($id);
    	// $this->Mdl_bpb->delete_dtl($id);  

    	redirect('Bpb','refresh');

    }   	

}	