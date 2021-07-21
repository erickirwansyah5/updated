	<?php 
include 'koneksi.php';
include 'header.php';
include 'function/format_tanggal.php';
include "function/format_rupiah.php";
   ?>
   <div id="page-wrapper">
            <div class="container-fluid">
            	<?php
							if(isset($_GET['submit'])){
								$no=0;
								$mulai 	 = $_GET['awal'];
								$selesai = $_GET['akhir'];
								$montir = $_GET['montir'];
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
							        $labajasalaiinya+=$jasalain;
							    }
							    $lababaranglain = $lababaranglaiinyakotor - $lababaranglaiinyabersih;
							    $labersih = $labakotor - $lababersih;

							    $labakotorkeseluruhan = $labakotor + $lababaranglaiinyakotor;
							    $lababersihkeseluruhan = $labersih + $lababaranglain;

							    $labajasakeseluruhan = $labajasa + $labajasalaiinya;
							    $lakotor = $labakotorkeseluruhan + $labajasa + $labajasalaiinya;
							    $allin = $lababersihkeseluruhan + $labajasakeseluruhan;

							?>
            	<div class="row">
                    <div class="col-lg-12">
                        <h5 class="page-header">Progess Montir = <b><?= $result['nama_montir'] ?></b></h5>
                        <h5 class="page-header">Periode = <b><?= $mulai ?> sampai <?= $selesai ?></b></h5>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
						
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
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
											$sql1 = "SELECT * from penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND id_montir = '$montir'";
											$total=0;
											$roso = mysqli_query($conn,$sql1);
											while($dato = mysqli_fetch_assoc($roso)) {
												
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $dato['tgl_penjualan'] .'</td>';
				
												echo '<td class="text-center">'.$dato['uraian'] .'</td>';
												echo '<td class="text-center">'. $dato['jenis'] .'</td>';
												echo '<td class="text-center">'. $dato['jumlah'] .'</td>';

												echo '<td class="text-center">'. format_rupiah($dato['total']) .'</td>';
												echo '</tr>';												
												$i++;
												$total += $dato['total'];
											}
										?>
									<tfoot>
										<tr>
											<th colspan="5" class="text-center"><b>Total Pendapatan Kotor</b></th>
											<th class="text-right"><b><?php echo format_rupiah($lakotor);?></b></th>
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
							<div class="form-group">
									<a href="laporan_progress.php?id_montir=<?=$montir?>&awal=<?php echo $mulai;?>&akhir=<?php echo $selesai;?>" target="_blank" class="btn btn-warning">Cetak</a>
							</div>
							</div>
						</div>
					</div>
				</div>
</div>
			<?php }?>

			<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [
				{ "orderable": false, "targets": [4] }
			]
		});
		
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<script>
		var app = {
			code: '0'
		};
</script>