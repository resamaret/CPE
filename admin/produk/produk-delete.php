<?php 
  include("../../koneksi.php");
  $id_produk = $_GET['id_produk'];
  session_start();

  $selectusername = "SELECT * FROM login WHERE username='".$_SESSION['username']."'";
  $resultusername = mysqli_query($koneksi, $selectusername);
  $rowusername = mysqli_fetch_array($resultusername, MYSQLI_ASSOC);
  $level = $rowusername['level'];

  if ($level!='admin') {
?>
    <script type='text/javascript'>
      alert('Anda Harus Login Terlebih Dahulu')
    </script>
    <META http-equiv='refresh' content='0;URL=../../login.php'>
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

    <title>Admin: Delete Produk TOKOCPE</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="../../logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li><a href="../index.php">Home</a></li>
            <li class="active"><a href="../produk/index.php">Produk</a></li>
            <li><a href="../member/index.php">Member</a></li>
            <li><a href="../laporan/index.php">Laporan</a></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
    
    <br/> 	
    	<div class="container theme-showcase" role="main">
        <div class="jumbotron">

          <?php  
            $select = "SELECT * FROM produk WHERE id_produk=$id_produk";
            $result = mysqli_query($koneksi, $select);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            extract($row);

            if (mysqli_num_rows($result) == "") {
              echo "<big>Data Produk Not Found<big>";
            } else {
          ?>

          <form class="form-signin" method="post">
            <div class="row">
              <div class="col-xs-6 col-md-4" align="center">
                <b><tt><?php echo $tanggal_upload; ?></tt></b><br/>
                <h2><?php echo $nama_produk; ?></h2>
                <img src="image/<?php echo $nama_gambar; ?>" width='200px'/>
              </div>
              <div class="col-xs-12 col-md-8">
              <br/><br/><br/><br/>
                ID Produk : <big><b><?php echo $id_produk; ?></b></big><br/>
                Harga : <?php echo "<big><b>Rp ".$harga."</b></big>"; ?><br/>
                Stok : <b><?php echo $stok; ?></b><br/>
                <?php echo $spesifikasi; ?><br/>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6 col-md-4" align="center">
                <br>
                <a class="btn btn-danger" href="index.php" name="back">Back</a>
                <button class="btn btn-primary" type="submit" name="delete">Delete</button>
               </div>
            </div>
          </form>
          <?php  
            }
            
            if(isset($_POST['delete'])) {

               $sqldelete = "DELETE FROM produk WHERE id_produk=$id_produk";
               
               if (mysqli_query($koneksi, $sqldelete)) {
                  echo "<b>This produk has been deleted</b>";
                  echo "<META http-equiv='refresh' content='1;URL=index.php'>";
               } else {
                  echo "Error: ". $sqldelete ."<br/>". mysqli_error($koneksi);
               }
              mysqli_close($koneksi);
            };
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