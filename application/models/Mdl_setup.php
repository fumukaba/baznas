<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_setup extends CI_Model {
    
    var $table = 't_setup';
	
	public function get_by_id() {
	
		$query = $this->db->query('select a.fc_isi as set_data1, b.fc_isi as set_data2,c.fc_isi as set_data3,d.fc_isi as set_data4, e.fc_isi as set_data5, f.fc_isi as set_data6, g.fc_isi as set_data7 
			from t_setup a
			left outer join t_setup b on b.fc_param="GAMBAR 1" AND b.fc_kode="2"
			left outer join t_setup c on c.fc_param="GAMBAR 2" AND c.fc_kode="2"
			left outer join t_setup d on d.fc_param="GAMBAR 3" AND d.fc_kode="2"
			left outer join t_setup e on e.fc_param="GAMBAR 1" AND e.fc_kode="1"
			left outer join t_setup f on f.fc_param="GAMBAR 2" AND f.fc_kode="1"
			left outer join t_setup g on g.fc_param="GAMBAR 3" AND g.fc_kode="1"
			where a.fc_param="SEKILAS"
			');
		return $query->row();
	}
	
	public function update_link($data1, $data2) {
		$this->db->update($this->table, $data1, $data2);
		return $this->db->affected_rows();
	}
	

	public function update_banner($data1,$data2, $data3) {
		$this->db->update($this->table, $data1, $data2, $data3);
		return $this->db->affected_rows();
	}
	public function update_data($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}

	public function update_data2($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}

	public function update_data3($data, $data2) {
		$this->db->update($this->table, $data, $data2);
		return $this->db->affected_rows();
	}
}