<?php $title = "<i class='fa fa-briefcase'></i>&nbsp;Detail Barang"; ?>
<div class='alert alert-success' id='berhasil' style='display: none;'>Proses Berhasil</div>
<div class='alert alert-danger' id='gagal' style='display: none;'>Proses Gagal</div>
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
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
			<th>No.</th>
            <th>fc_kdbarang</th>
			<th>fv_nama_barang</th>
			<th>fv_deskripsi</th>
			<th>fc_img</th>
			<th>fd_harga_barang_publish</th>
            <th>fd_harga_barang_min</th>
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

</section>
</div>

<div class="row">
<div class="col-xs-12">
<div id="form-data" style="display:none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Tambah Barang</h4>

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
<style type="text/css"> #loader1{display: none}#preview1{display: none}#loader2{display: none} #preview2{display: none}#loader3{display: none} #preview3{display: none}#loader4{display: none} #preview4{display: none}
</style>

<form id="form-add" class="form-horizontal" action="<?= site_url('Barang/ajax_add')?>" method="POST" role="form" enctype="multipart/form-data">
	<input type="hidden" name="fc_id">

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Barang </label>
		<div class="col-sm-10">
			<input type="text" id="fc_kdbarang" name="fc_kdbarang" placeholder="Kode Barang" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Kategori </label>
		<div class="col-sm-10">
			<input type="text" id="fc_kdkategori" name="fc_kdkategori" placeholder="Kode Kategori" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Nama Barang</label>
		<div class="col-sm-10">
			<input type="text" id="fv_nama_barang" name="fv_nama_barang" placeholder="fv_nama_barang" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>
		<div class="col-sm-6">
			<textarea class="form-control" id="fv_deskripsi" name="fv_deskripsi" placeholder="Deskripsi" class="col-xs-10 col-sm-5" cols="30" rows="10"></textarea>
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Barang Publish </label>
		<div class="col-sm-10">
			<input type="text" id="fd_harga_barang_publish" name="fd_harga_barang_publish" placeholder="fd_harga_barang_publish" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Barang Min </label>
		<div class="col-sm-10">
			<input type="text" id="fd_harga_barang_min" name="fd_harga_barang_min" placeholder="fd_harga_barang_min" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jenis Poin  </label>
		<div class="col-sm-10">
			<input type="text" id="fv_jenis_poin" name="fv_jenis_poin" placeholder="fv_jenis_poin" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Berat </label>
		<div class="col-sm-10">
			<input type="text" id="fv_berat" name="fv_berat" placeholder="fv_berat" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Dimensi </label>
		<div class="col-sm-10">
			<input type="text" id="fv_dimensi" name="fv_dimensi" placeholder="fv_dimensi" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Stok </label>
		<div class="col-sm-10">
			<input type="text" id="fc_status_stok" name="fc_status_stok" placeholder="fc_status_stok" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group" >
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gambar 1 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile1" id="userfile1" required>
			<span class="help-block"></span>
			<img id="loader1" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview1" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-2"> Gambar 2 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile2" id="userfile2" required>
			<span class="help-block"></span>
			<img id="loader2" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview2" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-3"> Gambar 3 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile3" id="userfile3" required>
			<span class="help-block"></span>
			<img id="loader3" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview3" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-3"> Gambar 4 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile4" id="userfile4" required>
			<span class="help-block"></span>
			<img id="loader4" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview4" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>



	</div>
	<div class="col-md-offset-2 col-md-9">
		<input type="submit" value="Add" id="btnSave" class="btn btn-primary">
	</div>
</form>
</div>
</div>
</div>					
</div><!-- /.row -->
</div>
</div><!-- /.row -->
</div>

<style type="text/css"> #loader-upload1{display: none}#loader-upload2{display: none}#loader-upload3{display: none}#loader-upload4{display: none}
</style>

