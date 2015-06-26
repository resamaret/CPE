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

    <title>Cek Order TOKOCPE</title>
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
          <form class="form-inline" method="get">
            <div class="form-group">
              <label for="inputidorder">Cek Order : </label>
              <select name="id_order" class="form-control">
                <option></option>
                <?php 
                  $query="SELECT * FROM `order` WHERE username='".$_SESSION['username']."'";
                  $result = mysqli_query($koneksi, $query);
                  while ($row = mysqli_fetch_array($result)) {
                    //list($kodeprodi, $namaprodi)=$result_data;          
                 ?>
                  <option value="<?php echo $row['id_order']; ?>"><?php echo $row['id_order']; ?></option>
                <?php 
                   }
                ?>
              </select>
              <button type="submit" name="cek" class="btn btn-primary">Cek Id Order</button>
            </div>
         </form>
         <?php  
          if (isset($_GET['cek'])) {
            $id_order = $_GET['id_order'];

            $selectidorder = "SELECT `produk`.nama_produk, `order`.* FROM `order` left JOIN `produk` ON produk.id_produk = order.id_produk WHERE id_order=$id_order";
            $resultidorder = mysqli_query($koneksi, $selectidorder);
            $rowidorder = mysqli_fetch_array($resultidorder, MYSQLI_ASSOC);

            echo "<br/><br/><table border='0' class='table table-responsive' align='center'>
                <tr>
                  <td align='left'><b>ID Order</b> : ".$rowidorder['id_order']."</td>
                  <td align='right'><b>Status Pengiriman</b> : ".$rowidorder['status_order']."</td>
                </tr>
                <tr>
                  <td align='left'><b>Nama Produk</b> :</td>
                  <td align='right'><b>Total Bayar</b> :</td>
                </tr>
                <tr>
                  <td align='left'>".$rowidorder['nama_produk']."</td>
                  <td align='right'>Rp ".$rowidorder['total_bayar']."</td>
                </tr>
                <tr>
                  <td colspan='2' align='center'>
                    <a href='detail-pemesanan.php?id_order=$id_order'><button class='btn btn-primary'>Detail Pesanan</button></a>
                  </td>
                </tr>
              </table>";
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