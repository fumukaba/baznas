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
        $data['view_file']    = "moduls/Laporan_zakat_fitrah";
		$this->load->view('admin_view',$data);
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

        $semua_data = $this->db->get('tb_zakat_fitrah')->result_array();

        $data['view_file']    = "moduls/filter_zakat_fitrah";
        $data['semua_data'] = $semua_data;
        $data['filter'] = $filter;
        $this->load->view('admin_view',$data);
    }

    function konfirmasi() {
        $data = array(
            'total_zakat' => $this->input->post('total_zakat'),
            'status_zakat' => $this->input->post('status_zakat')
        );

        $this->db->update('tb_zakat_fitrah', $data, array('id_zakat_fitrah' => $this->input->post('id_zakat_fitrah')));

        $id_zakat_fitrah = $this->input->post('id_zakat_fitrah');
        $status_zakat = $this->input->post('status_zakat');
        
        if($status_zakat == 'Valid') {
            // Kasmas
            $kasmas = array(
                'id_kasmas' => '',
                'asal_kasmas' => 'Zakat Fitrah',
                'id_asal' => $id_zakat_fitrah,
                'jumlah_kasmas' => $this->input->post('total_zakat')
            );

            $this->db->insert('tb_kasmas', $kasmas);

            // Kasbas
            $total_zakat = $this->input->post('total_zakat');
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total + $total_zakat;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);
        }

        echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_list() {
		$list = $this->Mdl_zakatfitrah->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $zakat) {
            $no++;
            
            $print_status = "";



			$row = array();
			$row[] = '';
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

	public function ajax_add() {
        $gambar = $_FILES['bukti_zakat']['name'];
		$config['upload_path'] = './uploads/zakat_fitrah/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2000000';
        $config['file_name'] = "i3" . md5(time());
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
        $this->upload->do_upload('bukti_zakat');
        
        
        $id_zakat_fitrah = "t3" . md5(time());

        $cek_harga = $this->db->query("SELECT * FROM tb_setting WHERE meta_key = 'nominal_zakat_fitrah' ORDER BY tahun DESC LIMIT 0, 1")->result_array();

        $diperbarui_oleh = $this->session->userdata('id');

		if(empty($gambar)){
			$data = array(
                'id_zakat_fitrah' => $id_zakat_fitrah,
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_orang' => $this->input->post('jumlah_orang'),
                'harga_zakat' => $cek_harga[0]['meta_value'],
                'total_zakat' => $this->input->post('total_zakat'),
                'tanggal_zakat' => $this->input->post('tanggal_zakat'),
                'status_zakat' => $this->input->post('status_zakat'),
                'status_uang_zakat' => $this->input->post('status_uang_zakat'),
                'diperbarui_oleh' => $diperbarui_oleh,
                'id_zis' => $this->input->post('id_zis')
            );
 		}else{
            $data_gambar =$this->upload->data();
			$data = array(
                'id_zakat_fitrah' => $id_zakat_fitrah,
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_orang' => $this->input->post('jumlah_orang'),
                'harga_zakat' => $cek_harga[0]['meta_value'],
                'total_zakat' => $this->input->post('total_zakat'),
                'tanggal_zakat' => $this->input->post('tanggal_zakat'),
                'bukti_zakat' => $data_gambar['file_name'],
                'status_zakat' => $this->input->post('status_zakat'),
                'status_uang_zakat' => $this->input->post('status_uang_zakat'),
                'diperbarui_oleh' => $diperbarui_oleh,
                'id_zis' => $this->input->post('id_zis')
            ); 			
        }
        
        $insert = $this->Mdl_zakatfitrah->add($data);
        
        $status_zakat = $this->input->post('status_zakat');

        if($status_zakat == 'Valid') {
            // Kasmas
            $kasmas = array(
                'id_kasmas' => '',
                'asal_kasmas' => 'Zakat Fitrah',
                'id_asal' => $id_zakat_fitrah,
                'jumlah_kasmas' => $this->input->post('total_zakat')
            );

            $this->db->insert('tb_kasmas', $kasmas);

            // Kasbas
            $total_zakat = $this->input->post('total_zakat');
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total + $total_zakat;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);
        }

		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_zakatfitrah->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$gambar = $_FILES['bukti_zakat']['name'];
		$config['upload_path'] = './uploads/zakat_fitrah/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2000000';
        $config['file_name'] = "i3" . md5(time());
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
        $this->upload->do_upload('bukti_zakat');

        $cek_harga = $this->db->query("SELECT * FROM tb_setting WHERE meta_key = 'nominal_zakat_fitrah' ORDER BY tahun DESC LIMIT 0, 1")->result_array();

        $diperbarui_oleh = $this->session->userdata('id');
        
        if(empty($gambar)){
			$data = array(
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_orang' => $this->input->post('jumlah_orang'),
                'harga_zakat' => $cek_harga[0]['meta_value'],
                'total_zakat' => $this->input->post('total_zakat'),
                'tanggal_zakat' => $this->input->post('tanggal_zakat'),
                'status_zakat' => $this->input->post('status_zakat'),
                'status_uang_zakat' => $this->input->post('status_uang_zakat'),
                'diperbarui_oleh' => $diperbarui_oleh,
                'id_zis' => $this->input->post('id_zis')
            );
 		}else{
            $data_gambar =$this->upload->data();
			$data = array(
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_orang' => $this->input->post('jumlah_orang'),
                'harga_zakat' => $cek_harga[0]['meta_value'],
                'total_zakat' => $this->input->post('total_zakat'),
                'tanggal_zakat' => $this->input->post('tanggal_zakat'),
                'bukti_zakat' => $data_gambar['file_name'],
                'status_zakat' => $this->input->post('status_zakat'),
                'status_uang_zakat' => $this->input->post('status_uang_zakat'),
                'diperbarui_oleh' => $diperbarui_oleh,
                'id_zis' => $this->input->post('id_zis')
            ); 			
        }

        $this->Mdl_zakatfitrah->update(array('id_zakat_fitrah' => $this->input->post('id_zakat_fitrah')), $data);

        $id_zakat_fitrah = $this->input->post('id_zakat_fitrah');
        $status_zakat = $this->input->post('status_zakat');
        $ostatus_zakat = $this->input->post('ostatus_zakat');

        if($ostatus_zakat != 'Valid' && $status_zakat == 'Valid') {
            // Kasmas
            $kasmas = array(
                'id_kasmas' => '',
                'asal_kasmas' => 'Zakat Fitrah',
                'id_asal' => $id_zakat_fitrah,
                'jumlah_kasmas' => $this->input->post('total_zakat')
            );

            $this->db->insert('tb_kasmas', $kasmas);

            // Kasbas
            $total_zakat = $this->input->post('total_zakat');
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total + $total_zakat;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);
        }

		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_zakatfitrah->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}	