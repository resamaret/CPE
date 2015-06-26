<?php 
  include("../../../koneksi.php");
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
    <META http-equiv='refresh' content='0;URL=../../../login.php'>
<?php
  }
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Page Not Found</title>
 </head>
 <body bgcolor="#f7f7f7">
 	<center><img src="../../../pagenotfound.png"></center>
 </body>
 </html>