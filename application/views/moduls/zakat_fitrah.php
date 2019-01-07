<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

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

<div id="idImgLoader" style="margin: 0 auto; text-align: center;">

	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />

</div>

<div id="data" style="display:none;">

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

<div class="box-header">

	<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>

	<button class="btn btn-danger" onclick="Tambah()"><i class="fa fa-plus"></i> Tambah Data</button>

</div><br />

<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">

    <thead>

        <tr>
        	<th></th>
            <th>No.</th>

            <th>Pengirim</th>

             <th>Jumlah</th>
             <th>Tanggal</th>
             <th>Status</th>
             <th>Uang</th>

            <th>Aksi</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>

</div><!-- /.span -->

</div>					

</div><!-- /.row -->

</div>

</div>

</div>



<script>

	var save_method;

	var link = "<?php echo site_url('Zakat_fitrah')?>";

	var table;

	$(document).ready(function(){

      //$('#idImgLoader').show(2000);

	  $('#idImgLoader').fadeOut(2000);

	  setTimeout(function(){

            data();

      }, 2000);

	  setTimeout(function(){

            ckeditor();

      }, 2000);

	//   setTimeout(function(){
	// 	reload_table();
	//   }, 5000)

    });

	

	function ckeditor(){

		tinymce.init({

			selector: "textarea"

		});

	}

	

	function data(){

		$('#data').fadeIn();

	}

	

	$(document).ready(function() {

		table = $('#example').DataTable({ 



        "processing": true, //Feature control the processing indicator.

        "serverSide": true, 

        "order": [], //Initial no order.



        // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('Zakat_fitrah/ajax_list')?>",

            "type": "POST"

        },



        //Set column definition initialisation properties.

       responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'asc' ]



    });

	

	});

	

	function reload_table() {

    	table.ajax.reload(null, false);

	}



	function Tambah() {

		save_method = 'add'; 

		$('#panel-data').fadeOut('slow');

		$('#form-data').fadeIn('slow'); 

		//document.getElementById('formAksi').reset();

	}

	

	// function save() {

	// 		$('#btn_save').text('Saving...');

	// 		$('#btn_save').attr('disabled', true);



	// 		var url;

	// 		if (save_method == 'add') {

	// 			url = "<?php echo site_url('Zakat_fitrah')?>/ajax_add";

	// 		} else {

	// 			url = "<?php echo site_url('Zakat_fitrah')?>/ajax_update"; 

	// 		}

			

	// 		tinyMCE.triggerSave();

	// 		$.ajax({

	// 			url: url,

	// 			type: "POST",

	// 			data: $('#formAksi').serialize(),

	// 			dataType: "JSON",

	// 			success: function(result) {
    //                 console.log(result);
	// 				// if (result.status) {

						

	// 				// 		setTimeout(function(){

	// 				// 			Batal();

	// 				// 		}, 1000);

						

	// 				// 	setTimeout(function(){

	// 				// 		reload_table();

	// 				// 	}, 1000);

	// 				// }

	// 				// setTimeout(function(){

	// 				// 	$('#btn_save').text('Save');

	// 				// 	$('#btn_save').attr('disabled', false);

	// 				// 	document.getElementById('formAksi').reset();

	// 				// }, 1000);

	// 				// swal_berhasil(); 

	// 				// setTimeout(function(){

	// 				// 		reload_table();

	// 				// }, 1000);

	// 			}, error: function(jqXHR, textStatus, errorThrown) {

	// 				// alert('Error adding/update data');

	// 				swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 

	// 				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);  

	// 			}

	// 		});

	// }

	

	function Batal() { 

		$('#form-data').slideUp(500,'swing');

		$('#panel-data').fadeIn(1000); 

	}

	

	function edit(id) {

			save_method = 'update';

			$('#panel-data').fadeOut('slow');

			$('#form-data').fadeIn('slow');

			document.getElementById('formAksi').reset();

			$.ajax({

				url : "<?php echo site_url('Zakat_fitrah')?>/ajax_edit/"+id,

				type: "GET",

				dataType: "JSON",

				success: function(result) {  

					//document.getElementById('fc_kdbahan').setAttribute('readonly','readonly');

					$('[name="id_zakat_fitrah"]').val(result.id_zakat_fitrah);
					$('[name="ostatus_zakat"]').val(result.status_zakat);

					$('[name="nama_pengirim"]').val(result.nama_pengirim);

					$('[name="bank_pengirim"]').val(result.bank_pengirim);

					$('[name="pemilik_rekening"]').val(result.pemilik_rekening);

                    $('[name="norek_pengirim"]').val(result.norek_pengirim);

                    $('[name="jumlah_orang"]').val(result.jumlah_orang);

                    $('[name="total_zakat"]').val(result.total_zakat);

                    $('[name="tanggal_zakat"]').val(result.tanggal_zakat);

                    if(result.status_zakat == 'Menunggu Konfirmasi') {
                        $('#status_zakat .c1').attr('selected', 'selected');
                    } else if(result.status_zakat == 'Valid') {
                        $('#status_zakat .c2').attr('selected', 'selected');
                    } else if(result.status_zakat == 'Tidak Valid') {
                        $('#status_zakat .c3').attr('selected', 'selected');
                    }

                    if(result.status_uang_zakat == 'Belum Dikirim') {
                        $('#status_uang_zakat .c1').attr('selected', 'selected');
                    } else if(result.status_uang_zakat == 'Sudah Dikirim') {
                        $('#status_uang_zakat .c2').attr('selected', 'selected');
                    }

                    var _classess = ".c" + result.id_zis;
					$('#id_zis ' + _classess).attr('selected', 'selected');

					// console.log(_classess);

				}, error: function (jqXHR, textStatus, errorThrown) {

					alert('Error get data from ajax');

				}

			});

	}

	

	function hapus(id) {

		if (confirm('Are you sure delete this data?')) {

			$.ajax ({

				url : "<?php echo site_url('Zakat_fitrah/ajax_delete')?>/"+id,

				type: "POST",

				dataType: "JSON",

				success: function(data) {

					setTimeout(function(){

                        Batal();

                    }, 1000);

					

					setTimeout(function(){

                        reload_table();

					}, 1000);

					swal_berhasil(); 

				}, error: function (jqXHR, textStatus, errorThrown) {

					swal({ title:"ERROR", text:"Error delete data", type: "warning", closeOnConfirm: true}); 

					$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 

				}

			});

		}

	}

