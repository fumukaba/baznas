<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Foto"; ?>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Nama Album</h4>

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
								<!-- PAGE CONTENT BEGINS -->
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Data Album </label>

										<div class="col-sm-5">
											<select name="album" id="album" class="form-control">
												<option>--Album--</option>
													<?php 
													foreach($album as $row_kat)	{	?>
														<option value="<?php echo $row_kat->id_album?>"><?php echo $row_kat->album_nama?></option>
													<?php } ?>
											</select>
										</div>
									</div>
							</div>
			</div>					
		</div>
	</div>
</div>
</div><!-- /.span -->
<br />
<span id="kota"></span>

<script>

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

	$(function(){ // sama dengan $(document).ready(function(){

		$('#album').change(function(){

           // $('#form-data').fadeOut('slow');

			$('#kota').html("<img style='display: block; margin: 0 auto; text-align: center; ' src='<?php echo base_url();?>assets/img/loader-dark.gif'>"); //Menampilkan loading selama proses pengambilan data kota

			var id = $(this).val(); //Mengambil id provinsi
                      
			$.get("<?php echo base_url('Gallery/create_load'); ?>", {id:id}, function(data){
				$('#kota').html(data);
			});
			setTimeout(function(){
			  $("#dynamic-table").dataTable();
			}, 3000);
		});

	});	
	
</script>