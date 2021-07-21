<?php
include 'sess_check.php';
include '../koneksi.php';
include '../function/format_tanggal.php';
include '../function/format_rupiah.php';
$kode = $_GET['id'];
	$sql = "SELECT trx.*, tmp_trx.*, barangjasa.*, konsumen.*, kasir.*, montir.* FROM trx, tmp_trx, barangjasa, konsumen, kasir,montir WHERE trx.id_trx=tmp_trx.id_trx AND trx.id_kon=konsumen.id_kon AND tmp_trx.id_brg=barangjasa.id_brg	AND trx.id_kasir = kasir.id_kasir AND trx.id_montir = montir.id_montir AND trx.id_trx='". $_GET['id'] ."'";
	$query = mysqli_query($conn,$sql);
	$result = mysqli_fetch_array($query);
	// deskripsi halaman
	$pagedesc = "Cetak Bukti Transaksi";
	$pagetitle = str_replace(" ", "_", $pagedesc)
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<link href="../foto/logos.png" rel="icon" type="images/x-icon">
	<title><?php echo $pagetitle ?></title>

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
			<h4 class="text-center">Detail Transaksi</h4>
			<br />
<table width="100%">
	<tr>
		<td width="20%"><b>ID. Transaksi</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['id_trx'];?></td>
	</tr>
	<tr>
		<td width="20%"><b>Tanggal</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo format_tanggal($result['tgl_trx']);?></td>
	</tr>
	<tr>
		<td width="20%"><b>Konsumen</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['nama_kon'];?></td>
	</tr>
	<tr>
		<td width="20%"><b>Kasir</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $result['nama_ksr'];?></td>
	</tr>
	<tr>
    <td width="20%"><b>Montir</b></td>
    <td width="2%"><b>:</b></td>
    <td width="78%"><?php echo $result['nama_montir'];?></td>
  </tr>
</table>
</br>
	<table class="table table-bordered table-keuangan">
				<thead>
					<tr>
						<th width="1%">No</th>
						<th width="10%">Nama Barang/Jasa</th>
						<th width="5%">Jumlah</th>
						<th width="10%">Harga Satuan</th>
						<th width="10%">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i=1;
						$grand=0;
						$sqltmp = "SELECT tmp_trx.*, barangjasa.* FROM tmp_trx, barangjasa WHERE tmp_trx.id_brg=barangjasa.id_brg
								AND tmp_trx.id_trx='$kode' ORDER BY barangjasa.nama ASC";
						$querytmp = mysqli_query($conn,$sqltmp);
						
						while($data = mysqli_fetch_array($querytmp)) {
							$ttl = $data['jml']*$data['harga_jual'];
							echo '<tr>';
							echo '<td class="text-center">'. $i .'</td>';
							echo '<td>'. $data['nama'] .'</td>';
							echo '<td>'. $data['jml'] .'</td>';
							echo '<td>'. format_rupiah($data['harga_jual']) .'</td>';
							echo '<td>'. format_rupiah($ttl) .'</td>';
							echo '</tr>';
							$i++;
							$grand+=$ttl;
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4" class="text-center">Total </th>
						<th class="text-right"><?php echo format_rupiah($grand);?></th>
					</tr>
				</tfoot>
	</table>
	<table style='width:650; font-size:7pt;' cellspacing='2'>
<tr>
	<br><br>
<td align='center'>Diterima Oleh,</br><br><br></br><u>(................................................)</u></td>
<td style='border:1px solid black; padding:5px; text-align:left; width:30%;height: 10px;'>
	Silahkan cek terlebih dahulu barang yang dibeli,
	Barang yang sudah diterima tidak bisa dikembalikan lagi
</td>
<td align='center'>TTD,</br><br></br></br><u>(................................................)</u></td>
</tr>
</table>
	<br />
		</div><!-- /.container -->
	</section>

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
    <script src="../js/demo/chart-pie-demo.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			window.print();
		});
	</script>

	

</body>
</html>