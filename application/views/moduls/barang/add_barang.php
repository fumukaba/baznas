<div class="row">

<div class="col-xs-12">

<div id="form-data">

<div class="widget-box">

<div class="widget-header">

		<h4 class="widget-title">Form Tambah Detail Barang</h4>

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
<?php $id = $this->uri->segment(3)?>
<input type="hidden" id="fc_id" name="fc_id" value="<?php echo $id;?>" />
<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Barang</label>
		<div class="col-sm-10">
			<input type="char" id="fc_kdbarang" name="fc_kdbarang" placeholder="Kode Barang" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Produk</label>
		<div class="col-sm-10">
			<input type="int" id="fc_kdkategori" name="fc_kdkategori" placeholder="Kode Kategori" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga </label>
		<div class="col-sm-10">
			<input type="int" id="harga" name="fc_kdkategori" placeholder="fc_kdkategori" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jumlah </label>
		<div class="col-sm-10">
			<input type="text" id="jumlah_stok" name="jumlah_stok" placeholder="Jumlah" class="col-xs-10 col-sm-5" />
		</div>
	</div>

	

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 1 </label>
		<div class="col-sm-10">
			<input type="file" name="up_line_patok[]" required>
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 2 </label>
		<div class="col-sm-10">
			<input type="file" name="up_line_patok[]" required>
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 3 </label>
		<div class="col-sm-10">
			<input type="file" name="up_line_patok[]" required>
			<span class="help-block"></span>
		</div>
	</div>

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 4 </label>
		<div class="col-sm-10">
			<input type="file" name="up_line_patok[]" required>
			<span class="help-block"></span>
		</div>
	</div>
	

	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>
		<div class="col-sm-10">
			<input type="text" id="fv_deskripsi" name="fv_deskripsi" class="col-xs-10 col-sm-5" placeholder="Deskripsi" />
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Barang </label>
		<div class="col-sm-5">
			<select name='status' id='status' class='form-control'>
				<option value="">Pilih Status</option>
				<option value="barang">Barang</option>
    			<option value="jasa">Jasa</option>
           </select>
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