<div id="form-update" style="display:none;">
<div class="tabbable">
	<ul class="nav nav-tabs" id="formAksi">
		<li class="active">
			<a data-toggle="tab" href="#home">
			<i class="green ace-icon fa fa-home bigger-120"></i>
				Form
			</a>
		</li>

		<li>
			<a data-toggle="tab" href="#messages">
			<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
				Gambar
			</a>
		</li>									
	</ul>

	<div class="tab-content">
	<div id="home" class="tab-pane fade in active">
	<form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="fc_id"/> 
		<div class="form-group">
		<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Barang </label>
		<div class="col-sm-10">
			<input type="text" id="fc_kdbarang" name="fc_kdbarang" placeholder="Kode Barang" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Kategori </label>
		<div class="col-sm-10">
			<input type="text" id="fc_kdkategori" name="fc_kdkategori" placeholder="Kode Kategori" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Nama Barang</label>
		<div class="col-sm-10">
			<input type="text" id="fv_nama_barang" name="fv_nama_barang" placeholder="fv_nama_barang" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>
		<div class="col-sm-6">
			<textarea class="form-control" id="fv_deskripsi" name="fv_deskripsi" placeholder="Deskripsi" class="col-xs-10 col-sm-5" cols="30" rows="10"></textarea>
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Barang Publish </label>
		<div class="col-sm-10">
			<input type="text" id="fd_harga_barang_publish" name="fd_harga_barang_publish" placeholder="fd_harga_barang_publish" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Barang Min </label>
		<div class="col-sm-10">
			<input type="text" id="fd_harga_barang_min" name="fd_harga_barang_min" placeholder="fd_harga_barang_min" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jenis Poin  </label>
		<div class="col-sm-10">
			<input type="text" id="fv_jenis_poin" name="fv_jenis_poin" placeholder="fv_jenis_poin" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Berat </label>
		<div class="col-sm-10">
			<input type="text" id="fv_berat" name="fv_berat" placeholder="fv_berat" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Dimensi </label>
		<div class="col-sm-10">
			<input type="text" id="fv_dimensi" name="fv_dimensi" placeholder="fv_dimensi" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Stok </label>
		<div class="col-sm-10">
			<input type="text" id="fc_status_stok" name="fc_status_stok" placeholder="fc_status_stokn" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
			<br /><br /><br /><br />
			<div class="col-md-offset-2 col-md-9">
				<button type="button" value="Add" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" onclick="Batal2()">Cancel</button>
			</div>
		</div>
		
	</form>
	</div>
</div>

	<div id="messages" class="tab-pane fade">
	<form id="form-upload" class="form-horizontal" role="form" action="<?= site_url('Barang/upload_barang')?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="fc_kdkategori"/>
				<input type="hidden" name="fv_nama_barang"/> 
			<div class="form-body">
				<div class="form-group" >
				<label class="control-label col-md-3"></label>
				<div class="input-group col-md-6">
					<div style="
						width: 100%;
						line-height: 10pt;
						background: #fb0;
						border-radius: 5px;
						padding: 5px;
						font-size: 8pt;
						box-sizing: border-box;
					">
						Max Size : 2 MB<br>
						Max Dimension : 2024 x 1468 (px)<br>
						Allowed Image : JPG | PNG | GIF
					</div>
				</div>
				</div>

					<div class="form-group" >
					<label class="control-label col-md-3">Pilih File</label>
					<div class="input-group col-md-6">
						<input type="file" name="file-upload1" id="file-upload1">
						<span class="help-block"></span>
						<div class="input-group-btn">
							<!-- <button type="submit" class="btn btn-primary">Upload</button> -->
						</div>
					</div>
					</div>
					<div class="form-group" >
						<label class="control-label col-md-3">Preview</label>
							<div class="input-group col-md-9">
								<img id="loader-upload1" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
								<img id="preview-upload1" src="#" style="height: 100px;border: 1px solid #DDC; " />
							</div>
					</div>

					<div class="form-group" >
					<label class="control-label col-md-3">Pilih File</label>
					<div class="input-group col-md-6">
						<input type="file" name="file-upload2" id="file-upload2">
						<span class="help-block"></span>
						<div class="input-group-btn">
							<!-- <button type="submit" class="btn btn-primary">Upload</button> -->
						</div>
					</div>
					</div>
					<div class="form-group" >
						<label class="control-label col-md-3">Preview</label>
							<div class="input-group col-md-9">
								<img id="loader-upload2" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
								<img id="preview-upload2" src="#" style="height: 100px;border: 1px solid #DDC; " />
							</div>
					</div>

					<div class="form-group" >
					<label class="control-label col-md-3">Pilih File</label>
					<div class="input-group col-md-6">
						<input type="file" name="file-upload3" id="file-upload3">
						<span class="help-block"></span>
						<div class="input-group-btn">
							<!-- <button type="submit" class="btn btn-primary">Upload</button> -->
						</div>
					</div>
					</div>
					<div class="form-group" >
						<label class="control-label col-md-3">Preview</label>
							<div class="input-group col-md-9">
								<img id="loader-upload3" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
								<img id="preview-upload3" src="#" style="height: 100px;border: 1px solid #DDC; " />
							</div>
					</div>


					<div class="form-group" >
					<label class="control-label col-md-3">Pilih File</label>
					<div class="input-group col-md-6">
						<input type="file" name="file-upload4" id="file-upload4">
						<span class="help-block"></span>
						<div class="input-group-btn">
							<button type="submit" class="btn btn-primary">Upload</button>
						</div>
					</div>
					</div>
					<div class="form-group" >
						<label class="control-label col-md-3">Preview</label>
							<div class="input-group col-md-9">
								<img id="loader-upload4" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
								<img id="preview-upload4" src="#" style="height: 100px;border: 1px solid #DDC; " />
							</div>
					</div>
				</div>
	</form>	
	</div>

