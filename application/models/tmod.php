<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmod extends CI_Model { 

	//Konversi jam
	public function ambilTime($tgl){
		$exp = explode(' ',$tgl); $time = $exp[1]; return $time;	}
	
	public function ambilJamMenit($jam){
		$exp = explode(':',$jam); if(count($exp) == 3) { $jm = $exp[0].':'.$exp[1]; } return $jm;	}
	
	//Konversi tanggal
	public function ambilDate($tgl){
		$exp = explode(' ',$tgl); $date = $exp[0]; return $date;	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl); $bln = $exp[2]; return $bln;	}
		
	public function ambilBln($tgl){
		$exp = explode('-',$tgl); $bln = $exp[1]; return $bln;	}
	
	public function ambilBlnRmw($tgl){
		$exp = explode('-',$tgl); $bln = $exp[1]; $blnrmw = $this->tmod->getRomawi($bln); return $blnrmw;	}
	
	public function ambilThn($tgl){
		$exp = explode('-',$tgl); $thn = $exp[0]; return $thn;	}
		
	public function ambilBlnThn($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1]; } return $date;	}
	
	public function thn_bln($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$bln = $this->tmod->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tahun.'-'.$bulan.' / '.$bln.' '.$tahun;		 
	}	

	public function datetime_tgl($datetime){
		$date = $this->tmod->ambilDate($datetime) ; $exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1].'-'.$exp[0]; } return $date;	}

	public function datetime_jam($datetime){
		$jam = $this->tmod->ambilTime($datetime) ; 
		$exp = explode(':',$jam); if(count($exp) == 3) { $jam = $exp[0].':'.$exp[1]; } return $jam;	}

		public function tgl_msql($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1].'-'.$exp[0]; } return $date;	}
		
	public function tgl_mstr($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1].'-'.$exp[0]; } return $date;	}
	
	public function tgl_ssql($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[0].'/'.$exp[1].'/'.$exp[2]; } return $date;	}
	
	public function tgl_sstr($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'/'.$exp[1].'/'.$exp[0]; } return $date;	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->tmod->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1:	return "Januari"; break; case 2: return "Februari"; break; case 3:	return "Maret"; break;
			case 4:	return "April";	break; case 5:	return "Mei"; break; case 6:	return "Juni"; break;
			case 7:	return "Juli"; break; case 8:	return "Agustus"; break; case 9:	return "September"; break;
			case 10: return "Oktober"; break; case 11: return "November"; break; case 12: return "Desember"; break;
		}
	} 
	
	public function tgl_singkatan($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->tmod->getBln(substr($tgl,5,2));
			$tahun = substr($tgl,2,2);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function bln_singkatan($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->tmod->getBln(substr($tgl,5,2));
			$tahun = substr($tgl,2,2);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBln($bln){
		switch ($bln){
			case 1:	return "Jan"; break; case 2: return "Feb"; break; case 3:	return "Mar"; break;
			case 4:	return "Apr";	break; case 5:	return "Mei"; break; case 6:	return "Jun"; break;
			case 7:	return "Jul"; break; case 8:	return "Aug"; break; case 9:	return "Sep"; break;
			case 10: return "Okt"; break; case 11: return "Nov"; break; case 12: return "Des"; break;
		}
	} 
	
	public function tgl_inggris($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->tmod->getMount(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $bulan.' '.$tanggal.', '.$tahun.' '.$jam;		 
	}	

	public function getMount($bln){
		switch ($bln){
			case 1:	return "January"; break; case 2: return "February"; break; case 3:	return "Maret"; break;
			case 4:	return "April";	break; case 5:	return "Mei"; break; case 6:	return "Juni"; break;
			case 7:	return "Juli"; break; case 8:	return "August"; break; case 9:	return "September"; break;
			case 10: return "Oktober"; break; case 11: return "November"; break; case 12: return "Desember"; break;
		}
	} 
	
	public function getRomawi($bln){
		switch ($bln){
			case 1:	return "I"; break; case 2: return "II"; break; case 3:	return "III"; break; case 4:	return "IV";	break;
			case 5:	return "V"; break; case 6:	return "VI"; break; case 7:	return "VII"; break; case 8:	return "VIII"; break;
			case 9:	return "IX"; break; case 10: return "X"; break; case 11: return "XI"; break; case 12: return "XII"; break;
		}
	} 
	
	public function hari($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$day = date('D', strtotime($hari));
		$dayList = array(
			'Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu',
			'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}
	
}
