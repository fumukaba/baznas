<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_masuk extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_kasmas');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	 function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/kasmas";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_kasmas->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $kasmas) {

		$asal_kasmas = $kasmas->asal_kasmas;			
		if($asal_kasmas='Infaq'){
			$tabel='tb_infaq';
			$kolom='id_infaq';
			$kolom2='status_uang';
		}else if($asal_kasmas='Zakat Fitrah'){
			$tabel='tb_zakat_fitrah';
			$kolom='id_zakat_fitrah';
			$kolom2='status_uang_zakat';
		}else{
			$tabel='tb_zakat_maal';
			$kolom='id_zakat_maal';
			$kolom2='status_uang';
		}

		$id_asal = $kasmas->id_asal;
		$asal = $this->db->query("SELECT * FROM $tabel");
		foreach($asal->result() as $row_asal)	{

			$id_transaksi = $row_asal->$kolom; 	
			if($id_asal==$id_transaksi){						
					$dataRek_1=$row_asal->pemilik_rekening;
					$dataRek_2=$row_asal->norek_pengirim;
					$dataRek_3=$row_asal->bank_pengirim;
					$id_zis=$row_asal->id_zis;
					$status1=$row_asal->$kolom2;		
			}

		}			

			$bahan_zis = $this->db->query("SELECT * FROM tb_zis");
			foreach($bahan_zis->result() as $row_zis)	{
	 		
				if($id_zis==$row_zis->id_zis){						
						$dataZis_1=$row_zis->nama_zis;
						$dataZis_2=$row_zis->alamat_zis;
					}
				}	
				


			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kasmas->tanggal_kasmas;
			$row[] = $dataRek_1 . "<br>" . $dataRek_2 . "<br>" . $dataRek_3;
			$row[] = $dataZis_1 . "<br>" . $dataZis_2;
			$row[] = $kasmas->asal_kasmas;
			$row[] = $kasmas->jumlah_kasmas;
			$row[] = $status1;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$kasmas->id_kasmas."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$kasmas->id_kasmas."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_kasmas->count_all(),
						"recordsFiltered" => $this->Mdl_kasmas->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {

        $id = $this->session->userdata('id');

		$data = array(
				'tanggal_kasmas'			=> $this->input->post('tanggal_kasmas'),
				'asal_kasmas'         	=> $this->input->post('asal_kasmas'),
				'id_asal'      			   	=> $this->input->post('asal_zis'),
				'jumlah_kasmas'         	=> $this->input->post('jumlah_kasmas'),				
				
			);
		$insert = $this->Mdl_kasmas->add($data);

            // Kasbas
            $jumlah_kaskel = $this->input->post('jumlah_kasmas');
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total - $jumlah_kasmas;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);		

		//print_r($this->db->last_query());
		echo json_encode(array('status' => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Mdl_kasmas->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {

		$id = $this->session->userdata('id');

		$data = array(
            'tanggal_kasmas'			=> $this->input->post('tanggal_kasmas'),
            'asal_kasmas'         	=> $this->input->post('asal_kasmas'),
            'id_asal'      			   	=> $this->input->post('asal_zis'),
            'jumlah_kasmas'         	=> $this->input->post('jumlah_kasmas'),					
			);
		$this->Mdl_kasmas->update(array('id_kasmas' => $this->input->post('id_kasmas')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_kasmas->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}