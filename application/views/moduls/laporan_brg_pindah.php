 <link rel="stylesheet" href="<?php echo base_url() . 'assets/j-ui/jquery-ui.css'; ?>">
 <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo base_url() . 'assets/j-ui/jquery3.js'; ?>"></script>
 <script src="<?php echo base_url() . 'assets/j-ui/jquery-ui.js'; ?>"></script>
 <script src="<?php echo base_url() . 'assets/j-ui/datatablejs.js'; ?>"></script>
 <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.js"></script>
 <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<style type="text/css">
	td.details-control {
   		background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
	}
</style>
<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Laporan Barang Pindah"; ?>
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
  <form id="formAksine" class="form-horizontal" action="<?php echo base_url('Laporan_brg_pindah/prints') ?>" target="_blank" method="POST" role="form" enctype="multipart/form-data">
  <div class="input-group input-daterange">

      <input type="text" id="tgl1" name="tgl1" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="From:">

      <div class="input-group-addon">to</div>

      <input type="text" id="tgl2" name="tgl2" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="To:">

   </div><br />
  <button type="submit" value="Cetak Laporan" id="btnSave" class="btn btn-default"><i class="fa fa-print"></i> Cetak Laporan</button>
   </form>
</div><br />
</div><!-- /.span -->
</div>					
</div><!-- /.row -->
</div>
</div>
</div>

<script>
	var zonk=''; 
	var save_method;
	var link = "<?php echo site_url('Bpb')?>";
	var table;

	$(document).ready(function(){
      
	  $('.input-daterange input').each(function() {
      	$(this).datepicker('clearDates');
      });	

	  $('#idImgLoader').fadeOut(2000);
	  setTimeout(function(){
            data();
      }, 2000);
	  
    });

	$(document).ready(function(){
		 getNomor();
	});

    function data(){
		$('#data').fadeIn();
	}



</script>	
