
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/j-ui/jquery-ui.css'; ?>">
        <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.css" rel="stylesheet" type="text/css" />

<style type="text/css"> 
#loader1{display: none} 
#loader2{display: none} 
#loader3{display: none} 
#loader4{display: none} 
#preview1{display: none} 
#preview2{display: none} 
#preview3{display: none}
#preview4{display: none}
</style>

        <script src="<?php echo base_url() . 'assets/j-ui/jquery3.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/j-ui/jquery-ui.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/j-ui/datatablejs.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.js"></script>
        <script src="<?php echo base_url() . 'assets/'; ?>DataTables/datatables.min.js"></script>

<?php $title = "Pencairan Poin Detail"; ?>
<div class='alert alert-success' id='berhasil' style='display: none;'>Proses Berhasil</div>
<div class='alert alert-danger' id='gagal' style='display: none;'>Proses Gagal</div>
<div id="idImgLoader" style="margin: 0 auto; text-align: center;">
	<img src='<?php echo base_url();?>assets/img/loader-dark.gif' />
</div>
<div id="data" style="display:none;">
<section class="content">
<div class="page-header">
	<h1>
		<i class='fa fa-money'> <?php echo $title;?></i>
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
<div class="box-header">
	<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
	<!-- <button class="btn btn-danger" onclick="Tambah()"><i class="fa fa-plus"></i> Tambah Data</button> -->
</div><br />
<form method="POST" action="#">
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="sorting_disabled"><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
            <th>Nama Gudang</th>
            <th>Nama Barang</th>
			<th>Stok</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
            <th>Nama Gudang</th>
            <th>Nama Barang</th>
			<th>Stok</th>
        </tr>
    </tfoot>
</table>
</form>
</div><!-- /.span -->
</div>					
</div><!-- /.row -->
</div>
</div>
</div>

</section>
</div>
						
