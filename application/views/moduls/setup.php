<?php $title = "<i class='fa fa-cogs'></i>&nbsp;Setup Content"; ?>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<section class="content">
<div class="page-header">
	<h1>
		<?php echo $title;?>
	</h1>
</div>
<div class="tabbable">
	<ul class="nav nav-tabs" id="formAksi">
		<li class="active">
			<a data-toggle="tab" href="#home">
			<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
				Setup Sekilas
			</a>
		</li>

	    <li>
			<a data-toggle="tab" href="#banner">
			<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
				Banner
			</a>
		</li>

		 <li>
			<a data-toggle="tab" href="#gambar_banner">
			<i class="green ace-icon fa fa-file-image-o bigger-120"></i>
				Gambar Banner
			</a>
		</li>

											
	</ul>

	<div class="tab-content">



	
	<div id="home" class="tab-pane fade in active">
	<form id="formAksi" class="form-horizontal" role="form" action="#" method="POST" >
		<div class="form-body">
			<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Sekilas </label>
				<div class="col-sm-10">
					<input type="text" id="sekilas" name="sekilas" class="col-xs-10 col-sm-5" />
				</div>
			</div>
			
			<div class="form-group">
			
			<div class="col-md-offset-2 col-md-9">
				<button class="btn btn-info" type="submit" id="btn_save" >
					<i class="ace-icon fa fa-check bigger-110"></i>
					Update
				</button>
			</div>	
			</div>
		</div>
	</form>	
	</div>
	
    <div id="banner" class="tab-pane fade">
	
		
		<div class="form-body">
			<form id="formAksi2" class="form-horizontal" role="form" action="#" method="POST" >
			<div class="form-body">
				<div class="form-group">
				<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Banner 1 </label>
					<div class="col-sm-10">
						<input type="text" id="banner_1" name="banner_1" class="col-xs-10 col-sm-5" />
					</div>
				</div>

				<div class="form-group">
				<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Banner 2 </label>
					<div class="col-sm-10">
						<input type="text" id="banner_2" name="banner_2" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				
				<div class="form-group">
				<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Banner 3 </label>
					<div class="col-sm-10">
						<input type="text" id="banner_3" name="banner_3" class="col-xs-10 col-sm-5" />
					</div>
				</div>

				<div class="form-group">
				
				<div class="col-md-offset-2 col-md-9">
					<button class="btn btn-info" type="submit" id="btn_save2" >
						<i class="ace-icon fa fa-check bigger-110"></i>
						Update
					</button>
				</div>	
				</div>
			</div>
			</form>	
				
		</div>	
		
		
	
	</div>

	<div id="gambar_banner" class="tab-pane fade">
	
		
		<div class="form-body">
			<form id="form-upload" class="form-horizontal" role="form" action="<?= site_url('Setup/upload')?>" method="POST" enctype="multipart/form-data">
		      <div class="form-group" >
		      <label class="control-label col-md-3">Pilih File</label>
		      <div class="input-group col-md-6">
		        <input type="file" name="file-upload" id="file-upload">
						Ukuran : 1200 x 809;
		        <span class="help-block"></span>
		        <div class="input-group-btn">
		          <button type="submit" id="btnSave" class="btn btn-primary">Upload</button>
		        </div>
		      </div>
		      </div>
		      <div class="form-group" >
		        <label class="control-label col-md-3">Header</label>
		          <div class="input-group col-md-9">
		            <img id="preview-upload" src="#" style="height: 100px;border: 1px solid #DDC; " />
		          </div>
		      </div>
		    </form>	

		    <form id="form-upload2" class="form-horizontal" role="form" action="<?= site_url('Setup/upload2')?>" method="POST" enctype="multipart/form-data">
		      <div class="form-group" >
		      <label class="control-label col-md-3">Pilih File</label>
		      <div class="input-group col-md-6">
		        <input type="file" name="file-upload2" id="file-upload2">
						Ukuran : 1200 x 809;
		        <span class="help-block"></span>
		        <div class="input-group-btn">
		          <button type="submit" id="btnSave2" class="btn btn-primary">Upload</button>
		        </div>
		      </div>
		      </div>
		      <div class="form-group" >
		        <label class="control-label col-md-3">Header</label>
		          <div class="input-group col-md-9">
		            <img id="preview-upload2" src="#" style="height: 100px;border: 1px solid #DDC; " />
		          </div>
		      </div>
		    </form>	

		     <form id="form-upload3" class="form-horizontal" role="form" action="<?= site_url('Setup/upload3')?>" method="POST" enctype="multipart/form-data">
		      <div class="form-group" >
		      <label class="control-label col-md-3">Pilih File</label>
		      <div class="input-group col-md-6">
		        <input type="file" name="file-upload3" id="file-upload3">
						Ukuran : 1200 x 809;
		        <span class="help-block"></span>
		        <div class="input-group-btn">
		          <button type="submit" id="btnSave3" class="btn btn-primary">Upload</button>
		        </div>
		      </div>
		      </div>
		      <div class="form-group" >
		        <label class="control-label col-md-3">Header</label>
		          <div class="input-group col-md-9">
		            <img id="preview-upload3" src="#" style="height: 100px;border: 1px solid #DDC; " />
		          </div>
		      </div>
		    </form>	
				
		</div>	
		
		
	
	</div>

	</div>
