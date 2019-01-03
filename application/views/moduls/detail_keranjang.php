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
 <?php $id = $this->uri->segment(3); ?>
<section class="content">
	<h4>Daftar Order</h4>
		<form id="formAksi" method="post">
		 <input type="hidden" name="fc_kdkeranjang_belanja" value="<?php echo $id;?>">
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
			  </tr>
			  
	          </thead>
	          <tbody></tbody>
          </table>
        </form>  

</section>


 <script type="text/javascript">
    var zonk='';
    var save_method;
    var table;
    var Kode = "<?php echo $id;?>";

     $(document).on('submit', '#formAksi', function(e) {  
      e.preventDefault();
      if (confirm('Apakah Anda Yakin Membatalkan Transaksi Ini?')) {
            $.ajax({
                url : "<?php echo site_url('Admin/generate_act')?>/",
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
            "url":  "<?php echo site_url('Admin')?>/ajax_list/"+Kode,
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