</div>
</div>
</div>				
<script>

	var zonk='';
	var save_method;
	var link = "<?php echo site_url('Barang')?>";
	var table;
	
	$(document).ready(function(){
	$('#form-add').submit(function(e) {
		tinyMCE.triggerSave();
		e.preventDefault(); var formData = new FormData($(this)[0]);
		$.ajax({
			url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
			beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
			success: function(response) {
				if(response.status) { Batal(); reload_table(); swal_berhasil();
				} else { Batal(); reload_table(); swal_error(response.error); }
			},
			complete: function() { $('#btnSave').text('save'); $('#btnSave').attr('disabled',false); },
			cache: false, contentType: false, processData: false
		});
		return false;
	});
	
	function readURL1(input) {
		$("#preview1").show();
		if (input.files && input.files[0]) {
			var rd = new FileReader(); 
			rd.onload = function (e) { $('#preview1').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
		}
	}

	function readURL2(input) {
		$("#preview2").show();
		if (input.files && input.files[0]) {
			var rd = new FileReader(); 
			rd.onload = function (e) { $('#preview2').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
		}
	}

	function readURL3(input) {
		$("#preview3").show();
		if (input.files && input.files[0]) {
			var rd = new FileReader(); 
			rd.onload = function (e) { $('#preview3').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
		}
	}

	function readURL4(input) {
		$("#preview4").show();
		if (input.files && input.files[0]) {
			var rd = new FileReader(); 
			rd.onload = function (e) { $('#preview4').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
		}
	}

	$("#userfile1").change(function(){ readURL1(this); });
	$("#userfile2").change(function(){ readURL2(this); });
	$("#userfile3").change(function(){ readURL3(this); });
	$("#userfile4").change(function(){ readURL4(this); });

	});


	
	$(document).ready(function(){
		$('#form-upload').submit(function(e) {
			tinyMCE.triggerSave();
			e.preventDefault(); var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
				beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
				success: function(response) {
					if(response.status) { Batal2(); reload_table(); swal_berhasil();
					} else { Batal2(); reload_table(); swal_error(response.error); }
				},
				complete: function() { $('#btnSave').text('save'); $('#btnSave').attr('disabled',false); },
				cache: false, contentType: false, processData: false
			});
		});

		function readURL1(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload1').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}

		function readURL2(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload2').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}

		function readURL3(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload3').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}

		function readURL4(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload4').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}

		$("#file-upload1").change(function(){ readURL1(this); });
		$("#file-upload2").change(function(){ readURL2(this); });
		$("#file-upload3").change(function(){ readURL3(this); });
		$("#file-upload4").change(function(){ readURL4(this); });

	});
	
	function save() {
		var url;
		url = "<?= site_url()?>Barang/update/";
		tinyMCE.triggerSave();
		$('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true);
		$.ajax({
			url : url, type: "POST", dataType: "JSON", data: $('#form').serialize(),
			success: function(data) {
				if(data.status) {  Batal2(); reload_table(); swal_berhasil(); 
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
					}
				}
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);  
			}
		});
	}
	
	// function edit(id) {
	// 		save_method = 'update';
	// 		$('#panel-data').fadeOut('slow');
	// 		$('#form-update').fadeIn('slow');
	// 		//document.getElementById('formAksi').reset();
	// 		$.ajax({
	// 			url : link+"/ajax_edit/"+id,
	// 			type: "GET",
	// 			dataType: "JSON",
	// 			success: function(result) {  
	// 			// var img = '<?= base_url(); ?>assets/images/'+result.slider_gambar;
	// 			// $('[name="fc_id"]').val(result.fc_id);
	// 			// $('[name="a1"]').val(result.slider_judul);
	// 			// // tinymce.editors[1].setContent(result.slider_deskripsi);
	// 			// $('#preview-upload').attr('src', img);
	// 			var img1 = '<?= base_url(); ?>assets/images/'+result.fc_img_1;
	// 			var img2 = '<?= base_url(); ?>assets/images/'+result.fc_img_2;
	// 			var img3 = '<?= base_url(); ?>assets/images/'+result.fc_img_3;
	// 			var img4 = '<?= base_url(); ?>assets/images/'+result.fc_img_4;
	// 				if(result.fc_img_1!==""){
	// 					img1='<?=base_url(); ?>assets/images/'+result.fc_img_1;
	// 				}
	// 				if(result.fc_img_2!==""){
	// 					img2='<?=base_url(); ?>assets/images/'+result.fc_img_2;
	// 				}
	// 				if(result.fc_img_3!==""){
	// 					img3='<?=base_url(); ?>assets/images/'+result.fc_img_3;
	// 				}
	// 				if(result.fc_img_4!==""){
	// 					img3='<?=base_url(); ?>assets/images/'+result.fc_img_4;
	// 				}



	// 			$('[name="fc_id"]').val(result.fc_id);
	// 			$('[name="fc_kdbarang"]').val(result.fc_kdbarang);
	// 			$('[name="fv_nama_barang"]').val(result.fv_nama_barang);
	// 			tinymce.editors[1].setContent(result.fv_deskripsi);
	// 			// $('#preview-upload').attr('src', img);
	// 			$('[name="fd_harga_barang_publish"]').val(result.fd_harga_barang_publish);	
	// 			$('[name="fd_harga_barang_min"]').val(result.fd_harga_barang_min);
	// 			$('[name="fv_jenis_poin"]').val(result.fv_jenis_poin);
	// 			$('[name="fc_kdgudang"]').val(result.fc_kdgudang);
	// 			$('[name="fv_berat"]').val(result.fv_berat);
	// 			$('[name="fv_dimensi"]').val(result.fv_dimensi);
	// 			$('[name="fc_status_stok"]').val(result.fc_status_stok);

	// 				$('#preview-upload1').attr('src', img1);
	// 				$('#preview-upload2').attr('src', img2);
	// 				$('#preview-upload3').attr('src', img3);
	// 				$('#preview-upload4').attr('src', img4);


	// 			}, error: function (jqXHR, textStatus, errorThrown) {
	// 				alert('Error get data from ajax');
	// 			}
	// 		});
	// }

	function edit(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-update').fadeIn('slow');
			// var my_editor_id = 'teksarea';
			// // set the content empty
			// tinymce.get(my_editor_id).setContent(''); 
			$.ajax({
				url : link+"/ajax_edit/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) { 
					console.log(result);
				var fc_img_1 = '<?= base_url(); ?>assets/images/'+result.fc_img_1;
				var fc_img_2 = '<?= base_url(); ?>assets/images/'+result.fc_img_2;
				var fc_img_3 = '<?= base_url(); ?>assets/images/'+result.fc_img_3;
				var fc_img_4 = '<?= base_url(); ?>assets/images/'+result.fc_img_4;
					if(result.fc_img_1!==""){
						fc_img_1='<?=base_url(); ?>assets/images/'+result.fc_img_1;
					}
					if(result.fc_img_2!==""){
						fc_img_2='<?=base_url(); ?>assets/images/'+result.fc_img_2;
					}
					if(result.fc_img_3!==""){
						fc_img_3='<?=base_url(); ?>assets/images/'+result.fc_img_3;
					}
					if(result.fc_img_4!==""){
						fc_img_3='<?=base_url(); ?>assets/images/'+result.fc_img_4;
					}

				$('[name="fc_id"]').val(result.fc_id);
				$('[name="fc_kdbarang"]').val(result.fc_kdbarang);
				$('[name="fc_kdkategori"]').val(result.fc_kdkategori);
				$('[name="fv_nama_barang"]').val(result.fv_nama_barang);
				$('[name="fv_deskripsi"]').val(result.fv_deskripsi);
				tinymce.editors[1].setContent(result.fv_deskripsi);
				// $('#preview-upload').attr('src', img);
				$('[name="fd_harga_barang_publish"]').val(result.fd_harga_barang_publish);	
				$('[name="fd_harga_barang_min"]').val(result.fd_harga_barang_min);
				$('[name="fv_jenis_poin"]').val(result.fv_jenis_poin);
				$('[name="fc_kdgudang"]').val(result.fc_kdgudang);
				$('[name="fv_berat"]').val(result.fv_berat);
				$('[name="fv_dimensi"]').val(result.fv_dimensi);
				$('[name="fc_status_stok"]').val(result.fc_status_stok);

					$('#preview-upload1').attr('src', fc_img_1);
					$('#preview-upload2').attr('src', fc_img_2);
					$('#preview-upload3').attr('src', fc_img_3);
					$('#preview-upload4').attr('src', fc_img_4);

				
				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
	
	
	$(document).ready(function(){
      //$('#idImgLoader').show(2000);
	  $('#idImgLoader').fadeOut(2000);
	  setTimeout(function(){
            data();
      }, 2000);
	  setTimeout(function(){
            ckeditor();
      }, 2000);
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
		table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Barang/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
	
	}).fnDestroy();
	
	$(document).ready(function() {
		$("input").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("textarea").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("select").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
	});
	
	function Tambah() {
		$('.form-group').removeClass('has-error');
		$('.help-block').empty(); 
		save_method = 'add'; 
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow'); 
		$('[name="userfile1"]').val(zonk);
		$('[name="userfile2"]').val(zonk);
		$('[name="userfile3"]').val(zonk);
		$('[name="userfile4"]').val(zonk);
		
	}
	
	function reload_table() {
    	table.ajax.reload(null, false);
	}				

	$(function() {
		var oTable1 = $('#dynamic-table').dataTable( {
		"aoColumns": [,
			 null, null, null, null, null,
		] } );
				
				
		$('table th input:checkbox').on('click' , function(){
			var that = this;
			$(this).closest('table').find('tr > td:first-child input:checkbox')
				.each(function(){
					this.checked = that.checked;
					$(this).closest('tr').toggleClass('selected');
				});
						
			});
			
			
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('table')
				var off1 = $parent.offset();
				var w1 = $parent.width();
			
				var off2 = $source.offset();
				var w2 = $source.width();
			
				if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
				return 'left';
		}
	})
			
	//$('#dynamic-table').dataTable( {
		//paging: false,
		//searching: false
	//} );	
		
	function reload_table() {
		table.ajax.reload(null, false);
	}

	function Batal() { 
		$('#form-data').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function Batal2() { 
		$('#form-update').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function hapus(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax ({
				url : "<?php echo site_url('Barang/ajax_delete')?>/"+id,
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