<script>
	var zonk='';
	var save_method;
	var link = "<?php echo site_url('Gudang')?>";
	var kodeGdng = "<?php echo $fc_kdgudang ?>"
	console.log(kodeGdng);
	var table;
	function autosum() {
		var selectedIds = table.columns().checkboxes.selected()[0];
		   console.log(selectedIds)

		   selectedIds.forEach(function(selectedId) {
		       alert(selectedId);
		   });
	}
  	function getJen(){
        $.get(link+'/getJen/'+$('#kategori').val(), $(this).serialize())
        .done(function(data) {
          $('#jenis').html(data);
        });  
        $.get(link+'/getSize/'+$('#kategori').val(), $(this).serialize())
        .done(function(data) {
          $('#size').html(data);
        });  
    }
	
	$(document).ready(function(){
	$('#form-add').submit(function(e) {
		//tinyMCE.triggerSave();
		e.preventDefault(); var formData = new FormData($(this)[0]);
		$.ajax({
			url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
			beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
			success: function(response) {
				if(response.status) { Batal(); reload_table(); swal_berhasil();
				} else { Batal(); reload_table(); swal_error(response.error); }
			},
			complete: function() { $('#btnSave').text('save'); $('#btnSave').attr('disabled',false); },
			cache: false, contentType: false, processData: false
		});
		return false;
	});
	
	function readURL(input) {
		$("#preview").show();
		if (input.files && input.files[0]) {
			var rd = new FileReader(); 
			rd.onload = function (e) { $('#preview').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
		}
	}
	$("#userfile").change(function(){ readURL(this); });

	});
	
	$(document).ready(function(){
		$('#form-upload').submit(function(e) {
			tinyMCE.triggerSave();
			e.preventDefault(); var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"), type: 'POST', dataType: 'json', data: formData, async: true,
				beforeSend: function() { $('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true); },
				success: function(response) {
					if(response.status) { Batal2(); reload_table(); swal_berhasil();
					} else { Batal2(); reload_table(); swal_error(response.error); }
				},
				complete: function() { $('#btnSave').text('save'); $('#btnSave').attr('disabled',false); },
				cache: false, contentType: false, processData: false
			});
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var rd = new FileReader(); 
				rd.onload = function (e) { $('#preview-upload').attr('src', e.target.result); }; rd.readAsDataURL(input.files[0]);
			}
		}
		$("#file-upload").change(function(){ readURL(this); });
	});
	
	function save() {
		var url;
		url = "<?= site_url()?>Slider/update/";
		tinyMCE.triggerSave();
		$('#btnSave').text('saving...'); $('#btnSave').attr('disabled',true);
		$.ajax({
			url : url, type: "POST", dataType: "JSON", data: $('#form').serialize(),
			success: function(data) {
				if(data.status) {  Batal2(); reload_table(); swal_berhasil(); 
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
					}
				}
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal({ title:"ERROR", text:"Error adding / update data", type: "warning", closeOnConfirm: true}); 
				$('#btnSave').text('save'); $('#btnSave').attr('disabled',false);  
			}
		});
	}
	
	function update(id) {
			save_method = 'update';
			$('#panel-data').fadeOut('slow');
			$('#form-update').fadeIn('slow');
			//document.getElementById('formAksi').reset();
			$.ajax({
				url : link+"/ajax_edit/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(result) {  
				var img = '<?= base_url(); ?>assets/images/'+result.slider_gambar;
				$('[name="id_slider"]').val(result.id_slider);
				$('[name="a1"]').val(result.slider_judul);
				tinymce.editors[1].setContent(result.slider_deskripsi);
				$('#preview-upload').attr('src', img);

				}, error: function (jqXHR, textStatus, errorThrown) {
					alert('Error get data from ajax');
				}
			});
	}
	
	$(document).ready(function(){
      //$('#idImgLoader').show(2000);
	  $('#idImgLoader').fadeOut(2000);
	  setTimeout(function(){
            data();
      }, 2000);
	  setTimeout(function(){
            ckeditor();
      }, 2000);
    });
	
	function ckeditor(){
		tinyMCE.init({
             
              mode : "textareas",
                
              // ===========================================
              // Set THEME to ADVANCED
              // ===========================================
                
              theme : "advanced",
                
              // ===========================================
              // INCLUDE the PLUGIN
              // ===========================================
             
              plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
                
              // ===========================================
              // Set LANGUAGE to EN (Otherwise, you have to use plugin's translation file)
              // ===========================================
             
              language : "en",
                 
              theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
              theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
              theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
             
              // ===========================================
              // Put PLUGIN'S BUTTON on the toolbar
              // ===========================================
             
              theme_advanced_buttons4 : "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                
              theme_advanced_toolbar_location : "top",
              theme_advanced_toolbar_align : "left",
              theme_advanced_statusbar_location : "bottom",
              theme_advanced_resizing : true,
                
              // ===========================================
              // Set RELATIVE_URLS to FALSE (This is required for images to display properly)
              // ===========================================
             
              relative_urls : false
                
            });
	}
	
	function data(){
		$('#data').fadeIn();
	}
	
	$(document).ready(function() {
		table = $('#example').DataTable({
        'ajax': '<?php echo site_url('Gudang')?>/ajax_listid/'+kodeGdng,
        // "type": "POST",
        'columns': [
        	{ 'data': 'ceklist' },
            //{ 'data': 'nama'},
            { 'data': 'fv_nmgudang' },
            //{ 'data': 'no_permintaan' },
            { 'data': 'fv_nama_barang' },
            // { 'data': 'aksi' },
            { 'data': 'fc_qty_barang' }
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
        $.getJSON('<?php echo base_url('Article/ajax_list_Det') ?>/' + d.id_article, {
            format: "json"
        })
        .done(function (data) {
        	console.log(data);
            var no = 1; 
            var atas = '<table class="table table-striped" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;"><tr><td>Kode</td><td>Nama</td><td>Harga</td><td>Stok</td><td>Aksi</td></tr>';
            var bawah = '</table>';
            var tengah = '';
            var gabung = '';
            $.each(data, function (key, val) {
                tengah+='<tr><td>' + val.kode + '</td><td>' + val.nama_size + '</td><td>' + val.harga + '</td><td>' + val.stok + '</td><td>' + val.aksi + '</td></tr>';
                no++;
            });
                

                // console.log('tengah222: '+tengah);
            if (tengah!="") {
                parah = atas+tengah+bawah;
            }else{
                parah = "Tidak Ada Data";
            }
                 document.getElementById('cuks['+d.id_pre_order+']').innerHTML = parah;

            })
        return '<div id="cuks['+d.id_pre_order+']"></div>';
}
	
	function Tambah() {
		$('.form-group').removeClass('has-error');
		$('.help-block').empty(); 
		save_method = 'add'; 
		$('#panel-data').fadeOut('slow');
		$('#form-data').fadeIn('slow'); 
		$('[name="userfile"]').val(zonk);
		
	}
	
	function reload_table() {
    	table.ajax.reload(null, false);
	}				

	$(function() {
		var oTable1 = $('#dynamic-table').dataTable( {
		"aoColumns": [,
			 null, null, null, null, null,
		] } );
				
				
		$('table th input:checkbox').on('click' , function(){
			var that = this;
			$(this).closest('table').find('tr > td:first-child input:checkbox')
				.each(function(){
					this.checked = that.checked;
					$(this).closest('tr').toggleClass('selected');
				});
						
			});
			
			
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
			function tooltip_placement(context, source) {
				var $source = $(source);
				var $parent = $source.closest('table')
				var off1 = $parent.offset();
				var w1 = $parent.width();
			
				var off2 = $source.offset();
				var w2 = $source.width();
			
				if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
				return 'left';
		}
	})
			
	//$('#dynamic-table').dataTable( {
		//paging: false,
		//searching: false
	//} );	
		

	function Batal() { 
		$('#form-data').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function Batal2() { 
		$('#form-update').slideUp(500,'swing');
		$('#panel-data').fadeIn(1000); 
	}
	
	function hapus(id) {
		if (confirm('Are you sure delete this data?')) {
			$.ajax ({
				url : "<?php echo site_url('Slider/ajax_delete')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					setTimeout(function(){
                        Batal();
                    }, 1000);
					
					setTimeout(function(){
                        reload_table();
					}, 1000);
					swal_berhasil(); 
				}, error: function (jqXHR, textStatus, errorThrown) {
					swal({ title:"ERROR", text:"Error delete data", type: "warning", closeOnConfirm: true}); 
					$('#btnSave').text('save'); $('#btnSave').attr('disabled',false); 
				}
			});
		}
	}
	
</script>


