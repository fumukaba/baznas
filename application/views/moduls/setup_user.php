<div class="row">

<div class="col-xs-12">

<div id="form-data">

<div class="widget-box">

<div class="widget-header">

		<h4 class="widget-title">Setting Akun</h4>



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

<form  class="form-horizontal"  action="<?=base_url()?>Admin/update_set" method="POST" role="form" enctype="multipart/form-data">

	<input type="hidden" name="id_admin">

	<div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Username </label>

		<div class="col-sm-10">

			<input type="text" id="a1" name="a1" placeholder="Nama Video" class="col-xs-10 col-sm-5" value="<?php echo $this->session->userdata('id_user');?>"/>

			<span class="help-block"></span>

		</div>

	</div>



  <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Password Lama </label>

		<div class="col-sm-10">

			<input type="Password" id="a2" name="a2" placeholder="Password Lama" class="col-xs-10 col-sm-5" />

			<span class="help-block"></span>

		</div>

	</div>



  <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Password Baru </label>

		<div class="col-sm-10">

			<input type="Password" id="a3" name="a3" placeholder="Password Baru" class="col-xs-10 col-sm-5" />

			<span class="help-block"></span>

		</div>

	</div>



  <div class="form-group">

	<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Ulangi Password Baru </label>

		<div class="col-sm-10">

			<input type="Password" id="a4" name="a4" placeholder="Ulangi Password Baru" class="col-xs-10 col-sm-5" />

			<span class="help-block"></span>

		</div>

	</div>



	<div class="col-md-offset-2 col-md-9">

		<button class="btn btn-info" type="submit" nclick="return confirm('Apakah anda Yakin akan melakukan perubahan data?')">

					<i class="ace-icon fa fa-check bigger-110"></i>

					Simpan

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