</div>

</div>
</section>

<script type="text/javascript">
	var zonk='';
	var link = "<?php echo site_url('Setup')?>";
	$(document).ready(function(){
      ubah();
    });

	function data(){
		$('#data').fadeIn();
	}
	
	
	
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
	
	$(document).ready(function(){
		$('#form-upload').submit(function(e) {
			//tinyMCE.triggerSave();
			e.preventDefault(); var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
				beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
				success: function(response) {
					 swal_berhasil();
					 ubah(); 
				},
				complete: function() { $('#btnSave').text('Upload'); $('#btnSave').attr('disabled',false); },
				cache: false, contentType: false, processData: false
			});
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload").change(function(){ readURL(this); });
	});


	$(document).ready(function(){
		$('#form-upload2').submit(function(e) {
			tinyMCE.triggerSave();
			e.preventDefault(); var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
				beforeSend: function() { $('#btnSave2').text('saving...'); $('#btnSave2').attr('disabled',true); },
				success: function(response) {
					if(response.status) { swal_berhasil();
							ubah();
							
					} else { swal_berhasil();
							ubah(); }
				},
				complete: function() { $('#btnSave2').text('save'); $('#btnSave2').attr('disabled',false); },
				cache: false, contentType: false, processData: false
			});
		});

		function readURL2(input) {
			if (input.files && input.files[0]) {
				var rd2 = new FileReader(); 
				rd2.onload = function (e) { $('#preview-upload2').attr('src', e.target.result); }; rd2.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload2").change(function(){ readURL2(this); });
	});

	$(document).ready(function(){
		$('#form-upload3').submit(function(e) {
			tinyMCE.triggerSave();
			e.preventDefault(); var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
				beforeSend: function() { $('#btnSave3').text('saving...'); $('#btnSave3').attr('disabled',true); },
				success: function(response) {
					if(response.status) { swal_berhasil();
							ubah();
							
					} else { swal_berhasil();
							ubah(); }
				},
				complete: function() { $('#btnSave3').text('save'); $('#btnSave3').attr('disabled',false); },
				cache: false, contentType: false, processData: false
			});
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var rd3 = new FileReader(); 
				rd3.onload = function (e) { $('#preview-upload3').attr('src', e.target.result); }; rd3.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload3").change(function(){ readURL(this); });
	});

    function ubah() {

		
		link_edit = "ajax_edit";
		
        $.ajax({
            url : "<?php echo site_url('Setup')?>/"+link_edit+"/",
            type: "GET",
            dataType: "JSON",
            success: function(result) { 
			   var img = '<?= base_url(); ?>../assets/images/'+result.set_data5;
			   var img2 = '<?= base_url(); ?>../assets/images/'+result.set_data6;	
			   var img3 = '<?= base_url(); ?>../assets/images/'+result.set_data7;	   
			   $("input[name='sekilas']").val(result.set_data1); 

			    $("input[name='banner_1']").val(result.set_data2);
			    $("input[name='banner_2']").val(result.set_data3);  
			    $("input[name='banner_3']").val(result.set_data4);
			 $('#preview-upload').attr('src', img);
			 $('#preview-upload2').attr('src', img2);
			 $('#preview-upload3').attr('src', img3);
            }, error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
	
    $(document).on('submit', '#formAksi', function(e) { 
    tinyMCE.triggerSave(); 
      e.preventDefault();
			
				link_edit = "update_link";
		
        $.ajax({
            url : "<?php echo site_url('Setup')?>/"+link_edit+"/",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){                 
                swal_berhasil(); 
                ubah();
                //$('#a7').val();  
                setTimeout(function(){
                    $('#btn_save').text('Ubah');
                    $('#btn_save').attr('disabled', false);
                    //document.getElementById('formAksi').reset();
                }, 1000);

            }           
        });
        return false;
    });

     $(document).on('submit', '#formAksi2', function(e) {
      tinyMCE.triggerSave();
        e.preventDefault();
          $.ajax({
              url : "<?php echo site_url('Setup')?>/update_banner/",
              type: "POST",
              data:  new FormData(this),
              contentType: false,
              cache: false,
              processData:false,
              success: function(data){
                  swal_berhasil();
                  ubah();
                  //$('#a7').val();
                  setTimeout(function(){
                      $('#btn_save2').text('Update Berhasil');
                      $('#btn_save2').attr('disabled', false);
                      //document.getElementById('formAksi').reset();
                  }, 1000);

              }
          });
          return false;
      });
</script>