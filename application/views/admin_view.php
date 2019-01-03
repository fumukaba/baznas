<!DOCTYPE html>

<html lang="en">

	<head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<meta charset="utf-8" />

		<title>Admin Elecomp</title>



		<meta name="description" content="top menu &amp; navigation" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon-elecomp.png" type="image/x-icon" />



		<!-- bootstrap & fontawesome -->

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css" />

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css" />



		<!-- page specific plugin styles -->



		<!-- text fonts -->

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-fonts.css" />



		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<link href="<?= base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">

        <link href="<?= base_url(); ?>assets/plugins/select2/select2.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery.gritter.css" />

		<!--[if lte IE 9]>

			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />

		<![endif]-->



		<!--[if lte IE 9]>

		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />

		<![endif]-->



		<!-- inline styles related to this page -->



		<!-- ace settings handler -->
		

		<script src="<?php echo base_url();?>assets/js/ace-extra.js"></script>

		<script src="<?= base_url(); ?>assets/jquery/jquery-2.1.4.min.js"></script>

		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->



		<!--[if lte IE 8]>

		<script src="../assets/js/html5shiv.js"></script>

		<script src="../assets/js/respond.js"></script>

		<![endif]-->

		

	</head>

<script type="text/javascript">

var table;

// Clear Search & Reload Tabel

function reload_table() { table.search(''); table.ajax.reload(null,false); }

function modal_show() { $('#modal_form').modal('show'); }

function modal_hide() { $('#modal_form').modal('hide'); }

function swal_berhasil() { swal({ title:"SUCCESS", text:"Berhasil", type: "success", closeOnConfirm: true}); }

function swal_error(msg) { swal({ title:"ERROR", text: msg, type: "warning", closeOnConfirm: true});  }

// Delete Data

function delete_data(table,id) {

	swal({

		title:"Hapus Data", text:"Yakin akan menghapus data ini?", type: "warning",

		showCancelButton: true, confirmButtonText: "Hapus", closeOnConfirm: true,

	},

	function(){

        $.ajax({ 

            url : "<?= site_url()?>admin/delete/"+table+'/'+id,

            type: "POST",

            dataType: "JSON",

            success: function(data) {

                $('#modal_form').modal('hide');

				swal({ title:"SUCCESS", text:"Hapus Berhasil", type: "success", closeOnConfirm: true}); 

                reload_table();

            },

            error: function (jqXHR, textStatus, errorThrown) {

				swal({ title:"ERROR", text:"Error deleting data", type: "warning", closeOnConfirm: true}); 

            }

        });

	});

}

function undelete_data(table,id) {

	$.ajax({

		url : "<?= site_url()?>admin/undelete/"+table+'/'+id, 

		type: "POST",

		dataType: "JSON",

		success: function(data) {

			$('#modal_form').modal('hide');

			swal({ title:"SUCCESS", text:"Data Berhasil Dikembalikan", type: "success", closeOnConfirm: true}); 

			reload_table();

		},

		error: function (jqXHR, textStatus, errorThrown) {

			swal({ title:"ERROR", text:"Error undeleting data", type: "warning", closeOnConfirm: true}); 

		}

	});

}

</script>

<!-- <body class="hold-transition skin-blue sidebar-mini fixed"> -->

