<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_infaq extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_post() {
        $uploadDir = './uploads/infaq/';
        
        $id_infaq = "t2" . md5(time());

        if($this->post('fileData') != '') {
            file_put_contents($uploadDir . $this->post('fileName'), base64_decode($this->post('fileData')));

            $data = array(
                'id_infaq' => $id_infaq,
                'nama_pengirim' => $this->post('nama_pengirim'),
                'telp_pengirim' => $this->post('telp_pengirim'),                   
                'bank_pengirim' => $this->post('bank_pengirim'),
                'pemilik_rekening' => $this->post('pemilik_rekening'),
                'norek_pengirim' => $this->post('norek_pengirim'),
                'jumlah_infaq' => $this->post('jumlah_infaq'),
                'tanggal_infaq' => $this->post('tanggal_infaq'),
                'bukti_infaq' => $this->post('fileName'),
                'status_infaq' => 'Menunggu Konfirmasi',
                'status_uang' => 'Kas Baznas',
                'id_zis' => $this->post('id_zis')
            );
        } else {
            $data = array(
                'id_infaq' => $id_infaq,
                'nama_pengirim' => $this->post('nama_pengirim'),
                'telp_pengirim' => $this->post('telp_pengirim'),                   
                'bank_pengirim' => $this->post('bank_pengirim'),
                'pemilik_rekening' => $this->post('pemilik_rekening'),
                'norek_pengirim' => $this->post('norek_pengirim'),
                'jumlah_infaq' => $this->post('jumlah_infaq'),
                'tanggal_infaq' => $this->post('tanggal_infaq'),
                'status_infaq' => 'Menunggu Konfirmasi',
                'status_uang' => 'Kas Baznas',
                'id_zis' => $this->post('id_zis')
            );
        }
        
        $insert = $this->db->insert('tb_infaq', $data);
        
        if ($insert) {
            $this->response(array('status' => 'success', 'result' => $data, 'message' => 'Infaq Anda berhasil ditambahkan!'));
        } else {
            $this->response(array('status' => 'fail', 'message' => 'Infaq Anda gagal ditambahkan!'));
        }
    }

    //Masukan function selanjutnya disini
}
?>