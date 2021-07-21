<?php 
include 'koneksi.php';
include 'header.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Kasir Matahari Motor</h1>
                   <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Suplier</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            	<?php $query = "SELECT * FROM kasir ORDER BY id_kasir ASC";
                            		$exec = mysqli_query($conn,$query);

                            	 ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Kasir</th>
                                            <th>Telp Kasir</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                              
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    	<?php while($res = mysqli_fetch_assoc($exec)) { ?>
                                        <tr>
                                           <td><?= $res['nama_ksr'] ?></td>
                                           <td><?= $res['no_telp'] ?></td>
                                           <td><?= $res['user_kasir'] ?></td>
                                           <td><?= $res['pass_kasir'] ?></td>
                                           <td><?= $res['alamat'] ?></td>
                                           <td><a href="#" class="view_data btn btn-sm btn-warning"data-bs-toggle="modal" data-bs-target="#myModal" id="<?php echo $res['id_kasir']; ?>">Edit</a>
                                           <a class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin?')" href="hapusuplier.php?id_kasir=<?= $res['id_kasir'] ?>">Delete</a></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Data Kasir</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="kasir.php" method="POST">
        	<input class="form-control mb-2" type="text" name="nama" placeholder="Nama Kasir">
        	<input class="form-control mb-2" type="text" name="telp" placeholder="Telp Kasir">
        	<input class="form-control mb-2" type="text" name="user_kasir" placeholder="Username">
          <input class="form-control mb-2" type="text" name="pass_kasir" placeholder="Password">
        	<textarea placeholder="Alamat Kasir" class="form-control" name="alamat"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" name="kasir" class="btn btn-primary">Simpan</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kasir</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body" id="data_suplier">

      
      </div>
    </div>
  </div>
</div>
<?php 

if(isset($_POST['kasir'])) {
	$nama =  strip_tags(strtoupper(htmlentities($_POST['nama'])));
	$telp =  strip_tags(strtoupper(htmlentities($_POST['telp'])));
	$user_kasir = strip_tags(strtoupper(htmlentities($_POST['user_kasir'])));
	$pass_kasir =  strip_tags(strtoupper(htmlentities($_POST['pass_kasir'])));
  $alamat =  strip_tags(strtoupper(htmlentities($_POST['alamat'])));

 $query = "INSERT INTO kasir(nama_ksr,no_telp,user_kasir,pass_kasir,alamat) VALUES ('$nama','$telp','$user_kasir','$pass_kasir','$alamat')";
 $exec = mysqli_query($conn,$query);
 if($exec) {
 	echo "<script> alert('Data Berhasil disimpan')</script>";
 	echo "<script type='text/javascript'> document.location = 'kasir.php'; </script>";
 }


}


if(isset($_POST['edit'])) {
	$nama =  strip_tags(strtoupper(htmlentities($_POST['nama'])));
  $telp =  strip_tags(strtoupper(htmlentities($_POST['telp'])));
  $user_kasir = strip_tags(strtoupper(htmlentities($_POST['user_kasir'])));
  $pass_kasir =  strip_tags(strtoupper(htmlentities($_POST['pass_kasir'])));
  $alamat =  strip_tags(strtoupper(htmlentities($_POST['alamat'])));
	$id= (int)$_POST['id_kasir'];	
	// var_dump($_POST);
	// die();
 $query = "UPDATE kasir SET 
 nama_ksr ='".$nama."',
 user_kasir='".$user_kasir."',
 pass_kasir ='".$pass_kasir."',
 alamat = '".$alamat."',
 no_telp ='".$telp."'
 WHERE id_kasir = '".$id."'";
 $ex = mysqli_query($conn,$query);
 if($ex) {
 	echo "<script> alert('Data berhasil diedit')</script>";
 	echo "<script type='text/javascript'> document.location = 'kasir.php'; </script>";
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
				data: {id_ksr:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
				success:function(data){		// kode dibawah ini jalan kalau sukses
					$('#data_suplier').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
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