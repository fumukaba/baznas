<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
 <script src="<?php echo base_url('assets/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
 <link rel="stylesheet" href="<?php echo base_url('assets/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">
  
 <style type="text/css">  
 	
 	td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
	}
 </style>
<?php $title = "<i class='fa fa-money'></i>&nbsp;Zakat Fitrah"; ?>

<div id="data">

<section class="content">

<div class="page-header">

	<h1>

		<?php echo $title;?>

	</h1>

</div><!-- /.page-header -->



<div id="panel-data">

<div class="widget-box">

<div class="widget-header">



	<div class="widget-toolbar">

		<a href="#" data-action="collapse">

			<i class="ace-icon fa fa-chevron-up"></i>

		</a>



		<a href="#" data-action="close">

			<i class="ace-icon fa fa-times"></i>

		</a>

	</div>

	</div>



<div class="widget-body">

<div class="widget-main">

<div class="row">

<div class="col-xs-12">

<div class="box-header" style="padding-bottom: 70px;">

    <form action="<?php echo base_url(); ?>Import_fitrah/index" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="col-md-6">
                <label for="">File Excel (.xlsx)</label>
                <input type="file" class="form-control" name="file_excel" required="required">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary" name="import">Preview</button>
            </div>
        </div>
    </form>
    
</div><br />

<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">

    <thead>

        <tr>
            <th>No.</th>

            <th>Pengirim</th>
             <th>Telp Pengirim</th>
			 <th>Total Uang</th>
             <th>Tanggal</th>
             <th>Tujuan</th>

        </tr>

    </thead>

    <tbody>
    <?php
        $numrow = 1;
        $kosong = 0;
        $data = array();
		
		// Lakukan perulangan dari data yang ada di excel
        // $sheet adalah variabel yang dikirim dari controller
        if(isset($sheet)) {
            $i = 1;
		foreach($sheet as $row){ 
			// Ambil data pada excel sesuai Kolom
			$tanggal = $row['A']; // Ambil data NIS
			$zis = $row['B']; // Ambil data nama
			$tempat = $row['C']; // Ambil data jenis kelamin
            $pengirim = $row['D']; // Ambil data alamat
            $kontak = $row['E'];
            $jumlah = $row['F'];
			
			// Cek jika semua data tidak diisi
			if(empty($tanggal) && empty($zis) && empty($tempat) && empty($pengirim) && empty($kontak) && empty($jumlah))
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1 && $zis == 'Zakat Fitrah'){
                array_push($data, array('nama_pengirim' => $pengirim, 'telp_pengirim' => $kontak, 'total_zakat' => $jumlah, 'tanggal_zakat' => $tanggal, 'nama_zis' => $tempat));
				// Validasi apakah semua data telah diisi
				$tanggal_td = ( ! empty($tanggal))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
				$tempat_td = ( ! empty($tempat))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
				$pengirim_td = ( ! empty($pengirim))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                $kontak_td = ( ! empty($kontak))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                $jumlah_td = ( ! empty($jumlah))? "" : " style='background: #E07171;'";
				
				// Jika salah satu data ada yang kosong
				if(empty($tanggal) || empty($zis) || empty($tempat) || empty($pengirim) || empty($kontak) || empty($jumlah)){
					$kosong++; // Tambah 1 variabel $kosong
				}
				
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
				echo "<td".$pengirim_td.">".$pengirim."</td>";
				echo "<td".$kontak_td.">".$kontak."</td>";
				echo "<td".$jumlah_td.">".$jumlah."</td>";
                echo "<td".$tanggal_td.">".$tanggal."</td>";
                echo "<td".$tempat_td.">".$tempat."</td>";
				echo "</tr>";
			}
			
			$numrow++; // Tambah 1 setiap kali looping
        }
        }
    ?>
    </tbody>

</table>

<?php if(isset($sheet)) { ?>
<form action="<?php echo base_url(); ?>Import_fitrah/import" method="POST" style="padding-top: 20px;">
    <div class="form-row">
        <textarea name="data" readonly="readonly" style="display: none;" cols="30" rows="10"><?php echo json_encode($data); ?></textarea>
        <div class="col-md-6">
            <button type="submit" class="btn btn-success" name="import">Import</button>
        </div>
    </div>
</form>
<?php } ?>

</div><!-- /.span -->

</div>					

</div><!-- /.row -->

</div>

</div>

</div>	
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('document').ready(function() {
        $('#example').DataTable();
    })
</script>