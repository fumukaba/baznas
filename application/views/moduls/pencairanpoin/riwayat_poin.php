<div class="span7">

<div class="row-fluid">

    <div class="widget-box">

	<div class="widget-header">

	<h4><i class="icon-credit-card" ></i>&nbsp;Riwayat Pencairan Poin</h4>

        <span class="widget-toolbar">

<a href="#" data-action="settings">

<i class="icon-cog"></i></a>



<a href="#" data-action="reload">

<i class="icon-refresh"></i></a>



<a href="#" data-action="collapse">

<i class="icon-chevron-up"></i>	</a>



<a href="#" data-action="close">

    <i class="icon-remove"></i>	

</a>

 </span>

	</div>



    <div class="widget-body">

	<div class="widget-main">

	<form class="form-inline" />

        <label for="form-field-1">Pilih User</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<label for="kecamatan"></label>

    <select name="user" id="user" style="width:240px;" >

    <option>--Pilih User--</option>

    <?php $user = $this->db->query('select * from tm_user');?>

    <?php foreach($user->result() as $row_kecamatan)	{	?>

   	<option value="<?php echo $row_kecamatan->id_user?>"><?php echo $row_kecamatan->id_user?></option>

    <?php } ?>

    </select>

	

</form>

</div>

</div>

</div>

</div>

  

  

    <span id="kota"></span>



    

    <script>



	$(function(){ // sama dengan $(document).ready(function(){



		$('#user').change(function(){



			$('#kota').html("<img src='<?php echo base_url();?>assets/img/loader-dark.gif"); //Menampilkan loading selama proses pengambilan data kota



			var id = $(this).val(); //Mengambil id provinsi

                      

			$.get("<?php echo site_url('Riwayat_Poin/create_load'); ?>", {id:id}, function(data){

				$('#kota').html(data);

			});

		});



	});



	</script>