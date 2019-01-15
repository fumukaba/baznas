<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Rest_zakat_fitrah extends REST_Controller {
    // Konfigurasi letak folder untuk upload image
    private $folder_upload = 'uploads/zakat_fitrah';
    function all_get(){
        $getZakatFitrah = $this->db->query("
            SELECT
                id_zakat_fitrah,
                nama_pengirim,
                telp_pengirim,
                bank_pengirim,
                pemilik_rekening,
                norek_pengirim,
                jumlah_orang,
                harga_zakat,
                total_zakat,
                tanggal_zakat,
                bukti_zakat,
                status_zakat,
                status_uang_zakat,
                id_zis
            FROM tb_zakat_fitrah")->result();
       $this->response(
           array(
               "status" => "success",
               "result" => $getZakatFitrah
           )
       );
    }

    function all_post() {
        $action  = $this->post('action');
        $dataZakatFitrah = array(
     	               'nama_pengirim'  => $this->post('nama_pengirim'),
     	               'telp_pengirim'       => $this->post('telp_pengirim'),
                       'bank_pengirim'   => $this->post('bank_pengirim'),
     	               'pemilik_rekening'     => $this->post('pemilik_rekening'),
     	               'norek_pengirim'      => $this->post('norek_pengirim'),
     	               'jumlah_orang'     => $this->post('jumlah_orang'),
                       'harga_zakat'     => $this->post('harga_zakat'),
                       'total_zakat'    => $this->post('total_zakat'),
                       'tanggal_zakat'    => $this->post('tanggal_zakat'),
                       'bukti_zakat'    => $this->post('bukti_zakat'),
                       'status_zakat'    => $this->post('status_zakat'),
                       'status_uang_zakat'    => $this->post('status_uang_zakat'),
                       'id_zis'    => $this->post('id_zis'),
 	               );
        switch ($action) {
            case 'insert':
                $this->insertZakatFitrah($dataZakatFitrah);
                break;           
            case 'update':
                $this->updateZakatFitrah($dataZakatFitrah);
                break;           
            case 'delete':
                $this->deleteZakatFitrah($dataZakatFitrah);
                break;          
            default:
                $this->response(
                    array(
                        "status"  =>"failed",
                        "message" => "action harus diisi"
                    )
                );
                break;
        }
    }

    function insertZakatFitrah($dataZakatFitrah){
 	   // Cek validasi
 	    if (empty($dataZakatFitrah['nama_pengirim']) || empty($dataZakatFitrah['telp_pengirim']) || empty($dataZakatFitrah['bank_pengirim']) || empty($dataZakatFitrah['pemilik_rekening']) || empty($dataZakatFitrah['norek_pengirim']) || empty($dataZakatFitrah['jumlah_orang']) || empty($dataZakatFitrah['harga_zakat']) || empty($dataZakatFitrah['total_zakat']) || empty($dataZakatFitrah['tanggal_zakat']) || empty($dataZakatFitrah['bukti_zakat']) || empty($dataZakatFitrah['status_zakat']) || empty($dataZakatFitrah['status_uang_zakat']) || empty($dataZakatFitrah['id_zis'])){
 	        $this->response(
 	           array(
 	               "status" => "failed",
 	               "message" => "Mohon Lengkapi Data"
 	           )
 	       );
 	    } else {
 	       $dataZakatFitrah['bukti_zakat'] = $this->uploadPhoto();
 	       $do_insert = $this->db->insert('tb_zakat_fitrah', $dataZakatFitrah);
     	   if ($do_insert){
         	   $this->response(
         	       array(
         	           "status" => "success",
         	           "result" => array($dataZakatFitrah),
         	           "message" => $do_insert
         	       )
         	   );
            }
 	    }
    }

    function updateZakatFitrah($dataZakatFitrah){
 	   // Cek validasi
        if (empty($dataZakatFitrah['nama_pengirim']) || empty($dataZakatFitrah['telp_pengirim']) || empty($dataZakatFitrah['bank_pengirim']) || empty($dataZakatFitrah['pemilik_rekening']) || empty($dataZakatFitrah['norek_pengirim']) || empty($dataZakatFitrah['jumlah_orang']) || empty($dataZakatFitrah['harga_zakat']) || empty($dataZakatFitrah['total_zakat']) || empty($dataZakatFitrah['tanggal_zakat']) || empty($dataZakatFitrah['bukti_zakat']) || empty($dataZakatFitrah['status_zakat']) || empty($dataZakatFitrah['status_uang_zakat']) || empty($dataZakatFitrah['id_zis'])){
 	       $this->response(
 	           array(
 	               "status" => "failed",
 	               "message" => "Mohon Lengkapi Data"
 	           )
 	       );
 	    } else {
 	       // Cek apakah ada di database
 	       $getZakatFitrah_baseID = $this->db->query("
 	           SELECT 1
 	           FROM tb_zakat_fitrah
 	           WHERE id_zakat_fitrah =  {$dataZakatFitrah['id_zakat_fitrah']}")->num_rows();
 	        if($getZakatFitrah_baseID === 0){
     	       // Jika tidak ada
     	       $this->response(
     	           array(
     	               "status"  => "failed",
      	               "message" => "ID Zakat Fitrah tidak ditemukan"
     	           )
     	       );
 	        } else {
 	           $dataZakatFitrah['gambar'] = $this->uploadPhoto();
         	    if ($dataZakatFitrah['gambar']){
         	       // Jika upload foto berhasil, eksekusi update
         	       $update = $this->db->query("
         	           UPDATE makanan SET
         	               menu = '{$dataZakatFitrah['menu']}',
         	               kategori = '{$dataZakatFitrah['kategori']}',
         	               gambar = '{$dataZakatFitrah['gambar']}',
                           harga = '{$dataZakatFitrah['harga']}',
                           alamat = '{$dataZakatFitrah['alamat']}',
                           review = '{$dataZakatFitrah['review']}',
                           tanggal = '{$dataZakatFitrah['tanggal']}'
         	           WHERE idMakanan = '{$dataZakatFitrah['idMakanan']}'");
         	    } else {
         	       // Jika foto kosong atau upload foto tidak berhasil, eksekusi update
                    $update = $this->db->query("
                        UPDATE makanan
                        SET
                            menu = '{$dataZakatFitrah['menu']}',
                            kategori = '{$dataZakatFitrah['kategori']}',
                            harga = '{$dataZakatFitrah['harga']}',
                            alamat = '{$dataZakatFitrah['alamat']}',
                            review = '{$dataZakatFitrah['review']}',
                            tanggal = '{$dataZakatFitrah['tanggal']}'
                        WHERE idMakanan = {$dataZakatFitrah['idMakanan']}"
                    );
         	    }        	  
         	    if ($update){
             	   $this->response(
             	       array(
             	           "status"    => "success",
             	           "result"    => array($dataZakatFitrah),
             	           "message"   => $update
             	       )
             	   );
                }
 	       }   
 	   }
    }

    function deleteZakatFitrah($dataZakatFitrah){
        if (empty($dataZakatFitrah['idMakanan'])){
 	       $this->response(
 	           array(
 	               "status" => "failed",
 	               "message" => "ID Makanan harus diisi"
 	           )
 	       );
 	    } else {
 	       // Cek apakah ada di database
 	       $getZakatFitrah_baseID =$this->db->query("
 	           SELECT 1
 	           FROM makanan
 	           WHERE idMakanan = {$dataZakatFitrah['idMakanan']}")->num_rows();
 	        if($getZakatFitrah_baseID > 0){        
 	           $get_gambar =$this->db->query("
 	           SELECT gambar
 	           FROM makanan
 	           WHERE idMakanan = {$dataZakatFitrah['idMakanan']}")->result(); 	       
                if(!empty($get_gambar)){
                    // Dapatkan nama file
                    $photo_nama_file = basename($get_gambar[0]->gambar);
                    // Dapatkan letak file di folder upload
                    $photo_lokasi_file = realpath(FCPATH . $this->folder_upload . $photo_nama_file);                   
                    // Jika file ada, hapus
                    if(file_exists($photo_lokasi_file)) {
                        // Hapus file
         	           unlink($photo_lokasi_file);
         	        }
         	       $this->db->query("
         	           DELETE FROM makanan
         	           WHERE idMakanan = {$dataZakatFitrah['idMakanan']}");
         	       $this->response(
         	           array(
         	               "status" => "success",
         	               "message" => "Data ID = " .$dataZakatFitrah['idMakanan']. " berhasil dihapus"
         	            )
         	       );
         	   }	       
            } else {
                $this->response(
                    array(
                        "status" => "failed",
                        "message" => "ID Makanan tidak ditemukan"
                    )
                );
            }
 	    }
    }

    function uploadPhoto() {
        // Apakah user upload gambar?
        if ( isset($_FILES['gambar']) && $_FILES['gambar']['size'] > 0 ){
            // Foto disimpan di android_api/uploads
            $config['upload_path'] = realpath(FCPATH . $this->folder_upload);
            $config['allowed_types'] = 'jpg|png';
 	       // Load library upload & helper
 	       $this->load->library('upload', $config);
 	       $this->load->helper('url');
 	       // Apakah file berhasil diupload?
 	       if ( $this->upload->do_upload('gambar')) {
               // jika berhasil, simpan nama file-nya
               // URL image yang disimpan adalah http://localhost/android_api/uploads/namafile

        	   $img_data = $this->upload->data();
               //-----edit ini------
        	   // $post_image = base_url(). $this->folder_upload .$img_data['file_name'];

               $post_image = $this->folder_upload .$img_data['file_name'];
 	       } else {
 	           // Upload gagal, beri nama image dengan errornya
 	           $post_image = $this->upload->display_errors();        
 	       }
 	   } else {
 	       // Tidak ada file yang di-upload, kosongkan nama image-nya
 	       $post_image = '';
 	   }
 	   return $post_image;
    }
}
