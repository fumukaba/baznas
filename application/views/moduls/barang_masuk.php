<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<?php $title = "<i class='fa fa-file-image-o'></i>&nbsp;Laporan Barang Masuk"; ?>
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
  <form id="formAksine" class="form-horizontal" action="<?php echo base_url('Barang_masuk/prints') ?>" target="_blank" method="POST" role="form" enctype="multipart/form-data">
   <div class="input-group input-daterange">

      <input type="text" id="tgl1" name="tgl1" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="From:">

      <div class="input-group-addon">to</div>

      <input type="text" id="tgl2" name="tgl2" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="To:">

    </div><br />
  <button type="submit" value="Cetak Laporan" id="btnSave" class="btn btn-default"><i class="fa fa-print"></i> Cetak Laporan</button>
   </form>
</div><br />

<script>
	var zonk=''; 
	var save_method;
	var link = "<?php echo site_url('Bpb')?>";
	var table;


  
	$(document).ready(function(){

    $('.input-daterange input').each(function() {
      $(this).datepicker('clearDates');
    });

      //$('#idImgLoader').show(2000);
	  $('#idImgLoader').fadeOut(2000);
	  setTimeout(function(){
            data();
      }, 2000);
	  
    });

	$(document).ready(function(){
		 getNomor();
	});

    function data(){
		$('#data').fadeIn();
	}

	$(document).ready(function() {
		var table = $('#example').DataTable({
        'ajax': '<?php echo base_url()."Bpb/ajax_list" ?>',
        // "type": "POST",
        'columns': [
            {
                'className':      'details-control',
                'orderable':      false,
                'data':           null,
                'defaultContent': '',
                 // 'render': function (data, type, full, meta){
                 //     return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '" style="width:50px;margin-left:-20px">&nbsp&nbsp';
                 // }
            },
            //{ 'data': 'nama'},
            { 'data': 'fd_tglbpb' },
        ],
		"pageLength": 50,
        'order': [[1, 'DESC']],
        "initComplete": function (oSettings) { //changed line

            var oTable = this;
            oTable.fnPageChange(<?php echo @$halaman ?>);
        }
    } );
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
	
	$(document).ready(function() {
		$("input").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("textarea").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
		$("select").change(function(){ $(this).parent().parent().removeClass('has-error'); $(this).next().empty(); });
	});
    function format ( d ) {
	    // `d` is the original data object for the row
	   var parah='';
        $.getJSON('<?php echo base_url('Bpb/JsonBpb/') ?>/' + d.fd_tglbpb, {
            format: "json"
        })
        .done(function (data) {
            var no = 1; 
            var atas = '<table class="table table-striped" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;"><tr><td>No</td><td>No Bpb</td><td>Barang</td><td>Qty Terima</td><td>Harga Satuan</td><td>Subtotal</td></tr><tr>';
            var bawah = '</table>';
            var tengah = '';
            var gabung = '';
            $.each(data, function (key, val) {
                tengah+='<tr><td>' + no + '</td><td>' + val.fc_nobpb + '</td><td>' + val.fc_kdbarang + '</td><td>' + val.fn_qtyterima + '</td><td>' + val.fm_harsat + '</td><td>' + val.fm_subtot + '</td></tr>';
                no++;
            });
                

                // console.log('tengah222: '+tengah);
            if (tengah!="") {
                parah = atas+tengah+bawah;
            }else{
                parah = "Tidak Ada Data";
            }
                 document.getElementById('cuks['+d.fd_tglbpb+']').innerHTML = parah;

            })
        return '<div id="cuks['+d.fd_tglbpb+']"></div>';
}

</script>	
