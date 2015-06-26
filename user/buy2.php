<?php 
  include("../koneksi.php");
  $id_produk = $_GET['id_produk'];
  $tanggalsekarang = date("Y-m-d");
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
      <div class="container">

        <table class="table table-hover">
          <center><h3><b>BARANG YANG DIBELI</b></h3></center>
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Kuantitas</th>
              <th>Biaya Pengiriman</th>
              <th>Total Pembayaran</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td><?php echo $_SESSION['nama_produk']; ?></td>
            <td>Rp <?php echo $_SESSION['harga']; ?></td>
            <td><?php echo $_SESSION['kuantitas']; ?></td>
            <td>Gratis</td>
            <td>Rp <?php echo $_SESSION['subtotal']; ?></td>
            </tr>
          </tbody>
        </table>
          <form class="form-horizontal" method="post">
            <div class="form-group">
              <label for="inputopsipembayaran" class="col-sm-2 control-label">Opsi Pembayaran *</label>
              <div class="col-sm-10" align="justify">
                <input type="radio" name="opsipembayaran" id="inputopsipembayaran" value="COD"/> Cash of Delivery &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="radio" name="opsipembayaran" id="inputopsipembayaran" value="BCA"/> Transfer Bank (BCA)
              </div>
            </div>            
            <div class="form-group">
              <label for="inputusername" class="col-sm-2 control-label">Nama Penerima *</label>
              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $_SESSION['nama']; ?>" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputusername" class="col-sm-2 control-label">Alamat Penerima *</label>
              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputusername" class="col-sm-2 control-label">No Handphone *</label>
              <div class="col-sm-10">
                <input type="number" name="nohp" class="form-control" placeholder="No Handphone" maxlength="12" required/>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="Lanjutkan">Lanjutkan Pembayaran</button>
              </div>
            </div>      
            <?php 
              if (isset($_POST['Lanjutkan'])) {
                $opsipembayaran = $_POST['opsipembayaran'];
                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];
                $nohp = $_POST['nohp'];
                $sisa = $_SESSION['stok'] - $_SESSION['kuantitas'];

                $_SESSION['nama'] = $nama;
                $_SESSION['alamat'] = $alamat;
                $_SESSION['nohp'] = $nohp;
                $_SESSION['opsipembayaran'] = $opsipembayaran;

                $selectidorder = "SELECT max(id_order) as max from `order`";
                $resultidorder = mysqli_query($koneksi, $selectidorder);
                $row = mysqli_fetch_array($resultidorder, MYSQLI_ASSOC);
                $max = $row['max'];
                $id_order = $max + 1;

                if ($_SESSION['opsipembayaran'] == "COD") {
                  $insert = "INSERT INTO `order`(`opsipembayaran`,`id_order`,`tanggal_beli`,`username`,`nama`,`id_produk`,`jumlah_order`,`alamat`,`nohp`,`total_bayar`,`status_order`) 
                            VALUES ('$opsipembayaran','$id_order','$tanggalsekarang','".$_SESSION['username']."','$nama',$id_produk,$_SESSION[kuantitas],'$alamat','$nohp',$_SESSION[subtotal],'Barang Dikirim')";

                } else if ($_SESSION['opsipembayaran'] == "BCA") {
                  $insert = "INSERT INTO `order`(`opsipembayaran`,`id_order`,`tanggal_beli`,`username`,`nama`,`id_produk`,`jumlah_order`,`alamat`,`nohp`,`total_bayar`) 
                            VALUES ('$opsipembayaran','$id_order','$tanggalsekarang','".$_SESSION['username']."','$nama',$id_produk,$_SESSION[kuantitas],'$alamat','$nohp',$_SESSION[subtotal])";
                }
                
                $update = "UPDATE produk SET stok = $sisa WHERE id_produk=$id_produk";

                $resultinsert = mysqli_query($koneksi, $insert);
                $resultupdate = mysqli_query($koneksi, $update);
                
                echo "<META http-equiv='refresh' content='0;URL=buy3.php?id_order=$id_order'>";
                mysqli_close($koneksi);
              }
             ?>
          </form>
          <div class='alert alert-warning' role='alert'><b>* Harus Diisi</b></div>  
      </div>
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>
    </div>
  </body>
</html>