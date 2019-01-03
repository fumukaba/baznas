<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Riwayat Pencairan Poin"; ?>

<?php $key = $_GET['id']; ?>

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

<!-- <div class="box-header">

	<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>

	<button class="btn btn-danger" onclick="Add()"><i class="fa fa-plus"></i> Tambah Data</button>

</div><br /> -->

<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="overflow-x:scroll;">

    <thead>

        <tr>

            <th>No.</th>

            <th>User</th>

            <th>Poin</th>

            <th>Nominal</th>

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

	var zonk='';

	var save_method;

	var link = "<?php echo site_url('Riwayat_Poin')?>";

	var table;

	var kdUser = "<?php echo @$key;?>";



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

		table = $('#dynamic-table').DataTable({



        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

		"bDestroy": true,

        "order": [], //Initial no order.



        // Load data for the table's content from an Ajax source

        "ajax": {

            "url": link+"/ajax_listid/"+kdUser,

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
</script>	