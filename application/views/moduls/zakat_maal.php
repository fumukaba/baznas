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
<?php $title = "<i class='fa fa-money'></i>&nbsp;Zakat Maal"; ?>

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
            <th>No.</th>

            <th>Pengirim</th>

             <th>Rekening Pengirim</th>
			 <th>Transfer</th>
             <th>Tanggal</th>
             <th>Status</th>
             <th>Uang</th>
			 <th>Bukti Transfer</th>
			<th>Terakhir Diperbarui</th>

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

	var link = "<?php echo site_url('Zakat_maal')?>";

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

            "url": "<?php echo site_url('Zakat_maal/ajax_list')?>",

            "type": "POST"

        },



        //Set column definition initialisation properties.

      
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
		$('#form_status').hide();
		$('#status_uang .c1').attr('selected', 'selected');
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

	// 			url = "<?php echo site_url('maal')?>/ajax_add";

	// 		} else {

	// 			url = "<?php echo site_url('maal')?>/ajax_update"; 

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
			// $('#form_status').show();

			save_method = 'update';

			$('#panel-data').fadeOut('slow');

			$('#form-data').fadeIn('slow');

			document.getElementById('formAksi').reset();

			$.ajax({

				url : "<?php echo site_url('Zakat_maal')?>/ajax_edit/"+id,

				type: "GET",

				dataType: "JSON",

				success: function(result) {  

					//document.getElementById('fc_kdbahan').setAttribute('readonly','readonly');

					$('[name="id_maal"]').val(result.id_maal);
					$('[name="status_maal"]').val(result.status_maal);

					$('[name="nama_pengirim"]').val(result.nama_pengirim);

					$('[name="telp_pengirim"]').val(result.telp_pengirim);

					$('[name="bank_pengirim"]').val(result.bank_pengirim);

					$('[name="pemilik_rekening"]').val(result.pemilik_rekening);

                    $('[name="norek_pengirim"]').val(result.norek_pengirim);

                    $('[name="jumlah_maal"]').val(result.jumlah_maal);

                    $('[name="tanggal_maal"]').val(result.tanggal_maal);

                    // if(result.status_maal == 'Menunggu Konfirmasi') {
                    //     $('#status_maal .c1').attr('selected', 'selected');
                    // } else if(result.status_maal == 'Valid') {
                    //     $('#status_maal .c2').attr('selected', 'selected');
                    // } else if(result.status_maal == 'Tidak Valid') {
                    //     $('#status_maal .c3').attr('selected', 'selected');
                    // }

                    // if(result.status_uang == 'Belum Dikirim') {
                    //     $('#status_uang .c1').attr('selected', 'selected');
                    // } else if(result.status_uang == 'Sudah Dikirim') {
                    //     $('#status_uang .c2').attr('selected', 'selected');
                    // }

					// if(result.jenis_maal == 'Uang') {
                    //     $('#jenis_maal .c1').attr('selected', 'selected');
                    // } else if(result.jenis_maal == 'Emas') {
                    //     $('#jenis_maal .c2').attr('selected', 'selected');
                    // } else if(result.jenis_maal == 'Perdagangan') {
                    //     $('#jenis_maal .c3').attr('selected', 'selected');
					// } else if(result.jenis_maal == 'Pertanian') {
                    //     $('#jenis_maal .c4').attr('selected', 'selected');
					// } else if(result.jenis_maal == 'Pertambangan') {
                    //     $('#jenis_maal .c5').attr('selected', 'selected');
					// }

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

				url : "<?php echo site_url('Zakat_maal/ajax_delete')?>/"+id,

				type: "POST",

				dataType: "JSON",

				success: function(data) {

					setTimeout(function(){

                        Batal();

                    }, 1000);

					

					setTimeout(function(){
						// reload_table();
						document.location.href = '';
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

		<h4 class="widget-title">Tambah Zakat Maal</h4>



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

	 <input type="hidden" name="id_maal">
	 <input type="hidden" name="status_maal">

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Muzaki </label>

		<div class="col-sm-10">

			<input type="text" id="nama_pengirim" name="nama_pengirim" required="required" autocomplete="off" placeholder="Nama Muzaki" class="col-xs-10 col-sm-5" />

		</div>

	</div>

    <div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No Telp. Pengirim </label>
		<div class="col-sm-10">
			<input type="text" id="telp_pengirim" required="required" name="telp_pengirim"  placeholder="No Telp. Pengirim" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bank Pengirim </label>

		<div class="col-sm-10">

        <input type="text" id="bank_pengirim" name="bank_pengirim" required="required" autocomplete="off" placeholder="Bank Pengirim" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Pemilik Rekening </label>

		<div class="col-sm-10">

        <input type="text" id="pemilik_rekening" name="pemilik_rekening" required="required" autocomplete="off" placeholder="Pemilik Rekening" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nomor Rekening </label>

		<div class="col-sm-10">

			<input type="text" id="norek_pengirim" name="norek_pengirim" required="required" autocomplete="off" placeholder="Nomor Rekening" class="col-xs-10 col-sm-5" />

		</div>

	</div>

    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jumlah </label>

		<div class="col-sm-10">

			<input type="number" id="jumlah_maal" name="jumlah_maal" required="required" autocomplete="off" placeholder="Jumlah" class="col-xs-10 col-sm-5" />

		</div>

	</div>

    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1" > Tanggal </label>

		<div class="col-sm-10">

			<input type="text" id="tanggal_maal" name="tanggal_maal" required="required" autocomplete="off" placeholder="Contoh: 2018-12-31 20:15:00" class="col-xs-10 col-sm-5 form_datetime" />

		</div>

	</div>

    <!-- <div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status maal </label>
		<div class="col-sm-4">
			<select name="status_maal" id="status_maal" class="form-control" required="required" autocomplete="off">
                <option class="c1" value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                <option class="c2" value="Valid">Valid</option>
                <option class="c3" value="Tidak Valid">Tidak Valid</option>
            </select>
		</div>
	</div>

    <div class="form-group" id="form_status">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Uang </label>
		<div class="col-sm-4">
			<select name="status_uang" id="status_uang" class="form-control" required="required" autocomplete="off">
                <option class="c1" value="Kas Baznas">Kas Baznas</option>
                <option class="c2" value="Sudah Terdistribusi">Sudah Terdistribusi</option>
            </select>
		</div>
	</div> -->

    <div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bukti Transfer </label>
		<div class="col-sm-10">
			<input type="file" id="bukti_maal" name="bukti_maal"  placeholder="Foto" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	<!-- <div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jenis Zakat Maal </label>
		<div class="col-sm-4">
			<select name="jenis_maal" id="jenis_maal" class="form-control" required="required">
                <option class="c1" value="Uang">Uang</option>
                <option class="c2" value="Emas">Emas</option>
                <option class="c3" value="Perdagangan">Perdagangan</option>
				<option class="c4" value="Pertanian">Pertanian</option>
				<option class="c5" value="Pertanian">Pertambangan</option>
            </select>
		</div>
	</div> -->

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tempat ZIS </label>
		<div class="col-sm-4">
			<select name="id_zis" id="id_zis" class="form-control" required="required" autocomplete="off">
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

<!-- Modal -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Status</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
	  <form class="form" id="KonfirmasiStatus" data-url="<?php echo base_url('Zakat_maal/konfirmasi'); ?>">
      <div class="modal-body">
		<input type="hidden" id="konfirmasiIdMaal" name="id_maal" value="">
		<input type="hidden" name="status_maal" value="Valid">
		<div class="form-group">
			<strong>Pengirim</strong>
			<p id="konfirmasiPengirim"></p>
		</div>
		<div class="form-group">
			<strong>Jumlah Maal</strong>
			<input type="number" id="konfirmasiJumlahMaal" name="jumlah_maal" step="1" min="0" required="required" autocomplete="off" class="form-control">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	$(document).ready(function(e){
		konfirmasiStatus = function(_this) {
			var id_maal = _this.data('id'),
				jumlah_maal = _this.data('jumlah'),
				pengirim = _this.data('pengirim'),
				url = _this.data('url'),
				konfirmasi = _this.data('konfirmasi');

			if(konfirmasi == 'tidak') {
				$.ajax({
					type: 'POST',
					url: url,
					data: 'id_maal=' + id_maal + '&status_maal=Tidak Valid&jumlah_maal=' + jumlah_maal,
					dataType: 'json',
					processData:false,
					success: function(result) {
						if (result.status) {
							swal({ title:"SUCCESS", text:"Berhasil dikonfirmasi.", type: "success", closeOnConfirm: true});

							setTimeout(function(){
								// reload_table();
								document.location.href = '';
							}, 1000);
						}
					}, error: function(jqXHR, textStatus, errorThrown) {
						// alert('Error adding/update data');
						swal({ title:"ERROR", text:"Gagal dikonfirmasi.", type: "warning", closeOnConfirm: true});  
					}
				});
			} else {
				$('#konfirmasiIdMaal').val(id_maal);
				$('#konfirmasiPengirim').html(pengirim);
				$('#konfirmasiJumlahMaal').val(jumlah_maal);
				$('#modalKonfirmasi').modal('show');
			}
		}

		konfirmasiUang = function(_this) {
			var id_maal = _this.data('id'),
				zis = _this.data('zis'),
				jumlah = _this.data('jumlah'),
				url = _this.data('url');

			$.ajax({
				type: 'POST',
				url: url,
				data: 'id_maal=' + id_maal + '&id_zis=' + zis + '&jumlah_maal=' + jumlah,
				dataType: 'json',
				processData:false,
				success: function(result) {
					if (result.status) {
						swal({ title:"SUCCESS", text:"Berhasil dikonfirmasi.", type: "success", closeOnConfirm: true});

						setTimeout(function(){
							// reload_table();
							document.location.href = '';
						}, 1000);
					}
				}, error: function(jqXHR, textStatus, errorThrown) {
					// alert('Error adding/update data');
					swal({ title:"ERROR", text:"Gagal dikonfirmasi.", type: "warning", closeOnConfirm: true});  
				}
			});
		}

		$('#KonfirmasiStatus').on('submit', (function(e) {
			e.preventDefault();

			var url = $(this).data('url');

			$.ajax({
				type: 'POST',
				url: url,
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false,
				success: function(result) {
                    if (result.status) {
						swal({ title:"SUCCESS", text:"Berhasil dikonfirmasi.", type: "success", closeOnConfirm: true});

						setTimeout(function(){
							// reload_table();
							document.location.href = '';
						}, 1000);
					}
				}, error: function(jqXHR, textStatus, errorThrown) {
					// alert('Error adding/update data');
					swal({ title:"ERROR", text:"Gagal dikonfirmasi.", type: "warning", closeOnConfirm: true});  
				}
			});
		}))

		$("#formAksi").on('submit', function(e){
			e.preventDefault();

			$('#btn_save').text('Saving...');
			$('#btn_save').attr('disabled', true);

			var url;
			if (save_method == 'add') {
				url = "<?php echo site_url('Zakat_maal')?>/ajax_add";
			} else {
				url = "<?php echo site_url('Zakat_maal')?>/ajax_update"; 
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
						// reload_table();
						document.location.href = '';
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