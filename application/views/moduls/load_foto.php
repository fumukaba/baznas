<?php		
$id = $_GET['id'];
?>

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
	<button class="btn btn-danger" onclick="Add()"><i class="fa fa-plus"></i> Tambah Data</button>
</div><br />
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Gallery Nama</th>
			<th>Gallery Gambar</th>
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

<script type="text/javascript">
	var save_method;
	var table;
	var link = "<?php echo site_url('Gallery')?>";
	var kdAlbum = "<?php echo $id;?>";
	
	$(document).ready(function(){
	  setTimeout(function(){
            ckeditor();
      }, 2000);
    });
	
	$(document).ready(function(){
	$('#form-add').submit(function(e) {
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
	
	function readURL(input) {
		$("#preview").show();
		if (input.files && input.files[0]) {
			var rd = new FileReader(); 
			rd.onload = function (e) { $('#preview').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
		}
	}
	$("#userfile").change(function(){ readURL(this); });

	});
	
	$(document).ready(function(){
		$('#form-upload').submit(function(e) {
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

		function readURL(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload").change(function(){ readURL(this); });
	});
	
	function save() {
		var url;
		url = "<?= site_url()?>Gallery/update/";
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
	
	$(document).ready(function() {
		table = $('#dynamic-table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy": true,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": link+"/ajax_listid/"+kdAlbum,
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
	
	function reload_table() {
    	table.ajax.reload(null, false);
	}
	
	function ckeditor(){
		tinymce.init({
			selector: "textarea"
		});
	}
	
	function Add() {
		save_method = 'add'; 
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow'); 
		document.getElementById('formAksi').reset();
	}
	
	function Batal() { 
		$('#form-data').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	
	function Batal2() { 
		$('#form-update').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function edite(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-update').fadeIn('slow');
			//document.getElementById('formAksi').reset();
			$.ajax({
				url : link+"/ajax_editfoto/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				var img = '<?= base_url(); ?>assets/images/'+result.gallery_gambar;
				$('[name="id_gallery"]').val(result.id_gallery);
				$('[name="gallery_nama"]').val(result.gallery_nama);
				$('#preview-upload').attr('src', img);
				$('[name="gallery_title_meta"]').val(result.gallery_title_meta);
				$('[name="gallery_deskripsi_meta"]').val(result.gallery_deskripsi_meta);
				$('[name="gallery_keyword_meta"]').val(result.gallery_keyword_meta);

				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
	
	function hapuse(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax ({
				url : "<?php echo site_url('Gallery/ajax_delfoto')?>/"+id,
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
		<h4 class="widget-title">Form Tambah Produk</h4>

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
<style type="text/css"> #loader{display: none} #preview{display: none}</style>
<form id="form-add" class="form-horizontal" action="<?= site_url('Gallery/ajax_addfoto')?>" method="POST" role="form" enctype="multipart/form-data">
	<input type="hidden" name="id_detail">
	<input type="hidden" name="id_album" value="<?php echo $id;?>">
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama </label>
		<div class="col-sm-10">
			<input type="text" id="gallery_nama" name="gallery_nama" placeholder="Nama" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gambar </label>
		<div class="col-sm-10">
			<input type="file" name="userfile" id="userfile" required>
			<span class="help-block"></span>
			<img id="loader" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gallery Title Meta </label>
		<div class="col-sm-10">
			<input type="text" id="gallery_title_meta" name="gallery_title_meta" placeholder="Gallery Title Meta" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gallery Keyword Meta </label>
		<div class="col-sm-10">
			<input type="text" id="gallery_keyword_meta" name="gallery_keyword_meta" placeholder="Gallery Keyword Meta" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gallery Deskripsi Meta </label>
		<div class="col-sm-6">
			<textarea class="form-control" id="gallery_deskripsi_meta" name="gallery_deskripsi_meta" placeholder="Gallery Deskripsi Meta" class="col-xs-10 col-sm-5"></textarea>
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


<style type="text/css"> #loader-upload{display: none}</style>
<div id="form-update" style="display:none;">
<div class="tabbable">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active">
		<a data-toggle="tab" href="#home">
			<i class="green ace-icon fa fa-home bigger-120"></i>
			Home
		</a>
		</li>

		<li>
			<a data-toggle="tab" href="#messages">
			Gambar
			<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
			</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			<form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data">
			<input type="hidden" name="id_gallery"/> 
			<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama </label>
				<div class="col-sm-10">
					<input type="text" id="gallery_nama" name="gallery_nama" placeholder="Judul" class="col-xs-10 col-sm-5" />
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gallery Title Meta </label>
				<div class="col-sm-10">
					<input type="text" id="gallery_title_meta" name="gallery_title_meta" placeholder="Gallery Title Meta" class="col-xs-10 col-sm-5" />
				</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gallery Keyword Meta </label>
				<div class="col-sm-10">
					<input type="text" id="gallery_keyword_meta" name="gallery_keyword_meta" placeholder="Gallery Keyword Meta" class="col-xs-10 col-sm-5" />
				</div>
			</div>
			<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gallery Deskripsi Meta </label>
				<div class="col-sm-6">
					<textarea class="form-control" id="gallery_deskripsi_meta" name="gallery_deskripsi_meta" placeholder="Gallery Deskripsi Meta" class="col-xs-10 col-sm-5"></textarea>
					<span class="help-block"></span>
				</div><br /><br /><br /><br />
				<div class="col-md-offset-2 col-md-9">
					<button type="button" value="Add" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-danger" onclick="Batal2()">Cancel</button>
				</div>
			</div>
			
		</form>
		</div>

		<div id="messages" class="tab-pane fade">
			<form id="form-upload" class="form-horizontal" role="form" action="<?= site_url('Gallery/upload')?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id_gallery"/> 
				<div class="form-body">
					<div class="form-group" >
					<label class="control-label col-md-3">Pilih File</label>
					<div class="input-group col-md-6">
						<input type="file" name="file-upload" id="file-upload">
						<span class="help-block"></span>
						<div class="input-group-btn">
							<button type="submit" class="btn btn-primary">Upload</button>
						</div>
					</div>
					</div>
					<div class="form-group" >
						<label class="control-label col-md-3">Preview</label>
							<div class="input-group col-md-9">
								<img id="loader-upload" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
								<img id="preview-upload" src="#" style="height: 100px;border: 1px solid #DDC; " />
							</div>
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>
</div><!-- /.col -->
</div>									