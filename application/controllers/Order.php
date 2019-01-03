<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Order extends CI_Controller {

    

    public function __construct() {

        parent::__construct();

        $this->load->model('Mdl_order');

        $this->auth->restrict();

        date_default_timezone_set("Asia/Jakarta");

        $this->load->library("session");

    }

    

    function index(){

       // $this->mdl_home->getsqurity();

        $data['view_file']    = "moduls/order";

        $this->load->view('admin_view',$data);

    }

    

    public function ajax_list() {

        $list = $this->Mdl_order->get_datatables();

        $data = array();

        $no = $_REQUEST['start'];

        foreach ($list as $produk) {



            if($produk->fc_status_kirim == 1){

                $status = "Belum melakukan pembayaran, Silahkan lakukan pembayaran";

            }

            elseif($produk->fc_status_kirim == 2){

                $status = "Menunggu Konfirmasi admin, silahkan tunggu selama 2x24 jam";

            }

            elseif($produk->fc_status_kirim == 3){

                $status = "Admin telah menghubungi penjual untuk segera mengirim pesanan";

            }

            elseif($produk->fc_status_kirim == 4){

                $status = "Penjual Telah mengirim pesanan";

            }

            elseif($produk->fc_status_kirim == 5){

                $status = "Pesanan telah diterima pembeli,terima kasih";

            }else{

                $status = "Pesanan telah lunas";

            }



            $no++;

            $row = array();

            $row[] = '';

            $row[] = $no;

            $row[] = $produk->fc_kdorder;

            $row[] = $produk->fd_tgl_order;

            $row[] = $produk->fm_total;

            $row[] = $produk->fv_nama_order;

            $row[] = $produk->fv_alamat_order;

            $row[] = $produk->fc_telp;

            $row[] = $status;

            $row[] = '

            <a href="javascript:void(0)" onclick="edit('."'".$produk->fc_kdorder."'".')">

                            <button class="btn btn-white btn-info btn-bold">

                                <i class="ace-icon fa fa-pencil bigger-120 blue"></i>

                            </button>

                        </a>';

            $data[] = $row;

        }



        $output = array(

                        "draw" => $_REQUEST['draw'],

                        "recordsTotal" => $this->Mdl_order->count_all(),

                        "recordsFiltered" => $this->Mdl_order->count_filtered(),

                        "data" => $data,

                );

        echo json_encode($output);

    }



    public function ajax_edit_status($id) {

        $data = $this->Mdl_order->get_by_id($id);

     //  print_r($this->db->last_query());

        echo json_encode($data);

    }



    public function ajax_update_status() {

        $data = array(

                'fc_status_kirim'              => $this->input->post('fc_status_kirim'),

            );

            

      

        $this->Mdl_order->update_status($this->input->post('fc_kdorder'), $data);

        

        

        //print_r($this->db->last_query());

        echo json_encode(array("status" => TRUE));

    }



   function detail_order($id){

        $data['order']     = $this->db->query("SELECT * FROM `tm_order` WHERE fc_kdorder='$id'")->result_array();

        $data['detail_order']  = $this->db->query("SELECT * FROM td_order d, td_barang p WHERE d.fc_kdorder='$id' AND d.fc_kdbarang = p.fc_kdbarang ")->result_array();

        $data['konfirmasi']    = $this->db->query("SELECT * FROM td_konfirmasi_bayar WHERE fc_kdorder='$id' LIMIT 1")->result_array();

        $data['id_order']      = $id;

        $data['detail_order2']     = $this->db->query("SELECT * FROM td_order d, td_barang p WHERE d.fc_kdorder='$id' AND d.fc_kdbarang = p.fc_kdbarang ")->result_array();

        $data['view_file']    = "moduls/detail_order2";

        $this->load->view('admin_view',$data);

    }

}   