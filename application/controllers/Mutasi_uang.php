<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi_uang extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_mutasi');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/mutasi_uang";
        $this->load->view('admin_view',$data);
    }

    function mutasi($id_zis){
        $zis = $this->db->get_where('tb_zis', array('id_zis' => $id_zis))->result_array();

        $data_infaq = $this->db->get_where('tb_infaq', array('status_infaq' => 'Valid', 'status_uang' => 'Kas Baznas', 'id_zis' => $id_zis))->result_array();
        $data_fitrah = $this->db->get_where('tb_zakat_fitrah', array('status_zakat' => 'Valid', 'status_uang_zakat' => 'Kas Baznas', 'id_zis' => $id_zis))->result_array();
        $data_maal = $this->db->get_where('tb_zakat_maal', array('status_maal' => 'Valid', 'status_uang' => 'Kas Baznas', 'id_zis' => $id_zis))->result_array();

        $semua_data = array();

        foreach($data_infaq as $infaq) {
            $push = array(
                'id' => $infaq['id_infaq'],
                'jenis' => 'Infaq',
                'uang' => $infaq['jumlah_infaq']
            );

            array_push($semua_data, $push);
        }

        foreach($data_fitrah as $fitrah) {
            $push = array(
                'id' => $fitrah['id_zakat_fitrah'],
                'jenis' => 'Zakat Fitrah',
                'uang' => $fitrah['total_zakat']
            );

            array_push($semua_data, $push);
        }

        foreach($data_maal as $maal) {
            $push = array(
                'id' => $maal['id_maal'],
                'jenis' => 'Zakat Maal',
                'uang' => $maal['jumlah_maal']
            );

            array_push($semua_data, $push);
        }

        $data['view_file']    = "moduls/transaksi_mutasi";
        $data['semua_data'] = $semua_data;
        $data['zis'] = $zis;
        $this->load->view('admin_view',$data);
     }
	
	public function ajax_list() {
		$list = $this->Mdl_mutasi->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $mutasi_uang) {
			if($mutasi_uang->id_zis != '0') {
				$no++;
				$row = array();
				// $row[] = '';
				$row[] = $no;
				$row[] = $mutasi_uang->nama_zis;
				$row[] = $mutasi_uang->kas_masuk;
				$row[] = $mutasi_uang->kas_keluar;
				$row[] = $mutasi_uang->sisa_kas;
				$row[] = '<a href="' . base_url('Mutasi_uang/mutasi/' . $mutasi_uang->id_zis) . '" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Mutasi</a>';
				$data[] = $row;
			}
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_mutasi->count_all(),
						"recordsFiltered" => $this->Mdl_mutasi->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
    }
    
    public function ajax_add() {
		$id = $this->session->userdata('id');
		
		$tanggal_kaskel = date('Y-m-d H:i:s', time());
		$keperluan_kaskel = $this->input->post('keperluan_kaskel');
		$id_zis = $this->input->post('id_zis');
		$jumlah_kaskel = 0;

		$semua_mutasi = explode(',', $this->input->post('data'));

		foreach($semua_mutasi as $item) {
			if($item != '') {
				$semua_data = explode(':', $item);
				$jumlah_kaskel += $semua_data[1];

				if($semua_data[2] == 'Infaq') {
					$data = array(
						'status_uang' => 'Sudah Terdistribusi'
					);

					$this->db->update('tb_infaq', $data, array('id_infaq' => $semua_data[0]));
				}

				if($semua_data[2] == 'Zakat Fitrah') {
					$data = array(
						'status_uang_zakat' => 'Sudah Terdistribusi'
					);

					$this->db->update('tb_zakat_fitrah', $data, array('id_zakat_fitrah' => $semua_data[0]));
				}

				if($semua_data[2] == 'Zakat Maal') {
					$data = array(
						'status_uang' => 'Sudah Terdistribusi'
					);

					$this->db->update('tb_zakat_maal', $data, array('id_maal' => $semua_data[0]));
				}
			}
		}

		$data = array(
			'tanggal_kaskel'			=> $tanggal_kaskel,
			'keperluan_kaskel'         	=> $keperluan_kaskel,
			'id_zis'      			   	=> $id_zis,
			'jumlah_kaskel'         	=> $jumlah_kaskel,
			'dibuat_oleh' 				=> $id		
		);
	
		$insert = $this->db->insert('tb_kaskel', $data);

		// Kasbas
		$jumlah_kaskel = $jumlah_kaskel;
		$r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
		$old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
		$new_total = $old_total - $jumlah_kaskel;

		$kasbas = array(
			'id_kasbas' => '',
			'total_kasbas' => $new_total
		);

		$this->db->insert('tb_kasbas', $kasbas);

		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
}