</script>	



<div class="row">

<div class="col-xs-12">

<div id="form-data" style="display:none;">

<div class="widget-box">

<div class="widget-header">

		<h4 class="widget-title">Tambah Zakat Fitrah</h4>



	<div class="widget-toolbar">

		<a href="#" data-action="collapse">

			<i class="ace-icon fa fa-chevron-up"></i>

		</a>



		<a onclick="Batal()" data-action="close">

			<i class="ace-icon fa fa-times"></i>

		</a>

	</div>

	</div>



<div class="widget-body">

<div class="widget-main">

<div class="row">

<div class="col-xs-12">

<form class="form-horizontal" role="form" method="POST" id="formAksi" enctype="multipart/form-data">

	 <input type="hidden" name="id_zakat_fitrah">
	 <input type="hidden" name="ostatus_zakat">

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Muzakki </label>

		<div class="col-sm-10">

			<input type="text" id="nama_pengirim" name="nama_pengirim" placeholder="Nama Muzakki" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bank Pengirim </label>

		<div class="col-sm-10">

        <input type="text" id="bank_pengirim" name="bank_pengirim" placeholder="Bank Pengirim" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Pemilik Rekening </label>

		<div class="col-sm-10">

        <input type="text" id="pemilik_rekening" name="pemilik_rekening" placeholder="Pemilik Rekening" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nomor Rekening </label>

		<div class="col-sm-10">

			<input type="text" id="norek_pengirim" name="norek_pengirim" placeholder="Nomor Rekening" class="col-xs-10 col-sm-5" />

		</div>

	</div>

    <?php
        $cek_harga = $this->db->query("SELECT * FROM tb_setting WHERE meta_key = 'nominal_zakat_fitrah' ORDER BY tahun DESC LIMIT 0, 1")->result_array();
    ?>
    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jumlah Orang </label>

		<div class="col-sm-10">

			<input type="number" id="jumlah_orang" name="jumlah_orang" data-harga="<?php echo $cek_harga[0]['meta_value']; ?>" placeholder="Jumlah Orang" class="col-xs-10 col-sm-5" min="1" value="1" step="1" />

		</div>

	</div>
    
    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Total Zakat </label>

		<div class="col-sm-10">

			<input type="text" readonly="readonly" id="total_zakat" name="total_zakat" placeholder="Total Zakat" class="col-xs-10 col-sm-5" value="<?php echo $cek_harga[0]['meta_value']; ?>" />

		</div>

	</div>

    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tanggal </label>

		<div class="col-sm-10">

			<input type="text" id="tanggal_zakat" name="tanggal_zakat" placeholder="Contoh: 2018-12-31 20:15:00" class="col-xs-10 col-sm-5" />

		</div>

	</div>

    <div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Zakat </label>
		<div class="col-sm-4">
			<select name="status_zakat" id="status_zakat" class="form-control">
                <option class="c1" value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                <option class="c2" value="Valid">Valid</option>
                <option class="c3" value="Tidak Valid">Tidak Valid</option>
            </select>
		</div>
	</div>

    <div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Uang </label>
		<div class="col-sm-4">
			<select name="status_uang_zakat" id="status_uang_zakat" class="form-control">
                <option class="c1" value="Kas Baznas">Kas Baznas</option>
                <option class="c2" value="Sudah Terdistribusi">Sudah Terdistribusi</option>
            </select>
		</div>
	</div>

    <div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bukti Transfer </label>
		<div class="col-sm-10">
			<input type="file" id="bukti_zakat" name="bukti_zakat" placeholder="Foto" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tempat ZIS </label>
		<div class="col-sm-4">
			<select name="id_zis" id="id_zis" class="form-control">
			<?php 
            $zis = $this->db->query("SELECT * FROM tb_zis");
			foreach($zis->result() as $row_kat)	{	?>
				<option class="c<?php echo $row_kat->id_zis; ?>" value="<?php echo $row_kat->id_zis?>"><?php echo $row_kat->nama_zis; ?></option>
			<?php } ?>
			</select>
		</div>
	</div>

	<div class="col-md-offset-2 col-md-9">

				<button class="btn btn-info" type="submit" id="btn_save">

					<i class="ace-icon fa fa-check bigger-110"></i>

					Submit

				</button>



				&nbsp; &nbsp; &nbsp;

				<button class="btn" type="reset">

				<i class="ace-icon fa fa-undo bigger-110"></i>

					Reset

				</button>

	</div>

