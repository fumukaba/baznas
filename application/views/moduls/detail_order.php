<section class="content">
	 <header class="panel-heading">
		<div class="alert alert-danger">  <h4>Detail Order #<?php echo $id_order;?></h4></div>
	</header>

	<div class="panel-body table-responsive">
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
		<div class="col-xs-12">
		<h4>Informasi Penerima</h4>
		<table class='table table-hover'>
		<?php 
		$status; foreach($order as $o):?>
			<tr><td><strong>Nama Penerima</strong></td><td> : </td><td><?php echo $o['nama_order']?></td></tr>
			<tr><td><strong>Alamat Penerima</strong></td><td> : </td><td><?php echo $o['alamat_order']?></td></tr>
			<tr><td colspan=2></td><td><?php echo $o['provinsi_order']?></td></tr>
			<tr><td colspan=2></td><td><?php echo $o['kode_pos_order']?></td></tr>
			<tr><td><strong>Telp Penerima</strong></td><td> : </td><td><?php echo $o['tlp_order']?></td></tr>
			<tr><td><strong>Total Belanja</strong></td><td> : </td><td>Rp <?php echo $o['total_order']?></td></tr>
			<tr><td><strong>Total Tagihan</strong></td><td> : </td><td>Rp <?php echo $o['grand_total_order']?></td></tr>
		<?php 
			$status = $o['status_order'];
			endforeach;
			//var_dump($status); ?>
		</table>
		</div>
		</div>
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
		<div class="col-xs-12">
		<h4>Konfirmasi Pembayaran</h4>
		<table class='table table-hover'>
			<form method="post" action="<?php echo base_url() . 'order/konfirmasi' ?>">
			
			<?php foreach($konfirmasi as $k):?>
			<tr><td><strong>Tanggal Transfer</strong></td><td><input type="text" name ="tgl_bayar" id="tgl_mulai" value="<?php echo $k['tgl_konfirmasi']?>" disabled></td></tr>
			<tr><td><strong>Nama Transfer</strong></td><td><input type="text" name ="nama_bayar"  value="<?php echo $k['nama_bayar']?>" disabled></td></tr>
			<tr><td><strong>Bank Transfer</strong></td><td><input type="text" name ="nama_bank" value="<?php echo $k['bank_bayar']?>" disabled></td></tr>
			<tr><td><strong>Rekening Transfer</strong></td><td><input type="text" name ="rek_bayar"  value="<?php echo $k['rekening_bayar']?>" disabled></td></tr>
			<tr><td><strong>Total Transfer</strong></td><td><input type="text" name ="total_bayar"  value="<?php echo $k['jumlah_bayar']?>" disabled></td></tr>
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
		</div>
		<?php } else if($status >= 3){ ?>
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
		<div class="col-xs-12">
		<h4>Konfirmasi Pembayaran</h4>
		<table class='table table-hover'>
			<form method="post" action="<?php echo base_url() . 'order/konfirmasi' ?>">
			
			<?php foreach($konfirmasi as $k):?>
			<tr><td><strong>Tanggal Transfer</strong></td><td><?php echo $k['tgl_konfirmasi']?></td></tr>
			<tr><td><strong>Nama Transfer</strong></td><td><?php echo $k['nama_bayar']?></td></tr>
			<tr><td><strong>Bank Transfer</strong></td><td><?php echo $k['bank_bayar']?></td></tr>
			<tr><td><strong>Rekening Transfer</strong></td><td><?php echo $k['rekening_bayar']?></td></tr>
			<tr><td><strong>Total Transfer</strong></td><td><?php echo $k['jumlah_bayar']?></td></tr>
			<tr><td><strong>&nbsp;</strong></td><td><span class="label label-success">Sudah Dibayar</span></td></tr>
			<?php endforeach?>
			</form>
		</table>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<?php } ?>
		<br/>
		<div class="col-sm-12">
		<h4>Daftar Order</h4>
		<table class='table table-hover'>
	          <tbody>
			  <tr>
				<th>#</th>
				<th>Nama Produk</th>
				<th>Jumlah Produk</th>
				<th>Harga</th>
				<th>Harga Satuan Setelah Pajak</th>
				<th>Subtotal</th>
				<th>Subtotal Setelah Pajak</th>
				<th>Status</th>
				<th>Opsi</th>
			  </tr>
			  
			  <?php
			  $selisih=0;
			  
			
						$counter = 1;
						
						foreach($detail_order as $d):

							
						?>
				<tr>
						<td><?php echo $counter;?></td>
						<td><?php echo $d['nama_produk']?></td>
						<td><?php echo $d['jumlah_produk']?></td>
						<td><?php echo $d['harga']?></td>
						<td><?php echo $d['harga_pajak']?></td>
						<td><?php echo $d['subtotal']?></td>
						<td><?php echo $d['subtotal_pajak']?></td>
						<td><?php echo $d['no_resi']?></td>
						<td><?php
						if ($d['status_kirim']== 0) {
							
						}else{
							if($selisih>=4 || $d['pembayaran']==0){?> <a href="<?php echo base_url('laporan/penjual/'.$d['id_penjual'])?>" type="button" class="btn btn-success">Lanjutkan Pembayaran Ke <?php echo $d['id_penjual']?></a>
						 <?php }
						} ?></td>
				</tr>
				
				
			  <?php 
					$counter++;
					endforeach;
					
					if ($counter==1){
						foreach($detail_order2 as $d){?>
						<tr>
						<td><?php echo $counter?></td>
						<td><?php echo $d['nama_produk']?></td>
						<td><?php echo $d['jumlah_produk']?></td>
						<td><?php echo $d['harga']?></td>
						<td><?php echo $d['harga_pajak']?></td>
						<td><?php echo $d['subtotal']?></td>
						<td><?php echo $d['subtotal_pajak']?></td>
						<td><?php echo $Status_pengiriman?></td>
						<td><?php echo $d['no_resi']?></td>
						</tr>
							
						<?php }
					}
				?>
	          </tbody>
          </table>
    </div>   
</section>
