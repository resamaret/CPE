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
    
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>View Produk: TOKOCPE</title>
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
    	<div class="container">
        <script src="selectproduk.js"></script>
        
         <form class="form-search">
            <div class="form-group">
              <select name="prodi" onchange="showProduk(this.value)" class="form-control">
                <option> Pilih Produk </option>
                <?php 
                  $query = "SELECT DISTINCT merk FROM produk";
                  $result = mysqli_query($koneksi, $query);

                  while ($row = mysqli_fetch_array($result)) {
                    extract($row);
                 ?>
                  <option value="<?php echo "$merk" ?>"><?php echo "$merk" ?></option>
                <?php 
                   }
                ?>
              </select>
            </div>
         </form>
          
      </div>
      <div id="txtHint"></div>
      
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>

      </div>
  </body>
</html>

