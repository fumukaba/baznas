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


    <table id="example6" class="display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Nama Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
<script type="text/javascript">
var table;

$(document).ready(function() {
  table = $('#example6').DataTable({

      "paging":   false,
      "ordering": false,
      "info":     false,
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "bDestroy": true,
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url('Bpb/ajax_list_bar')?>",
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

}).fnDestroy();
</script>
