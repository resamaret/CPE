<?php
	include("koneksi.php");
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

    <title>Registrasi TOKOCPE</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li><a href="index.php">Home</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="login.php">Login</a></li>
            <li class="active"><a href="daftar.php">Daftar</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        </nav>
      </div>
      <br/>
    	<div class="container theme-showcase" role="main">
        <div class="jumbotron">

          <form class="form-horizontal" method="post">
            <div class="form-group">
              <label for="inputusername" class="col-sm-2 control-label">Username *</label>
              <div class="col-sm-10">
                <input type="text" name="username" class="form-control" maxlength="12" placeholder="Username" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputpassword" class="col-sm-2 control-label">Password *</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" placeholder="Password" minlength="8" maxlength="20" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputnamalengkap" class="col-sm-2 control-label">Nama *</label>
              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="Nama" maxlength="40" required/>
              </div>
            </div>
            <div class="form-group">
              <label for="inputalamat" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <input type="text" name="alamat" class="form-control" placeholder="Alamat"/>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
              </div>
            </div>      
          </form>
          <div class='alert alert-warning' role='alert'><b>* Harus Diisi</b></div>
          <?php  
            if (isset($_POST['register'])) {
              $username = $_POST['username'];
              $password = md5(md5($_POST['password']));
              $nama = $_POST['nama'];
              $alamat = $_POST['alamat'];

              $sqlregister = "INSERT INTO login (username,password,nama,alamat) 
                              VALUES ('$username','$password','$nama','$alamat')";
              
              if (mysqli_query($koneksi, $sqlregister)) {
                echo "<script type='text/javascript'>alert('Akun anda berhasil dibuat')</script>";
                echo "<META http-equiv='refresh' content='0;URL=login.php'>";
              } else {
                echo "<div class='alert alert-danger' role='alert'>Cek Kembali Data Anda. Username sudah ada";
              }   
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