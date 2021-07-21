<?php 
include 'koneksi.php';
include 'header.php';
include 'function/format_rupiah.php';
 ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Barang Masuk Matahari Motor</h1>
                   <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            	<?php $query = "SELECT * FROM barangjasa WHERE jenis = 'barang' ORDER BY id_brg ASC";
                            		$exec = mysqli_query($conn,$query);

                            	 ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                            <th>Harga Modal</th>
                                            <th>Harga Jual</th>
                                            <th>Ket</th>
                                            <th>Aksi</th>
                              
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    	<?php while($res = mysqli_fetch_assoc($exec)) { ?>
                                        <tr>
                                           <td><?= $res['nama'] ?></td>
                                           <td><?= $res['stok'] ?></td>
                                           <td><?= format_rupiah($res['harga_modal']) ?></td>
                                            <td><?= format_rupiah($res['harga_jual']) ?></td>
                                            <td><?= $res['ket'] ?></td>
                                           <td><a href="#" class="view_data btn btn-sm btn-warning"data-bs-toggle="modal" data-bs-target="#myModal" id="<?php echo $res['id_brg']; ?>">Edit</a>
                                           <a class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin?')" href="hapusuplier.php?id_brg=<?= $res['id_brg'] ?>">Delete</a></td>
                                        </tr>
                                        <?php } ?>
                                   </tbody>
                               
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="barangjasa.php" method="POST">
        	<input class="form-control mb-2" type="text" name="nama" placeholder="Nama Barang">
        	<input class="form-control mb-2" type="hidden" name="jenis" value="barang">
        	<input class="form-control mb-2" type="text" name="harga_modal" placeholder="harga_modal">
          <input class="form-control mb-2" type="text" name="harga_jual" placeholder="harga_jual">
        	<textarea placeholder="Keterangan Barang" class="form-control" name="ket"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" name="barang" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal edit -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang/Jasa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body" id="data_brg">

      
      </div>
    </div>
  </div>
</div>
<?php 

if(isset($_POST['barang'])) {
	$nama = strip_tags(strtoupper(htmlentities($_POST['nama'])));
	$jenis =  strip_tags(strtoupper(htmlentities($_POST['jenis'])));
	$harga_modal = strip_tags(strtoupper(htmlentities($_POST['harga_modal'])));
	$harga_jual =  strip_tags(strtoupper(htmlentities($_POST['harga_jual'])));
  $ket =  strip_tags(strtoupper(htmlentities($_POST['ket'])));
  // $alamat = $_SESSION['id']''

 $query = "INSERT INTO barangjasa(nama,jenis,harga_modal,harga_jual,ket) VALUES ('$nama','$jenis','$harga_modal','$harga_jual','$ket')";
 $exec = mysqli_query($conn,$query);
 if($exec) {
 	echo "<script> alert('Data Berhasil disimpan')</script>";
 	echo "<script type='text/javascript'> document.location = 'barangjasa.php'; </script>";
 }


}


if(isset($_POST['edit'])) {
	 $nama =  strip_tags(strtoupper(htmlentities($_POST['nama'])));
  $jenis =  strip_tags(strtoupper(htmlentities($_POST['jenis'])));
  $harga_modal = strip_tags(strtoupper(htmlentities($_POST['harga_modal'])));
  $harga_jual =  strip_tags(strtoupper(htmlentities($_POST['harga_jual'])));
  $ket =  strip_tags(strtoupper(htmlentities($_POST['ket'])));
	$id= (int)$_POST['id_brg'];	
	// var_dump($_POST);
	// die();
 $query = "UPDATE barangjasa SET 
 nama ='".$nama."',
 jenis ='".$jenis."',
 harga_modal='".$harga_modal."',
 harga_jual='".$harga_jual."',
 ket = '".$ket."' WHERE id_brg = '".$id."'";
 $ex = mysqli_query($conn,$query);
 if($ex) {
 	echo "<script> alert('Data berhasil diedit')</script>";
 	echo "<script type='text/javascript'> document.location = 'barangjasa.php'; </script>";
 }


}

 ?>

    <!-- Scroll to Top Button-->
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
   <script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
	$('.view_data').click(function(){
			// membuat variabel id, nilainya dari attribut id pada button
			// id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
			var id = $(this).attr("id");
			
			// memulai ajax
			$.ajax({
				url: 'view.php',	// set url -> ini file yang menyimpan query tampil detail data siswa
				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
				data: {id_brg:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
				success:function(data){		// kode dibawah ini jalan kalau sukses
					$('#data_brg').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
					$('#myModal').modal("show");	// menampilkan dialog modal nya
				}
			});
		});
	
</script>
<script type="text/javascript">
       $('input').attr('autocomplete','off');
   </script>
</body>

</html>