<div class="modal fade" id="modal-6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	  		<div class="modal-content">
	    		<div class="modal-header">
	     		 	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      			<h4 class="modal-title"></h4>
	    		</div>
	     		<div class="modal-body" style="overflow:auto;">
					<div style="text-align: center;"><div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Barang Pindah </label>
														<div class="col-sm-8">
															<input type="text" id="kodene" name="kodene"  class="col-xs-10 col-sm-5" readonly="" />
															<span class="help-block"></span>
														</div>
					</div></div><br /><br />
					<div style="text-align: center;"><a href="<?php echo base_url('Barang_pindah')?>" class="btn btn-danger">Kembali Ke Barang Pindah</a></div>
				</div>
	      		<div class="modal-footer">
	        		<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	      		</div>
	    	</div>
	  	</div>
</div>
<div class="modal fade" id="modal-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	  		<div class="modal-content">
	    		<div class="modal-header">
	     		 	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      			<h4 class="modal-title">Pilih Barang</h4>
	    		</div>
	     		<div class="modal-body" style="overflow:auto;">
						<?php	$this->load->view('moduls/produk/popup_stok');?>
					</div>
	      		<div class="modal-footer">
	        		<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	      		</div>
	    	</div>
	  	</div>
</div>
<div class="modal fade" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	  		<div class="modal-content">
	    		<div class="modal-header">
	     		 	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      			<h4 class="modal-title">Pilih Gudang</h4>
	    		</div>
	     		<div class="modal-body" style="overflow:auto;">
						<?php	$this->load->view('moduls/produk/popup_gudang');?>
					</div>
	      		<div class="modal-footer">
	        		<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	      		</div>
	    	</div>
	  	</div>
</div>

<div class="modal fade" id="modal-5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog">
	  		<div class="modal-content">
	    		<div class="modal-header">
	     		 	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      			<h4 class="modal-title">Pilih Gudang</h4>
	    		</div>
	     		<div class="modal-body" style="overflow:auto;">
						<?php	$this->load->view('moduls/produk/popup_gudang_tujuan');?>
					</div>
	      		<div class="modal-footer">
	        		<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	      		</div>
	    	</div>
	  	</div>
</div>

<div class="row">
<div class="col-xs-12">
<div id="form-data" >
<div class="widget-box">
<div class="widget-header">
		<h4 class="widget-title">Input Barang Pindah</h4>

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
							Bukti Pindah Barang	
						</h4>
					</div>

					<div class="widget-body">
						<div class="widget-main">
						    	<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Barang Pindah </label>
									<div class="col-sm-8">
										<input type="text" id="fc_kdbarang_pindah" name="fc_kdbarang_pindah" placeholder="No. Barang Pindah" class="col-xs-10 col-sm-5" />
										<span class="help-block"></span>
									</div>
								</div>
								<?php $date2 = date('Y-m-d H:i:s');?>
								<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Tanggal Barang Pindah </label>
									<div class="col-sm-8">
										<input type="text" id="fd_tgl_barang_pindah" name="fd_tgl_barang_pindah" value="<?php echo $date2 ?>" placeholder="Tanggal Barang Pindah" class="col-xs-10 col-sm-5" />
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gudang Asal </label>
														<input type="hidden" id="fc_kdgudang_asal" name="fc_kdgudang_asal" class="col-xs-10 col-sm-5" />
														<div class="col-sm-8">
															<input type="text" id="fv_nmgudang" name="fv_nmgudang" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
														 <button onclick="ca2()" type="button" class="btn btn-default btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>

								</div>
								<div class="form-group">
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Gudang Tujuan </label>
														<input type="hidden" id="fc_kdgudang_tujuan" name="fc_kdgudang_tujuan" class="col-xs-10 col-sm-5" />
														<div class="col-sm-8">
															<input type="text" id="fv_nmgudang2" name="fv_nmgudang2" class="col-xs-10 col-sm-5" />
															<span class="help-block"></span>
														</div>
														 <button onclick="ca3()" type="button" class="btn btn-default btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>

								</div>
						</div>
					</div>
				</div>	
			</div>
			
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
													<label class="col-sm-2 control-label no-padding-right" for="form-field-1">Jumlah Barang </label>
														<div class="col-sm-8">
															<input type="text" id="f_jumlah_barang" name="f_jumlah_barang" class="col-xs-10 col-sm-5" />
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
		
														<div class="col-md-offset-2 col-md-9">
															<button type="button" value="Add" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
														</div>
													</div>

												</div>
											</div>
										</div>
			</div>							
	</div>		
    
</form>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
     $(document).ready(function(){
		 getNomor();
	});

    function getNomor(){
		$.get("<?php echo site_url('Barang_pindah/getNomor')?>", $(this).serialize())
		.done(function(data) {
			$('#fc_kdbarang_pindah').val(data);
			$('#kodene').val(data);
			var nomore = data;
			//  console.log(nomore);
		});
	}	
	
		function pilihDatastok(id2, nama2){
	    document.getElementById('fv_nama_barang').value = nama2;
	    document.getElementById('fc_kdbarang').value = id2;
			$('#modal-3').modal('hide');
	}
	
    function pilihDatagudang(id3, nama3){
	    document.getElementById('fc_kdgudang_asal').value = id3;
	    document.getElementById('fv_nmgudang').value = nama3;
		$('#modal-4').modal('hide');
	}
	
	 function pilihDatagudangtjn(id3, nama3){
	    document.getElementById('fc_kdgudang_tujuan').value = id3;
	    document.getElementById('fv_nmgudang2').value = nama3;
		$('#modal-5').modal('hide');
	}
	
	function ca() {
		$("#modal-3").modal('show');
	}

    function ca2() {
		$("#modal-4").modal('show');
	}
    
    function ca3() {
		$("#modal-5").modal('show');
	}
	
	function save() {
		var url;
		url = "<?= site_url()?>Barang_pindah/save/";
		$('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true);
		tinyMCE.triggerSave();
		$.ajax({
			url : url, type: "POST", dataType: "JSON", data: $('#formAksine').serialize(),
			success: function(data) {
				if(data.status) { swal_berhasil(); setTimeout(function(){reload_table();}, 1000);
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
					}
				}
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);
				sukses();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal_berhasil(); setTimeout(function(){reload_table();}, 1000);
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 
				sukses();
			}
		});
	}
	
	function sukses() {
		$("#modal-6").modal('show');
	}
</script>