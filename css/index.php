<?php 
  session_start();

  if (!isset($_SESSION['username'])) {
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
 	<title>Page Not Found</title>
 </head>
 <body bgcolor="#f7f7f7">
 	<center><img src="../pagenotfound.png"></center>
 </body>
 </html>