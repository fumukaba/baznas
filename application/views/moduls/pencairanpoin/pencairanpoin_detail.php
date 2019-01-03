		<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/j-ui/jquery-ui.css'; ?>">
        <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.css" rel="stylesheet" type="text/css" />

 <style type="text/css">
 	
 	td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
	}
 </style>

<style type="text/css"> 
#loader1{display: none} 
#loader2{display: none} 
#loader3{display: none} 
#loader4{display: none} 
#preview1{display: none} 
#preview2{display: none} 
#preview3{display: none}
#preview4{display: none}
</style>

        <script src="<?php echo base_url() . 'assets/j-ui/jquery3.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/j-ui/jquery-ui.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/j-ui/datatablejs.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.js"></script>
        <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<?php $title = "Pencairan Poin Detail"; ?>
<div class='alert alert-success' id='berhasil' style='display: none;'>Proses Berhasil</div>
<div class='alert alert-danger' id='gagal' style='display: none;'>Proses Gagal</div>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<section class="content">
<div class="page-header">
	<h1>
		<i class='fa fa-money'> <?php echo $title;?></i>
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
	<!-- <button class="btn btn-danger" onclick="Tambah()"><i class="fa fa-plus"></i> Tambah Data</button> -->
</div><br />
<form method="POST" action="<?php echo base_url('Pencairanpoin/tukar') ?>">
	<input type="hidden" name="id_user" value="<?php echo $id_user ?>">
<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
        <th></th>
            <th class="sorting_disabled"><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
            <th>ID Order</th>
            <th>Tanggal Order</th>
			<th>Harga</th>
			<th>Poin</th>
			<th>Status</th>
			<th>Nominal Poin</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
        	<th></th>
            <th><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
            <th>ID Order</th>
            <th>Tanggal Order</th>
			<th>Harga</th>
			<th>Poin</th>
			<th>Status</th>
			<th>Nominal Poin</th>
        </tr>
    </tfoot>
</table>
<!-- Total poin yang dipilih : <input type="text" name="total_poin" id="total_poin" readonly value="0"> -->
<button type="submit" class="btn btn-success" onclick="return confirm('Anda yakin ingin tukar poin?');"><span class="fa fa-money"></span> Tukar Poin</button>
</form>
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
		<h4 class="widget-title">Form <?php echo $title ?></h4>

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
<form id="form-add" class="form-horizontal" action="<?= site_url('Article/ajax_add')?>" method="POST" role="form" enctype="multipart/form-data">
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama </label>
		<div class="col-sm-10">
			<input type="text" id="nama_article" name="nama_article" placeholder="Nama Article" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Article </label>
		<div class="col-sm-10">
			<input type="text" id="kode_article" name="kode_article" placeholder="Kode Article" class="col-xs-10 col-sm-5" />
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kategori </label>
		<div class="col-sm-5">
			<select class="form-control col-sm-5" id="kategori" name="kategori" onchange="getJen()">
				<option value="0" selected="selected">Pilih Kategori</option>
	           <?php foreach ($kategori as $row) { ?>
		            <option value="<?php echo $row->id_kategori;?>"><?php echo $row->nama_kategori;?></option>
		        <?php }?>
	          </select>
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jenis </label>
		<div class="col-sm-5">
			<select name="jenis" id="jenis" value="" class="form-control" >
                <option value="0">-- Pilih Kategori Terlebih Dahulu --</option> 
            </select>
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Bahan </label>
		<div class="col-sm-5">
			<select class="form-control col-sm-5" id="bahan" name="bahan">
	           <?php foreach ($bahan as $row) { ?>
		            <option value="<?php echo $row->id_bahan;?>"><?php echo $row->nama_bahan;?></option>
		        <?php }?>
	          </select>
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Warna </label>
		<div class="col-sm-5">
			<select class="form-control col-sm-5" id="warna" name="warna">
	           <?php foreach ($warna as $row) { ?>
		            <option value="<?php echo $row->id_warna;?>"><?php echo $row->nama_warna;?></option>
		        <?php }?>
	          </select>
			<span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1" id="size"> Size </label>
		<div class="col-sm-12" id="size">
			<input type="hidden" id="id_size" name="id_size" value="1" />
			<input type="text" id="nama_size" name="nama_size" placeholder="Nama Size" value="XS" readonly />
			<input type="text" id="stok" name="stok" placeholder="Stok" />
			<input type="text" id="harga" name="harga" placeholder="Harga" />
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group" >
		<label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
		<div class="col-md-6">
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
	
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 1 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile1" id="userfile1" required>
			<span class="help-block"></span>
			<img id="loader1" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview1" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 2 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile2" id="userfile2" required>
			<span class="help-block"></span>
			<img id="loader2" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview2" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 3 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile3" id="userfile3" required>
			<span class="help-block"></span>
			<img id="loader3" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview3" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 4 </label>
		<div class="col-sm-10">
			<input type="file" name="userfile4" id="userfile4" required>
			<span class="help-block"></span>
			<img id="loader4" src="<?= base_url(); ?>uploads/load.gif" style="height: 30px;">
			<img id="preview4" src="#" style="height: 100px;border: 1px solid #DDC; " />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>
		<div class="col-sm-6">
			<textarea class="form-control" id="slider_deskripsi" name="slider_deskripsi" placeholder="Deskripsi" class="col-xs-10 col-sm-5" cols="30" rows="10"></textarea>
			<span class="help-block"></span>
		</div>
	</div>
	<div class="col-md-offset-2 col-md-9">
		<!-- <input type="submit" value="Simpan" id="btnSave" class="btn btn-primary"> -->
		<button onclick="batal()" class="btn btn-warning"><span class="fa fa-reply"></span> Kembali</button>
		<button type="submit" id="btnSave" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
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

		<input type="hidden" name="id_slider"/> 
		<div class="form-group">
		<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Judul </label>
			<div class="col-sm-10">
				<input type="text" id="a1" name="a1" placeholder="Judul" class="col-xs-10 col-sm-5" />
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
		<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>
			<div class="col-sm-6">
				<textarea class="form-control" id="a2" name="a2" placeholder="Deskripsi" class="col-xs-10 col-sm-5"></textarea>
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
	<form id="form-upload" class="form-horizontal" role="form" action="<?= site_url('Slider/upload')?>" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id_slider"/> 
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
</div>
						
