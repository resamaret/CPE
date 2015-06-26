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

    <title>Admin: Edit Produk TOKOCPE</title>
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
          $select = "SELECT tanggal_upload, merk, nama_produk, nama_gambar, spesifikasi, harga, stok FROM produk WHERE id_produk=$id_produk";
          $result = mysqli_query($koneksi, $select);
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if (mysqli_num_rows($result) == "") {
              echo "<big>Data Produk Not Found<big>";
            } else {
        ?>
          <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputtanggal_upload" class="col-sm-2 control-label">Tanggal Upload</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" value="<?php echo $row['tanggal_upload']; ?>" disabled/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputmerk" class="col-sm-2 control-label">Merk</label>
              <div class="col-sm-10">
                <input type="radio" name="merk" id="inputmerk" value="ACER" <?php echo ($row['merk'] == "ACER") ? "checked" : "" ; ?>/>Acer
                <input type="radio" name="merk" id="inputmerk" value="LENOVO" <?php echo ($row['merk'] == "LENOVO") ? "checked" : "" ; ?>/>Lenovo
              </div>
            </div>
            <div class="form-group">
              <label for="inputnama_produk" class="col-sm-2 control-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" value="<?php echo $row['nama_produk'] ;?>" maxlength="40" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputspesifikasi" class="col-sm-2 control-label">Spesifikasi</label>
              <div class="col-sm-10">
                <textarea name="spesifikasi" class="form-control"><?php echo $row['spesifikasi']?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputharga" class="col-sm-2 control-label">Harga</label>
              <div class="col-sm-10">
                <input type="number" name="harga" class="form-control" value="<?php echo $row['harga'];?>" placeholder="Harga" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputstok" class="col-sm-2 control-label">Stok</label>
              <div class="col-sm-10">
                <input type="number" name="stok" class="form-control" value="<?php echo $row['stok']; ?>" placeholder="Stok" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputgambar" class="col-sm-2 control-label">Gambar</label>
              <div class="col-sm-10">
                <img src="image/<?php echo $row['nama_gambar']; ?>" width="200px"/>
                <input type="file" name="Gambar" value="<?php echo $row['gambar']; ?>"/>
              </div>   
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="editproduk">Edit</button>
              </div>
            </div>      
          <?php  
            
            if (isset($_POST['editproduk'])) {

                $merk = $_POST['merk'];
                $nama_produk = $_POST['nama_produk'];
                $spesifikasi = $_POST['spesifikasi'];
                $harga = $_POST['harga'];
                $stok = $_POST['stok'];

                $nama_gambar = $_FILES ['Gambar']['name'];

                if ($nama_gambar == "") {
                $update = "UPDATE produk SET merk='$merk', nama_produk='$nama_produk', spesifikasi='$spesifikasi', harga='$harga', stok='$stok' WHERE id_produk='$id_produk'";
                  if (mysqli_query($koneksi, $update)) {
                      echo "Data berhasil diedit";
                      echo "<META http-equiv='refresh' content='1;URL=index.php'>";
                    } else {
                      echo "Gagal inputkan data";
                    }             
                    mysqli_close($koneksi);
                } else {

                $lokasi_file = $_FILES ['Gambar']['tmp_name'];
                $tipe_file = $_FILES ['Gambar']['type'];
                $direktori = "image/$nama_gambar";
                move_uploaded_file( $lokasi_file,$direktori);

                  $update = "UPDATE produk SET merk='$merk', nama_produk='$nama_produk', spesifikasi='$spesifikasi', harga='$harga', stok='$stok', nama_gambar='$nama_gambar' WHERE id_produk='$id_produk'";
                  if (mysqli_query($koneksi, $update)) {
                      echo "<script type='text/javascript'>alert('Data Berhasil Di Update')</script>";
                      echo "<META http-equiv='refresh' content='0;URL=index.php'>";
                    } else {
                      echo "Gagal inputkan data";
                    }             
                    mysqli_close($koneksi);
                
                }

            }
          }
          ?>
          
          </form>
        </div>
      </div>

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>

    </div>
  </body>
</html>