<?php 
  include("../../koneksi.php");
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

    <title>Admin: Order - TOKOCPE</title>
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
    <form method="get" align="center" class="form-inline">
      <div class="form-group">
        <input class="form-control" type="date" name="awal"/> s/d 
        <input class="form-control" type="date" name="akhir"/>
        <button class="btn btn-primary" name="enter">ENTER</button>
      </div>

      <?php 
        if (isset($_GET['enter'])) {
          $awal=$_GET['awal'];
          $akhir=$_GET['akhir'];

        $query = "SELECT * FROM `order` where tanggal_beli BETWEEN '$awal' and '$akhir'";
        $resul = mysqli_query($koneksi, $query);
      ?>
        <br/><br/>
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
<?php
while ($row=mysqli_fetch_array($resul, MYSQLI_ASSOC)) {
extract($row);
?>
          <tbody>
            <tr>
              <td><?php echo $tanggal_beli; ?></td>
              <td><?php echo $id_order; ?></td>
              <td><?php echo $nama; ?></td>
              <td><?php echo $alamat; ?></td>
              <td><?php echo $nohp; ?></td>
              <td><?php echo $id_produk; ?></td>
              <td><?php echo $jumlah_order; ?></td>
              <td><?php echo $total_bayar; ?></td>
              <td><?php echo $status_order; ?></td>
              <td><a href="edit-order.php?id_order=<?php echo $id_order; ?>"><button type="button" class="btn btn-danger" name="edit">EDIT</button></a></td>
            </tr>
          </tbody>

<?php
}
}
 ?>
        </table>
    </form>   
</div>
  
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>

    </div>

  </body>
</html>