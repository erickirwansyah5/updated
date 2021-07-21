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

</body>

</html>