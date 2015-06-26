<?php  
  include("koneksi.php");
  session_start();
  session_destroy();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">

    <title>TOKOCPE</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="daftar.php">Daftar</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        </nav>

      </div>

      <br/>
      <div class="row">
      <?php

        $select = "SELECT * FROM produk ORDER BY tanggal_upload desc";
        $result = mysqli_query($koneksi, $select);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          extract($row);
          $stok = $row['stok'];

          if ($stok == 0) {
            //Barang Kosong
          } else {
            echo "
            <div class='col-lg-4'>
              <h6><hr>$tanggal_upload</h6>
              <h2>$nama_produk</h2>
              <big><b>Rp $harga</b></big><br/>
              <p>
                <img src='admin/produk/image/$nama_gambar' width='180px'>
              </p>
              <p>
                <a class='btn btn-primary' href='view-produk.php?id_produk=$id_produk' role='button'>View details &raquo;</a>
                <a class='btn btn-danger' href='buy.php?id_produk=$id_produk' role='button'>Buy Now &raquo;</a>
              </p>
            </div>";
          }  
        }
     ?>
      </div>
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>
    </div>

  </body>
</html>