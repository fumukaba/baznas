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
        $data['view_file']    = "moduls/laporan_infaq";
		$this->load->view('admin_view',$data);
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

        $semua_data = $this->db->get('tb_infaq')->result_array();

        $data['view_file']    = "moduls/filter_infaq";
        $data['semua_data'] = $semua_data;
        $data['filter'] = $filter;
        $this->load->view('admin_view',$data);
    }

    // function konfirmasi() {
    //     $data = array(
    //         'jumlah_infaq' => $this->input->post('jumlah_infaq'),
    //         'status_infaq' => $this->input->post('status_infaq')
    //     );

    //     $this->db->update('tb_infaq', $data, array('id_infaq' => $this->input->post('id_infaq')));

    //     $id_infaq = $this->input->post('id_infaq');
    //     $status_infaq = $this->input->post('status_infaq');
        
    //     if($status_infaq == 'Valid') {
    //         // Kasmas
    //         $kasmas = array(
    //             'id_kasmas' => '',
    //             'asal_kasmas' => 'Infaq',
    //             'id_asal' => $id_infaq,
    //             'jumlah_kasmas' => $this->input->post('jumlah_infaq')
    //         );

    //         $this->db->insert('tb_kasmas', $kasmas);

    //         // Kasbas
    //         $jumlah_infaq = $this->input->post('jumlah_infaq');
    //         $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
    //         $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
    //         $new_total = $old_total + $jumlah_infaq;

    //         $kasbas = array(
    //             'id_kasbas' => '',
    //             'total_kasbas' => $new_total
    //         );

    //         $this->db->insert('tb_kasbas', $kasbas);
    //     }

    //     echo json_encode(array('status' => TRUE));
    // }
	
	public function ajax_list() {
		$list = $this->Mdl_infaq->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $infaq) {
            $no++;
            

			$row = array();
			$row[] = '';
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

	// public function ajax_add() {
    //     $gambar = $_FILES['bukti_infaq']['name'];
	// 	$config['upload_path'] = './uploads/infaq/';
	// 	$config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     $config['max_size'] = '2000000';
    //     $config['file_name'] = "i2" . md5(time());
        
		
	// 	$this->load->library('upload', $config);
 	// 	$this->upload->initialize($config);
    //     $this->upload->do_upload('bukti_infaq');
        
    //     $id_infaq = "t2" . md5(time());
    //     $id = $this->session->userdata('id');

	// 	if(empty($gambar)){
	// 		$data = array(
    //             'id_infaq' => $id_infaq,
    //             'nama_pengirim' => $this->input->post('nama_pengirim'),
    //             'bank_pengirim' => $this->input->post('bank_pengirim'),
    //             'pemilik_rekening' => $this->input->post('pemilik_rekening'),
    //             'norek_pengirim' => $this->input->post('norek_pengirim'),
    //             'jumlah_infaq' => $this->input->post('jumlah_infaq'),
    //             'tanggal_infaq' => $this->input->post('tanggal_infaq'),
    //             'status_infaq' => $this->input->post('status_infaq'),
    //             'status_uang' => $this->input->post('status_uang'),
    //             'diperbarui_oleh' => $id,
    //             'id_zis' => $this->input->post('id_zis')
    //         );
 	// 	}else{
    //         $data_gambar = $this->upload->data(); // Iki

	// 		$data = array(
    //             'id_infaq' => $id_infaq,
    //             'nama_pengirim' => $this->input->post('nama_pengirim'),
    //             'bank_pengirim' => $this->input->post('bank_pengirim'),
    //             'pemilik_rekening' => $this->input->post('pemilik_rekening'),
    //             'norek_pengirim' => $this->input->post('norek_pengirim'),
    //             'jumlah_infaq' => $this->input->post('jumlah_infaq'),
    //             'tanggal_infaq' => $this->input->post('tanggal_infaq'),
    //             'bukti_infaq' => $data_gambar['file_name'], // Iki
    //             'status_infaq' => $this->input->post('status_infaq'),
    //             'status_uang' => $this->input->post('status_uang'),
    //             'diperbarui_oleh' => $id,
    //             'id_zis' => $this->input->post('id_zis')
    //         ); 			
    //     }
        
    //     $insert = $this->Mdl_infaq->add($data);
        
    //     $status_infaq = $this->input->post('status_infaq');

    //     if($status_infaq == 'Valid') {
    //         // Kasmas
    //         $kasmas = array(
    //             'id_kasmas' => '',
    //             'asal_kasmas' => 'Infaq',
    //             'id_asal' => $id_infaq,
    //             'jumlah_kasmas' => $this->input->post('jumlah_infaq')
    //         );

    //         $this->db->insert('tb_kasmas', $kasmas);

    //         // Kasbas
    //         $jumlah_infaq = $this->input->post('jumlah_infaq');
    //         $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
    //         $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
    //         $new_total = $old_total + $jumlah_infaq;

    //         $kasbas = array(
    //             'id_kasbas' => '',
    //             'total_kasbas' => $new_total
    //         );

    //         $this->db->insert('tb_kasbas', $kasbas);
    //     }

	// 	//print_r($this->db->last_query());
	// 	echo json_encode(array('status' => TRUE));
	// }
	
	// public function ajax_edit($id) {
	// 	$data = $this->Mdl_infaq->get_by_id($id);
	// 	echo json_encode($data);
	// }
	
	// public function ajax_update() {
	// 	$gambar = $_FILES['bukti_infaq']['name'];
	// 	$config['upload_path'] = './uploads/infaq/';
	// 	$config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     $config['max_size'] = '2000000';
    //     $config['file_name'] = "i2" . md5(time());
		
	// 	$this->load->library('upload', $config);
 	// 	$this->upload->initialize($config);
    //     $this->upload->do_upload('bukti_infaq');

    //     $id = $this->session->userdata('id');
        
    //     if(empty($gambar)){
	// 		$data = array(
    //             'nama_pengirim' => $this->input->post('nama_pengirim'),
    //             'bank_pengirim' => $this->input->post('bank_pengirim'),
    //             'pemilik_rekening' => $this->input->post('pemilik_rekening'),
    //             'norek_pengirim' => $this->input->post('norek_pengirim'),
    //             'jumlah_infaq' => $this->input->post('jumlah_infaq'),
    //             'tanggal_infaq' => $this->input->post('tanggal_infaq'),
    //             'status_infaq' => $this->input->post('status_infaq'),
    //             'status_uang' => $this->input->post('status_uang'),
    //             'diperbarui_oleh' => $id,
    //             'id_zis' => $this->input->post('id_zis')
    //         );
 	// 	}else{
    //         $data_gambar = $this->upload->data(); // Iki

	// 		$data = array(
    //             'nama_pengirim' => $this->input->post('nama_pengirim'),
    //             'bank_pengirim' => $this->input->post('bank_pengirim'),
    //             'pemilik_rekening' => $this->input->post('pemilik_rekening'),
    //             'norek_pengirim' => $this->input->post('norek_pengirim'),
    //             'jumlah_infaq' => $this->input->post('jumlah_infaq'),
    //             'tanggal_infaq' => $this->input->post('tanggal_infaq'),
    //             'bukti_infaq' => $data_gambar['file_name'],
    //             'status_infaq' => $this->input->post('status_infaq'),
    //             'status_uang' => $this->input->post('status_uang'),
    //             'diperbarui_oleh' => $id,
    //             'id_zis' => $this->input->post('id_zis')
    //         ); 			
    //     }

    //     $this->Mdl_infaq->update(array('id_infaq' => $this->input->post('id_infaq')), $data);

    //     $id_infaq = $this->input->post('id_infaq');
    //     $status_infaq = $this->input->post('status_infaq');
    //     $ostatus_infaq = $this->input->post('ostatus_infaq');

    //     if($ostatus_infaq != 'Valid' && $status_infaq == 'Valid') {
    //         // Kasmas
    //         $kasmas = array(
    //             'id_kasmas' => '',
    //             'asal_kasmas' => 'Infaq',
    //             'id_asal' => $id_infaq,
    //             'jumlah_kasmas' => $this->input->post('jumlah_infaq')
    //         );

    //         $this->db->insert('tb_kasmas', $kasmas);

    //         // Kasbas
    //         $jumlah_infaq = $this->input->post('jumlah_infaq');
    //         $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
    //         $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
    //         $new_total = $old_total + $jumlah_infaq;

    //         $kasbas = array(
    //             'id_kasbas' => '',
    //             'total_kasbas' => $new_total
    //         );

    //         $this->db->insert('tb_kasbas', $kasbas);
    //     }

	// 	echo json_encode(array("status" => TRUE));
    // }
	
	// public function ajax_delete($id) {
    //   $this->Mdl_infaq->delete_by_id($id);
    //   echo json_encode(array("status" => TRUE));
    // }

}	