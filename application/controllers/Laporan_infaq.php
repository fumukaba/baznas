<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_infaq extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_infaq');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
		// $this->load->library("phpqrcode/qrlib");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        // $data['view_file']    = "moduls/laporan_infaq";
        // $this->load->view('admin_view',$data);
        
        $this->filter();
    }

    function filter() {
        $start = $this->input->post('startDate');
        $end = $this->input->post('endDate');
        $status_infaq = $this->input->post('status_infaq');
        $status_uang = $this->input->post('status_uang');

        $filter = array(
            'start' => $start,
            'end' => $end,
            'status_infaq' => $status_infaq,
            'status_uang' => $status_uang
        );

        if($start != '') {
            $this->db->where('tanggal_infaq >=', $start);
        }

        if($end != '') {
            $this->db->where('tanggal_infaq <=', $end);
        }

        if($status_infaq != '') {
            $this->db->where('status_infaq', $status_infaq);
        }

        if($status_uang != '') {
            $this->db->where('status_uang', $status_uang);
        }

        $sess_id = $this->session->userdata('id_zis');
        $sess_level = $this->session->userdata('level');

        if($sess_level == 'Pengurus ZIS') {
            $this->db->where('id_zis', $sess_id);
        }

        $semua_data = $this->db->get('tb_infaq')->result_array();

        $data['view_file']    = "moduls/filter_infaq";
        $data['semua_data'] = $semua_data;
        $data['filter'] = $filter;
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
        $sess_id = $this->session->userdata('id_zis');
        $sess_level = $this->session->userdata('level');

        if($sess_level == 'Pengurus ZIS') {
            $list = $this->db->get_where('tb_infaq', array('id_zis' => $sess_id))->result();
        } else {
            $list = $this->Mdl_infaq->get_datatables();
        }

        $data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $infaq) {
            $no++;
            

			$row = array();
			$row[] = $no;
			$row[] = $infaq->nama_pengirim . "<br>" . $infaq->norek_pengirim . "<br>" . $infaq->bank_pengirim;
            $row[] = $infaq->jumlah_infaq;
            $row[] = $infaq->tanggal_infaq;
            $row[] = $infaq->status_infaq;
            $row[] = $infaq->status_uang;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_infaq->count_all(),
						"recordsFiltered" => $this->Mdl_infaq->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
    }

}	