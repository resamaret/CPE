<?php 
  include("../koneksi.php");
  session_start();

  $selectusername = "SELECT * FROM login WHERE username='".$_SESSION['username']."'";
  $resultusername = mysqli_query($koneksi, $selectusername);
  $rowusername = mysqli_fetch_array($resultusername, MYSQLI_ASSOC);
  $level = $rowusername['level'];
  $_SESSION['nama'] = $rowusername['nama'];

  if ($level!='admin') {
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

    <title>Admin: TOKOCPE</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="../logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="../admin/index.php">Home</a></li>
            <li><a href="../admin/produk/index.php">Produk</a></li>
            <li><a href="../admin/member/index.php">Member</a></li>
            <li><a href="../admin/laporan/index.php">Laporan</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
      <!-- Example row of columns -->
    <br/><br/>
      <div class="row">        
        <div class="col-lg-4">
          <p>
            <a href="../admin/produk/index.php"><img src="../img/produk.png" width="180px"></a>
          </p>
        </div>
        <div class="col-lg-4">
          <p>
            <a href="../admin/member/index.php"><img src="../img/member.png" width="180px"></a>
          </p>
        </div>
        <div class="col-lg-4">
          <p>
            <a href="../admin/laporan/index.php"><img src="../img/laporan.png" width="180px"></a>
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