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
<?php $title = "<i class='fa fa-map-marker'></i>&nbsp;Tempat ZIS"; ?>

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
            <th>Nama</th>
            <th>Nama Pengurus</th>
            <th>Rekening Pengurus</th>
             <th>QR Code</th>
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

	var link = "<?php echo site_url('Zis')?>";

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

            "url": "<?php echo site_url('Zis/ajax_list')?>",

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

		save_method = 'add'; 

		$('#panel-data').fadeOut('slow');

		$('#form-data').fadeIn('slow'); 

		//document.getElementById('formAksi').reset();

	}

	

	function save() {

			$('#btn_save').text('Saving...');

			$('#btn_save').attr('disabled', true);



			var url;

			if (save_method == 'add') {

				url = "<?php echo site_url('Zis')?>/ajax_add";

			} else {

				url = "<?php echo site_url('Zis')?>/ajax_update"; 

			}

			

			tinyMCE.triggerSave();

			$.ajax({

				url: url,

				type: "POST",

				data: $('#formAksi').serialize(),

				dataType: "JSON",

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

	}

	

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

				url : "<?php echo site_url('Zis')?>/ajax_edit/"+id,

				type: "GET",

				dataType: "JSON",

				success: function(result) {  

					//document.getElementById('fc_kdbahan').setAttribute('readonly','readonly');

					$('[name="id_zis"]').val(result.id_zis);

					$('[name="nama_zis"]').val(result.nama_zis);

					tinymce.activeEditor.setContent(result.alamat_zis);

					$('[name="kelurahan_zis"]').val(result.kelurahan_zis);	

					$('[name="kecamatan_zis"]').val(result.kecamatan_zis);	

					var _classess = ".c" + result.pengurus_zis;
					$('#pengurus_zis ' + _classess).attr('selected', 'selected');

					// console.log(_classess);

				}, error: function (jqXHR, textStatus, errorThrown) {

					alert('Error get data from ajax');

				}

			});

	}

	

	function hapus(id) {

		if (confirm('Are you sure delete this data?')) {

			$.ajax ({

				url : "<?php echo site_url('Zis/ajax_delete')?>/"+id,

				type: "POST",

				dataType: "JSON",

				success: function(data) {

					setTimeout(function(){

                        Batal();

                    }, 1000);

					

					// setTimeout(function(){

                    //     reload_table();

					// }, 1000);

					swal_berhasil(); 

					setTimeout(function(){
						// reload_table();
						document.location.href = '';
					}, 1000);

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

		<h4 class="widget-title">Tambah Tempat ZIS</h4>



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

	 <input type="hidden" name="id_zis">

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Tempat ZIS </label>

		<div class="col-sm-10">

			<input type="text" id="nama_zis" name="nama_zis" placeholder="Nama Tempat ZIS" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Alamat Tempat ZIS </label>

		<div class="col-sm-10">

            <textarea name="alamat_zis" id="alamat_zis" cols="30" rows="10" placeholder="Alamat Tempat ZIS" class="col-xs-10 col-sm-5"></textarea>

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kelurahan </label>

		<div class="col-sm-10">

			<input type="text" id="kelurahan_zis" name="kelurahan_zis" placeholder="Kelurahan" class="col-xs-10 col-sm-5" />

		</div>

	</div>

    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kecamatan </label>

		<div class="col-sm-10">

			<input type="text" id="kecamatan_zis" name="kecamatan_zis" placeholder="Kecamatan" class="col-xs-10 col-sm-5" />

		</div>

	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Pengurus </label>
		<div class="col-sm-4">
			<select name="pengurus_zis" id="pengurus_zis" class="form-control">
			<option>--Pilih Pengurus--</option>
			<?php 
			$level = $this->db->query("SELECT * FROM user_type WHERE user_type_name = 'Pengurus ZIS'")->result_array();
			$user_type_id = $level[0]['user_type_id'];
			$pengurus = $this->db->query("SELECT tm_user.* FROM tm_user WHERE NOT EXISTS(SELECT pengurus_zis FROM tb_zis WHERE tb_zis.pengurus_zis=tm_user.id) AND tm_user.admin_level = $user_type_id");
			foreach($pengurus->result() as $row_kat)	{	?>
				<option class="c<?php echo $row_kat->id; ?>" value="<?php echo $row_kat->id?>"><?php echo $row_kat->nama; ?></option>
			<?php } ?>
			</select>
		</div>
	</div>

	<div class="col-md-offset-2 col-md-9">

				<button class="btn btn-info" type="button" id="btn_save" onclick="save()">

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