<script>
	var zonk='';
	var save_method;
	var link = "<?php echo site_url('Pencairanpoin')?>";
	var kodeKat = "<?php echo $id_user ?>"
	console.log(kodeKat);
	var table;
	$('#ck').click(function(e) {
		var ck = document.getElementById('ck').value;
		console.log('ckk');
		console.log(ck);
	});
	function autosum() {
		var selectedIds = table.columns().checkboxes.selected()[0];
		   console.log(selectedIds)

		   selectedIds.forEach(function(selectedId) {
		       alert(selectedId);
		   });
	}
  	function getJen(){
        $.get(link+'/getJen/'+$('#kategori').val(), $(this).serialize())
        .done(function(data) {
          $('#jenis').html(data);
        });  
        $.get(link+'/getSize/'+$('#kategori').val(), $(this).serialize())
        .done(function(data) {
          $('#size').html(data);
        });  
    }
	
	$(document).ready(function(){
	$('#form-add').submit(function(e) {
		//tinyMCE.triggerSave();
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
		url = "<?= site_url()?>Slider/update/";
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
	
	function update(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-update').fadeIn('slow');
			//document.getElementById('formAksi').reset();
			$.ajax({
				url : link+"/ajax_edit/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				var img = '<?= base_url(); ?>assets/images/'+result.slider_gambar;
				$('[name="id_slider"]').val(result.id_slider);
				$('[name="a1"]').val(result.slider_judul);
				tinymce.editors[1].setContent(result.slider_deskripsi);
				$('#preview-upload').attr('src', img);

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
		tinyMCE.init({
             
              mode : "textareas",
                
              // ===========================================
              // Set THEME to ADVANCED
              // ===========================================
                
              theme : "advanced",
                
              // ===========================================
              // INCLUDE the PLUGIN
              // ===========================================
             
              plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
                
              // ===========================================
              // Set LANGUAGE to EN (Otherwise, you have to use plugin's translation file)
              // ===========================================
             
              language : "en",
                 
              theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
              theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
              theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
             
              // ===========================================
              // Put PLUGIN'S BUTTON on the toolbar
              // ===========================================
             
              theme_advanced_buttons4 : "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                
              theme_advanced_toolbar_location : "top",
              theme_advanced_toolbar_align : "left",
              theme_advanced_statusbar_location : "bottom",
              theme_advanced_resizing : true,
                
              // ===========================================
              // Set RELATIVE_URLS to FALSE (This is required for images to display properly)
              // ===========================================
             
              relative_urls : false
                
            });
	}
	
	function data(){
		$('#data').fadeIn();
	}
	
	$(document).ready(function() {
		table = $('#example').DataTable({
        'ajax': '<?php echo site_url('Pencairanpoin')?>/ajax_listid/'+kodeKat,
        // "type": "POST",
        'columns': [
        	{ 'data': 'kosong' },
            { 'data': 'ceklist' },
            //{ 'data': 'nama'},
            { 'data': 'fc_kdorder' },
            //{ 'data': 'no_permintaan' },
            { 'data': 'fd_tgl_order' },
            // { 'data': 'aksi' },
            { 'data': 'fm_harga' },
            { 'data': 'total_poin' },
            { 'data': 'stt' },
            { 'data': 'nominal_poin' },
        ],
		"pageLength": 50,
        'order': [[1, 'DESC']],
        "initComplete": function (oSettings) { //changed line

            var oTable = this;
            oTable.fnPageChange(<?php echo @$halaman ?>);
        },
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
    } );
    $('#example').on( 'page.dt', function () {
        var info = table.page.info();
        $('#pageInfo').html( 
            console.log('Showing page: '+info.page+' of '+info.pages) );
            document.getElementById('halaman').value = info.page;
        } );
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function(){
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
	
    // Handle click on "Expand All" button
    $('#btn-show-all-children').on('click', function(){
        // Enumerate all rows
        table.rows().every(function(){
            // If row has details collapsed
            if(!this.child.isShown()){
                // Open this row
                this.child(format(this.data())).show();
                $(this.node()).addClass('shown');
            }
        });
    });

    // Handle click on "Collapse All" button
    $('#btn-hide-all-children').on('click', function(){
        // Enumerate all rows
        table.rows().every(function(){
            // If row has details expanded
            if(this.child.isShown()){
                // Collapse row details
                this.child.hide();
                $(this.node()).removeClass('shown');
            }
        });
    });
	//var allpage = table.fnPageChange();
	//console.log()
    // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });
   // Handle form submission event
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all checkboxes in the table
      table.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         }
      });
      });

    });
	
	$(document).ready(function() {
		$("input").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("textarea").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("select").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
	});
    function format ( d ) {
	    // `d` is the original data object for the row
	   var parah='';
        $.getJSON('<?php echo base_url('Article/ajax_list_Det') ?>/' + d.id_article, {
            format: "json"
        })
        .done(function (data) {
        	console.log(data);
            var no = 1; 
            var atas = '<table class="table table-striped" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;"><tr><td>Kode</td><td>Nama</td><td>Harga</td><td>Stok</td><td>Aksi</td></tr>';
            var bawah = '</table>';
            var tengah = '';
            var gabung = '';
            $.each(data, function (key, val) {
                tengah+='<tr><td>' + val.kode + '</td><td>' + val.nama_size + '</td><td>' + val.harga + '</td><td>' + val.stok + '</td><td>' + val.aksi + '</td></tr>';
                no++;
            });
                

                // console.log('tengah222: '+tengah);
            if (tengah!="") {
                parah = atas+tengah+bawah;
            }else{
                parah = "Tidak Ada Data";
            }
                 document.getElementById('cuks['+d.id_pre_order+']').innerHTML = parah;

            })
        return '<div id="cuks['+d.id_pre_order+']"></div>';
}
	
	function Tambah() {
		$('.form-group').removeClass('has-error');
		$('.help-block').empty(); 
		save_method = 'add'; 
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow'); 
		$('[name="userfile"]').val(zonk);
		
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
				url : "<?php echo site_url('Slider/ajax_delete')?>/"+id,
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


