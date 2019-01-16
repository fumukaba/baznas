<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_infaq extends CI_Controller {
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
		$this->load->model('Mdl_infaq');
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

        $data['view_file']    = "moduls/import_infaq";
		$this->load->view('admin_view',$data);
	}
	
	public function import() {
		$data = json_decode($this->input->post('data'));
		$id = $this->session->userdata('id');
		
		foreach($data as $infaq) {
			$id_infaq = "t2" . $this->gencode(32);

			$zis = $this->db->get_where('tb_zis', array('nama_zis' => $infaq->nama_zis))->result_array();

			$tambah = array(
                'id_infaq' => $id_infaq,
                'nama_pengirim' => $infaq->nama_pengirim,
                'telp_pengirim' => $infaq->telp_pengirim,                   
                'bank_pengirim' => '',
                'pemilik_rekening' => '',
                'norek_pengirim' => '',
                'jumlah_infaq' => $infaq->jumlah_infaq,
                'tanggal_infaq' => date('Y-m-d h:i:s', strtotime($infaq->tanggal_infaq)),
                'status_infaq' => 'Valid',
                'status_uang' => 'Kas Baznas',
				'diperbarui_oleh' => $id,
				'id_zis' => (count($zis) > 0 ? $zis[0]['id_zis'] : '0')
			);
			
			$insert = $this->Mdl_infaq->add($tambah);

			// Kasmas
            $kasmas = array(
                'id_kasmas' => '',
                'asal_kasmas' => 'Infaq',
                'id_asal' => $id_infaq,
                'jumlah_kasmas' => $infaq->jumlah_infaq
            );

            $this->db->insert('tb_kasmas', $kasmas);

            // Kasbas
            $jumlah_infaq = $infaq->jumlah_infaq;
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total + $jumlah_infaq;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);
		}

		echo "<script>alert('Import data infaq berhasil!'); document.location.href = '" . base_url('Import_infaq') . "';</script>";
	}
}	