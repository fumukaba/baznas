<?php
 // Define relative path from this script to mPDF
// $nama_dokumen='Laporan'; //Beri nama file PDF hasil.
// define('_MPDF_PATH','MPDF60/');
// include(_MPDF_PATH."mpdf.php");
// $mpdf=new mPDF('utf-8','A4-L');
// ob_start();
?>
<html>
<head>
<meta charset="utf-8">
<title>Barang Pindah Document</title>
 <style type="text/css" media="print">
        table {
            border-collapse: collapse; 
            width: 100%;
        }
        td {
            padding: 7px 5px;
            text-align: left;
        }
        .container{
            box-sizing: inherit;
        }
        .logodisp {
            float: left;
            position: relative;
            width: 80px;
            height: 80px;
            margin: .5rem 0 0 .5rem;
        }
        .up {
            text-transform: uppercase;
            margin: 0;
            line-height: 2.2rem;
            font-size: 1.5rem;
            font-size: 17px!important;
            font-weight: normal;
        }
        .disp {
            text-align: left;
            margin: -.5rem 0;
        }
        .separator {
            border-bottom: 2px solid #616161;
            margin: 1rem 0 1rem;
            width: 100%;
        }
    </style>

    <style type="text/css" media="screen">
        table {
            border-collapse: collapse; 
            width: 60%; 
        }
        td {
            padding: 7px 5px;
            text-align: left;
        }
        .container{
            box-sizing: inherit;
        }
        .logodisp {
            float: left;
            position: relative;
            width: 80px;
            height: 80px;
            margin: .5rem 0 0 .5rem;
        }
        .up {
            text-transform: uppercase;
            margin: 0;
            line-height: 2.2rem;
            font-size: 17px!important;
            font-weight: normal;
        }
        .disp {
            text-align: center;
            margin: -.5rem 0;
        }
        .separator {
            border-bottom: 2px solid #616161;
            margin: 1rem 0 2rem;
            width: 60%;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="disp">
            <table align="center">
                <tr>
                    <td colspan="2" style="text-align: center;">
                        
                        <h5 class="up" id="nama">Laporan Barang Pindah</h5>
                    </td>
                </tr>
            </table>
        </div>
        <center><div class="separator"></div></center>
        <div class="disp">
            <table align="center" border="1">
                <tr>
                    <th colspan="3" style="text-align: center;">
                        <b><p>BARANG Pindah</p></b>
                    </th>
                </tr>
                <tr>
                    <th>Kode Barang Pindah</th>
                    <th>Tanggal Barang Pindah</th>
                    <th>Gudang Asal</th>
                    <th>Gudang Tujuan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                </tr>
            <?php foreach($print as $trans) { ?>
                <tr>
                    <td><?php echo $trans["fc_kdbarang_pindah"]; ?></td>
                    <td><?php echo $trans["fd_tgl_barang_pindah"]; ?></td>
                    <td><?php echo $trans["nmasal"]; ?></td>
                    <td><?php echo $trans["nmtujuan"]; ?></td>
                    <td><?php echo $trans["fv_nama_barang"]; ?></td>
                    <td><?php echo $trans["f_jumlah_barang"]; ?></td>
                </tr>
            <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
<?php
// $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
// ob_end_clean();
// //Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
// $mpdf->WriteHTML(utf8_encode($html));
// $mpdf->Output($nama_dokumen.".pdf" ,'I');
// exit;
?>