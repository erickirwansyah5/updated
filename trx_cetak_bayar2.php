<?php
include 'sess_check.php';
include '../koneksi.php';
include '../function/format_tanggal.php';
include '../function/format_rupiah.php';
$query = "SELECT * FROM trx ORDER by no_trx DESC LIMIT 1";
$exec = mysqli_query($conn,$query);
$res = mysqli_fetch_assoc($exec);
$kode = $res['id_trx'];
$sql = "SELECT trx.*, tmp_trx.*, barangjasa.*, konsumen.* FROM trx, tmp_trx, barangjasa, konsumen WHERE trx.id_trx=tmp_trx.id_trx AND trx.id_kon=konsumen.id_kon AND tmp_trx.id_brg=barangjasa.id_brg AND trx.id_trx='". $res['id_trx'] ."'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query);

?>

<html>
<head>
<title>Faktur Pembayaran</title>
<link href="../foto/logos.png" rel="icon" type="images/x-icon">
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<?php $exec = mysqli_query($conn,"SELECT * FROM info");
			 $info = mysqli_fetch_assoc($exec);
							 ?>
<body style='font-family:tahoma; font-size:8pt;' onload="window.print()">
<center>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<span style='font-size:12pt'><b><?= $info['nama_bengkel'] ?></b></span></br>
<?= $info['alamat_bengkel'] ?> </br>
<?= $info['no_telp'] ?>
<br><br>
</td>
<td style='vertical-align:top' width='30%' align='left'>
<b><span style='font-size:12pt'>FAKTUR PENJUALAN</span></b></br>
<b>ID Transaksi. : <?= $res['id_trx'] ?></b></br>
<b>Tanggal : <?= format_tanggal($res['tgl_trx']) ?></b></br>
</td>
</table>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
Nama Konsumen : <b><?= $result['nama_kon'] ?></b></br>
Alamat :<b> <?= $result['alamat'] ?></b><br>
No Telp : <b><?= $result['telp'] ?></b>
</td>
</table>
<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
 <tr>
						<th width="1%">No</th>
						<th width="10%">Nama Barang/Jasa</th>
						<th width="5%">Jumlah</th>
						<th width="10%">Harga Satuan</th>
						<th width="10%">Total</th>
					</tr>
					<br><br>
<?php
						$i=1;
						$grand=0;
						$sqltmp = "SELECT tmp_trx.*, barangjasa.* FROM tmp_trx, barangjasa WHERE tmp_trx.id_brg=barangjasa.id_brg
								AND tmp_trx.id_trx='$kode' ORDER BY barangjasa.nama ASC";
						$querytmp = mysqli_query($conn,$sqltmp);
						
						while($data = mysqli_fetch_array($querytmp)) {
							$ttl = $data['jml']*$data['harga_jual'];
							echo '<tr>';
							echo '<td align="center">'. $i .'</td>';
							echo '<td align="center">'. $data['nama'] .'</td>';
							echo '<td align="center">'. $data['jml'] .'</td>';
							echo '<td align="center">'. format_rupiah($data['harga_jual']) .'</td>';
							echo '<td align="center">'. format_rupiah($ttl) .'</td>';
							echo '</tr>';
							$i++;
							$grand+=$ttl;
						}
					?>
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
<td align='center'>Diterima Oleh,</br><br><br></br><u>(............)</u></td>
<td style='border:1px solid black; padding:5px; text-align:left; width:30%;height: 10px;'>
	Silahkan cek terlebih dahulu barang yang dibeli,
	Barang yang sudah diterima tidak bisa dikembalikan lagi
</td>
<td align='center'>TTD,</br><br></br></br><u>(...........)</u></td>
</tr>
</table>
</center>
</body>
</html>
