<?php $title = "<i class='fa fa-book'></i>&nbsp;Kontak"; ?>

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



<div class="row">

<div class="col-xs-12">

<div id="form-data" style="display:none;">

<div class="widget-box">

<div class="widget-header">

		<h4 class="widget-title">Form Kontak</h4>



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

<form class="form-horizontal" role="form" id="formAksi">

	 <input type="hidden" name="id_kontak">

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Latitude </label>

		<div class="col-sm-10">

			<input type="text" id="kontak_lat" name="kontak_lat" placeholder="Kontak Latitude" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Longtitude </label>

		<div class="col-sm-10">

			<input type="text" id="kontak_long" name="kontak_long" placeholder="Kontak Longtitude" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Judul </label>

		<div class="col-sm-10">

			<input type="text" id="kontak_judul" name="kontak_judul" placeholder="Kontak judul" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kontak Deskripsi </label>

		<div class="col-sm-6">

			<textarea class="form-control" id="kontak_deskripsi" name="kontak_deskripsi" placeholder="Kontak Deskripsi" class="col-xs-10 col-sm-5"></textarea>

		</div>

	</div>

	

	<div class="col-md-offset-2 col-md-9">

				<button class="btn btn-info" type="button" id="btnSave" onclick="save()">

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

</div>



<script>

	var save_method;

	var link = "<?php echo site_url('Kontak2')?>";

	var table;

	

	$(document).ready(function(){

		edit();

    });



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

	

	function Batal() { 

		$('#form-data').slideUp(500,'swing');

		$('#panel-data').fadeIn(1000); 

	}

	

		function edit() {

			save_method = 'update';

			$('#panel-data').fadeOut('slow');

			$('#form-data').fadeIn('slow');

			document.getElementById('formAksi').reset();

			$.ajax({

				url : "<?php echo site_url('Kontak_2')?>/ajax_edit/",

				type: "GET",

				dataType: "JSON",

				success: function(result) {  

					//document.getElementById('fc_kdbahan').setAttribute('readonly','readonly');

					$('[name="id_kontak"]').val(result.id_kontak);

					$('[name="kontak_lat"]').val(result.kontak_lat);

					$('[name="kontak_long"]').val(result.kontak_long);

					$('[name="kontak_deskripsi"]').val(result.kontak_deskripsi);

					$('[name="kontak_judul"]').val(result.kontak_judul);

					$('[name="kontak_title_meta"]').val(result.kontak_title_meta);

					$('[name="kontak_deskripsi_meta"]').val(result.kontak_deskripsi_meta);

					$('[name="kontak_keyword_meta"]').val(result.kontak_keyword_meta);



				}, error: function (jqXHR, textStatus, errorThrown) {

					alert('Error get data from ajax');

				}

			});

	}



	function save() {

		var url;

		url = "<?= site_url()?>Kontak_2/ajax_update/";

		$('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true);

		tinyMCE.triggerSave();

		$.ajax({

			url : url, type: "POST", dataType: "JSON", data: $('#formAksi').serialize(),

			success: function(data) {

				if(data.status) { swal_berhasil(); edit();

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

	

	

	



	

</script>



