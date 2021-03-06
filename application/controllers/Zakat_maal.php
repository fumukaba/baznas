<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zakat_maal extends CI_Controller {
	
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
        $data['view_file']    = "moduls/zakat_maal";
		$this->load->view('admin_view',$data);
    }

    function konfirmasi_uang() {
        $id = $this->session->userdata('id');

        $data = array(
            'status_uang' => 'Sudah Terdistribusi'
        );

        $this->db->update('tb_zakat_maal', $data, array('id_maal' => $this->input->post('id_maal')));

		$data = array(
            'tanggal_kaskel'			=> date('Y-m-d h:i:s', time()),
            'keperluan_kaskel'         	=> "Mutasi sebesar Rp. " . number_format($this->input->post('jumlah_maal'), 0, '', '.'),
            'id_zis'      			   	=> $this->input->post('id_zis'),
            'jumlah_kaskel'         	=> $this->input->post('jumlah_maal'),
            'dibuat_oleh' 				=> $id,				
            
        );
		$insert = $this->db->insert('tb_kaskel', $data);

        // Kasbas
        $jumlah_kaskel = $this->input->post('jumlah_maal');
        $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
        $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
        $new_total = $old_total - $jumlah_kaskel;

        $kasbas = array(
            'id_kasbas' => '',
            'total_kasbas' => $new_total
        );

        $this->db->insert('tb_kasbas', $kasbas);

        echo json_encode(array('status' => TRUE));
    }

    function konfirmasi() {
        $data = array(
            'jumlah_maal' => $this->input->post('jumlah_maal'),
            'status_maal' => $this->input->post('status_maal')
        );

        $this->db->update('tb_zakat_maal', $data, array('id_maal' => $this->input->post('id_maal')));

        $id_maal = $this->input->post('id_maal');
        $status_maal = $this->input->post('status_maal');
        
        if($status_maal == 'Valid') {
            // Kasmas
            $kasmas = array(
                'id_kasmas' => '',
                'asal_kasmas' => 'Zakat Maal',
                'id_asal' => $id_maal,
                'jumlah_kasmas' => $this->input->post('jumlah_maal')
            );

            $this->db->insert('tb_kasmas', $kasmas);

            // Kasbas
            $jumlah_maal = $this->input->post('jumlah_maal');
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total + $jumlah_maal;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);
        }
        echo json_encode(array('status' => TRUE));
    }
	
	public function ajax_list() {
		$list = $this->Mdl_zakatmaal->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $zakat_maal) {
            $no++;
            
            $print_status = "";
            $print_uang = "";

            if($zakat_maal->status_maal == 'Menunggu Konfirmasi') {
                $print_status = '<span>' . $zakat_maal->status_maal . '</span><br /><a onclick="konfirmasiStatus($(this))" data-url="'. base_url('Zakat_maal/konfirmasi') . '" data-id="' . $zakat_maal->id_maal . '" data-konfirmasi="ya" data-jumlah="' . $zakat_maal->jumlah_maal . '" data-pengirim="' . $zakat_maal->nama_pengirim . '<br>A.n ' . $zakat_maal->pemilik_rekening. '<br>' . $zakat_maal->norek_pengirim . '<br>' . $zakat_maal->bank_pengirim .'" href="javascript:void(0)">Valid</a>&nbsp;&mdash;&nbsp;<a onclick="konfirmasiStatus($(this))" data-url="'. base_url('Zakat_maal/konfirmasi') . '" data-id="' . $zakat_maal->id_maal . '" data-konfirmasi="tidak" data-jumlah="' . $zakat_maal->jumlah_maal . '" data-pengirim="' . $zakat_maal->nama_pengirim . '<br>A.n ' . $zakat_maal->pemilik_rekening. '<br>' . $zakat_maal->norek_pengirim . '<br>' . $zakat_maal->bank_pengirim .'" href="javascript:void(0)">Tidak Valid</a>';
            } else {
                $print_status = $zakat_maal->status_maal;
            }

            if($zakat_maal->status_maal == 'Valid' && $zakat_maal->status_uang == 'Kas Baznas' && $zakat_maal->id_zis != '0') {
                $print_uang = '<span>' . $zakat_maal->status_uang . '</span><br /><a onclick="konfirmasiUang($(this))" data-url="'. base_url('Zakat_maal/konfirmasi_uang') . '" data-id="' . $zakat_maal->id_maal . '" data-zis="' . $zakat_maal->id_zis . '" data-jumlah="' . $zakat_maal->jumlah_maal . '" href="javascript:void(0)">Sudah Terdistribusi</a>';
            } else {
                $print_uang = $zakat_maal->status_uang;
            }

            $id_zis = $zakat_maal->id_zis;
            $asal = $this->db->query("SELECT * FROM tb_zis");
            foreach($asal->result() as $row_zis)	{
            if($id_zis==$row_zis->id_zis){						
                $dataZis_1=$row_zis->nama_zis;
                $dataZis_2=$row_zis->alamat_zis;
                }
            }
            
            foreach($this->db->get_where('tm_user', array('id' => $zakat_maal->diperbarui_oleh))->result_array() as $row) {
				$nama_orang = $row['nama'];
            }
  
			$row = array();
			$row[] = $no;
            $row[] = $zakat_maal->nama_pengirim . "<br>" . $zakat_maal->telp_pengirim;
            $row[] = $zakat_maal->pemilik_rekening . "<br>" . $zakat_maal->norek_pengirim . "<br>" . $zakat_maal->bank_pengirim;
            $row[] = $zakat_maal->jumlah_maal . "<br>" . $dataZis_1 . "<br>" . $dataZis_2;
            $row[] = $zakat_maal->tanggal_maal;
            $row[] = $print_status;
            $row[] = $print_uang;
            // $row[] = $zakat_maal->jenis_maal;
            $row[] = '<img src="'.base_url('uploads/ZakatMaal/'.$zakat_maal->bukti_maal).'" alt="" width="100" height="100">';
            $row[] = $nama_orang . "<br>" . $zakat_maal->terakhir_diperbarui;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="javascript:void(0)" onclick="edit('."'".$zakat_maal->id_maal."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$zakat_maal->id_maal."'".')">Delete</a></li>
                        </ul>
            </div>';
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

	public function ajax_add() {
        $gambar = $_FILES['bukti_maal']['name'];
		$config['upload_path'] = './uploads/ZakatMaal/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2000000';
        $config['file_name'] = "i4" . md5(time());
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
        $this->upload->do_upload('bukti_maal');
        
        $id_maal = "t4" . md5(time());
        $id = $this->session->userdata('id');

		if(empty($gambar)){
			$data = array(
                'id_maal' => $id_maal,
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'telp_pengirim' => $this->input->post('telp_pengirim'),                
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_maal' => $this->input->post('jumlah_maal'),
                'tanggal_maal' => $this->input->post('tanggal_maal'),
                'status_maal' => 'Valid',
                'status_uang' => 'Kas Baznas',
                'diperbarui_oleh' => $id,
                'id_zis' => $this->input->post('id_zis')
            );
 		}else{
            $data_gambar =$this->upload->data();
			$data = array(
                'id_maal' => $id_maal,
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'telp_pengirim' => $this->input->post('telp_pengirim'),                
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_maal' => $this->input->post('jumlah_maal'),
                'tanggal_maal' => $this->input->post('tanggal_maal'),
                'bukti_maal' => $data_gambar['file_name'],
                'status_maal' => 'Valid',
                'status_uang' => 'Kas Baznas',
                'diperbarui_oleh' => $id,
                'id_zis' => $this->input->post('id_zis')
            ); 			
        }
        
        $insert = $this->Mdl_zakatmaal->add($data);
        
        $status_maal = $this->input->post('status_maal');

        // Kasmas
        $kasmas = array(
            'id_kasmas' => '',
            'asal_kasmas' => 'Zakat Maal',
            'id_asal' => $id_maal,
            'jumlah_kasmas' => $this->input->post('jumlah_maal')
        );

        $this->db->insert('tb_kasmas', $kasmas);

        // Kasbas
        $jumlah_maal = $this->input->post('jumlah_maal');
        $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
        $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
        $new_total = $old_total + $jumlah_maal;

        $kasbas = array(
            'id_kasbas' => '',
            'total_kasbas' => $new_total
        );

        $this->db->insert('tb_kasbas', $kasbas);

		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_zakatmaal->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {
		$gambar = $_FILES['bukti_maal']['name'];
		$config['upload_path'] = './uploads/ZakatMaal/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2000000';
        $config['file_name'] = "i4" . md5(time());
		
		$this->load->library('upload', $config);
 		$this->upload->initialize($config);
        $this->upload->do_upload('bukti_maal');

        $id = $this->session->userdata('id');
        
        if(empty($gambar)){
			$data = array(
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'telp_pengirim' => $this->input->post('telp_pengirim'),
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_maal' => $this->input->post('jumlah_maal'),
                'tanggal_maal' => $this->input->post('tanggal_maal'),
                // 'status_maal' => $this->input->post('status_maal'),
                // 'status_uang' => $this->input->post('status_uang'),
                'diperbarui_oleh' => $id,
                'id_zis' => $this->input->post('id_zis')
            );
 		}else{
            $data_gambar =$this->upload->data();
			$data = array(
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'telp_pengirim' => $this->input->post('telp_pengirim'),                
                'bank_pengirim' => $this->input->post('bank_pengirim'),
                'pemilik_rekening' => $this->input->post('pemilik_rekening'),
                'norek_pengirim' => $this->input->post('norek_pengirim'),
                'jumlah_maal' => $this->input->post('jumlah_maal'),
                'tanggal_maal' => $this->input->post('tanggal_maal'),
                'bukti_maal' => $data_gambar['file_name'],
                // 'status_maal' => $this->input->post('status_maal'),
                // 'status_uang' => $this->input->post('status_uang'),
                'diperbarui_oleh' => $id,
                'id_zis' => $this->input->post('id_zis')
            ); 			
        }

        $this->Mdl_zakatmaal->update(array('id_maal' => $this->input->post('id_maal')), $data);

        // $id_maal = $this->input->post('id_maal');
        // $status_maal = $this->input->post('status_maal');
        // $ostatus_maal = $this->input->post('ostatus_maal');

        // if($ostatus_maal != 'Valid' && $status_maal == 'Valid') {
        //     // Kasmas
        //     $kasmas = array(
        //         'id_kasmas' => '',
        //         'asal_kasmas' => 'Zakat Maal',
        //         'id_asal' => $id_maal,
        //         'jumlah_kasmas' => $this->input->post('jumlah_maal')
        //     );

        //     $this->db->insert('tb_kasmas', $kasmas);

        //     // Kasbas
        //     $jumlah_maal = $this->input->post('jumlah_maal');
        //     $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
        //     $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
        //     $new_total = $old_total + $jumlah_maal;

        //     $kasbas = array(
        //         'id_kasbas' => '',
        //         'total_kasbas' => $new_total
        //     );

        //     $this->db->insert('tb_kasbas', $kasbas);
        // }

		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_zakatmaal->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}	