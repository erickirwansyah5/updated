<?php 
include "sess_check.php";
include 'koneksi.php';
// include 'header.php';
include 'function/format_tanggal.php';
include "function/format_rupiah.php";
$mulai 	 = $_GET['awal'];
	$selesai = $_GET['akhir'];
	$sql = "SELECT trxbarang.*, suplier.*, barangjasa.* FROM trxbarang, suplier, barangjasa WHERE
			trxbarang.id_sup=suplier.id_sup AND trxbarang.id_brg=barangjasa.id_brg AND 
			trxbarang.tgl_trx BETWEEN '$mulai' AND '$selesai' ORDER BY trxbarang.id_trx DESC";
	$ress = mysqli_query($conn, $sql);
	// deskripsi halaman
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<link href="foto/logos.png" rel="icon" type="images/x-icon">
	<title>Laporan Barang</title>

	
	 <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-striped">
				<tbody>
					<tr>
						<td class="text-left" width="20%">
							<img src="foto/logo.png" alt="logo-dkm" width="300" />
						</td>
						<td class="text-center" width="60%">
							<?php $exec = mysqli_query($conn,"SELECT * FROM info");
								$info = mysqli_fetch_assoc($exec);
							 ?>
						<b><?= $info['nama_bengkel'] ?></b> <br>
						<?= $info['alamat_bengkel'] ?><br>
						<?= $info['no_telp'] ?><br>
						<td class="text-right" width="20%">
						</td>
					</tr>
				</tbody>
			</table>
			<hr class="line-top" />
		</div>
	</section>

	<section id="body-of-report">
		<div class="container-fluid">
			<h4 class="text-center">Laporan Data Barang Masuk Periode Tanggal <?php echo format_tanggal($mulai);?> s/d <?php echo format_tanggal($selesai);?></h4>
			<br />
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">ID Trx</th>
											<th width="10%">Tgl Trx</th>
											<th width="10%">Supplier</th>
											<th width="10%">Barang</th>
											<th width="5%">Jumlah</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											while($data = mysqli_fetch_array($ress)) {
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['id_trx'] .'</td>';
												echo '<td class="text-center">'. format_tanggal($data['tgl_trx']) .'</td>';
												echo '<td class="text-center">'. $data['nama_sup'] .'</td>';
												echo '<td class="text-center">'. $data['nama'] .'</td>';
												echo '<td class="text-center">'. $data['jml'] .'</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
			<br />
		</div><!-- /.container -->
	</section>
  <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
   <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			window.print();
		});
	</script>

</body>
</html>