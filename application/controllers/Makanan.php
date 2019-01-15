<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Makanan extends REST_Controller {
    // Konfigurasi letak folder untuk upload image
    private $folder_upload = 'uploads/';
    function all_get(){
        $getMakanan = $this->db->query("
            SELECT
                idMakanan,
                menu,
                kategori,
                gambar,
                harga,
                alamat,
                review,
                tanggal,
                suka,
                komentar
            FROM makanan")->result();
       $this->response(
           array(
               "status" => "success",
               "result" => $getMakanan
           )
       );
    }

    function all_post() {
        $action  = $this->post('action');
        $dataMakanan = array(
     	               'idMakanan'  => $this->post('idMakanan'),
     	               'menu'       => $this->post('menu'),
                       'kategori'   => $this->post('kategori'),
     	               'gambar'     => $this->post('gambar'),
     	               'harga'      => $this->post('harga'),
     	               'alamat'     => $this->post('alamat'),
                       'review'     => $this->post('review'),
                       'tanggal'    => $this->post('tanggal'),
                       'suka'       => 0,
                       'komentar'   => 0
 	               );
        switch ($action) {
            case 'insert':
                $this->insertMakanan($dataMakanan);
                break;           
            case 'update':
                $this->updateMakanan($dataMakanan);
                break;           
            case 'delete':
                $this->deleteMakanan($dataMakanan);
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

    function insertMakanan($dataMakanan){
 	   // Cek validasi
 	    if (empty($dataMakanan['menu']) || empty($dataMakanan['kategori']) || empty($dataMakanan['harga']) || empty($dataMakanan['alamat']) || empty($dataMakanan['review']) || empty($dataMakanan['tanggal'])){
 	        $this->response(
 	           array(
 	               "status" => "failed",
 	               "message" => "Mohon Lengkapi Data"
 	           )
 	       );
 	    } else {
 	       $dataMakanan['gambar'] = $this->uploadPhoto();
 	       $do_insert = $this->db->insert('makanan', $dataMakanan);
     	   if ($do_insert){
         	   $this->response(
         	       array(
         	           "status" => "success",
         	           "result" => array($dataMakanan),
         	           "message" => $do_insert
         	       )
         	   );
            }
 	    }
    }

    function updateMakanan($dataMakanan){
 	   // Cek validasi
 	    if (empty($dataMakanan['menu']) || empty($dataMakanan['kategori']) || empty($dataMakanan['harga']) || empty($dataMakanan['alamat']) || empty($dataMakanan['review']) || empty($dataMakanan['tanggal'])){
 	       $this->response(
 	           array(
 	               "status" => "failed",
 	               "message" => "Mohon Lengkapi Data"
 	           )
 	       );
 	    } else {
 	       // Cek apakah ada di database
 	       $getMakanan_baseID = $this->db->query("
 	           SELECT 1
 	           FROM makanan
 	           WHERE idMakanan =  {$dataMakanan['idMakanan']}")->num_rows();
 	        if($getMakanan_baseID === 0){
     	       // Jika tidak ada
     	       $this->response(
     	           array(
     	               "status"  => "failed",
      	               "message" => "ID Makanan tidak ditemukan"
     	           )
     	       );
 	        } else {
 	           $dataMakanan['gambar'] = $this->uploadPhoto();
         	    if ($dataMakanan['gambar']){
         	       // Jika upload foto berhasil, eksekusi update
         	       $update = $this->db->query("
         	           UPDATE makanan SET
         	               menu = '{$dataMakanan['menu']}',
         	               kategori = '{$dataMakanan['kategori']}',
         	               gambar = '{$dataMakanan['gambar']}',
                           harga = '{$dataMakanan['harga']}',
                           alamat = '{$dataMakanan['alamat']}',
                           review = '{$dataMakanan['review']}',
                           tanggal = '{$dataMakanan['tanggal']}'
         	           WHERE idMakanan = '{$dataMakanan['idMakanan']}'");
         	    } else {
         	       // Jika foto kosong atau upload foto tidak berhasil, eksekusi update
                    $update = $this->db->query("
                        UPDATE makanan
                        SET
                            menu = '{$dataMakanan['menu']}',
                            kategori = '{$dataMakanan['kategori']}',
                            harga = '{$dataMakanan['harga']}',
                            alamat = '{$dataMakanan['alamat']}',
                            review = '{$dataMakanan['review']}',
                            tanggal = '{$dataMakanan['tanggal']}'
                        WHERE idMakanan = {$dataMakanan['idMakanan']}"
                    );
         	    }        	  
         	    if ($update){
             	   $this->response(
             	       array(
             	           "status"    => "success",
             	           "result"    => array($dataMakanan),
             	           "message"   => $update
             	       )
             	   );
                }
 	       }   
 	   }
    }

    function deleteMakanan($dataMakanan){
        if (empty($dataMakanan['idMakanan'])){
 	       $this->response(
 	           array(
 	               "status" => "failed",
 	               "message" => "ID Makanan harus diisi"
 	           )
 	       );
 	    } else {
 	       // Cek apakah ada di database
 	       $getMakanan_baseID =$this->db->query("
 	           SELECT 1
 	           FROM makanan
 	           WHERE idMakanan = {$dataMakanan['idMakanan']}")->num_rows();
 	        if($getMakanan_baseID > 0){        
 	           $get_gambar =$this->db->query("
 	           SELECT gambar
 	           FROM makanan
 	           WHERE idMakanan = {$dataMakanan['idMakanan']}")->result(); 	       
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
         	           WHERE idMakanan = {$dataMakanan['idMakanan']}");
         	       $this->response(
         	           array(
         	               "status" => "success",
         	               "message" => "Data ID = " .$dataMakanan['idMakanan']. " berhasil dihapus"
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
