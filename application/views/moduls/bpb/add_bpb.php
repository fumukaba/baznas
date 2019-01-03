 <link rel="stylesheet" href="<?php echo base_url() . 'assets/j-ui/jquery-ui.css'; ?>">
 <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo base_url() . 'assets/j-ui/jquery3.js'; ?>"></script>
 <script src="<?php echo base_url() . 'assets/j-ui/jquery-ui.js'; ?>"></script>
 <script src="<?php echo base_url() . 'assets/j-ui/datatablejs.js'; ?>"></script>
 <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.js"></script>
 <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.js"></script>
<style type="text/css">
	td.details-control {
   		background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
	}
</style>
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
	     		<div class="modal-body" >
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
	      			<h4 class="modal-title"></h4>
	    		</div>
	     		<div class="modal-body" style="overflow:auto;">
					<div style="text-align: center;"><div class="form-group">
							<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> No. Bpb </label>
														<div class="col-sm-8">
															<input type="text" id="no_bpbne" name="no_bpbne"  class="col-xs-10 col-sm-5" readonly="" />
															<span class="help-block"></span>
														</div>
					</div></div><br /><br />
					<div style="text-align: center;"><a href="<?php echo base_url('Bpb2')?>" class="btn btn-danger">Kembali Ke Bpb</a></div>
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
	

													<form id="forme" method="post">
													<input type="submit" value="Hapus" class="btn btn-danger">	<br />	<br />	<br />
													<table id="example3" class="display responsive nowrap" cellspacing="0" width="100%">
													    <thead>
													        <tr>
													        	<th></th>
													        	<th></th>
													            <th>No.</th>
																<th>Kode Stok</th>
																<th>Nama Stok</th>
																<th>Qty Terima</th>
																<th>Harga Satuan</th>
																<th>Subtotal</th>
													        </tr>
													    </thead>
													    <tbody></tbody>
													</table><br />
													
												    </form>
												    <form id="formne" method="post">
												    	<?php $user = $this->session->userdata('id_user');?>
												    	<input type="hidden" name="fc_user" value="<?php echo $user;?>">
												    	<input type="hidden" name="fc_nobpb" value="<?php echo $id;?>">
												    	<input type="submit" id="btn" value="Simpan Transaksi" class="btn btn-primary">	
												    </form>						

</div>
</div>
</div>					
</div><!-- /.row -->
</div>
</div><!-- /.row -->
</div>
<?php $session = $this->session->userdata('id_user');?>




<script>
	var zonk=''; 
	var save_method;
	var link = "<?php echo site_url('Bpb')?>";
	var table;
	var nomer = "<?php echo $session;?>";

	

	$(document).on('submit', '#forme', function(e) {  
      e.preventDefault();
      if (confirm('Apakah Anda Yakin Membatalkan Transaksi Ini?')) {
            $.ajax({
                url : "<?php echo site_url('Bpb/generate_act')?>/",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){  
                setTimeout(function(){
                    reload_table();
                }, 1000);

                swal_berhasil(); 
                }           
            });
        }
        return false;
    }); 

    $(document).on('submit', '#formne', function(e) {  
      e.preventDefault();
      if (confirm('Apakah Anda Yakin Menyimpan Transaksi Ini?')) {
      		$('#btn').text('saving...');$('#btn').attr('disabled',true); 
            $.ajax({
                url : "<?php echo site_url('Bpb/generate_act_simpan')?>/",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){  
                setTimeout(function(){
                    reload_table();
                }, 1000);
                sukses();
                $('#btn').text('Simpan Transaksi');$('#btn').attr('disabled',false); 
                }           
            });
        }
        return false;
    }); 

    $(document).ready(function(){
		 getNomor();
	});

	 $(document).ready(function() {
 
		
  table = $('#example3').DataTable({

      "paging":   false,
      "ordering": false,
      "info":     false,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url('Bpb')?>/ajax_list_bpb/"+nomer,
          "type": "POST"
      },

      //Set column definition initialisation properties.
       responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'asc' ]

  });
});

	function pilihDatastok(id2, nama2){
	    document.getElementById('fv_nama_barang').value = nama2;
	    document.getElementById('fc_kdbarang').value = id2;
			$('#modal-3').modal('hide');
	}

	function pilihDatagudang(id3, nama3){
	    document.getElementById('fc_kdgudang').value = id3;
	    document.getElementById('fv_nmgudang').value = nama3;
			$('#modal-4').modal('hide');
	}

    function Tambah() {
		$('.form-group').removeClass('has-error');
		$('.help-block').empty(); 
		save_method = 'add'; 
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow'); 
		$('[name="userfile"]').val(zonk);
		
	}

	function getNomor(){
		$.get("<?php echo site_url('Bpb/getNomor')?>", $(this).serialize())
		.done(function(data) {
			$('#no_bpb').val(data);
			$('#no_bpbne').val(data);
			var nomore = data;
			//  console.log(nomore);
		});
	}	

	  function updateNomor(){
		$.get("<?php echo site_url('Bpb/updateNomor')?>", $(this).serialize())
		.done(function(data) {  });
    }

	setInterval('getNomor()', 2000);

	function ca() {
		$("#modal-3").modal('show');
	}

	function ca2() {
		$("#modal-4").modal('show');
	}

	function sukses() {
		$("#modal-5").modal('show');
	}

	function sum() {
      var txtFirstNumberValue = document.getElementById('qty_terima').value;
      var txtSecondNumberValue = document.getElementById('harga_beli').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
	      if (!isNaN(result)) {
	         document.getElementById('subtotal').value = result;
	      }
	}

	function save() {
		var url;
		url = "<?= site_url()?>Bpb/save/";
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
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal_berhasil(); setTimeout(function(){reload_table();}, 1000);
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 
			}
		});
	}

	function reload_table() {
    	table.ajax.reload(null, false);
	}
</script>	
