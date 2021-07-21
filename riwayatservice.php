<?php 
include '../koneksi.php';
include 'header.php';
include '../function/format_tanggal.php';
include "../function/format_rupiah.php";
 ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Riwayat Service Matahari Motor</h1>
                 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Riwayat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $query = "SELECT trx.*,konsumen.* from trx,konsumen WHERE trx.id_kon = konsumen.id_kon";
                                    $exec =mysqli_query($conn,$query);
                                    // $rese = mysqli_fetch_array($exec);


                                 ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Nomor Plat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php while($res =  mysqli_fetch_assoc($exec)) { ?>
                                        <tr>
                                            <td><?= $res['id_trx'] ?></td>
                                            
                                            <td><?= format_tanggal($res['tgl_trx']) ?></td>
                                           
                                            <td><?= $res['no_plat'] ?></td>
                                            <td>
                                                <a href="#" class="view_data btn btn-sm btn-primary"data-bs-toggle="modal" data-bs-target="#myModal" id="<?php echo $res['id_trx']; ?>">details</a>
                                            </td>
                                          
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

<!-- modal edit -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body" id="data_transaksi">

      
      </div>
    </div>
  </div>
</div>

    <!-- Scroll to Top Button-->
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script type="text/javascript">
    $('.view_data').click(function(){
      // membuat variabel id, nilainya dari attribut id pada button
      // id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
      var id = $(this).attr("id");
      
      // memulai ajax
      $.ajax({
        url: 'view.php',  // set url -> ini file yang menyimpan query tampil detail data siswa
        method: 'post',   // method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
        data: {id_trx:id},   // nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
        success:function(data){   // kode dibawah ini jalan kalau sukses
          $('#data_transaksi').html(data);  // mengisi konten dari -> <div class="modal-body" id="data_siswa">
          $('#myModal').modal("show");  // menampilkan dialog modal nya
        }
      });
    });
</script>
</body>

</html>