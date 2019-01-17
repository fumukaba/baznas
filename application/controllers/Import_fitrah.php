<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_fitrah extends CI_Controller {
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
		$this->load->model('Mdl_zakatfitrah');
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

        $data['view_file']    = "moduls/import_fitrah";
		$this->load->view('admin_view',$data);
	}
	
	public function import() {
		$data = json_decode($this->input->post('data'));
		$id = $this->session->userdata('id');
        
        $query = $this->db->query("SELECT * FROM tb_setting WHERE meta_key='nominal_zakat_fitrah' ");
        foreach($query->result() as $row_zis)	{					
            $setting=$row_zis->meta_value;
        }



		foreach($data as $fitrah) {
			$id_fitrah = "t3" . $this->gencode(32);

            $total=$fitrah->total_zakat;
            $jumlah_orang=$total/$setting;

			$zis = $this->db->get_where('tb_zis', array('nama_zis' => $fitrah->nama_zis))->result_array();

			$tambah = array(
                'id_zakat_fitrah' => $id_fitrah,
                'nama_pengirim' => $fitrah->nama_pengirim,
                'telp_pengirim' => $fitrah->telp_pengirim,                   
                'bank_pengirim' => '',
                'pemilik_rekening' => '',
                'norek_pengirim' => '',
                'jumlah_orang' => $jumlah_orang,
                'harga_zakat' => $setting,
                'total_zakat' => $fitrah->total_zakat,
                'tanggal_zakat' => date('Y-m-d h:i:s', strtotime($fitrah->tanggal_zakat)),
                'status_zakat' => 'Valid',
                'status_uang_zakat' => 'Kas Baznas',
				'diperbarui_oleh' => $id,
				'id_zis' => (count($zis) > 0 ? $zis[0]['id_zis'] : '0')
			);
			
			$insert = $this->Mdl_zakatfitrah->add($tambah);

			// Kasmas
            $kasmas = array(
                'id_kasmas' => '',
                'asal_kasmas' => 'Zakat Fitrah',
                'id_asal' => $id_fitrah,
                'jumlah_kasmas' => $fitrah->total_zakat
            );

            $this->db->insert('tb_kasmas', $kasmas);

            // Kasbas
            $total_zakat = $fitrah->total_zakat;
            $r_kasbas = $this->db->query("SELECT * FROM tb_kasbas ORDER BY id_kasbas DESC LIMIT 0, 1")->result_array();
            $old_total = (count($r_kasbas) > 0 ? $r_kasbas[0]['total_kasbas'] : 0);
            $new_total = $old_total + $total_zakat;

            $kasbas = array(
                'id_kasbas' => '',
                'total_kasbas' => $new_total
            );

            $this->db->insert('tb_kasbas', $kasbas);
		}

		echo "<script>alert('Import data zakat fitrah berhasil!'); document.location.href = '" . base_url('Import_fitrah') . "';</script>";
	}
}	