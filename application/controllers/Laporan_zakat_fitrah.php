<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_zakat_fitrah extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_zakatfitrah');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
		// $this->load->library("phpqrcode/qrlib");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        // $data['view_file']    = "moduls/Laporan_zakat_fitrah";
        // $this->load->view('admin_view',$data);
        
        $this->filter();
    }

    function filter() {
        $start = $this->input->post('startDate');
        $end = $this->input->post('endDate');
        $status_zakat_fitrah = $this->input->post('status_zakat_fitrah');
        $status_uang = $this->input->post('status_uang');

        $filter = array(
            'start' => $start,
            'end' => $end,
            'status_zakat_fitrah' => $status_zakat_fitrah,
            'status_uang' => $status_uang
        );

        if($start != '') {
            $this->db->where('tanggal_zakat >=', $start);
        }

        if($end != '') {
            $this->db->where('tanggal_zakat <=', $end);
        }

        if($status_zakat_fitrah != '') {
            $this->db->where('status_zakat', $status_zakat_fitrah);
        }

        if($status_uang != '') {
            $this->db->where('status_uang_zakat', $status_uang);
        }

        $sess_id = $this->session->userdata('id_zis');
        $sess_level = $this->session->userdata('level');

        if($sess_level == 'Pengurus ZIS') {
            $this->db->where('id_zis', $sess_id);
        }

        $semua_data = $this->db->get('tb_zakat_fitrah')->result_array();

        $data['view_file']    = "moduls/filter_zakat_fitrah";
        $data['semua_data'] = $semua_data;
        $data['filter'] = $filter;
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
        $sess_id = $this->session->userdata('id_zis');
        $sess_level = $this->session->userdata('level');

        if($sess_level == 'Pengurus ZIS') {
            $list = $this->db->get_where('tb_zakat_fitrah', array('id_zis' => $sess_id))->result();
        } else {
            $list = $this->Mdl_zakatfitrah->get_datatables();
        }

		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $zakat) {
            $no++;
            
            $print_status = "";



			$row = array();
			$row[] = $no;
			$row[] = $zakat->pemilik_rekening . "<br>" . $zakat->norek_pengirim . "<br>" . $zakat->bank_pengirim;
            $row[] = $zakat->total_zakat;
            $row[] = $zakat->tanggal_zakat;
            $row[] = $zakat->status_zakat;
            $row[] = $zakat->status_uang_zakat;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_zakatfitrah->count_all(),
						"recordsFiltered" => $this->Mdl_zakatfitrah->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
    }

	

}	