<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_zakat_fitrah extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }
 
    function index_post() {
        $uploadDir = './uploads/zakat_fitrah/';
        
        $id_zakat_fitrah = "t3" . md5(time());

        if($this->post('fileData') != '') {
            file_put_contents($uploadDir . $this->post('fileName'), base64_decode($this->post('fileData')));

            $data = array(
               'id_zakat_fitrah'  => $id_zakat_fitrah,
               'nama_pengirim'  => $this->post('nama_pengirim'),
               'telp_pengirim'       => $this->post('telp_pengirim'),
               'bank_pengirim'   => $this->post('bank_pengirim'),
               'pemilik_rekening'     => $this->post('pemilik_rekening'),
               'norek_pengirim'      => $this->post('norek_pengirim'),
               'jumlah_orang'     => $this->post('jumlah_orang'),
               'harga_zakat'     => $this->post('harga_zakat'),
               'total_zakat'    => $this->post('total_zakat'),
               'tanggal_zakat'    => $this->post('tanggal_zakat'),
               'bukti_zakat'    => $this->post('fileName'),
               'status_zakat'    => 'Menunggu Konfirmasi',
               'status_uang_zakat'    => 'Kas Baznas',
               'id_zis'    => $this->post('id_zis')
            );
        } else {
            $data = array(
               'id_zakat_fitrah'  => $id_zakat_fitrah,
               'nama_pengirim'  => $this->post('nama_pengirim'),
               'telp_pengirim'       => $this->post('telp_pengirim'),
               'bank_pengirim'   => $this->post('bank_pengirim'),
               'pemilik_rekening'     => $this->post('pemilik_rekening'),
               'norek_pengirim'      => $this->post('norek_pengirim'),
               'jumlah_orang'     => $this->post('jumlah_orang'),
               'harga_zakat'     => $this->post('harga_zakat'),
               'total_zakat'    => $this->post('total_zakat'),
               'tanggal_zakat'    => $this->post('tanggal_zakat'),
               'status_zakat'    => 'Menunggu Konfirmasi',
               'status_uang_zakat'    => 'Kas Baznas',
                'id_zis'    => $this->post('id_zis')
            );
        }
        
        $insert = $this->db->insert('tb_zakat_fitrah', $data);
        
        if ($insert) {
            $this->response($this->db->insert_id(), 200);
            $this->response(array('status'=>'sucsess','result' =>
            $data,"message" =>"Zakat Fitrah berhasil ditambahkan"));
        } else {
            $this->response(array('status' => 'fail', 502));
            $this->response(array('status'=>'fail',
            "message" =>"Zakat Fitrah gagal ditambahkan"));
        }
    }

    //Masukan function selanjutnya disini
}
?>