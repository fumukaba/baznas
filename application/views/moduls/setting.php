<?php $title = "<i class='fa fa-newspaper-o'></i>&nbsp;Setting"; ?>
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
<style type="text/css"> #loader-upload{display: none}</style>
<div id="form-update" >
<div class="tabbable">
	<ul class="nav nav-tabs" id="formAksi">
		<li class="active">
			<a data-toggle="tab" href="#zakatfitrah">
			<i class="green ace-icon fa fa-home bigger-120"></i>
				Zakat Fitrah
			</a>
		</li>											
	</ul>

	<div class="tab-content">
	<div id="zakatfitrah" class="tab-pane fade in active">
	<form action="#" id="form" name="form" class="form-horizontal" enctype="multipart/form-data">

		<input type="hidden" name="id_setting"/> 
		<div class="form-group">
		
		<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tahun </label>
			<div class="col-sm-6">
            <input type="text" id="tahun" name="tahun" placeholder="Tahun" readonly="readonly" value="<?php echo date('Y'); ?>" />
				<span class="help-block"></span>
			</div>
		</div>
		<div class="form-group"> 

		<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nominal </label>
			<div class="col-sm-6">
				<input type="text" id="nominal" name="nominal" placeholder="Nominal" />
			</div>	
		</div>
		<div class="form-group">
		
			<div class="col-md-offset-2 col-md-9">
				<button type="button" value="Add" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
				
			</div>
		</div>
		
	</form>
	</div>

</div>
</div>

<script>
	var zonk='';
	var save_method;
	var link = "<?php echo site_url('Setting')?>";
	var table;
	$(document).ready(function(){
		setTimeout(function(){
			update();
		},3000)
    });
	
	$(document).ready(function(){
		setTimeout(function(){
			update2();
		},3000)
    });
	
	function data(){
		$('#data').fadeIn();
	}
	
	$(document).ready(function(){
	$('#form-add').submit(function(e) {
		tinyMCE.triggerSave();
		e.preventDefault(); var formData = new FormData($(this)[0]);
		$.ajax({
			url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
			beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
			success: function(response) {
				if(response.status) { swal_berhasil(); update();
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
					if(response.status) { swal_berhasil(); update();
					} else { reload_table(); swal_error(response.error); }
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
		url = "<?= site_url()?>Setting/update/";
		$('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true);
		tinyMCE.triggerSave();
		$.ajax({
			url : url, type: "POST", dataType: "JSON", data: $('#form').serialize(),
			success: function(data) {
				if(data.status) { swal_berhasil(); update();
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
	
	function update() {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-update').fadeIn('slow');
			//document.getElementById('formAksi').reset();
			$.ajax({
				url : "<?php echo site_url('Setting')?>/ajax_edit/",
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				    $('[name="nominal"]').val(result.meta_value);
				    $('[name="tahun"]').val(result.tahun);
				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}

	function save2() {
		var url;
		url = "<?= site_url()?>Setting/update2/";
		$('#btnSave2').text('saving...'); $('#btnSave2').attr('disabled',true);
		tinyMCE.triggerSave();
		$.ajax({
			url : url, type: "POST", dataType: "JSON", data: $('#form2').serialize(),
			success: function(data) {
				if(data.status) { swal_berhasil(); update2();
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
					}
				}
				$('#btnSave2').text('save'); $('#btnSave2').attr('disabled',false); 
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 
				$('#btnSave2').text('save'); $('#btnSave2').attr('disabled',false);  
			}
		});
	}

	function update2() {
			save_method = 'update2';
			$('#panel-data').fadeOut('slow');
			$('#form-update').fadeIn('slow');
			//document.getElementById('formAksi').reset();
			$.ajax({
				url : "<?php echo site_url('Setting')?>/ajax_edit2/",
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				    $('[name="nominal2"]').val(result.meta_value);
				    $('[name="tahun"]').val(result.tahun);
				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
		
</script>	