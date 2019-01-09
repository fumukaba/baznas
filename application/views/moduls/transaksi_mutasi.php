<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        } );
    })
 </script>
 
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
 
 <style type="text/css">
 	
 	td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
	}
 </style>
<?php $title = "<i class='fa fa-map-marker'></i>&nbsp;" . $zis[0]['nama_zis']; ?>
<div class='alert alert-success' id='berhasil' style='display: none;'>Proses Berhasil</div>
<div class='alert alert-danger' id='gagal' style='display: none;'>Proses Gagal</div>
<!-- <div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src="<?php echo base_url('assets/img/loader-dark.gif'); ?>" />
</div> -->
<div id="data">
<section class="content">
<div class="page-header">
	<h1>
		<?php echo $title;?>
	</h1>
</div><!-- /.page-header -->

<div id="panel-data">
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
<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
        	<th>No.</th>
            <th>Jenis</th>
            <th>Jumlah Uang</th>
            <th>Potongan (2%)</th>
            <th>Setelah Dipotong</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; $sub1 = 0; $sub2 = 0; $total = 0; ?>
        <?php foreach($semua_data as $data) { ?>
        <?php 
            $potongan = (0.02 * $data['uang']);
            $sub1 += $data['uang'];
            $sub2 += $potongan;
            $total += $data['uang'] - $potongan;
        ?>
        <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $data['jenis']; ?></td>
            <td><?php echo "Rp. " . number_format($data['uang'], 0, '.', ','); ?></td>
            <td><?php echo "Rp. " . number_format($potongan, 0, '.', ','); ?></td>
            <td><?php echo "Rp. " . number_format($data['uang'] - $potongan, 0, '.', ','); ?></td>
            <td><input type="checkbox" class="ids" autocomplete="off" data-id="<?php echo $data['id']; ?>" data-uang="<?php echo $data['uang'] - $potongan; ?>" data-jenis="<?php echo $data['jenis']; ?>"></td>
        </tr>
        <?php } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="2">Sub Total</td>
            <td><?php echo "Rp. " . number_format($sub1, 0, '.', ','); ?></td>
            <td><?php echo "Rp. " . number_format($sub2, 0, '.', ','); ?></td>
            <td><?php echo "Rp. " . number_format($total, 0, '.', ','); ?></td>
            <td><input id="centangSemua" type="checkbox" autocomplete="off" data-jumlah="<?php echo $i; ?>"></td>
        </tr>
    </tbody>
</table>
<table class="table">
    <tbody>
        <tr>
            <td colspan="2"><h4>Detail Mutasi</h4></td>
        </tr>
        <tr>
            <td>Total uang keseluruhan</td>
            <td><?php echo "Rp. " . number_format($total, 0, '.', ','); ?></td>
        </tr>
        <tr>
            <td>Total yang akan dimutasi</td>
            <td id="labelTotal">Rp. 0</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <form id="mutasiUang" data-url="<?php echo base_url('Mutasi_uang/ajax_add'); ?>">
                    <input type="hidden" autocomplete="off" id="keperluanMutasi" name="keperluan_kaskel" value="">
                    <input type="hidden" autocomplete="off" name="id_zis" value="<?php echo $zis[0]['id_zis']; ?>">
                    <input type="hidden" autocomplete="off" id="dataMutasi" name="data" value="">
                    <button type="submit" class="btn btn-primary">Mutasi</button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
</div><!-- /.span -->
</div>					
</div><!-- /.row -->
</div>
</div>
</div>

</section>
</div>

<script>
    function rupiah(bilangan) {
        var	number_string = bilangan.toString(),
            sisa 	= number_string.length % 3,
            rupiah 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                
        if (ribuan) {
            separator = sisa ? ',' : '';
            rupiah += separator + ribuan.join(',');
        }

        return 'Rp. ' + rupiah;
    }

    $(document).ready(function() {
        $('#mutasiUang').on('submit', (function(e) {
            e.preventDefault();

            var url = $(this).data('url');

            $.ajax({
                type: 'POST',
                url: url,
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result.status) {
						swal({ title:"SUCCESS", text:"Berhasil dimutasi.", type: "success", closeOnConfirm: true});

						document.location.href = '';
					}
				}, error: function(jqXHR, textStatus, errorThrown) {
					// alert('Error adding/update data');
					swal({ title:"ERROR", text:"Gagal dimutasi.", type: "warning", closeOnConfirm: true});  
				}
            })
        }))

        $('.ids').on('click', (function() {
            var parse = "",
                cek = 0,
                cek_is = 0;
                total = 0;

            if($(this).is(':checked')) {

            } else {
                $('#centangSemua').prop('checked', false);
            }

            $('.ids').each(function() {
                cek += 1;
                if($(this).is(':checked')) {
                    var id = $(this).data('id'),
                        uang = $(this).data('uang');

                        var jenis = $(this).data('jenis');cek_is += 1;
                    parse += id + ":" + uang + ":" + jenis + ",";
                    total += uang;
                }
            })

            if(cek_is == cek) {
                $('#centangSemua').prop('checked', true);
            }

            $('#keperluanMutasi').val("Mutasi sebesar " + rupiah(total));
            $('#labelTotal').html(rupiah(total));
            $('#dataMutasi').val(parse);
        }))

        $('#centangSemua').on('click', (function() {
            var cek = 0,
                jumlah = $(this).data('jumlah');
            
            var parse = "",
                total = 0;

            $('.ids').each(function() {
                if($(this).is(':checked')) {
                    cek += 1;
                }
            })

            if(cek == jumlah) {
                $('.ids').each(function() {
                    $(this).prop('checked', false);
                })
            } else {
                $('.ids').each(function() {
                    $(this).prop('checked', true);
                })
            }

            $('.ids').each(function() {
                if($(this).is(':checked')) {
                    var id = $(this).data('id'),
                        uang = $(this).data('uang');
                    var jenis = $(this).data('jenis');
                    parse += id + ":" + uang + ":" + jenis + ",";
                    total += uang;
                }
            })

            $('#keperluanMutasi').val("Mutasi sebesar " + rupiah(total));
            $('#labelTotal').html(rupiah(total));
            $('#dataMutasi').val(parse);
        }))
    })
</script>