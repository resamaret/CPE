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
    <link rel="icon" href="../../favicon.ico">

    <title>Detail Pemesanan TOKOCPE</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="../logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li><a href="index.php">Home</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="about.php">About</a></li>
            <li class="active"><a href="cek-order.php">Cek Order</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
      <br/>
      <div class="container theme-showcase" role="main">
        <div class="jumbotron">
        <?php  
          $sql = "SELECT `produk`.nama_produk, nama_gambar, `order`.* FROM `order` left JOIN `produk` ON produk.id_produk = order.id_produk WHERE id_order=$id_order";
          $result = mysqli_query($koneksi, $sql);
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>
        <table class="table table-responsive" align="center">
          <tr>
            <td colspan="2" align="center"><b>Id Order </b>: <?php echo $row['id_order']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal Beli</b> : <?php echo $row['tanggal_beli']; ?></td>
            <td align="right"><b>Status Order</b> : <?php echo $row['status_order']; ?></td>
          </tr>
          <tr>
            <td><b>Nama Barang</b> : <?php echo $row['nama_produk']; ?></td>
            <td align="right"><b>Nama Penerima</b> : <?php echo $row['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Kuantitas</b> : <?php echo $row['jumlah_order']; ?></td>
            <td align="right"><b>Alamat Pengiriman</b> : <?php echo $row['alamat']; ?></td>
          </tr>
          <tr>
            <td><img src="../admin/produk/image/<?php echo $row['nama_gambar']; ?>" width="100px"></td>
            <td align="right"><b>No Hp</b> : <?php echo $row['nohp']; ?></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><b>Total Bayar</b> : Rp <?php echo $row['total_bayar']; ?></td>
          </tr>
          <tr>
            <form method="post">
            <?php  
              if ($row['status_order'] == "Barang Dikirim") {
                echo'<td colspan="2" align="center"><button class="btn btn-primary" name="update">Konfirmasi Barang Telah Diterima</button></td>';
                 
                if (isset($_POST['update'])) {
                  $sqlupdate = "UPDATE `order` SET status_order='Barang Telah Diterima' WHERE id_order=$id_order";
                  $resultupdate = mysqli_query($koneksi, $sqlupdate);

                  echo "<META http-equiv='refresh' content='1;URL=index.php'>";
                }

              } else if ($row['status_order'] == "Menunggu Pembayaran") {
                echo '<td colspan="2" align="center"><button class="btn btn-danger" name="update2">Konfirmasi Pembayaran</button></td>';
                
                if (isset($_POST['update2'])) {
                  $sqlupdate = "UPDATE `order` SET status_order='Barang Dikirim' WHERE id_order=$id_order";
                  $resultupdate = mysqli_query($koneksi, $sqlupdate);

                  echo "<META http-equiv='refresh' content='1;URL=index.php'>";
                }
              }
            ?>
            </form>
          </tr>
        </table>
        <center><a href="cek-order.php"><button class="btn btn-primary">Back</button></a></center>
        </div>       
      </div>
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>
    </div>
  </body>
</html>