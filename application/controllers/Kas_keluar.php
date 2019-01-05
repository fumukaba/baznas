<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_keluar extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Mdl_kaskel');
		$this->auth->restrict();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("session");
	}
	
	 function index(){
       // $this->mdl_home->getsqurity();
        $data['view_file']    = "moduls/kaskel";
        $this->load->view('admin_view',$data);
    }
	
	public function ajax_list() {
		$list = $this->Mdl_kaskel->get_datatables();
		$data = array();
		$no = $_REQUEST['start'];
		foreach ($list as $kaskel) {

			$id1 = $kaskel->id_zis;			
            $zis = $this->db->query("SELECT * FROM tb_zis");
			foreach($zis->result() as $row_zis)	{	
				$id2 = $row_zis->id_zis; 		
				if($id1==$id2){						
						$convert_zis=$row_zis->nama_zis;
					}
				}
			$id3 = $kaskel->dibuat_oleh;			
			$user = $this->db->query("SELECT * FROM tm_user");
			foreach($user->result() as $pembuat)	{	
				$id4 = $pembuat->id; 		
				if($id3==$id4){						
						$convert_pembuat=$pembuat->nama;
					}
				}
			
			$no++;
			$row = array();
			$row[] = '';
			$row[] = $no;
			$row[] = $kaskel->tanggal_kaskel;
			$row[] = $kaskel->keperluan_kaskel;
			$row[] = $convert_zis;
			$row[] = $kaskel->jumlah_kaskel;
			$row[] = $convert_pembuat;
			$row[] = $kaskel->terakhir_diperbarui;
			$row[] = '
			<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" onclick="edit('."'".$kaskel->id_kaskel."'".')">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapus('."'".$kaskel->id_kaskel."'".')">Delete</a></li>
                        </ul>
            </div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_REQUEST['draw'],
						"recordsTotal" => $this->Mdl_kaskel->count_all(),
						"recordsFiltered" => $this->Mdl_kaskel->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	
	public function ajax_add() {

        $id = $this->session->userdata('id');

		$data = array(
				'tanggal_kaskel'			=> $this->input->post('tanggal_kaskel'),
				'keperluan_kaskel'         	=> $this->input->post('keperluan_kaskel'),
				'id_zis'      			   	=> $this->input->post('id_zis'),
				'jumlah_kaskel'         	=> $this->input->post('jumlah_kaskel'),
                'dibuat_oleh' 				=> $id,				
				
			);
		$insert = $this->Mdl_kaskel->add($data);

            // Kasbas
            $jumlah_kaskel = $this->input->post('jumlah_kaskel');
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
	
	public function ajax_edit($id) {
		$data = $this->Mdl_kaskel->get_by_id($id);
		echo json_encode($data);
	}
	
	public function ajax_update() {

		$id = $this->session->userdata('id');

		$data = array(
			'tanggal_kaskel'			=> $this->input->post('tanggal_kaskel'),
			'keperluan_kaskel'         	=> $this->input->post('keperluan_kaskel'),
			'id_zis'      			   	=> $this->input->post('id_zis'),
			'jumlah_kaskel'         	=> $this->input->post('jumlah_kaskel'),
			'dibuat_oleh' 				=> $id,					
			);
		$this->Mdl_kaskel->update(array('id_kaskel' => $this->input->post('id_kaskel')), $data);
		echo json_encode(array("status" => TRUE));
    }
	
	public function ajax_delete($id) {
      $this->Mdl_kaskel->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
    }

}