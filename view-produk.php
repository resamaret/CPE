<?php 
	include("koneksi.php");
  $id_produk=$_GET['id_produk'];
  session_start();
  session_destroy();
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

    <title>View Produk: TOKOCPE</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="produk.php">Produk</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="daftar.php">Daftar</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        </nav>
      </div>      
    <br/>
    	<div class="container">
				<?php
  				$select = "SELECT * FROM produk WHERE id_produk='$id_produk'";
  				$result = mysqli_query($koneksi, $select);

					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
 						extract($row);
        ?>

        <div class="row">
          <div class="col-xs-6 col-md-4" align="center">
            <b><tt><?php echo $tanggal_upload; ?></tt></b><br/>
            <h2><?php echo $nama_produk; ?></h2>
            <img src="admin/produk/image/<?php echo $nama_gambar; ?>" width='300px'/>
          </div>
          <div class="col-xs-12 col-md-8">
          <br/><br/><br/><br/><br/>
            <b><?php echo $merk; ?></b><br/>
            <?php echo "<big><b>Rp ".$harga."</b></big>"; ?><br/>
            <?php echo $spesifikasi; ?><br/>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6 col-md-4" align="center">
            <a href="index.php"><button class="btn btn-danger">Back</button></a>
            <a href="buy.php?id_produk=<?php echo $id_produk; ?>"><button class="btn btn-primary">Buy</button></a>
          </div>
        </div>

        <?php
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

