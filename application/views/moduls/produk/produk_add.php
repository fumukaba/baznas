

<div class="row">

<div class="col-xs-12">

<div id="form-data">

<div class="widget-box">

<div class="widget-header">

		<h4 class="widget-title">Form Produk</h4>



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

<?php echo form_open_multipart('Barang/save', 'class="form-horizontal"'); ?>
<?php $id = $this->uri->segment(3);
$type = $this->session->userdata('admin_level');

?>
<input type="hidden" id="fc_kdkategori" name="fc_kdkategori" value="<?php echo $id;?>" />
<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Barang </label>

		<div class="col-sm-10">

			<input type="text" id="fc_kdbarang" name="fc_kdbarang" placeholder="Kode Produk" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Produk</label>

		<div class="col-sm-10">

			<input type="text" id="fv_nama_barang" name="fv_nama_barang" placeholder="Nama Produk" class="col-xs-10 col-sm-5" />

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Publish </label>
		<?php
			if($type=='3'){
				$read = 'readonly';
			}else{
				$read = '';
			} 
		?>
		<div class="col-sm-10">

			<input type="text" id="fd_harga_barang_publish" name="fd_harga_barang_publish" placeholder="Harga Publish" class="col-xs-10 col-sm-5" <?php echo $read;?>/>

		</div>

	</div>
	
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Min </label>

		<div class="col-sm-10">

			<input type="text" id="fd_harga_barang_min" name="fd_harga_barang_min" placeholder="Harga Min" class="col-xs-10 col-sm-5" <?php echo $read;?>/>

		</div>

	</div>



    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>

		<div class="col-sm-10">

			<input type="text" id="fv_deskripsi" name="fv_deskripsi" class="col-xs-10 col-sm-5" placeholder="Deskripsi" />

		</div>

	</div>
	
	

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jenis Poin</label>

		<div class="col-sm-10">

			<input type="text" id="fv_jenis_poin" name="fv_jenis_poin" placeholder="exp : 2.5 ..." class="col-xs-10 col-sm-5" />

		</div>

	</div>
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Berat(gram) </label>

		<div class="col-sm-10">

			<input type="text" id="fv_berat" name="fv_berat" placeholder="Jenis Poin" class="col-xs-10 col-sm-5" />

		</div>

	</div>
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Dimensi </label>

		<div class="col-sm-10">

			<input type="text" id="fv_dimensi" name="fv_dimensi" placeholder="Dimensi" class="col-xs-10 col-sm-5" />

		</div>

	</div>
	
		<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Stok </label>

		<div class="col-sm-10">

			<select id="fc_status_stok" name="fc_status_stok" class="col-xs-10 col-sm-5">
			    <option value="">Pilih Status Stok</option>
			    <option value="in stok">In Stok</option>
			    <option value="pre order">Pre Order</option>
			</select>

		</div>

	</div>
	

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 1 (1200x1486) (max size : 2 Mb ) </label>

		<div class="col-sm-10">

			<input type="file" name="up_line_patok[]" >

			<span class="help-block"></span>

			

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 2 (1200x1486)(max size : 2 Mb )</label>

		<div class="col-sm-10">

			<input type="file" name="up_line_patok[]" >

			<span class="help-block"></span>

			

		</div>

	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 3 (1200x1486)(max size : 2 Mb )</label>

		<div class="col-sm-10">

			<input type="file" name="up_line_patok[]" >

			<span class="help-block"></span>

			

		</div>

	</div>
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 4 (1200x1486)(max size : 2 Mb )</label>

		<div class="col-sm-10">

			<input type="file" name="up_line_patok[]" >

			<span class="help-block"></span>

			

		</div>

	</div>




	<div class="col-md-offset-2 col-md-9">

				<input type="submit" name="mit" class="btn btn-primary" value="Submit">



				&nbsp; &nbsp; &nbsp;

				<button class="btn" type="reset">

				<i class="ace-icon fa fa-undo bigger-110"></i>

					Reset

				</button>

	</div>

<?php echo form_close(); ?>

</div>

</div>

</div>

</div><!-- /.row -->

</div>

</div><!-- /.row -->

</div>

<script type="text/javascript">
	$(document).ready(function(){
		 getNomor();
	});

	function getNomor(){
		$.get("<?php echo site_url('Barang/getNomor')?>", $(this).serialize())
		.done(function(data) {
			$('#fc_kdbarang').val(data);
			var nomore = data;
			//  console.log(nomore);
		});
	}	
</script>