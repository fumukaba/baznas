<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

 <style type="text/css">
  
  td.details-control {
      background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
      cursor: pointer;
  }
  tr.shown td.details-control {
      background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
  }
 </style>
<section class="content">
	 <header class="panel-heading">
		<div class="alert alert-danger">  <h4>Detail Order #<?php echo $id_order;?></h4></div>
	</header>

	<div class="panel-body table-responsive">
		<div class="widget-box">
		<div class="widget-header">

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
		<h4>Informasi Penerima</h4>
		<table class='table table-hover'>
		<?php 
		$status; foreach($order as $o):?>
			<tr><td><strong>Nama Penerima</strong></td><td> : </td><td><?php echo $o['fv_nama_order']?></td></tr>
			<tr><td><strong>Alamat Penerima</strong></td><td> : </td><td><?php echo $o['fv_alamat_order']?></td></tr>
			<tr><td colspan=2></td><td><?php echo $o['fv_provinsi_order']?></td></tr>
			<tr><td colspan=2></td><td><?php echo $o['fc_kode_pos_order']?></td></tr>
			<tr><td><strong>Telp Penerima</strong></td><td> : </td><td><?php echo $o['fc_telp']?></td></tr>
			<tr><td><strong>Total Belanja</strong></td><td> : </td><td>Rp <?php echo $o['fm_total']?></td></tr>
			<tr><td><strong>Total Tagihan</strong></td><td> : </td><td>Rp <?php echo $o['fm_grandtotal_order']?></td></tr>
		<?php 
			$status = $o['fc_status_kirim'];

			if($o['fc_status_kirim'] == 1){
				$status = "Belum melakukan pembayaran, Silahkan lakukan pembayaran";
			}
			elseif($o['fc_status_kirim'] == 2){
				$status = "Menunggu Konfirmasi admin, silahkan tunggu selama 2x24 jam";
			}
			elseif($o['fc_status_kirim'] == 3){
				$status = "Admin telah menghubungi penjual untuk segera mengirim pesanan";
			}
			elseif($o['fc_status_kirim'] == 4){
				$status = "Penjual Telah mengirim pesanan";
			}
			elseif($o['fc_status_kirim'] == 5){
				$status = "Pesanan telah diterima pembeli,terima kasih";
			}
			endforeach;
			//var_dump($status); ?>
		</table>
		</div>
		</div>
		</div>
		</div>
		<?php if($status == "2"){ ?>
		<div class="col-sm-6">
		<div class="widget-box">
		<div class="widget-header">

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
		<h4>Konfirmasi Pembayaran</h4>
		<table class='table table-hover'>
			<form method="post" action="<?php echo base_url() . 'order/konfirmasi' ?>">
			
			<?php foreach($konfirmasi as $k):?>
			<tr><td><strong>Tanggal Transfer</strong></td><td><input type="text" name ="tgl_bayar" id="tgl_mulai" value="<?php echo $k['fd_tgl_konfirmasi']?>" disabled></td></tr>
			<tr><td><strong>Nama Transfer</strong></td><td><input type="text" name ="nama_pemilik"  value="<?php echo $k['fv_nama_bayar']?>" disabled></td></tr>
			<tr><td><strong>Bank Transfer</strong></td><td><input type="text" name ="bank" value="<?php echo $k['fc_bank_bayar']?>" disabled></td></tr>
			<tr><td><strong>Rekening Transfer</strong></td><td><input type="text" name ="no_rekening"  value="<?php echo $k['fc_rekening_bayar']?>" disabled></td></tr>
			<tr><td><strong>Total Transfer</strong></td><td><input type="text" name ="total_transfer"  value="<?php echo $k['fm_jumlah_bayar']?>" disabled></td></tr>
			<input type="hidden" value="<?php echo $id_order?>" name="id_order">
			<tr><td colspan=2><input type="submit" value="Konfirmasi" class="btn btn-success"><td></tr>
			<?php endforeach?>
			</form>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		<?php }  ?>
		
	
		<h4>Daftar Order</h4>
		<form id="formAksi" method="post">
		 <input type="hidden" name="fc_kdorder" value="<?php echo $id_order;?>">
		<input type="submit" value="Batal Transaksi" class="btn btn-default">
		<br/><br/>
		<table id="example5" class="display responsive nowrap" cellspacing="0" width="100%">
	          <thead>
			  <tr>
			  	<th></th>
			  	<th></th>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Jumlah Produk</th>
				<th>Harga</th>
				<th>Subtotal</th>
				<th>Status</th>
			  </tr>
			  
	          </thead>
	          <tbody></tbody>
          </table>
        </form>  
</section>
<?php $id = $this->uri->segment(3); ?>
 <script type="text/javascript">
    var zonk='';
    var save_method;
    var table;
    var link = "<?php echo site_url('interen/home')?>";
    var Kode = "<?php echo $id;?>";
    
     $(document).on('submit', '#formAksi', function(e) {  
      e.preventDefault();
      if (confirm('Apakah Anda Yakin Membatalkan Transaksi Ini?')) {
            $.ajax({
                url : "<?php echo site_url('Ordere/generate_act')?>/",
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
    $(document).ready(function() {
     //  $.noConflict();
        table = $('#example5').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, 
        "paging": false,
        "searching": false,
        "info": false,
        "ordering": false,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url":  "<?php echo site_url('Ordere')?>/ajax_list/"+Kode,
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

   

 </script>