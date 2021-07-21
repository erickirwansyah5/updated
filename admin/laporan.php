<?php 
include 'koneksi.php';
include 'header.php';
include 'function/format_tanggal.php';
include "function/format_rupiah.php";
   
 ?>

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Laporan Data Transaksi</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
					        <form method="get" name="laporan" onSubmit="return valid();"> 
								<div class="form-group">
									<div class="col-sm-4">
										<label>Tanggal Awal</label>
										<input type="date" class="form-control" name="awal" placeholder="From Date(dd/mm/yyyy)" required>
									</div>
									<div class="col-sm-4">
										<label>Tanggal Akhir</label>
										<input type="date" class="form-control" name="akhir" placeholder="To Date(dd/mm/yyyy)" required>
									</div>
									<div class="col-sm-4">
										<label>&nbsp;</label><br/>
										<input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
									</div>
								</div>
							</form>
							</div>
						</div>
						<?php
							if(isset($_GET['submit'])){
								$no=0;
								$mulai 	 = $_GET['awal'];
								$selesai = $_GET['akhir'];
								$sql = "SELECT trx.*, konsumen.*, kasir.* FROM trx, konsumen, kasir WHERE
										trx.id_kon=konsumen.id_kon AND trx.id_kasir=kasir.id_kasir AND 
										trx.tgl_trx BETWEEN '$mulai' AND '$selesai' ORDER BY trx.id_trx DESC";
								$ress = mysqli_query($conn, $sql);
								$labakotor2=0;
							    $lababersih2=0;
							    $sql = "SELECT * FROM penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'BARANG'";
							    $ress2 = mysqli_query($conn, $sql);
							    $jmltrx = mysqli_num_rows($ress);
							    // query database mencari data admin
							    while($data2=mysqli_fetch_array($ress2)){
							        $kotor=$data2['jumlah'] * $data2['harga_jual_barang'];
							        $bersih = $data2['jumlah'] * $data2['harga_modal_barang'];
							        $labakotor2+=$kotor;
							        $lababersih2+=$bersih;
							    }
					                $labajasa=0;
								    $sql = "SELECT * FROM penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'JASA'";
								    $ress3 = mysqli_query($conn, $sql);
								    $jmltrx = mysqli_num_rows($ress3);
								    // query database mencari data admin
								    while($data3=mysqli_fetch_array($ress3)){
								        $jasa = $data3['harga_jasa'];
								        $labajasa+=$jasa;
								    }
								    $lababaranglaiinyakotor=0;
								    $lababaranglaiinyabersih=0;
								    $sql = "SELECT * FROM penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'LAINNYABARANG'";
								    $ress4 = mysqli_query($conn, $sql);
								    $jmltrx = mysqli_num_rows($ress4);
								    // query database mencari data admin
								    while($data4=mysqli_fetch_array($ress4)){
								        $kotor=$data4['jumlah'] * $data4['harga_jual_barang'];
								        $bersih = $data4['jumlah'] * $data4['harga_modal_barang'];
								        $lababaranglaiinyakotor+=$kotor;
								        $lababaranglaiinyabersih+=$bersih;
								    }
								    $labajasalaiinya=0;
								    $sql = "SELECT * FROM penjualan WHERE tgl_penjualan BETWEEN '$mulai' AND '$selesai' AND jenis = 'LAINNYAJASA'";
								    $ress5 = mysqli_query($conn, $sql);
								    $jmltrx = mysqli_num_rows($ress5);
								    // query database mencari data admin
								    while($data5=mysqli_fetch_array($ress5)){
								        $jasa = $data5['harga_jasa'];
								        $labajasalaiinya+=$jasa;
								    }
								    $labalainnya = $lababaranglaiinyabersih + $labajasalaiinya;
								      $totalbarang = $labakotor2 - $lababersih2;
   									 $allin = $totalbarang + $labajasa + $lababaranglaiinyabersih+$labajasalaiinya;
							?>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
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
											$lababersih=0;
											$i = 1;
											while($data = mysqli_fetch_array($ress)) {
												$tot = $data['total'];
												$laba = $data['total_modal'];
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
												$lababersih+=$laba;
											}
										?>
									<tfoot>
										<tr>
											<th colspan="5" class="text-center">Laba Kotor </th>
											<th class="text-right"><?php echo format_rupiah($labakotor2);?></th>
										</tr>
										<tr>
											<th colspan="5" class="text-center">Laba Bersih </th>
											<th class="text-right"><?php echo format_rupiah($labakotor2 - $lababersih2);?></th>
										</tr>
										<tr>
											<th colspan="5" class="text-center">Laba Jasa </th>
											<th class="text-right"><?php echo format_rupiah($labajasa);?></th>
										</tr>
										<tr>
											<th colspan="5" class="text-center">Laba Lainnya </th>
											<th class="text-right"><?php echo format_rupiah($labalainnya);?></th>
										</tr>
										<tr>
											<th colspan="5" class="text-center"><b>Laba Bersih Keseluruhan</b></th>
											<th class="text-right"><b><?php echo format_rupiah($allin);?></b></th>
										</tr>
									</tfoot>
									</tbody>
								</table>
							<div class="form-group">
									<a href="laporan_cetak.php?awal=<?php echo $mulai;?>&akhir=<?php echo $selesai;?>" target="_blank" class="btn btn-warning">Cetak</a>
							</div>
							</div>
			<!-- Large modal -->
			<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<p>One fine body…</p>
						</div>
					</div>
				</div>
			</div>    
						</div><!-- /.panel -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
			<?php }?>
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
    </div>
</div>
<!-- bottom of file -->
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