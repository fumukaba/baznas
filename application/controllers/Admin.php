<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Admin extends CI_Controller {



	public function __construct() {

		parent::__construct();

		$this->load->model('Mdl_administrator');
		$this->load->model('Mdl_administrator2');

		$this->load->model('Mdl_produk');

		$this->load->model('Mdl_gallery');

		$this->auth->restrict();

		date_default_timezone_set("Asia/Jakarta");

		$this->load->library("session");

	}



// Load View

    //public function index() { $this->load->view('admin_view'); }



// Pilih Modul Menu

	public function modul($modul) {

        if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Menu.'); redirect('admin');}

		$data['level']        = $this->Mdl_user->get_level();

		$data['produk']       = $this->Mdl_produk->get_produk();

		$data['album']        = $this->Mdl_gallery->get_album();

		$this->load->view('moduls/'.$modul, $data);	

	}

	

	

	function user_setup(){

		$data['view_file']    = "moduls/setup_user";

		$this->load->view('admin_view',$data);

	}



	function update_set(){

		$nim = $this->session->userdata('id_user');

		$nama = $this->session->userdata('nama');

		$password = $this->session->userdata('password');

		$username = $this->input->post('a1');

		$pwlama = $this->input->post('a2');

		$pwbaru= $this->input->post('a3');

		$pwulang = $this->input->post('a4');

		$md5lama=md5($pwlama);

		$passbaru= md5($pwbaru);

		$passe= $pwbaru;

		$enc=md5($passbaru);

		if ($pwbaru==$pwulang){

			if($password==$md5lama){

				if($nim!=''&&$password!=''&&$md5lama!=''&&$pwbaru!=''){

					$data = array(

								'id_user'   => $username,

				        'password'   => $passbaru,

				        'view_password' => $pwbaru

				      );

				    $this->Mdl_administrator->update(array('id_user' => $this->session->userdata('id_user')), $data);

				    echo "<script language='javascript' >alert('Sukses!!'); document.location=''</script>";

				}else{

					echo "<script language='javascript' >alert('Error Coba Cek !!'); document.location=''</script>";

				}

			}else{

				echo "<script language='javascript' >alert('Password Lama Tidak Sesuai!!'); document.location=''</script>";

			}

		}else{

			echo "<script language='javascript' >alert('Kedua Password Baru Tidak Sama!!'); document.location=''</script>";

		}

		if($data==true){

		$this->session->set_flashdata("pesan","<h3 class='content-box-header bg-primary' id='pesan'> <i class='glyph-icon icon-envelope'></i>&nbsp;&nbsp;&nbsp;Password Baru Anda Adalah : $pwbaru<div class='header-buttons-separator'><a href='#' onclick='Batal()' class='icon-separator'><i class='glyph-icon icon-times'></i></a></div></h3>");

		}else{

		$this->session->set_flashdata("pesan","<h3 class='content-box-header bg-danger' id='pesan'> <i class='glyph-icon icon-envelope'></i>&nbsp;&nbsp;&nbsp;Gagal Ganti Password<div class='header-buttons-separator'><a href='#' onclick='Batal()' class='icon-separator'><i class='glyph-icon icon-times'></i></a></div></h3>");

		}

	}





// Load Data Tabel List

	public function data($modul,$deleted) {

        if(!$modul){$this->session->set_userdata('err_msg', 'Anda Harus pilih salah satu Modul.'); redirect('admin');}

		if ($modul=='view_home'){

			$this->load->view('moduls/view_home');

		}else if($modul=='user'){

			$this->load->view('moduls/user');

		}else if($modul=='slider'){

			$this->load->view('moduls/slider');

		}else if($modul=='kontak'){

			$this->load->view('moduls/kontak');

		}else if($modul=='produk'){

			$this->load->view('moduls/produk');

		}else if($modul=='gallery'){

			$this->load->view('moduls/gallery');

		}else if($modul=='produk_det')	{

			$this->load->view('moduls/produk_det');

		}else if($modul=='foto'){

			$this->load->view('moduls/foto');

		}		

	}



	function cek_stok(){
		
		$row= $this->Mdl_administrator->get_cek_stok()->num_rows();
		// print_r($this->db->last_query());
		echo json_encode($row);

	}
	
	
	function cek_voucher(){
		
		$row= $this->Mdl_administrator->get_cek_voucher()->num_rows();
		// print_r($this->db->last_query());
		echo json_encode($row);

	}

	function cek_keranjang(){
		
		$row= $this->Mdl_administrator->get_cek_keranjang()->num_rows();
		// print_r($this->db->last_query());
		echo json_encode($row);

	}

	function show_cart(){

		$cart = $this->Mdl_administrator->get_cek_stok2()->result();

		

		$output = '';



			foreach ($cart as $items) {

				$link = base_url('Order/detail_order/'.$items->fc_kdorder);

				$output .="

					<li>

											<a href='#'>

												<div class='clearfix'>

													<span class='pull-left'>

														<i class='btn btn-xs no-hover btn-success fa fa-shopping-cart'></i>

																<a href=".$link.">".$items->fc_kdorder."</a>

													</span>

												</div>

											</a>

										</li>

				";

			}	

			return $output;

	}

    function show_voucher(){

		$cart = $this->Mdl_administrator->get_cek_voucher()->result();

		

		$output = '';



			foreach ($cart as $items) {

				$link = base_url('Admin/batal_voucher/'.$items->fc_id_voucher);

				$output .="

					<li>

											<a href='#'>

												<div class='clearfix'>

													<span class='pull-left'>

														<i class='btn btn-xs no-hover btn-success fa fa-briefcase'></i>

																<a href=".$link.">".$items->f_kode_voucher."</a>

													</span>

												</div>

											</a>

										</li>

				";

			}	

			return $output;

	}

	function show_keranjang(){

		$cart = $this->Mdl_administrator->get_cek_keranjang()->result();

		

		$output = '';



			foreach ($cart as $items) {

				$link = base_url('Admin/batal_keranjang/'.$items->fc_kdkeranjang_belanja);

				$output .="

					<li>

											<a href='#'>

												<div class='clearfix'>

													<span class='pull-left'>

														<i class='btn btn-xs no-hover btn-success fa fa-briefcase'></i>

																<a href=".$link.">".$items->fc_kdkeranjang_belanja."</a>

													</span>

												</div>

											</a>

										</li>

				";

			}	

			return $output;

	}
	
	function batal_voucher($id){
	        $data = array(
					'fc_status' => '1'

			);
			$this->Mdl_administrator->update_voucher($id,$data);
			//print_r($this->db->last_query());
	    	redirect('Dashboard','refresh');
	}

	function batal_keranjang($id){
		//$data['data_keranjang'] = $this->Mdl_administrator->cek_keranjang($id)->row();
		$data['view_file']    = "moduls/detail_keranjang";

        $this->load->view('admin_view',$data);
	}

	function load_cart(){ //load data cart

		echo $this->show_cart();

	}

    function load_voucher(){
        echo $this->show_voucher();
    }

    function load_keranjang(){
        echo $this->show_keranjang();
    }

	function update_notif(){
		 $query = $this->db->query('update tm_order set fc_status_notif="1" where fc_status_notif="0"');
		 print_r($this->db->last_query());
	}

	 public function ajax_list() {
        $kode = $this->uri->segment(3);
        $list = $this->Mdl_administrator2->get_datatables($kode);
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
            for ($i=1; $i <= $produk->fn_jumlah_produk ; $i++) { 
                    if($i == $produk->fn_jumlah_produk){
                    
                        $tengah =$tengah.'<option selected value="'.$i.'">'.$i.'</option>';
                      
                    }
                    else{
                    
                        $tengah = $tengah.'<option value="'.$i.'">'.$i.'</option>';
                      
                    }
                  }
            $row[] = $awal.$tengah.$akhir;
            $row[] = $produk->fm_harga_produk;
            $row[] = $produk->fm_subtotal_belanja;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_REQUEST['draw'],
                        "recordsTotal" => $this->Mdl_administrator2->count_all($kode),
                        "recordsFiltered" => $this->Mdl_administrator2->count_filtered($kode),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    function generate_act(){
    	$kode_barang = $this->input->post('kode_barang');
            $kode_gudange = $this->input->post('kode_gudang');
            $id_produk = $this->input->post('fc_kdbarang');
            $kode_gudang = $this->input->post('fc_kdgudang');
            $id_ordere = $this->input->post('fc_kdkeranjang_belanja');
            $quantity = $this->input->post('quantity');

            foreach ($id_produk as $id) {
              $where = array(
                'fc_kdkeranjang_belanja'  => $id_ordere,
                'fc_kdbarang'       => $id
              );

              $cek_q = $this->Mdl_administrator2->get_table_where('td_keranjang_belanja', $where);

              $ambil_data_qty = $this->Mdl_administrator2->get_table_where('td_stok_barang_gudang', array('fc_kdbarang' => $cek_q[0]['fc_kdbarang'] , 'fc_kdgudang' => $cek_q[0]['fc_kdgudang']));
              // print_r($this->db->last_query());
              $quantity_update = $ambil_data_qty[0]['fc_qty_barang'] + $cek_q[0]['fn_jumlah_produk'];

              $data_qty = array(
                'fc_qty_barang' => $quantity_update,
              );

              $update_qty = $this->Mdl_administrator2->update_table('td_stok_barang_gudang',$data_qty, array('fc_kdbarang' => $cek_q[0]['fc_kdbarang']  , 'fc_kdgudang' => $cek_q[0]['fc_kdgudang']));
              print_r($this->db->last_query());
            }

              $delete_keranjang = $this->db->query('delete from td_keranjang_belanja where fc_kdkeranjang_belanja="'.$id_ordere.'"');  
    }

}

