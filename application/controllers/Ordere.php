<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordere extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_ordere');
        $this->auth->restrict();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->library("session");
    }
    
    
    public function ajax_list() {
        $kode = $this->uri->segment(3);
        $list = $this->Mdl_ordere->get_datatables($kode);
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = '';
            $row[] = '
            <input type="hidden" name="kode_barang" value="'.$produk->fc_kdbarang.'">
            <input type="hidden" name="kode_gudang" value="'.$produk->fc_kdgudang.'">
            <input type="hidden" name="fc_kdbarang['.$produk->fc_kdbarang.']" value="'.$produk->fc_kdbarang.'">
            <input type="hidden" name="fc_kdgudang['.$produk->fc_kdgudang.']" value="'.$produk->fc_kdgudang.'">';
            $row[] = $no;
            $row[] = $produk->fv_nama_barang;
            $awal = '<select class="js-select2" name="quantity['.$produk->fc_kdbarang.']">';
            $akhir = '</select><div class="dropDownSelect2"></div>';
            $tengah = '';
            for ($i=1; $i <= $produk->f_jumlah_produk ; $i++) { 
                    if($i == $produk->f_jumlah_produk){
                    
                        $tengah =$tengah.'<option selected value="'.$i.'">'.$i.'</option>';
                      
                    }
                    else{
                    
                        $tengah = $tengah.'<option value="'.$i.'">'.$i.'</option>';
                      
                    }
                  }
            $row[] = $awal.$tengah.$akhir;
            $row[] = $produk->fm_harga;
            $row[] = $produk->fm_subtotal;
            $row[] = 'Belum Melakukan Pembayaran';
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_REQUEST['draw'],
                        "recordsTotal" => $this->Mdl_ordere->count_all($kode),
                        "recordsFiltered" => $this->Mdl_ordere->count_filtered($kode),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function generate_act(){
            $kode_barang = $this->input->post('kode_barang');
            $kode_gudange = $this->input->post('kode_gudang');
            $id_produk = $this->input->post('fc_kdbarang');
            $kode_gudang = $this->input->post('fc_kdgudang');
            $id_ordere = $this->input->post('fc_kdorder');
            $quantity = $this->input->post('quantity');

            foreach ($id_produk as $id) {
              $where = array(
                'fc_kdorder'  => $id_ordere,
                'fc_kdbarang'       => $id
              );

              $cek_q = $this->Mdl_ordere->get_table_where('td_order', $where);

              $ambil_data_qty = $this->Mdl_ordere->get_table_where('td_stok_barang_gudang', array('fc_kdbarang' => $cek_q[0]['fc_kdbarang'] , 'fc_kdgudang' => $cek_q[0]['fc_kdgudang']));
              // print_r($this->db->last_query());
              $quantity_update = $ambil_data_qty[0]['fc_qty_barang'] + $cek_q[0]['f_jumlah_produk'];

              $data_qty = array(
                'fc_qty_barang' => $quantity_update,
              );

              $update_qty = $this->Mdl_ordere->update_table('td_stok_barang_gudang',$data_qty, array('fc_kdbarang' => $cek_q[0]['fc_kdbarang']  , 'fc_kdgudang' => $cek_q[0]['fc_kdgudang']));
              //print_r($this->db->last_query());
            }
           
            $query = $this->db->query('update tm_order set fc_status_kirim="6" where fc_kdorder="'.$id_ordere.'"');  

            $this->load->library('email');

               $config['charset'] = 'utf-8';
               $config['useragent'] = 'Produk pada pesanan Anda #'.$id_ordere.' telah dibatalkan';
               $config['protocol'] = 'smtp';
               $config['mailtype'] = 'html';
               $config['smtp_host'] = 'ssl://mail.neowoodart.com';
               $config['smtp_port'] = '465';
               $config['smtp_timeout'] = '5';
               $config['smtp_user'] = 'cs@neowoodart.com'; //isi dengan email gmail
               $config['smtp_pass'] = 't@rLF(+46uCl'; //isi dengan password
               $config['crlf'] = "\r\n";
               $config['newline'] = "\r\n";
               $config['wordwrap'] = TRUE;
               $config['charset'] = 'iso-8859-1';


               $this->email->initialize($config);

               $order_email = $this->Mdl_ordere->get_table_where('tm_order', array('fc_kdorder' => $id_ordere));

               $email = $order_email[0]['fv_email_order'];
               $this->email->from('cs@neowoodart.com', "Produk pada pesanan Anda #".$id_ordere." telah dibatalkan");
               $this->email->to($email);
               $this->email->subject('Produk pada pesanan Anda #'.$id_ordere.' telah dibatalkan');

               $data['id_order'] = $id_ordere;

               $data['order']=$this->Mdl_ordere->get_table_where('tm_order', array('fc_kdorder' => $id_ordere));
               $data['detail_order']=$this->Mdl_ordere->get_table_join_where('td_order','td_barang','td_order.fc_kdbarang=td_barang.fc_kdbarang', array('fc_kdorder' => $id_ordere));

               //print_r($this->db->last_query());
               $body = $this->load->view('moduls/email',$data,TRUE);
               $this->email->message($body);
               $this->email->send();

            $delete_keranjang = $this->db->query('delete from td_order where fc_kdorder="'.$id_ordere.'"');  
            $delete_keranjang2 = $this->db->query('delete from tm_order where fc_kdorder="'.$id_ordere.'"');    
        
    }      
}    