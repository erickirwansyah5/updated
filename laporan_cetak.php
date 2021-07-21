<?php
include 'sess_check.php';
	include '../koneksi.php';
	include '../function/format_tanggal.php';
include "../function/format_rupiah.php";
	$mulai 	 = $_GET['awal'];
	$selesai = $_GET['akhir'];
	$sql = "SELECT trx.*, konsumen.*, kasir.* FROM trx, konsumen, kasir WHERE
			trx.id_kon=konsumen.id_kon AND trx.id_kasir=kasir.id_kasir AND 
			trx.tgl_trx BETWEEN '$mulai' AND '$selesai' ORDER BY trx.id_trx DESC";
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
	<link href="../foto/logos.png" rel="icon" type="images/x-icon">
	<title>laporan</title>

	 <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td class="text-left" width="20%">
							<img src="../foto/logo.png" alt="logo-dkm" width="300" />
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
			<h5 class="text-center">Laporan Transaksi Periode Tanggal <?php echo format_tanggal($mulai);?> s/d <?php echo format_tanggal($selesai);?></h5>
			<br />
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">ID Trx</th>
											<th width="10%">Tgl Trx</th>
											<th width="10%">Konsumen</th>
											<th width="10%">Kasir</th>
											<th width="10%">Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$ttl=0;
											$i = 1;
											while($data = mysqli_fetch_array($ress)) {
												$tot = $data['total'];
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['id_trx'] .'</td>';
												echo '<td class="text-center">'. format_tanggal($data['tgl_trx']) .'</td>';
												echo '<td class="text-center">'. $data['nama_kon'] .'</td>';
												echo '<td class="text-center">'. $data['nama_ksr'] .'</td>';
												echo '<td class="text-center">'. format_rupiah($data['total']) .'</td>';
												echo '</tr>';												
												$i++;
												$ttl+=$tot;
											}
										?>
									<tfoot>
										<tr>
											<th colspan="5" class="text-center">Total </th>
											<th class="text-right"><?php echo format_rupiah($ttl);?></th>
										</tr>
									</tfoot>
									</tbody>
								</table>
			<br />
		</div><!-- /.container -->
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			window.print();
		});
	</script>
	<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
   <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
     <!-- Bootstrap core JavaScript-->


	<script type="text/javascript" src="../js/jTerbilang.js"></script>
</body>
</html>