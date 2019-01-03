
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
<?php 
	$type = $this->session->userdata('admin_level');
?>
<?php echo form_open_multipart('Barang/update', 'class="form-horizontal"'); ?>
<input type="hidden" name="id_produk" value="<?php echo $id ?>" />
 <input type="hidden" name="id" value="<?php echo $id ?>" />
  <input type="hidden" name="fc_kdkategori" value="<?php echo $produk->fc_kdkategori; ?>" />
   <input type="hidden" name="fc_kdbarang" value="<?php echo $produk->fc_kdbarang; ?>" />
  
  <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Produk</label>

		<div class="col-sm-10">

			<input type="text" id="fv_nama_barang" name="fv_nama_barang" placeholder="Nama Produk" class="col-xs-10 col-sm-5" value="<?php echo $produk->fv_nama_barang; ?>"/>

		</div>

	</div>
	<?php
			if($type=='3'){
				$read = 'readonly';
			}else{
				$read = '';
			} 
		?>
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Publish </label>

		<div class="col-sm-10">

			<input type="text" id="fd_harga_barang_publish" name="fd_harga_barang_publish" placeholder="Harga Publish" class="col-xs-10 col-sm-5" value="<?php echo $produk->fd_harga_barang_publish; ?>" <?php echo $read;?>/>

		</div>

	</div>
	
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Harga Min </label>

		<div class="col-sm-10">

			<input type="text" id="fd_harga_barang_min" name="fd_harga_barang_min" placeholder="Harga Min" class="col-xs-10 col-sm-5" value="<?php echo $produk->fd_harga_barang_min; ?>" <?php echo $read;?>/>

		</div>

	</div>



    <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Deskripsi </label>

		<div class="col-sm-10">

			<input type="text" id="fv_deskripsi" name="fv_deskripsi" class="col-xs-10 col-sm-5" placeholder="Deskripsi" value="<?php echo $produk->fv_deskripsi; ?>" />

		</div>

	</div>
	
	
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Jenis Poin </label>

		<div class="col-sm-10">

			<input type="text" id="fv_jenis_poin" name="fv_jenis_poin" placeholder="exp : 2.5 ..." class="col-xs-10 col-sm-5" value="<?php echo $produk->fv_jenis_poin; ?>"/>

		</div>

	</div>
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Berat </label>

		<div class="col-sm-10">

			<input type="text" id="fv_berat" name="fv_berat" placeholder="Jenis Poin" class="col-xs-10 col-sm-5" value="<?php echo $produk->fv_berat; ?>" />

		</div>

	</div>
	
	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Dimensi </label>

		<div class="col-sm-10">

			<input type="text" id="fv_dimensi" name="fv_dimensi" placeholder="Dimensi" class="col-xs-10 col-sm-5"  value="<?php echo $produk->fv_dimensi; ?>"/>

		</div>

	</div>
	
		<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Status Stok </label>

		<div class="col-sm-10">

			<select id="fc_status_stok" name="fc_status_stok" class="col-xs-10 col-sm-5">
			    
            <?php
                $status= $produk->fc_status_stok;
                 if ($status== "") echo "<option value='' selected>Pilih Status Stok</option>";
                else echo "<option value='in stok'>In Stok</option>";
                if ($status== "in stok") echo "<option value='in stok' selected>In Stok</option>";
                else echo "<option value='in stok'>In Stok</option>";
                if ($status== "pre order") echo "<option value='pre order' selected>Pre Order</option>";
                else echo "<option value='pre order'>Pre Order</option>";                     
                ?>
            </select>    
		</div>

	</div>
  
	
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 1 (1200x1486)(max size : 2 Mb )</label>
		<div class="col-sm-10">
			<a target="_blank" href="<?php echo base_url().$loc[0].$fc_img_1; ?>"><?php echo $fc_img_1; ?></a>
            <input type="hidden" name="edit_bg[]" value="<?php echo $fc_img_1; ?>"/>
			<input type="file" name="up_bg[]">
			<span class="help-block"></span>
			
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 2 (1200x1486)(max size : 2 Mb )</label>
		<div class="col-sm-10">
			<a target="_blank" href="<?php echo base_url().$loc[1].$fc_img_2; ?>"><?php echo $fc_img_2; ?></a>
            <input type="hidden" name="edit_bg[]" value="<?php echo $fc_img_2; ?>"/>
			<input type="file" name="up_bg[]">
			<span class="help-block"></span>
			
		</div>
	</div>
	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 3 (1200x1486)(max size : 2 Mb )</label>
		<div class="col-sm-10">
			 <a target="_blank" href="<?php echo base_url().$loc[2].$fc_img_3; ?>"><?php echo $fc_img_3; ?></a>
            <input type="hidden" name="edit_bg[]" value="<?php echo $fc_img_3; ?>"/>
			<input type="file" name="up_bg[]">
			<span class="help-block"></span>
			
		</div>
	</div>

    	<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Foto 4 (1200x1486)(max size : 2 Mb )</label>
		<div class="col-sm-10">
			 <a target="_blank" href="<?php echo base_url().$loc[3].$fc_img_4; ?>"><?php echo $fc_img_4; ?></a>
            <input type="hidden" name="edit_bg[]" value="<?php echo $fc_img_4; ?>"/>
			<input type="file" name="up_bg[]">
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