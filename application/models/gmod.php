<?php

class Gmod extends CI_Model {

	var $data;
	
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	//Last Number
	public function last_number($table)	{
		$numbered = $this->db->count_all_results('table'); return $numbered; }

	public function last_number_where($table,$row,$where)	{
		$this->db->where($row, $where); $numbered = $this->db->count_all_results('table'); return $numbered; }

	//Number Format
	public function n_format($number)	{
		$numbered = number_format(($number), 0, '', '.'); return $numbered; }

	public function rp_format($number)	{
		$numbered = number_format(($number), 0, '', '.'); return 'Rp '.$numbered.',-'; }

	public function dec_format($number,$decimal)	{
		$numbered = number_format(($number), $decimal, ',', '.');; return $numbered; }

	//Encrypt & Decrypt Kode
	public function encrypt_to($pass,$id)	{
		$key = md5($pass, true); $encrypted_id= encrypt($id, $key); return $encrypted_id; }

	public function decrypt_from($pass,$encrypted_id)	{
		$key= md5($pass, true); $id= decrypt($encrypted_id, $key); return $id; }

	//Pencarian data
	public function get_result($table) {
		$d = $this->db->get_where($table,array('deleted'=>'0')); $hasil = $d->result(); return $hasil; }

	public function get_result_array($table) {
		$d = $this->db->get_where($table,array('deleted'=>'0')); $hasil = $d->result_array(); return $hasil; }

	public function data($table,$row,$id) {
		$d = $this->db->get_where($table, array('id' => $id)); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->$row;} }else{ $hasil = ''; } return $hasil; }

	public function data_max($table,$row,$law,$id) {
		$this->db->select_avg($row); $hasil = $this->db->get_where($table, array($law => $id)); return $hasil; }

	public function warna($warna){
		switch ($warna){
			case 1: return "red"; break;
			case 2: return "yellow"; break;
			case 3: return "blue"; break;
			case 4: return "green";	break;
			case 5: return "orange"; break;
			case 6: return "purple"; break;
			case 7: return "fuchsia"; break;
			case 8: return "navy"; break;
			case 9: return "aqua"; break;
			case 10: return "lime"; break;
			case 11: return "red"; break;
			case 12: return "yellow"; break;
			case 13: return "blue"; break;
			case 14: return "green";	break;
			case 15: return "orange"; break;
			case 16: return "purple"; break;
			case 17: return "fuchsia"; break;
			case 18: return "navy"; break;
			case 19: return "aqua"; break;
			case 20: return "lime"; break;
			case 21: return "red"; break;
			case 22: return "yellow"; break;
			case 23: return "blue"; break;
			case 24: return "green";	break;
			case 25: return "orange"; break;
			case 26: return "purple"; break;
			case 27: return "fuchsia"; break;
			case 28: return "navy"; break;
			case 29: return "aqua"; break;
			case 30: return "lime"; break;
		}
	} 
	
}
