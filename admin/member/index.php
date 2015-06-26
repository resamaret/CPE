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

    <title>Admin: Member - TOKOCPE</title>
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
            <li class="active"><a href="../member/index.php">Member</a></li>
            <li><a href="../laporan/index.php">Laporan</a></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>

      
    <br/> 	
    	<div class="container">
			<br/>
			<table cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Alamat</th>
					</tr>
				</thead>
				<tbody>				
			<?php
				$select = "SELECT username, nama, alamat FROM login WHERE level='user' ORDER BY nama asc";
				$result = mysqli_query($koneksi, $select);
				$no=1;

				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					extract($row);
					echo "<tr>";
						echo "<td>".($no++)."</td>";
						echo "<td>$nama</td>";
						echo "<td>$username</td>";
						echo "<td>$alamat</td>";
					echo "</tr>"; 
				}
			?>
				</tbody>
			</table>
		  </div>  
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; CPE 2015</p>
      </footer>

    </div>

  </body>
</html>