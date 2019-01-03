<?php $title = "<i class='fa fa-briefcase'></i>&nbsp;Produk Detail"; ?>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Nama Prduk</h4>

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
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Data Produk </label>

										<div class="col-sm-5">
											<select name="produk" id="produk" class="form-control">
												<option>--Produk--</option>
													<?php 
													foreach($produk as $row_kat)	{	?>
														<option value="<?php echo $row_kat->id_produk?>"><?php echo $row_kat->produk_utama?></option>
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
	   setTimeout(function(){
            ckeditor();
      }, 2000);
    });
	
	 function data(){
		$('#data').fadeIn();
	 }
	 
	function ckeditor(){
		tinymce.init({
			selector: "textarea"
		});
	} 

	$(function(){ // sama dengan $(document).ready(function(){

		$('#produk').change(function(){

           // $('#form-data').fadeOut('slow');

			$('#kota').html("<img style='display: block; margin: 0 auto; text-align: center; ' src='<?php echo base_url();?>assets/img/loader-dark.gif'>"); //Menampilkan loading selama proses pengambilan data kota

			var id = $(this).val(); //Mengambil id provinsi
                      
			$.get("<?php echo base_url('Produk/create_load'); ?>", {id:id}, function(data){
				$('#kota').html(data);
			});
			setTimeout(function(){
				tinymce.init({
					selector: "textarea"
				});
			}, 2000);
		});

	});		
	
</script>