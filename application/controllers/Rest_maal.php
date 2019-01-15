<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_maal extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }	
	function index_post() {
		$uploadDir = './uploads/ZakatMaal/';
        
        $id_maal = "t4" . md5(time());

        if($this->post('fileData') != '') {
            file_put_contents($uploadDir . $this->post('fileName'), base64_decode($this->post('fileData')));

			$data = array(
				'id_maal' => $id_maal,
				'nama_pengirim' => $this->post('nama_pengirim'),
				'telp_pengirim' => $this->post('telp_pengirim'),
				'bank_pengirim' => $this->post('bank_pengirim'),
				'pemilik_rekening' => $this->post('pemilik_rekening'),
				'norek_pengirim' => $this->post('norek_pengirim'),
				'jumlah_maal' => $this->post('jumlah_maal'),
				'tanggal_maal' => $this->post('tanggal_maal'),
				'bukti_maal' => $this->post('fileName'),
				'status_maal' => 'Menunggu Konfirmasi',
				'status_uang' => 'Kas Baznas',
				'id_zis' => $this->post('id_zis')
			);
		}else{
			$data = array(
				'id_maal' => $id_maal,
				'nama_pengirim' => $this->post('nama_pengirim'),
				'telp_pengirim' => $this->post('telp_pengirim'),
				'bank_pengirim' => $this->post('bank_pengirim'),
				'pemilik_rekening' => $this->post('pemilik_rekening'),
				'norek_pengirim' => $this->post('norek_pengirim'),
				'jumlah_maal' => $this->post('jumlah_maal'),
				'tanggal_maal' => $this->post('tanggal_maal'),
				'status_maal' => 'Menunggu Konfirmasi',
				'status_uang' => 'Kas Baznas',
				'id_zis' => $this->post('id_zis')
			);
		}

			$insert= $this->db->insert('tb_zakat_maal',$data);
			if ($insert){
				$this->response(array('status'=>'success','result' =>
					$data,"message"=>'Zakat Maal Anda Berhasil ditambahkan!'));
			}
			else{
				$this->response(array('status'=>'fail',"message"=>'Zakat Maal Anda gagal ditambahkan!'));
			}
		
	}

}
