<?php 
include 'koneksi.php';
include 'function/format_tanggal.php';
include "function/format_rupiah.php";
$mulai 	 = $_GET['awal'];
$selesai = $_GET['akhir'];
$montir = $_GET['id_montir'];
$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM montir WHERE id_montir = '$montir'"));
	$no=0;
								$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM montir WHERE id_montir = '$montir'"));
									 $labakotor=0;
							    $lababersih=0;
							    $sql1 = "SELECT * from penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'BARANG' and id_montir = '$montir'";
							    $res1 = mysqli_query($conn, $sql1);
							    // query database mencari data admin
							    while($data1=mysqli_fetch_array($res1)){
							        $kotor=$data1['jumlah'] * $data1['harga_jual_barang'];
							        $bersih = $data1['jumlah'] * $data1['harga_modal_barang'];
							        $labakotor+=$kotor;
							        $lababersih+=$bersih;
							        
							    }
							    $labajasa=0;
							    $sql1 = "SELECT * from penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'JASA' and id_montir = '$montir'";
							    $res1 = mysqli_query($conn, $sql1);
							    // query database mencari data admin
							    while($data1=mysqli_fetch_array($res1)){
							        $jasa=$data1['jumlah'] * $data1['harga_jual_barang'];
							        $labajasa+=$jasa;
							    }
							    $lababaranglaiinyabersih=0;
							    $lababaranglaiinyakotor= 0;
							    $sql1 = "SELECT * from penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'LAINNYABARANG' and id_montir = '$montir'";
							    $res1 = mysqli_query($conn, $sql1);
							    // query database mencari data admin
							    while($data1=mysqli_fetch_array($res1)){
							    	$kotor=$data1['jumlah'] * $data1['harga_jual_barang'];
							        $bersih = $data1['jumlah'] * $data1['harga_modal_barang'];
							        $lababaranglaiinyabersih+=$bersih;
							        $lababaranglaiinyakotor +=$kotor;
							    }
							    $labajasalaiinya= 0;
							    $sql1 = "SELECT * from penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'LAINNYAJASA' and id_montir = '$montir'";
							    $res1 = mysqli_query($conn, $sql1);
							    // query database mencari data admin
							    while($data1=mysqli_fetch_array($res1)){
							        $jasalain=$data1['jumlah'] * $data1['harga_jual_barang'];
							        $labajasalaiinya+=$jasa;
							    }
							    $lababaranglain = $lababaranglaiinyakotor - $lababaranglaiinyabersih;
							    $labakotorkeseluruhan = $labakotor + $lababaranglaiinyakotor;
							    $labersih = $labakotor - $lababersih;
							    $lababersihkeseluruhan = $labersih + $lababaranglain;
							    $labajasakeseluruhan = $labajasa + $labajasalaiinya;

							    $allin = $lababersihkeseluruhan + $labajasakeseluruhan;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<link href="foto/logos.png" rel="icon" type="images/x-icon">
	<title>laporan</title>

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

<body onload="window.print()">
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-borderless">
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
			<?php 
				$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM montir WHERE id_montir = '$montir'"));
			 ?>
			<h5 class="text-center">Laporan Progres <b><i><?= $result['nama_montir'] ?></i></b> Periode Tanggal <b><i><?php echo format_tanggal($mulai);?> s/d <?php echo format_tanggal($selesai);?></i></b></h5>
			<br />
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th>Tgl Penjualan</th>
											<th>Uraian</th>
											<th>Jenis</th>
											<th>Jumlah</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT * from penjualan WHERE id_montir = '$montir' ";
											$total=0;
											$ress = mysqli_query($conn,$sql);
											while($data = mysqli_fetch_assoc($ress)) {
												
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['tgl_penjualan'] .'</td>';
				
												echo '<td class="text-center">'.$data['uraian'] .'</td>';
												echo '<td class="text-center">'. $data['jenis'] .'</td>';
												echo '<td class="text-center">'. $data['jumlah'] .'</td>';

												echo '<td class="text-center">'. format_rupiah($data['total']) .'</td>';
												echo '</tr>';												
												$i++;
												$total += $data['total'];
											}
										?>
									<tfoot>
										<tr>
											<th colspan="5" class="text-center"><b>Total Pendapatan Kotor</b></th>
											<th class="text-right"><b><?php echo format_rupiah($total);?></b></th>
										</tr>
										<tr>
											<th colspan="5" class="text-center">Total Kotor Penjualan Barang </th>
											<th class="text-right"><?php echo format_rupiah($labakotorkeseluruhan);?></th>
										</tr>
										<tr>
											<th colspan="5" class="text-center">Laba Bersih Penjualan Barang </th>
											<th class="text-right"><?php echo format_rupiah($lababersihkeseluruhan);?></th>
										</tr>
										<tr>
											<th colspan="5" class="text-center">Total Laba Penjualan Jasa </th>
											<th class="text-right"><?php echo format_rupiah($labajasakeseluruhan);?></th>
										</tr>
										
										<tr>
											<th colspan="5" class="text-center"><b>Laba Bersih Keseluruhan</b></th>
											<th class="text-right"><b><?php echo format_rupiah($allin);?></b></th>
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
     <!-- Bootstrap core JavaScript-->


	<script type="text/javascript" src="../js/jTerbilang.js"></script>
</body>
</html>