</form>

</div>

</div>

</div>					

</div><!-- /.row -->

</div>

</div><!-- /.row -->

</div>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	$(document).ready(function(e){
        $('#jumlah_orang').on('change', (function() {
            var jumlah = $(this).val(),
                harga = $(this).data('harga');

            var total = jumlah * harga;

            $('#total_zakat').val(total);
        }))
        
		$("#formAksi").on('submit', function(e){
			e.preventDefault();

			$('#btn_save').text('Saving...');
			$('#btn_save').attr('disabled', true);

			var url;
			if (save_method == 'add') {
				url = "<?php echo site_url('Zakat_fitrah')?>/ajax_add";
			} else {
				url = "<?php echo site_url('Zakat_fitrah')?>/ajax_update"; 
			}

			$.ajax({
				type: 'POST',
				url: url,
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
				},
				success: function(result) {
                    if (result.status) {
						
							setTimeout(function(){
								Batal();
							}, 1000);
						
						setTimeout(function(){
							reload_table();
						}, 1000);
					}
					setTimeout(function(){
						$('#btn_save').text('Save');
						$('#btn_save').attr('disabled', false);
						document.getElementById('formAksi').reset();
					}, 1000);
					swal_berhasil(); 
					setTimeout(function(){
							reload_table();
					}, 1000);
				}, error: function(jqXHR, textStatus, errorThrown) {
					// alert('Error adding/update data');
					swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 
					$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);  
				}
			});
		});
	});
</script>