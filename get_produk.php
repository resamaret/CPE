<?php 
	$q = $_GET["q"];
	include("koneksi.php");
	session_start();
  	session_destroy();

	$sql = "SELECT id_produk, tanggal_upload, nama_produk, nama_gambar, harga, stok 
			FROM produk WHERE merk = '".$q."' ORDER BY tanggal_upload desc";
		
		$result = mysqli_query($koneksi, $sql);

		echo "<div class='row'>";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          extract($row);
          $stok = $row['stok'];

          if ($stok == 0) {
            //Barang Kosong
          } else {       
?>
			<div class="col-lg-4">
	          <h6><hr><?php echo $tanggal_upload; ?></h6>
	          <h3><?php echo $nama_produk; ?></h3>
	          <big><b>Rp <?php echo $harga; ?></b></big><br/>
	          <p>
	            <img src="admin/produk/image/<?php echo $nama_gambar; ?>" width="180px">
	          </p>
	          <p>
	            <a class="btn btn-primary" href="view-produk.php?id_produk=<?php echo $id_produk ?>" role="button">View details &raquo;</a>
	            <a class="btn btn-danger" href="buy.php?id_produk=<?php echo $id_produk ?>" role="button">Buy Now &raquo;</a>
	          </p>
	        </div>
<?php
		  }
		}

		echo "</div>";
 ?>
