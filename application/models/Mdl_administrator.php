<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mdl_administrator extends CI_Model {

	

	var $table = 'user';

	

	

	

	public function update($where, $data) {

		$this->db->update($this->table, $data, $where);

		return $this->db->affected_rows();

	}



	function get_cek_stok(){
		$date = date('Y-m-d H:i:s');
		return $this->db->where('fd_tgl_exp <=',$date)
						->where('fc_status_kirim','1')
						->where('fc_visitor','user')
		   				->get('tm_order');

	}



	function get_cek_stok2(){
		$date = date('Y-m-d H:i:s');
		return $this->db->where('fd_tgl_exp <=',$date)
						->where('fc_status_kirim','1')
						->where('fc_visitor','user')
		   				->get('tm_order');

	}

	function get_cek_voucher(){
		$date = date('Y-m-d');
		return $this->db->where('fd_tgl_exp_voucher <=',$date)
		                ->where('fc_status','0')
		                
		   				->get('tm_voucher');

	}


	function get_cek_keranjang(){
		$date = date('Y-m-d H:i:s');
		return $this->db->where('fd_exp_date <=',$date)
		   				->get('td_keranjang_belanja');

	}

	function cek_keranjang($id){
		return $this->db->select('a.*,b.*')
						->from('td_keranjang_belanja a')
						->join('td_barang b','b.fc_kdbarang=a.fc_kdbarang')
						->where('fc_kdkeranjang_belanja ',$ids);
	}

    function update_voucher($id,$data) {
		$this->db->where('fc_id_voucher', $id);
		$this->db->update('tm_voucher', $data);
	}

}