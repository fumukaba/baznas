<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style type="text/css">
    	.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}

.how-itemcart1 {
  width: 60px;
  position: relative;
  margin-right: 20px;
  cursor: pointer;
}

.how-itemcart1 img {
  width: 100%;
}

.how-itemcart1::after {
  content: '\e870';
  font-family: Linearicons-Free;
  font-size: 16px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.5);
  color: #fff;
  transition: all 0.3s;
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  -moz-transition: all 0.3s;
  opacity: 0;
}

.how-itemcart1:hover:after {
  opacity: 1;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="http://malangbatikparade.com/assets_invoice/logo.png">
      </div>
      <h1 style="background: url(http://malangbatikparade.com/assets_invoice/dimension.png);">INVOICE TAGIHAN <?php echo $order[0]['fc_kdorder']; ?></h1>
      <div id="notices">
        <div>Catatan :</div>
        <div class="notice">Kami informasikan bahwa produk pada nomor pesanan #<?php echo $order[0]['fc_kdorder']; ?> telah dibatalkan.</div>
      </div><br /><br />
      <div id="project">
        <div class="service" style="font-size: 16px;"><span>ID Order</span> : <?php echo $order[0]['fc_kdorder']; ?></div>
        <div class="service" style="font-size: 16px;"><span>Ditagihkan</span> :  <?php echo $order[0]['fv_nama_order']; ?></div>
        <div class="service" style="font-size: 16px;"><span>Kota</span> : <?php echo $order[0]['fv_kota_order']; ?> </div>
        <div class="service" style="font-size: 16px;"><span>Provinsi</span> : <?php echo $order[0]['fv_provinsi_order']; ?></div>
        <div class="service" style="font-size: 16px;"><span>Alamat</span> : <?php echo $order[0]['fv_alamat_order']; ?></div>
        <div class="service" style="font-size: 16px;"><span>Email</span> : <?php echo $order[0]['fv_email_order']; ?></div>
        <div class="service" style="font-size: 16px;"><span>No Telp</span> : <?php echo $order[0]['fc_telp']; ?></div>
        <div class="service" style="font-size: 16px;"><span>Kode Pos</span> : <?php echo $order[0]['fc_kode_pos_order']; ?></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Nama Produk</th>
            <th></th>
            <th class="desc">Harga</th>
            <th>Qty</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
        <?php 
            foreach($detail_order as $key){
                    
        ?>
              
          <tr>
            <td class="service"> <div class="how-itemcart1">
                      <img src="<?php echo base_url();?>assets/images/<?php echo $key['fc_img_1'] ?>" alt="IMG">
                    </div></td>
            <td class="desc"><?php echo $key['fv_nama_barang'] ?></td>
            <td class="unit">Rp. <?php echo nominal($key['fm_harga'])?></td>
            <td class="qty"><?php echo $key['f_jumlah_produk'] ?></td>
            <td class="total">Rp. <?php echo nominal($key['fm_subtotal']) ?></td>
          </tr>
        <?php } ?>  
          <tr>
            <td colspan="4">Total</td>
            <td class="total">Rp.  <?php echo nominal($order[0]['fm_total'])?></td>
          </tr>
          <tr>
            <td colspan="4">Ongkir</td>
            <td class="total">Rp. <?php echo nominal($order[0]['fm_ongkir_order']); ?></td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">Rp. <?php echo nominal($order[0]['fm_grandtotal_order']); ?></td>
          </tr>
        </tbody>
      </table>
      
    </main>
    <footer>
    </footer>
  </body>
</html>