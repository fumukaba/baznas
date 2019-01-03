<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

 <style type="text/css">
 	
 	td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
	}
 </style>
<?php $title = "<i class='fa fa-briefcase'></i>&nbsp;Bpb"; ?>

<div id="idImgLoader" style="margin: 0 auto; text-align: center;">

	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />

</div>

<div id="data" style="display:none;">

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
 <div class="input-group input-daterange">

      <input type="text" id="min-date" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="From:">

      <div class="input-group-addon">to</div>

      <input type="text" id="max-date" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="To:">

    </div><br />
<div class="box-header">
<a class="btn btn-danger" href="<?php echo base_url('Barang_pindah/add')?>"><i class="fa fa-plus"></i> Tambah Data</a>
</div><br />
<table id="example" class="display" cellspacing="0" width="100%">

    <thead>

        <tr>
            <th></th>

            <th>No Barang Pindah</th>

            <th>Tanggal</th>

            <th>Gudang Asal</th>

            <th>Gudang Tujuan</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>

</div><!-- /.span -->

</div>					

</div><!-- /.row -->

</div>

</div>

</div>

<script>

	var save_method;

	var link = "<?php echo site_url('Barang_pindah2')?>";

	//var table;

	

	$(document).ready(function(){

      //$('#idImgLoader').show(2000);

	  $('#idImgLoader').fadeOut(2000);

	  setTimeout(function(){

            data();

      }, 2000);


    });



	

    function data(){

		$('#data').fadeIn();

	}

	
	

	$(document).ready(function() {
		$('.input-daterange input').each(function() {
		  $(this).datepicker('clearDates');
		});

		var table = $('#example').DataTable({
        'ajax': '<?php echo site_url('Barang_pindah2')?>/ajax_list',
        // "type": "POST",
        'columns': [
            { 'data': 'no'},
            { 'data': 'fc_kdbarang_pindah' },

            { 'data': 'fd_tgl_barang_pindah' },
            //{ 'data': 'no_permintaan' },
            { 'data': 'nmasal' },
            // { 'data': 'aksi' },
            { 'data': 'nmtujuan' },
            { 'data': 'fv_nama_barang' },
            { 'data': 'f_jumlah_barang' },
        ],
		"pageLength": 50,
        'order': [[1, 'DESC']],
        
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
    } );

	$.fn.dataTable.ext.search.push(
	  function(settings, data, dataIndex) {
	    var min = $('#min-date').val();
	    var max = $('#max-date').val();
	    var createdAt = data[2] || 0; // Our date column in the table

	    if (
	      (min == "" || max == "") ||
	      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
	    ) {
	      return true;
	    }
	    return false;
	  }
	);

	// Re-draw the table when the a date range filter changes
	$('.date-range-filter').change(function() {
	  table.draw();
	});			

    $('#example').on( 'page.dt', function () {
        var info = table.page.info();
        $('#pageInfo').html( 
            console.log('Showing page: '+info.page+' of '+info.pages) );
            document.getElementById('halaman').value = info.page;
        } );
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function(){
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
	
    // Handle click on "Expand All" button
    $('#btn-show-all-children').on('click', function(){
        // Enumerate all rows
        table.rows().every(function(){
            // If row has details collapsed
            if(!this.child.isShown()){
                // Open this row
                this.child(format(this.data())).show();
                $(this.node()).addClass('shown');
            }
        });
    });

    // Handle click on "Collapse All" button
    $('#btn-hide-all-children').on('click', function(){
        // Enumerate all rows
        table.rows().every(function(){
            // If row has details expanded
            if(this.child.isShown()){
                // Collapse row details
                this.child.hide();
                $(this.node()).removeClass('shown');
            }
        });
    });
	//var allpage = table.fnPageChange();
	//console.log()
    // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });
   // Handle form submission event
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all checkboxes in the table
      table.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         }
      });
      });

    });

	

	function reload_table() {

    	table.ajax.reload(null, false);

	}
</script>    