<body class="no-skin">

		<!-- #section:basics/navbar.layout -->

		<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar">

			<script type="text/javascript">

				try{ace.settings.check('navbar' , 'fixed')}catch(e){}

			</script>



			<div class="navbar-container" id="navbar-container">

				<div class="navbar-header pull-left">

					<!-- #section:basics/navbar.layout.brand -->

					<a href="#" class="navbar-brand">

						<small>

							Admin Web Elecomp

						</small>

					</a>



					<!-- /section:basics/navbar.layout.brand -->



					<!-- #section:basics/navbar.toggle -->

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">

						<span class="sr-only">Toggle user menu</span>



						<img src="<?= base_url(); ?>assets/avatars/avatar2.png" alt="Jason's Photo" />

					</button>



					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">

						<span class="sr-only">Toggle sidebar</span>



						<span class="icon-bar"></span>



						<span class="icon-bar"></span>



						<span class="icon-bar"></span>

					</button>



					<!-- /section:basics/navbar.toggle -->

				</div>



				<!-- #section:basics/navbar.dropdown -->

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">

					<ul class="nav ace-nav">
						<li class="light-blue user-min">

							<a data-toggle="dropdown" href="#" class="dropdown-toggle">

								<img class="nav-user-photo" src="<?php echo base_url();?>assets/avatars/avatar2.png" alt="Jason's Photo" />

								<span class="user-info">

									<small>Welcome,</small>

									<?php echo $this->session->userdata('admin_nama');?>

								</span>



								<i class="ace-icon fa fa-caret-down"></i>

							</a>



							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<li>

									<a href="#">

										<i class="ace-icon fa fa-cog"></i>

										Settings

									</a>

								</li>



								<li>

									<a href="profile.html">

										<i class="ace-icon fa fa-user"></i>

										Profile

									</a>

								</li>



								<li class="divider"></li>



								<li>

									<a href="<?=base_url()?>Login/logout">

										<i class="ace-icon fa fa-power-off"></i>

										Logout

									</a>

								</li>

							</ul>

						</li>



						<!-- /section:basics/navbar.user_menu -->

					</ul>

				</div>



				<!-- /section:basics/navbar.dropdown -->

				<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">



					<!-- /section:basics/navbar.form -->

				</nav>

			</div><!-- /.navbar-container -->

		</div>



		<!-- /section:basics/navbar.layout -->

		<div class="main-container" id="main-container">

			<script type="text/javascript">

				try{ace.settings.check('main-container' , 'fixed')}catch(e){}

			</script>



			<!-- #section:basics/sidebar.horizontal -->

			<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse">

				<script type="text/javascript">

					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}

				</script>



				<div class="sidebar-shortcuts" id="sidebar-shortcuts">

					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">

						<button class="btn btn-success">

							<i class="ace-icon fa fa-signal"></i>

						</button>



						<button class="btn btn-info">

							<i class="ace-icon fa fa-pencil"></i>

						</button>



						<!-- #section:basics/sidebar.layout.shortcuts -->

						<button class="btn btn-warning">

							<i class="ace-icon fa fa-users"></i>

						</button>



						<button class="btn btn-danger">

							<i class="ace-icon fa fa-cogs"></i>

						</button>



						<!-- /section:basics/sidebar.layout.shortcuts -->

					</div>



					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">

						<span class="btn btn-success"></span>



						<span class="btn btn-info"></span>



						<span class="btn btn-warning"></span>



						<span class="btn btn-danger"></span>

					</div>

				</div><!-- /.sidebar-shortcuts -->



				<?php $this->load->view('view_menu');?>



				<!-- #section:basics/sidebar.layout.minimize -->



				<!-- /section:basics/sidebar.layout.minimize -->

				<script type="text/javascript">

					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}

				</script>

			</div>



			<!-- /section:basics/sidebar.horizontal -->

			<div class="main-content">

				<div class="main-content-inner">

					<div class="page-content">

						<!-- #section:settings.box -->

						<div class="ace-settings-container" id="ace-settings-container">

							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">

								<i class="ace-icon fa fa-cog bigger-130"></i>

							</div>



							<div class="ace-settings-box clearfix" id="ace-settings-box">

								<div class="pull-left width-50">

									<!-- #section:settings.skins -->

									<div class="ace-settings-item">

										<div class="pull-left">

											<select id="skin-colorpicker" class="hide">

												<option data-skin="no-skin" value="#438EB9">#438EB9</option>

												<option data-skin="skin-1" value="#222A2D">#222A2D</option>

												<option data-skin="skin-2" value="#C6487E">#C6487E</option>

												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>

											</select>

										</div>

										<span>&nbsp; Choose Skin</span>

									</div>



									<!-- /section:settings.skins -->



									<!-- #section:settings.navbar -->

									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />

										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>

									</div>



									<!-- /section:settings.navbar -->



									<!-- #section:settings.sidebar -->

									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />

										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>

									</div>



									<!-- /section:settings.sidebar -->



									<!-- #section:settings.breadcrumbs -->

									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />

										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>

									</div>



									<!-- /section:settings.breadcrumbs -->



									<!-- #section:settings.rtl -->

									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />

										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>

									</div>



									<!-- /section:settings.rtl -->



									<!-- #section:settings.container -->

									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />

										<label class="lbl" for="ace-settings-add-container">

											Inside

											<b>.container</b>

										</label>

									</div>



									<!-- /section:settings.container -->

								</div><!-- /.pull-left -->



								<div class="pull-left width-50">

									<!-- #section:basics/sidebar.options -->

									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />

										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>

									</div>



									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />

										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>

									</div>



									<div class="ace-settings-item">

										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />

										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>

									</div>



									<!-- /section:basics/sidebar.options -->

								</div><!-- /.pull-left -->

							</div><!-- /.ace-settings-box -->

						</div><!-- /.ace-settings-container -->



						<!-- /section:settings.box -->



						<div class="row">

							<div class="col-xs-12">

								<!-- PAGE CONTENT BEGINS -->

								

								<?php $this->load->view($view_file) ?>



								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->

						</div><!-- /.row -->

					</div><!-- /.page-content -->

				</div>

			</div><!-- /.main-content --><br />
