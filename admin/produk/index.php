<?php 
  include("../../koneksi.php");
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

    <title>Admin: Produk - TOKOCPE</title>
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
    	<div class="container">
			<center><a href="produk-upload.php"><button class="btn btn-info">Upload Produk</button></a></center>
			<br>
      <table class="table table-hover">
				<?php
  					$select = "SELECT * FROM produk ORDER BY tanggal_upload desc";
  					$result = mysqli_query($koneksi, $select);

  					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  						extract($row);
  						echo 
  						"<tr>
  							<td colspan='2'><b><tt>".$tanggal_upload."</tt></b></td>
  						 </tr>
  						 <tr>
  						  <td rowspan='5'><img src='image/$nama_gambar' class='img-responsive' alt='Responsive image' width='200px'></td>
  						 </tr>
  						 <tr>
  							<td>".$merk."</td>
  						 </tr>
  							<td>".$nama_produk."</td>
  						 <tr>
  							<td>Rp ".$harga."</td>
  						 </tr>
  						 <tr>
  							<td>Stok : ".$stok."</td>
  						 </tr>
               <tr>
                <td colspan='2'>".$spesifikasi."</td>
               </tr>
  						 <tr>
  							<td colspan='2'>
  							<center>
  						  <a href='produk-edit.php?id_produk=$id_produk'><button type='button' class='btn btn-class btn-primary'>Edit</button></a>
  							<a href='view-produk.php?id_produk=$id_produk'><button type='button' class='btn btn-class btn-warning'>View Produk</button></a>
                <a href='produk-delete.php?id_produk=$id_produk'><button type='button' class='btn btn-class btn-danger'>Delete</button></a>
  							</center>
  							</td>
  						</tr>";
  					 
  					}
  				?>
			</table>
		  </div>  
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>
    </div>
  </body>
</html>