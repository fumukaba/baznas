<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


<?php $title = "<i class='fa fa-briefcase'></i>&nbsp;Order"; ?>

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



</div><br />

<table id="example" class="display nowrap" cellspacing="0"  width="100%">

    <thead>

        <tr>
             <th></th>
            <th>No.</th>

            <th>Id Order</th>

            <th>Tanggal Order</th>

            <th>Total Order</th>

            <th>Nama Order</th>

            <th>Alamat Order</th>

            <th>Telp Order</th>

            <th>Status Order</th>

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

	var link = "<?php echo site_url('Order')?>";

	var table;

	$(document).ready(function(){

      //$('#idImgLoader').show(2000);

	  $('#idImgLoader').fadeOut(2000);

	  setTimeout(function(){

            data();

      }, 2000);

    });



    function data(){

		$('#data').fadeIn();

	}

	

	$(document).ready(function() {

		table = $('#example').DataTable({ 



        "processing": true, //Feature control the processing indicator.

        "serverSide": true,


        "responsive": {
            "details": {
                "type": 'column'
            }
        },
        "columnDefs": [ {
            "data": null,
            "defaultContent": '',
            "className": 'control',
            "orderable": false,
            "targets":   0
        } ],
        "order": [ 1, 'asc' ],

        // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('Order/ajax_list')?>",

            "type": "POST"

        },



        //Set column definition initialisation properties.

        


    });

	

	});

	

	function reload_table() {

    	table.ajax.reload(null, false);

	}



    function edit(id) {

        

        save_method = 'update';

        $('#form')[0].reset();



        $.ajax({

            url : "<?php echo site_url('Order/ajax_edit_status')?>/" + id,

            type: "GET",

            dataType: "JSON",

            success: function(result) {

                console.log(result);

                // document.getElementById('id_order').value = result.id_order;

                $('[name="fc_kdorder"]').val(result.fc_kdorder);

                // document.getElementById('form').innerHTML =' <input type="text" value="bar" id="id_order1" name="id_order1"> ';

                $('[name="fc_status_kirim"]').val(result.fc_status_kirim);

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

            

            url = "<?php echo site_url('Order')?>/ajax_update_status";



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



<div id="modal_form" class="modal fade" tabindex="-1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header no-padding">

                                    <div class="table-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">

                                        <span class="white">&times;</span>

                                    </button>

                                    Status Order

                                    </div>

                                </div>



                                <div class="modal-body no-padding">

                                <div align="center">

                                <form id="form" class="form-horizontal"><br />

                                <input type="hidden" value=""  name="fc_kdorder"> 

                                <div class="form-group">

                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1">  Status Order </label>

                                        <div class="col-sm-6">

                                            <select name="fc_status_kirim" id="fc_status_kirim" class="form-control">

                                            <option>--Pilih Status Order--</option>

                                            <option value="1">Belum melakukan pembayaran, Silahkan lakukan pembayaran</option>

                                             <option value="2">Menunggu Konfirmasi admin, silahkan tunggu selama 2x24 jam</option>

                                             <option value="3">Admin telah menghubungi penjual untuk segera mengirim pesanan</option>

                                             <option value="4">Penjual Telah mengirim pesanan</option> 

                                             <option value="5">Pesanan telah diterima pembeli,terima kasih</option> 

                                             <option value="6">Pesanan telah lunas</option> 

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