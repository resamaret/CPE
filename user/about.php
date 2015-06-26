<?php 
  include("../koneksi.php");
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

    <title>ABOUT TOKOCPE</title>
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
            <li class="active"><a href="about.php">About</a></li>
            <li><a href="cek-order.php">Cek Order</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
      <br/>
      <div class="container theme-showcase" role="main">
        <div class="jumbotron">
          <p align="justify">
            TOKO CPE adalah salah satu e-commerce konsep berbelanja laptop online. Dengan konsep tersebut kami mengharapkan agar masyarakat dapat menemukan laptop yang mereka cari dengan mudah dan menyenangkan dimanapun dan kapanpun. TOKO CPE merupakan produk pertama kelompok CPE yang terdiri dari: 
            <ul>
              <li>Resa Marettanto</li>
              <li>Nur Muhammad Aulia Rahman</li>
              <li>Saadillah Razaqi Salam</a></li>
              <li>Eka Bagus Susanto</li>
            </ul>
            <br/><b>Contact Person:</b>
            <ul>
              <li>Eka (087857898090)</li>
              <li>Nur (089721831822)</li>
            </ul>
          </p>
        </div>
      </div>
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>
    </div>
  </body>
</html>