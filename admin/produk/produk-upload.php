<?php 
  include("../../koneksi.php");
  $tanggalsekarang = date("Y-m-d");
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

    <title>Admin: Upload Produk TOKOCPE</title>
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
          <form class="form-horizontal" method="post" enctype="multipart/form-data" >
            <div class="form-group">
              <label for="inputtanggal_upload" class="col-sm-2 control-label">Tanggal Upload</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" value="<?php echo $tanggalsekarang; ?>" disabled/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputmerk" class="col-sm-2 control-label">Merk</label>
              <div class="col-sm-10">
                <input type="radio" name="merk" id="inputmerk" value="ACER">Acer
                <input type="radio" name="merk" id="inputmerk" value="LENOVO">Lenovo
              </div>
            </div>
            <div class="form-group">
              <label for="inputnama_produk" class="col-sm-2 control-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" maxlength="40" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputspesifikasi" class="col-sm-2 control-label">Spesifikasi</label>
              <div class="col-sm-10">
                <textarea name="spesifikasi" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputharga" class="col-sm-2 control-label">Harga</label>
              <div class="col-sm-10">
                <input type="number" name="harga" class="form-control" placeholder="Harga" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputstok" class="col-sm-2 control-label">Stok</label>
              <div class="col-sm-10">
                <input type="number" name="stok" class="form-control" placeholder="Stok" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputgambar" class="col-sm-2 control-label">Gambar</label>
              <div class="col-sm-10">
                <input type="file" name="gambar" required/>
              </div>   
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="uploadproduk">Upload Produk</button>
              </div>
            </div>      
          </form>
          <?php 
          if (isset($_POST['uploadproduk'])) {
          
            $tanggal_upload = $tanggalsekarang;
            $merk = $_POST['merk'];
            $nama_produk = $_POST['nama_produk'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $spesifikasi = $_POST['spesifikasi'];

            $lokasi_file = $_FILES['gambar']['tmp_name'];
            $tipe_file = $_FILES['gambar']['type'];
            $nama_file = $_FILES['gambar']['name'];
            $direktori = "image/$nama_file";

            move_uploaded_file($lokasi_file, $direktori);

            $sql = "INSERT INTO produk (tanggal_upload, merk, nama_produk, harga, stok, spesifikasi, nama_gambar) 
                    VALUES ('$tanggal_upload', '$merk', '$nama_produk', '$harga', '$stok', '$spesifikasi', '$nama_file')";
              
              if (mysqli_query($koneksi, $sql)) {
                echo "Data berhasil diupload<br/>";
                echo "<META http-equiv='refresh' content='1;URL=index.php'>";
              } else {
                echo "Gagal inputkan data";
              }

              mysqli_close($koneksi);

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
