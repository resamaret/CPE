<?php 
  include("../../koneksi.php");
  $id_order = $_GET['id_order'];
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

    <title>Admin: Edit Order - TOKOCPE</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <div class="masthead">
        <h3 class="text-muted"><img src="../../logoCPE.png" width="5%">TOKOCPE</h3>
        <nav>
          <ul class="nav nav-pills nav-justified">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../produk/index.php">Produk</a></li>
            <li><a href="../member/index.php">Member</a></li>
            <li class="active"><a href="../laporan/index.php">Laporan</a></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
    <br/>   
      <div class="container">
      <br/>
        <form method="post">
          
      <table cellspacing="0" class="table table-striped">
        <thead>
          <tr>
            <th>Tanggal Beli</th>
            <th>ID Order</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Hp</th>
            <th>ID Produk</th>
            <th>Jumlah Order</th>
            <th>Total Bayar</th>
            <th>Status Order</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>     
      <?php
        $select = "SELECT * FROM `order` where `id_order`=$id_order";
        $result = mysqli_query($koneksi, $select);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC)  ;
        extract($row);
          echo "<tr>";
            echo "<td>$tanggal_beli</td>";
            echo "<td>$id_order</td>";
            echo "<td>$nama</td>";
            echo "<td>$alamat</td>";
            echo "<td>$nohp</td>";
            echo "<td>$id_produk</td>";
            echo "<td>$jumlah_order</td>";     
            echo "<td>$total_bayar</td>";
            ?>
            <td>
              <select name="status_order">
                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                <option value="Barang Dikirim">Barang Dikirim</option>
                <option value="Barang Telah Diterima">Barang Telah Diterima</option>
              </select>
            </td>
            <td><a href='index.php'><button class='btn-primary' name='ok'>OK</button></a> </td>
          </tr>
        </tbody>
      </table>
        
            <?php
        if (isset($_POST['ok'])) {
          $status_order=$_POST['status_order'];

          $result= mysqli_query($koneksi, "UPDATE `order` SET `status_order`='$status_order' where `id_order`=$id_order");

          echo "<div class='alert alert-danger' role='alert'><b>Berhasil di update</b></div>";
          echo "<META http-equiv='refresh' content='2;URL=index.php'>";
        }
      ?>

        </form>
      </div>  
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>
    </div>
  </body>
</html>