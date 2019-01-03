<div class="row">
<div class="col-xs-12">
<div id="form-data" >
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Input Barang Masuk</h4>

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

<style type="text/css"> #loader{display: none} #preview{display: none}</style>
<form id="formAksine" class="form-horizontal" action="#" method="POST" role="form" enctype="multipart/form-data">
	 <div class="row">
			<div class="col-sm-6">
										<div class="widget-box">
											<div class="widget-header">
												<h4 class="smaller">
													Bukti Penerimaan Barang	
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Bpb </label>
														<div class="col-sm-8">
															<input type="text" id="no_bpb" name="no_bpb" placeholder="No. Bpb" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
													</div>
													<?php $date = date('Y-m-d');?>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tgl Bpb </label>
														<div class="col-sm-8">
															<input type="text" id="tgl_bpb" name="tgl_bpb" placeholder="Tgl Bpb" value="<?php echo $date ?>" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
													</div>
													<?php $date2 = date('Y-m-d H:i:s');?>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tgl Input </label>
														<div class="col-sm-8">
															<input type="text" id="tgl_input" name="tgl_input" value="<?php echo $date2 ?>" placeholder="Tgl Input" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
													</div>
													<?php $user = $this->session->userdata('id_user')?>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Oleh </label>
														<div class="col-sm-8">
															<input type="text" id="id_user" name="id_user" placeholder="Oleh" value="<?php echo $user;?>" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
													</div>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Supplier </label>
														<div class="col-sm-8">
															<input type="text" id="nama_supplier" name="nama_supplier" placeholder="Nama Supplier" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
													</div>
													<hr>

													<!-- #section:elements.tooltip -->
													

													<!-- /section:elements.tooltip -->
												</div>
											</div>
										</div>
									</div><!-- /.col -->
									
									<div class="col-sm-6">
										<div class="widget-box">
											<div class="widget-header">
												<h4 class="smaller">
													Cari Stok
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gudang </label>
														<input type="hidden" id="fc_kdgudang" name="fc_kdgudang" class="col-xs-10 col-sm-5" />
														<div class="col-sm-8">
															<input type="text" id="fv_nmgudang" name="fv_nmgudang" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
														 <button onclick="ca2()" type="button" class="btn btn-default btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>

													</div>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Kode Stok </label>
														<div class="col-sm-8">
															<input type="text" id="fc_kdbarang" name="fc_kdbarang" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
														 <button onclick="ca()" type="button" class="btn btn-default btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>

													</div>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nama Barang </label>
														<div class="col-sm-8">
															<input type="text" id="fv_nama_barang" name="fv_nama_barang" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>

													</div>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Qty Terima </label>
														<div class="col-sm-8">
															<input type="text" id="qty_terima" name="qty_terima" onkeyup="sum();" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>

													</div>

													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Harga Beli </label>
														<div class="col-sm-8">
															<input type="text" id="harga_beli" name="harga_beli" onkeyup="sum();" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>

													</div>
													<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Subtotal </label>
														<div class="col-sm-8">
															<input type="text" id="subtotal" name="subtotal" class="col-xs-10 col-sm-5" readonly="" />
															<span class="help-block"></span>
														</div>

													</div>
													<!-- #section:elements.tooltip -->
													<div class="form-group">
		
														<div class="col-md-offset-2 col-md-9">
															<button type="button" value="Add" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
														</div>
													</div>

													<!-- /section:elements.tooltip -->
												</div>
											</div>
										</div>
									</div><!-- /.col -->
								</div>


			

									
</form>