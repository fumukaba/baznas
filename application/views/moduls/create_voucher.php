<?php $title = "<i class='fa fa-briefcase'></i>&nbsp;Voucher"; ?>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<section class="content">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Voucher</h4>

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
<form class="form-horizontal" role="form" method="POST">
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Barang </label>
		<div class="col-sm-10">
			<input type="text" id="tgl_promo" name="tgl_promo" placeholder="Nama Barang" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Masukan Nominal </label>
		<div class="col-sm-10">
			<input type="text" id="tgl_promo" name="tgl_promo" placeholder="Masukan Nominal" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tanggal Expirete </label>
		<div class="col-sm-10">
			<input type="date" id="tgl_promo" name="tgl_promo" placeholder="Tanggal Expirete" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="col-md-offset-2 col-md-9">
				<button class="btn btn-info" type="submit" id="btn_save" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Submit
				</button>

				
	</div>
</form>
</div>
</div>
</div>					
</div><!-- /.row -->
</div>



</section>
</div>

<script>
	var save_method;
	var link = "<?php echo site_url('Promo')?>";
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
    });
	
	function ckeditor(){
		tinymce.init({
			selector: "textarea"
		});
	}
	
	function data(){
		$('#data').fadeIn();
	}
	
	
</script>	

<div class="row">
<div class="col-xs-12">
<div id="form-data" style="display:none;">
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Form Promo</h4>

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
	 <input type="hidden" name="id_promo">
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tanggal Promo </label>
		<div class="col-sm-10">
			<input type="text" id="tgl_promo" name="tgl_promo" placeholder="Tanggal Promo" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Produk</label>
		<div class="col-sm-10">
		<select name="id_produk" id="id_produk">
		<?php $query = $this->db->query('select * from produk');
		foreach($query->result() as $row){
		?>
			<option value="<?php echo $row->id_produk;?>"><?php echo $row->nama_produk;?></option>
		<?php } ?>	
		</select>
			
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Promo </label>
		<div class="col-sm-10">
			<input type="text" id="harga_promo" name="harga_promo" placeholder="Harga Promo" class="col-xs-10 col-sm-5" />
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