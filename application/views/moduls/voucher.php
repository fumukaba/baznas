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
<?php $title = "<i class='fa fa-money'></i>&nbsp;Voucher"; ?>

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

<?php if ($this->session->flashdata('berhasil')) { echo '

  <div class="alert alert-success">

    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <strong>Berhasil!</strong> '.$this->session->flashdata('berhasil').'

  </div>

  ';} if ($this->session->flashdata('gagal')) { echo '

    <div class="alert alert-danger">

    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    <strong>Gagal!</strong> '.$this->session->flashdata('gagal').'

  </div>

  ';}?>

  <script type="text/javascript">

	window.setTimeout(function() {

	    $(".alert").fadeTo(500, 0).slideUp(500, function(){

	        $(this).remove(); 

	    });

	}, 5000);

	</script>

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

            <th>Nama Barang</th>

            <th>Nominal</th>

			<th>Tanggal Expired</th>

			<th>Kode Voucher</th>

			<th>Tanggal Terbit</th>

            <th>Status</th>

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

<form id="form-add" class="form-horizontal" action="<?= site_url('Voucher/ajax_add')?>" method="POST" role="form" enctype="multipart/form-data">

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Barang </label>

		<div class="col-sm-10">

			<select class="form-control col-sm-5" id="barang" name="barang">

				<option value="0" selected="selected">Pilih Barang</option>

	           <?php foreach ($barang as $b) { ?>

		            <option value="<?php echo $b['fc_kdbarang'];?>"><?php echo $b['fv_nama_barang'];?></option>

		        <?php }?>

	          </select>

			<span class="help-block"></span>

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nominal </label>

		<div class="col-sm-10">

			<input type="text" id="nominal" name="nominal" placeholder="Nominal" class="col-xs-10 col-sm-5" />

			<span class="help-block"></span>

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tanggal Expired </label>

		<div class="col-sm-5">

			<input type="date" name="expired" id="expired" class="col-xs-10 col-sm-5" />

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


<div id="modal_form" class="modal fade" tabindex="-1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header no-padding">

                                    <div class="table-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">

                                        <span class="white">&times;</span>

                                    </button>

                                    Status Voucher

                                    </div>

                                </div>



                                <div class="modal-body no-padding">

                                <div align="center">

                                <form id="form" class="form-horizontal"><br />

                                <input type="hidden" value=""  name="fc_id_voucher"> 

                                <div class="form-group">

                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1">  Status Voucher </label>

                                        <div class="col-sm-6">

                                            <select name="fc_status" id="fc_status" class="form-control">

                                            <option>--Pilih Status Voucher--</option>

                                            <option value="0">Belum Dipakai</option>

                                             <option value="1">Sudah Dipakai</option>

                                            </select>

                                        </div>

                                </div><br />

                                <div class="form-group no-padding-right">

                                    <button class="btn btn-info" type="button" id="btn_save" onclick="simpan()">

                                        <i class="ace-icon fa fa-pencil bigger-110"></i>

                                        Ubah

                                    </button>

                                    <button type="button" id="btn_close" class="btn btn-default hide" data-dismiss="modal">Close</button>

                                </div>

                                </form>

                                </div>      

                                </div>

                            </div><!-- /.modal-content -->

                        </div><!-- /.modal-dialog -->

</div>  

<script>

	var save_method;

	var link = "<?php echo site_url('Voucher')?>";

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

		url = "<?= site_url()?>Pencairanpoin/update_kategori/";

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

	

	$(document).ready(function(){

      //$('#idImgLoader').show(2000);

	  $('#idImgLoader').fadeOut(2000);

	  setTimeout(function(){

            data();

      }, 2000);

	  setTimeout(function(){

            ckeditor();

      }, 2000);

	  setTimeout(function(){

            ckeditor2();

      }, 2000);

    });

	

	

	function data(){

		$('#data').fadeIn();

	}

	

	$(document).ready(function() {

		table = $('#example').DataTable({ 



        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order
		

       



        // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('Voucher/ajax_list')?>",

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

	function update(id) {

        

        save_method = 'update';

        $('#form')[0].reset();



        $.ajax({

            url : "<?php echo site_url('Voucher/ajax_edit_status')?>/" + id,

            type: "GET",

            dataType: "JSON",

            success: function(result) {

                console.log(result);

                // document.getElementById('id_order').value = result.id_order;

                $('[name="fc_id_voucher"]').val(result.fc_id_voucher);

                // document.getElementById('form').innerHTML =' <input type="text" value="bar" id="id_order1" name="id_order1"> ';

                $('[name="fc_status"]').val(result.fc_status);

                $('#modal_form').modal('show');

            }, error: function (jqXHR, textStatus, errorThrown) {

                alert('Error get data from ajax');

            }

        });

    }

    function simpan() {

            $('#btn_save').text('Saving...');

            $('#btn_save').attr('disabled', true);



            var url;

            

            url = "<?php echo site_url('Voucher')?>/ajax_update_status";



            $.ajax({

                url: url,

                type: "POST",

                data: $('#form').serialize(),

                dataType: "JSON",

                success: function(result) {

                    if (result.status) {

                        

                        setTimeout(function(){

                            $('#btn_close').click();

                        }, 1000);

                        

                        setTimeout(function(){

                            reload_table();

                        }, 1000);

                    }

                    setTimeout(function(){

                        $('#btn_save').text('Save');

                        $('#btn_save').attr('disabled', false);

                        document.getElementById('form').reset();

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

    }

</script>	

