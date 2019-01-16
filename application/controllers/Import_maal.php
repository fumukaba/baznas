<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_maal extends CI_Controller {
	private $filename = "import_data";

	public function gencode($length, $keyspace = '123456789abcdefghijklmnopqrstuvwxyz') {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i=0; $i<$length; ++$i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }

        return implode('', $pieces);
    }

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
		if(isset($_POST['import'])) {
			$this->load->library('upload'); // Load librari upload
		
			$config['upload_path'] = './excel/';
			$config['allowed_types'] = 'xlsx';
			$config['max_size']	= '2048';
			$config['overwrite'] = true;
			$config['file_name'] = $this->filename;

			$return = array();
		
			$this->upload->initialize($config); // Load konfigurasi uploadnya
			if($this->upload->do_upload('file_excel')){ // Lakukan upload dan Cek jika proses upload berhasil
				// Jika berhasil :
				$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			}else{
				// Jika gagal :
				$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			}

			if($return['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $return['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

        $data['view_file']    = "moduls/import_maal";
		$this->load->view('admin_view',$data);
	}
	
	public function import() {
		$data = json_decode($this->input->post('data'));
		$id = $this->session->userdata('id');
		
		foreach($data as $maal) {
			$id_maal = "t4" . $this->gencode(32);

			$zis = $this->db->get_where('tb_zis', array('nama_zis' => $maal->nama_zis))->result_array();

			$tambah = array(
                'id_maal' => $id_maal,
                'nama_pengirim' => $maal->nama_pengirim,
                'telp_pengirim' => $maal->telp_pengirim,                   
                'bank_pengirim' => '',
                'pemilik_rekening' => '',
                'norek_pengirim' => '',
                'jumlah_maal' => $maal->jumlah_maal,
                'tanggal_maal' => date('Y-m-d h:i:s', strtotime($maal->tanggal_maal)),
                'status_maal' => 'Valid',
                'status_maal' => 'Kas Baznas',
				'diperbarui_oleh' => $id,
				'id_zis' => (count($zis) > 0 ? $zis[0]['id_zis'] : '0')
			);
			
			$insert = $this->Mdl_zakatmaal->add($tambah);

			// Kasmas
            $kasmas = array(
                'id_kasmas' => '',
                'asal_kasmas' => 'Zakat Maal',
                'id_asal' => $id_maal,
                'jumlah_kasmas' => $maal->jumlah_maal
            );

            $this->db->insert('tb_kasmas', $kasmas);

            // Kasbas
            $jumlah_maal = $maal->jumlah_maal;
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total + $jumlah_maal;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);
		}

		echo "<script>alert('Import data zakat maal berhasil!'); document.location.href = '" . base_url('Import_maal') . "';</script>";
	}
}	