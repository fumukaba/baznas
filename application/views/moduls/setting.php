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
				Header
			</a>
		</li>


											
	</ul>

	<div class="tab-content">



	
	<div id="home" class="tab-pane fade in active">
	<form id="formAksi" class="form-horizontal" role="form" action="#" method="POST" >
		<div class="form-body">
			<div class="form-group">
			<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Waktu(Jam)</label>
				<div class="col-sm-10">
					<input type="text" id="waktu" name="waktu" class="col-xs-10 col-sm-5" />
				</div>

			</div>
			
			<div class="form-group">
			
			<div class="col-md-offset-2 col-md-9">
				<button class="btn btn-info" type="submit" id="btn_save" onclick="save()">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Update
				</button>
			</div>	
			</div>
		</div>
	</form>	
	</div>
	
   

	</div>
</div>

</div>
</section>

<script type="text/javascript">
	var zonk='';
	var link = "<?php echo site_url('Setting')?>";
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
	
    function ubah() {

		
		link_edit = "ajax_edit";
		
        $.ajax({
            url : "<?php echo site_url('Setting')?>/"+link_edit+"/",
            type: "GET",
            dataType: "JSON",
            success: function(result) {    
			   $("input[name='waktu']").val(result.set_data1); 
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
            url : "<?php echo site_url('Setting')?>/"+link_edit+"/",
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
</script>