
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
<?php $ide = $this->uri->segment(3);?>
<div class="widget-body">
<div class="widget-main">
<div class="row">
<div class="col-xs-12">
<?php echo form_open_multipart('Produk/update', 'class="form-horizontal"'); ?>
<input type="hidden" name="id_produk" value="<?php echo $id ?>" />
 <input type="hidden" name="id" value="<?php echo $ide ?>" />
  <input type="hidden" name="kategori_produk" value="<?php echo $produk->kategori_produk; ?>" />
<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Produk </label>
		<div class="col-sm-10">
			<input type="text" id="kode_produk" name="kode_produk" placeholder="Kode Pos Hidrologi" class="col-xs-10 col-sm-5" value="<?php echo $produk->kode_produk; ?>"/>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Produk</label>
		<div class="col-sm-10">
			<input type="text" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?php echo $produk->nama_produk; ?>" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga </label>
		<div class="col-sm-10">
			<input type="text" id="harga" name="harga" value="<?php echo $produk->harga; ?>" placeholder="harga" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Jumlah </label>
		<div class="col-sm-10">
			<input type="text" id="jumlah_stok" name="jumlah_stok" value="<?php echo $produk->jumlah_stok; ?>" placeholder="Nama Pos" class="col-xs-10 col-sm-5" />
		</div>
	</div>
	
	
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 1 </label>
		<div class="col-sm-10">
			<a target="_blank" href="<?php echo base_url().$loc[0].$foto_produk1; ?>"><?php echo $foto_produk1; ?></a>
            <input type="hidden" name="edit_bg[]" value="<?php echo $foto_produk1; ?>"/>
			<input type="file" name="up_bg[]">
			<span class="help-block"></span>
			
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 2 </label>
		<div class="col-sm-10">
			<a target="_blank" href="<?php echo base_url().$loc[0].$foto_produk2; ?>"><?php echo $foto_produk2; ?></a>
            <input type="hidden" name="edit_bg[]" value="<?php echo $foto_produk2; ?>"/>
			<input type="file" name="up_bg[]">
			<span class="help-block"></span>
			
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 3 </label>
		<div class="col-sm-10">
			 <a target="_blank" href="<?php echo base_url().$loc[0].$foto_produk3; ?>"><?php echo $foto_produk3; ?></a>
            <input type="hidden" name="edit_bg[]" value="<?php echo $foto_produk3; ?>"/>
			<input type="file" name="up_bg[]">
			<span class="help-block"></span>
			
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>
		<div class="col-sm-10">
			<input type="text" id="deskripsi" name="deskripsi" class="col-xs-10 col-sm-5" value="<?php echo $produk->deskripsi; ?>"/>
		</div>
	</div>

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Barang </label>

		<div class="col-sm-5">

			<select name='status' id='status' class='form-control'>

				<?php
                $status=$produk->status;
                if ($status== "barang") echo "<option value='barang' selected>barang</option>";
                else echo "<option value='barang'>barang</option>";
                if ($status== "jasa") echo "<option value='jasa' selected>jasa</option>";
                else echo "<option value='jasa'>jasa</option>";
                ?>
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