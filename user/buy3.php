<?php 
  include("../koneksi.php");
  $id_order = $_GET['id_order'];
  session_start();

  $selectusername = "SELECT * FROM login WHERE username='".$_SESSION['username']."'";
  $resultusername = mysqli_query($koneksi, $selectusername);
  $rowusername = mysqli_fetch_array($resultusername, MYSQLI_ASSOC);
  $level = $rowusername['level'];

  if ($level!='user') {
?>
    <script type='text/javascript'>
      alert('Anda Harus Login Terlebih Dahulu')
    </script>
    <META http-equiv='refresh' content='0;URL=../login.php'>
<?php
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Buy Produk: TOKOCPE</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="../logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="produk.php">Produk</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="cek-order.php">Cek Order</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
      <br/>
    	<div class="container theme-showcase" role="main">
        <div class="jumbotron">

        <?php  
          $sql = "SELECT `produk`.nama_produk, `order`.* FROM `produk` LEFT JOIN `order` ON `produk`.id_produk=`order`.id_produk WHERE id_order=$id_order";
          $result = mysqli_query($koneksi, $sql);
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

          if ($_SESSION['opsipembayaran'] == "COD") {
            echo "
              <h2>Terima Kasih ".$_SESSION['nama'].", Barang Anda akan kami kirim</h2><br/>
              <p align='justify'>
                Kode pemesanan anda adalah <font color='#337ab7'><b>".$row['id_order']."</b></font>. Kode pemesanan tersebut untuk pengecekan status order barang apabila barang belum sampai ke penerima.
                <b>Silahkan membayar uang senilai <font color='#337ab7'>Rp ".$_SESSION['subtotal']." </font> apabila kurir pengiriman barang kami telah tiba ke alamat anda <font color='#337ab7'> ".$row['alamat']."</font></b>, 
                dan pastikan No Handphone anda <font color='#337ab7'><b>".$row['nohp']."</b></font> selalu aktif apabila barang telah tiba di alamat tujuan anda, maka kurir kami akan menghubungi anda.
              </p>
              <table border='0' class='table table-responsive' align='center'>
                <tr>
                  <td align='left'><b>ID Order</b> : ".$row['id_order']."</td>
                  <td align='right'><b>Status Pengiriman</b> : ".$row['status_order']."</td>
                </tr>
                <tr>
                  <td align='left'><b>Produk</b> :</td>
                  <td align='right'><b>Total Bayar</b> :</td>
                </tr>
                <tr>
                  <td align='left'>".$row['nama_produk']."</td>
                  <td align='right'>Rp ".$_SESSION['subtotal']."</td>
                </tr>
                <tr>
                  <td colspan='2' align='center'>
                    <a href='detail-pemesanan.php?id_order=$id_order'><button class='btn btn-primary'>Detail Pesanan</button></a>
                  </td>
                </tr>
              </table>
              ";

          } else if ($_SESSION['opsipembayaran'] == "BCA") {
            echo "
              <h2>Terima Kasih ".$_SESSION['nama']."</h2><br/>
              Barang anda akan kami kirim setelah anda melakukan transaksi pembayaran via <b>ATM BCA</b>.<br/>
              Berikut ini adalah langkah-langkah melakukan pembayaran menggunakan <b>ATM BCA</b> :<br/><br/>
              <img src='../pembayarantransfer.png' class='img-responsive'><br/>
              
              <table border='0' class='table table-responsive' align='center'>
                <tr>
                  <td align='left'><b>ID Order</b> : ".$row['id_order']."</td>
                  <td align='right'><b>Status Pengiriman</b> : ".$row['status_order']."</td>
                </tr>
                <tr>
                  <td align='left'><b>Nama Produk</b> :</td>
                  <td align='right'><b>Total Bayar</b> :</td>
                </tr>
                <tr>
                  <td align='left'>".$row['nama_produk']."</td>
                  <td align='right'>Rp ".$_SESSION['subtotal']."</td>
                </tr>
                <tr>
                  <td colspan='2' align='center'>
                    <a href='detail-pemesanan.php?id_order=$id_order'><button class='btn btn-primary'>Detail Pesanan</button></a>
                  </td>
                </tr>
              </table>
              ";
          }
        ?>

          
          
        </div>
      </div>
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>
    </div>
  </body>
</html>