<?php 
  include ("koneksi.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign In: TOKOCPE</title>
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
            <li class="active"><a href="login.php">Login</a></li>
            <li><a href="daftar.php">Daftar</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        </nav>
      </div>
      <br/>
    <div class="container theme-showcase" role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <form class="form-signin" method="post">
          <h2 class="form-signin-heading">Please Sign in</h2>
          <label class="sr-only">Username</label>
          <input type="text" name="username" class="form-control" placeholder="username" ><br/>
          <label class="sr-only">Password</label>
          <input type="password" name="password" class="form-control" placeholder="password" ><br/>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign In</button>
        </form>
          <br/><center><b>OR</b></center><br/>
          <a href="daftar.php"><button class="btn btn-lg btn-danger btn-block" type="submit" name="daftar">Daftar baru</button></a><br/>
          
          <?php
            if (isset($_POST['signin'])) {
              $username = $_POST['username'];
              $password = md5(md5($_POST['password']));

                  $cek = "SELECT * FROM login WHERE username='$username' AND password='$password'";
                  $result = mysqli_query($koneksi,$cek);
                  $c = mysqli_fetch_array($result);
                  if(mysqli_num_rows($result)==1){//jika berhasil akan bernilai 1
                      $_SESSION['username'] = $c['username'];
                      $_SESSION['password'] = $c['password'];
                      $_SESSION['level'] = $c['level'];
                      
                      if($c['level']=="admin"){
                          echo "<div class='alert alert-danger' role='alert'><h2><b><center>Admin : Mr. /Mrs. ".$c['nama']." Silahkan Masuk</center></b></h2></div>";
                          echo "<META http-equiv='refresh' content='2;URL=admin/index.php'>";
                      }else if($c['level']=="user"){
                          echo "<div class='alert alert-danger' role='alert'><h2><b><center>Welcome Mr. /Mrs. ".$c['nama']." Selamat Berbelanja</center></b></h2></div>";
                          echo "<META http-equiv='refresh' content='2;URL=user/index.php'>";
                      }
                  }else{
                       echo "<div class='alert alert-danger' role='alert'><b>Login Gagal !!! 
                            Periksa Kembali username dan password anda</b></div>";
                  }
            }

           ?>
      </div>
</body>
</html>