<input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5" />
<script type="text/javascript">

	var link = "<?php echo site_url('Admin')?>";



	$(document).ready(function(){    

        detail_cart();
        detail_voucher();
        detail_keranjang();
        cek();
        cek_voucher();
        cek_keranjang();
    });    



    function detail_cart(){

       //$('#detail_cart').load("<?php echo base_url();?>Admin/load_cart"); 

         $.ajax({

            url: link+"/load_cart",

            cache: false,

            success: function(msg){ 

              if(msg < 0){

                document.getElementById("detail_cart").className = "";

              } else{

               // document.getElementById("detail_cart").className = "data-notify='2'";

                $('#detail_cart').html(msg);

              }

            }

            });

         var waktu = setTimeout("detail_cart()",100000); 

    }
    

    
     function detail_voucher(){

       //$('#detail_cart').load("<?php echo base_url();?>Admin/load_cart"); 

         $.ajax({

            url: link+"/load_voucher",

            cache: false,

            success: function(msg){ 

              if(msg < 0){

                document.getElementById("detail_voucher").className = "";

              } else{

               // document.getElementById("detail_cart").className = "data-notify='2'";

                $('#detail_voucher').html(msg);

              }

            }

            });

         var waktu = setTimeout("detail_voucher()",100000); 

    }

    function detail_keranjang(){

       //$('#detail_cart').load("<?php echo base_url();?>Admin/load_cart"); 

         $.ajax({

            url: link+"/load_keranjang",

            cache: false,

            success: function(msg){ 

              if(msg < 0){

                document.getElementById("detail_keranjang").className = "";

              } else{

               // document.getElementById("detail_cart").className = "data-notify='2'";

                $('#detail_keranjang').html(msg);

              }

            }

            });

         var waktu = setTimeout("detail_keranjang()",4000); 

    }

	function cek(){

            $.ajax({

            url: link+"/cek_stok",

            cache: false,
            // console.log(msg);
            success: function(msg){ 
            	
              if(msg < 0){

                document.getElementById("notifikasi").className = "0";

                document.getElementById("notifikasine").className = "0";


              } else{
              	//console.log(msg.length);
                document.getElementById("notifikasi").className = "data-notify='2'";

                document.getElementById("notifikasine").className = "data-notify='2'";

                $('#notifikasi').html(msg);

                $('#notifikasine').html(msg);

                $('#notife').html('"'+msg+'"');

               
               
                var waktu = setTimeout("cek()",100000);
               //  get_pesan();
              }
              }


            });

         

    }
    
    
    function cek_voucher(){

            $.ajax({

            url: link+"/cek_voucher",

            cache: false,
            // console.log(msg);
            success: function(msg){ 
            	
              if(msg < 0){

                document.getElementById("notifikasi_voucher").className = "0";

                document.getElementById("notifikasi_vouchere").className = "0";


              } else{
              	//console.log(msg.length);
                document.getElementById("notifikasi_voucher").className = "data-notify='2'";

                document.getElementById("notifikasi_vouchere").className = "data-notify='2'";

                $('#notifikasi_voucher').html(msg);

                $('#notifikasi_vouchere').html(msg);

                $('#notife').html('"'+msg+'"');

               
               
                var waktu = setTimeout("cek_voucher()",100000);
               //  get_pesan();
              }
              }


            });

         

    }

    function cek_keranjang(){

            $.ajax({

            url: link+"/cek_keranjang",

            cache: false,
            // console.log(msg);
            success: function(msg){ 
            	
              if(msg < 0){

                document.getElementById("notifikasi_keranjang").className = "0";

                document.getElementById("notifikasi_keranjange").className = "0";


              } else{
              	//console.log(msg.length);
                document.getElementById("notifikasi_keranjang").className = "data-notify='2'";

                document.getElementById("notifikasi_keranjange").className = "data-notify='2'";

                $('#notifikasi_keranjang').html(msg);

                $('#notifikasi_keranjange').html(msg);

                $('#notife').html('"'+msg+'"');

               
               
                var waktu = setTimeout("cek_keranjang()",4000);
               //  get_pesan();
              }
              }


            });

         

    }

    function get_pesan(){
    	$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'This is a notice without an image!',
						// (string | mandatory) the text inside the notification
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
    }

    jQuery(function($) {
				/**
				$('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				  //console.log(e.target.getAttribute("href"));
				})
					
				$('#accordion').on('shown.bs.collapse', function (e) {
					//console.log($(e.target).is('#collapseTwo'))
				});
				*/
				
				$('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
					//if($(e.target).attr('href') == "#home") doSomethingNow();
				})
			
				
				/**
					//go to next tab, without user clicking
					$('#myTab > .active').next().find('> a').trigger('click');
				*/
			
			
				$('#accordion-style').on('click', function(ev){
					var target = $('input', ev.target);
					var which = parseInt(target.val());
					if(which == 2) $('#accordion').addClass('accordion-style2');
					 else $('#accordion').removeClass('accordion-style2');
				});
				
				//$('[href="#collapseTwo"]').trigger('click');
			
			
				var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
				$('.easy-pie-chart.percentage').each(function(){
					$(this).easyPieChart({
						barColor: $(this).data('color'),
						trackColor: '#EEEEEE',
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: 8,
						animate: oldie ? false : 1000,
						size:75
					}).css('color', $(this).data('color'));
				});
			
				$('[data-rel=tooltip]').tooltip();
				$('[data-rel=popover]').popover({html:true});
			
			
				$('#gritter-regular').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a regular notice!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: '../assets/avatars/avatar1.png', //in Ace demo ../assets will be replaced by correct assets path
						sticky: false,
						time: '',
						class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
					});
			
					return false;
				});
			
				$('#gritter-sticky').on(ace.click_event, function(){
					var unique_id = $.gritter.add({
						title: 'This is a sticky notice!',
						text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: '../assets/avatars/avatar.png',
						sticky: true,
						time: '',
						class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-without-image').on(ace.click_event, function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'This is a notice without an image!',
						// (string | mandatory) the text inside the notification
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-max3').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a notice with a max of 3 on screen at one time!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: '../assets/avatars/avatar3.png', //in Ace demo ../assets will be replaced by correct assets path
						sticky: false,
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-center').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a centered notification',
						text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
				
				$('#gritter-error').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a warning notification',
						text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
					
			
				$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
				});
					
			
				///////
			
			
				$("#bootbox-regular").on(ace.click_event, function() {
					bootbox.prompt("What is your name?", function(result) {
						if (result === null) {
							
						} else {
							
						}
					});
				});
					
				$("#bootbox-confirm").on(ace.click_event, function() {
					bootbox.confirm("Are you sure?", function(result) {
						if(result) {
							//
						}
					});
				});
				
			/**
				$("#bootbox-confirm").on(ace.click_event, function() {
					bootbox.confirm({
						message: "Are you sure?",
						buttons: {
						  confirm: {
							 label: "OK",
							 className: "btn-primary btn-sm",
						  },
						  cancel: {
							 label: "Cancel",
							 className: "btn-sm",
						  }
						},
						callback: function(result) {
							if(result) alert(1)
						}
					  }
					);
				});
			**/
					
				$("#bootbox-options").on(ace.click_event, function() {
					bootbox.dialog({
						message: "<span class='bigger-110'>I am a custom dialog with smaller buttons</span>",
						buttons: 			
						{
							"success" :
							 {
								"label" : "<i class='ace-icon fa fa-check'></i> Success!",
								"className" : "btn-sm btn-success",
								"callback": function() {
									//Example.show("great success");
								}
							},
							"danger" :
							{
								"label" : "Danger!",
								"className" : "btn-sm btn-danger",
								"callback": function() {
									//Example.show("uh oh, look out!");
								}
							}, 
							"click" :
							{
								"label" : "Click ME!",
								"className" : "btn-sm btn-primary",
								"callback": function() {
									//Example.show("Primary button");
								}
							}, 
							"button" :
							{
								"label" : "Just a button...",
								"className" : "btn-sm"
							}
						}
					});
				});
			
			
			
				$('#spinner-opts small').css({display:'inline-block', width:'60px'})
			
				var slide_styles = ['', 'green','red','purple','orange', 'dark'];
				var ii = 0;
				$("#spinner-opts input[type=text]").each(function() {
					var $this = $(this);
					$this.hide().after('<span />');
					$this.next().addClass('ui-slider-small').
					addClass("inline ui-slider-"+slide_styles[ii++ % slide_styles.length]).
					css('width','125px').slider({
						value:parseInt($this.val()),
						range: "min",
						animate:true,
						min: parseInt($this.attr('data-min')),
						max: parseInt($this.attr('data-max')),
						step: parseFloat($this.attr('data-step')) || 1,
						slide: function( event, ui ) {
							$this.val(ui.value);
							spinner_update();
						}
					});
				});
			
			
			
				//CSS3 spinner
				$.fn.spin = function(opts) {
					this.each(function() {
					  var $this = $(this),
						  data = $this.data();
			
					  if (data.spinner) {
						data.spinner.stop();
						delete data.spinner;
					  }
					  if (opts !== false) {
						data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
					  }
					});
					return this;
				};
			
				function spinner_update() {
					var opts = {};
					$('#spinner-opts input[type=text]').each(function() {
						opts[this.name] = parseFloat(this.value);
					});
					opts['left'] = 'auto';
					$('#spinner-preview').spin(opts);
				}
			
			
			
				$('#id-pills-stacked').removeAttr('checked').on('click', function(){
					$('.nav-pills').toggleClass('nav-stacked');
				});
			
				
				
				
				
				
				///////////
				$(document).one('ajaxloadstart.page', function(e) {
					$.gritter.removeAll();
					$('.modal').modal('hide');
				});
			
			});

</script>			

<?php $this->load->view('vfooter'); ?>	

