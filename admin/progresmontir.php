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
                        <h1 class="page-header">Lihat Progress Montir</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
					        <form action="progresperorangan.php" method="get" name="laporan" onSubmit="return valid();"> 
								<div class="form-group">
									<div class="col-sm-4">
										<label>Nama Montir</label>
										 <select name="montir" id="id_montir" class="form-control mt-2" required>
						                  <option value="">== Pilih Montir ==</option>
						                                    <?php
						                                      $sql_kon = "SELECT * FROM montir ORDER BY id_montir ASC";
						                                      $ress_kon = mysqli_query($conn, $sql_kon);
						                                      while($li = mysqli_fetch_array($ress_kon)) {
						                                        echo '<option value="'. $li['id_montir'] .'">'. $li['nama_montir'].'</option>';
						                                      }
						                                    ?>
						              </select>
									</div>
									<div class="col-sm-4 mt-2">
										<label>Tanggal Awal</label>
										<input type="date" class="form-control" name="awal" placeholder="From Date(dd/mm/yyyy)" required>
									</div>
									<div class="col-sm-4">
										<label>Tanggal Akhir</label>
										<input type="date" class="form-control" name="akhir" placeholder="To Date(dd/mm/yyyy)" required>
									</div>
									<div class="col-sm-4">
										<label>&nbsp;</label><br/>
										<input type="submit" name="submit" value="Lihat Progress" class="btn btn-primary">
									</div>
								</div>
							</form>
							</div>
						</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th>Nama Montir</th>
											<th>Tgl Penjualan</th>
											<th>Uraian</th>
											<th>Jenis</th>
											<th >Jumlah</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT penjualan.*,montir.* from penjualan,montir WHERE montir.id_montir = penjualan.id_montir";
											$ress = mysqli_query($conn,$sql);
											while($data = mysqli_fetch_assoc($ress)) {
												$tot = $data['total'];
											
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['nama_montir'] .'</td>';
												echo '<td class="text-center">'. $data['tgl_penjualan'] .'</td>';
												
												echo '<td class="text-center">'. $data['uraian'] .'</td>';
												echo '<td class="text-center">'. $data['jenis'] .'</td>';
												echo '<td class="text-center">'. $data['jumlah'] .'</td>';

												echo '<td class="text-center">'. format_rupiah($data['total']) .'</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									<tfoot>
										
									</tfoot>
									</tbody>
								</table>
							
							</div>
		
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