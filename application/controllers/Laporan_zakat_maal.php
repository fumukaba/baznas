<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_zakat_maal extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_zakatmaal');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
		// $this->load->library("phpqrcode/qrlib");
    }
    
    function index(){
        // $this->mdl_home->getsqurity();
         $data['view_file']    = "moduls/laporan_zakat_maal";
         $this->load->view('admin_view',$data);
     }
 
     function filter() {
         $start = $this->input->post('startDate');
         $end = $this->input->post('endDate');
         $status_maal = $this->input->post('status_maal');
         $status_uang = $this->input->post('status_uang');
 
         $filter = array(
             'start' => $start,
             'end' => $end,
             'status_maal' => $status_maal,
             'status_uang' => $status_uang
         );
 
         if($start != '') {
             $this->db->where('tanggal_maal >=', $start);
         }
 
         if($end != '') {
             $this->db->where('tanggal_maal <=', $end);
         }
 
         if($status_maal != '') {
             $this->db->where('status_maal', $status_maal);
         }
 
         if($status_uang != '') {
             $this->db->where('status_uang', $status_uang);
         }
 
         $semua_data = $this->db->get('tb_zakat_maal')->result_array();
 
         $data['view_file']    = "moduls/filter_zakat_maal";
         $data['semua_data'] = $semua_data;
         $data['filter'] = $filter;
         $this->load->view('admin_view',$data);
     }
	
	public function ajax_list() {
		$list = $this->Mdl_zakatmaal->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $maal) {
            $no++;
            

			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $maal->nama_pengirim . "<br>" . $maal->norek_pengirim . "<br>" . $maal->bank_pengirim;
            $row[] = $maal->jumlah_maal;
            $row[] = $maal->tanggal_maal;
            $row[] = $maal->status_maal;
            $row[] = $maal->status_uang;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_zakatmaal->count_all(),
						"recordsFiltered" => $this->Mdl_zakatmaal->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
    }
}	