 <?php 
include '../koneksi.php';
include 'header.php';
include '../function/format_rupiah.php'; 




?>
                <!--- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Transaksi Baru</h1>
                   <button class="btn btn-warning btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data Barang</button> 

                    <button class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tambah Data Jasa</button>
                     <button class="btn btn-secondary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal4">Tambah Barang Lainnya</button>
                      <button class="btn btn-secondary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal3">Tambah Jasa Lainnya</button>
                     <p style="color: red;">Tata Cara Transaksi : <b>SILAHKAN TAMBAHKAN TERLEBIH DAHULU SEMUA ITEM BARANG/JASA YANG DI BELI, SETELAH ITU BARU MELAKUKAN PENAMBAHAN JUMLAH, SETELAH PROSES <I>HITUNG TOTAL</I>, JUMLAH TIDAK BISA DIRUBAH </b></p>
                     <p>note: untuk merubah jumlah silahkan hapus terlebih dahulu baru kemudian di tambahkan lagi!</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          
                        </div>
                        <div class="card-body">
                           
                            <div class="table-responsive" >
                            	<?php $query = "SELECT tmp_trx.*,barangjasa.* FROM tmp_trx, barangjasa WHERE tmp_trx.id_brg=barangjasa.id_brg AND tmp_trx.status = 'onprocess'";
                            		$exec = mysqli_query($conn,$query);

                            	 ?>
                              <form action="transaksibaru.php" method="post" id="hapus">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                     
                                        <tr>
                                            <th >No</th>
                                            <th>Uraian</th>
                                            <th width="10%">Jumlah/pcs</th>
                                            <th>Harga Satuan</th>
                                            <th>Total</th>
                                         <!--    <th>Pilih</th> -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    	<?php 
                                      $no=1;
                                      $grand=0;
                                      while($res = mysqli_fetch_assoc($exec)) :
                                          $total = $res['jml'] * $res['harga_jual'];
                                       ?>
                                        <tr>
                                          <td><?= $no++; ?></td>
                                           <td><?= $res['nama'] ?></td>
                                            <td>
                                              <input type="text" id="<?= $res['id_brg'] ?>" name="jml[]" min="1" data="<?= $res['jenis'] ?>" data-id="<?= $res['id_tmp'] ?>" class="jml form-control" value="<?= $res['jml'] ?>"></td>
                                            <td>
                                              <input type="hidden" name="hagajual" id="tdharga" value="<?= $res['harga_jual']?>">
                                              <?= format_rupiah($res['harga_jual']) ?></td>
                                             <td><?= format_rupiah($total) ?></td>
                                             <!-- <td><input type="checkbox" name="pilih[]" value="<?=$res['id_tmp']?>"></td> -->
                                           <td><a class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?')" href="hapusuplier.php?id_brg=<?= $res['id_brg'] ?>&id_tmp=<?= $res['id_tmp'] ?>&jml=<?= $res['jml'] ?>">Delete</a></td>
                                        </tr>
                                        <?php 
                                        $grand+=$total;
                                      endwhile; ?>
                                   </tbody>
                               <tfoot>
                                  <tr>
                                    </form>

                                    <!-- <th><button class="hapus btn btn-danger" type="submit" name="hapus" onclick="return confirm('Yakin Ingin Menghapus Data Yang Di Tandai?')">HAPUS TANDA</button></th> -->
                                     <th><a href="transaksibaru.php" id="update" class="btn btn-secondary">UPDATE CART</a></th>
                                  <th><a href="transaksibaru.php" id="clik" class="btn btn-success">HITUNG TOTAL</a></th>

                                    <th colspan="2" class="text-center">Total </th>
                                    <th class="text-right" id="thgrand"></th>
                                    <th class="text-center"> </th>
                               
                                  </tr>
                                 
                                </tfoot>
                                </table>
                                
                            </div>
                        </div>
                        <div class="panel-body">
                      <!-- <input type="hidden" name="tgl" class="form-control"> -->
                </div>
                <div class="panel-footer">
                  <button onclick="return confirm('Apakah Anda Ingin Checkout?')" class="btn btn-primary mb-2 ml-2" id="klik" data-bs-toggle="modal" data-bs-target="#exampleModal2">CHECKOUT</button>
                </div>
                 
           
              <!-- </form> -->
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="transaksibaru.php" method="POST">
          <select style="width: 100%;" multiple="multiple" class="form-control barang" name="id_brg[]">
            <option selected disabled="disabled">==Pilih Barang==</option>
            <?php
                          $sql_don = "SELECT * FROM barangjasa WHERE jenis ='barang' ORDER BY nama ASC";
                          $ress_don = mysqli_query($conn, $sql_don);
                          while($li = mysqli_fetch_array($ress_don)) {
                            ?>
                            <option value="<?=$li['id_brg']?>"> <?=$li['nama']?> |
                            <i style="color: red" >Stok <?= $li['stok']?></i></option>
                         <?php }
                        ?>
          </select>
          <textarea placeholder="Catatan Jika Diperlukan, Ex: Kerusakan, KM Ganti Oli, Dll" class="form-control mt-2" name="ket"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" name="barang" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Jasa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="transaksibaru.php" method="POST">
          <select multiple="multiple" style="width: 100%;" class="form-control jasa" name="id_brg[]">
            <option selected>==Pilih Jasa==</option>
            <?php
                          $sql_don = "SELECT * FROM barangjasa WHERE jenis ='jasa' ORDER BY nama ASC";
                          $ress_don = mysqli_query($conn, $sql_don);
                          while($li = mysqli_fetch_array($ress_don)) {
                            echo '<option value="'. $li['id_brg'] .'">'. $li['nama'].'</option>';
                            
                          }
                        ?>
          </select>
          <input type="hidden" name="jml" value="1">
          <textarea placeholder="Catatan Jika Diperlukan" class="form-control mt-2" name="ket"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" name="jasa" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- modal 3 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Jasa Lainnya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="transaksibaru.php" method="POST">
          <input type="text" class="form-control mb-2" name="nama" id="nama" placeholder="Nama Jasa">
          <input type="hidden" name="jml" value="1" id="jml">
          <input type="text" name="harga" class="form-control mb-2" id="harga" placeholder="Harga Jasa">
          <textarea placeholder="Catatan Jika Diperlukan" class="form-control" id="ket" name="ket"></textarea>
      </div>
      <div class="modal-footer">
        <a href="transaksibaru.php" class="btn btn-secondary">Close</a>
        <button type="Submit" name="lainnya" class="lainnya btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal 4 -->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Barang Lainnya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form action="transaksibaru.php" method="POST">
          <input type="text" class="form-control mb-2" name="nama2" id="nama2" placeholder="Nama Barang">
          <input type="hidden" name="jml2" value="1" id="jml2">
          <input type="text" name="harga_modal" class="form-control mb-2" id="harga_modal" placeholder="Harga Modal Barang">
          <input type="text" name="harga_jual" class="form-control mb-2" id="harga_jual" placeholder="Harga Jual Barang">
          <textarea placeholder="Catatan Jika Diperlukan" class="form-control" id="ket2" name="ket2"></textarea>
      </div>
      <div class="modal-footer">
        <a href="transaksibaru.php" class="btn btn-secondary">Close</a>
        <button type="Submit" name="baranglainnya" class="baranglainnya btn btn-primary">Simpan</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body" id="data_brg">

      
      </div>
    </div>
  </div>
</div>


<!-- modal bayar -->

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CHECKOUT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <?php 
        $grand=0;
        $query = "SELECT tmp_trx.*,barangjasa.* FROM tmp_trx,barangjasa WHERE tmp_trx.id_brg=barangjasa.id_brg AND tmp_trx.status = 'onprocess'";
          $exec = mysqli_query($conn,$query);
          while ($res =mysqli_fetch_assoc($exec)) {
            $ttl = $res['jml'] * $res['harga_jual'];
            $grand+=$ttl;
          } 
  ?>
        
          <table class="table">         
         
         <tr>
          <td>
           Pilih Konsumen
             <select name="id_kon" id="id_kon" data-id="1" class="form-control mb-2" required>
                  <option selected="true">== Pilih Konsumen ==</option>
                                    <?php
                                      $sql_kon = "SELECT * FROM konsumen ORDER BY id_kon ASC";
                                      $ress_kon = mysqli_query($conn, $sql_kon);
                                      while($li = mysqli_fetch_array($ress_kon)) {
                                        echo '<option value="'. $li['id_kon'] .'">'. $li['nama_kon'].'</option>';
                                      }
                                    ?>
              </select>
              <form action="transaksibaru.php" method="POST">
              <p><b>Jika Konsumen Baru, Silahkan Tulis Manual di Bawah ini!</b></p>
              <input type="hidden" name="idkon" id="idkon">
            <input class="form-control mb-2" type="text" id="kon" name="kon" placeholder="Nama Konsumen">
            <input class="form-control mb-2"  type="text"  id="no_plat" name="no_plat" placeholder="Nomor Plat">
             <input class="form-control mb-2"  type="text"  id="no_telp" name="no_telp" placeholder="Nomor Telpon">
            <input class="form-control mb-2"  type="text" id="alamat" name="alamat" placeholder="Alamat Singkat">
            <input type="hidden" name="auth" id="auth">
          </td>

          <td>
            Montir
             <select name="id_montir" id="id_montir"  class="form-control mt-2" required>
                  <option value="">== Pilih Montir ==</option>
                                    <?php
                                      $sql_kon = "SELECT * FROM montir ORDER BY id_montir ASC";
                                      $ress_kon = mysqli_query($conn, $sql_kon);
                                      while($li = mysqli_fetch_array($ress_kon)) {
                                        echo '<option value="'. $li['id_montir'] .'">'. $li['nama_montir'].'</option>';
                                      }
                                    ?>
              </select>
              <tr>
                <td><b>Total : <?= format_rupiah($grand) ?></b></td>
              </tr>
        </tr>
        
          <tr>
            <td>
              CASH
                <input type="hidden" name="grand" id="grand" value="<?= $grand ?>">
            <input type="text" class="form-control" id="cash" name="cash">
            </td>
            <td>
              KEMBALIAN
              <input type="text" id="kembali" class="form-control" id="cash" name="cash">
            </td>
          </tr>
          <tr>
          <td><input type="radio" id="hanyabarang" name="hanyabarang" value="hanyabarang"> HANYA BELI BARANG</td>
        </tr>
        </table>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="Submit" name="simpan" id="bayar" class="btn btn-primary">Bayar</button>
        </form>

      </div>
    </div>
  </div>
</div>



<?php 


// if(isset($_POST['pilih'])) {
//   $barang = $_POST['pilih'];
//   $jumlah_dipilih = count($barang);
 
//   for($x=0;$x<$jumlah_dipilih;$x++){
//     $query0 = mysqli_query($conn,"SELECT * FROM tmp_trx where id_tmp = '$barang[$x]' ORDER BY id_tmp DESC");
//     $res0 = mysqli_fetch_assoc($query0);
//     $jml = $res0['jml'];
//     $query1 = mysqli_query($conn,"SELECT * FROM barangjasa where id_brg = '$barang[$x]' ORDER BY id_brg DESC");
//     $res = mysqli_fetch_assoc($query1);
//     $stokbaru = $res['stok'] + $jml;
//     $query2 = "UPDATE barangjasa set stok = ".$stokbaru." WHERE id_brg ='$barang[$x]'";
//     if($exec = mysqli_query($conn,$query2)){
//       mysqli_query($conn, "DELETE FROM tmp_trx WHERE id_tmp='$barang[$x]'");
//      }
//   }
//   echo "<script>alert('Data Berhasil Dihapus')</script>";
    
  
// }



 

if(isset($_POST['barang'])) {

  foreach($_POST['id_brg'] as $brg) {
  $barang = $brg;
  $ket = strip_tags(ucwords(htmlentities($_POST['ket'])));
  // $alamat = $_SESSION['id']''
  $id_kasir = $_SESSION['id_kasir'];
  $stts = "onprocess";

  
  $query = "INSERT INTO tmp_trx(id_brg,catatan,id_kasir,status) VALUES ('$barang','$ket','$id_kasir','$stts')";
       $exec = mysqli_query($conn,$query);
      echo "<script type='text/javascript'> document.location = 'transaksibaru.php'; </script>";
    }
  }
  // die();
	

  if(isset($_POST['jasa'])) {
   foreach($_POST['id_brg'] as $brg) {
  $barang = $brg;
  $ket =  strip_tags(strtoupper(htmlentities($_POST['ket'])));
   $jumlah = (int) strip_tags(htmlentities($_POST['jml']));
   // $no_plat =  strip_tags(strtoupper(htmlentities($_POST['no_plat'])));
  // $alamat = $_SESSION['id']''
  $id_kasir = $_SESSION['id_kasir'];
  $id_montir = 
  $stts = "onprocess";

  $query = mysqli_query($conn,"SELECT * FROM barangjasa where id_brg = '$barang' ORDER BY id_brg DESC");
  $res = mysqli_fetch_assoc($query);

      $query = "INSERT INTO tmp_trx(id_brg,jml,catatan,id_kasir,status) VALUES ('$barang','$jumlah','$ket','$id_kasir','$stts')";
       $exec = mysqli_query($conn,$query);
        if($exec) {
          
          }    

  }
}


 ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    
    
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script type="text/javascript">
           $(document).ready(function() {
     $('.barang').select2();
       $('.jasa').select2();

    })
  </script>
  <script type="text/javascript">
  $('#hanyabarang').click(function(){
    $('#id_montir').attr('disabled','disabled');
  })
</script>
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
       $('input').attr('autocomplete','off');
   </script>
  
  <script type="text/javascript">

 

    $('#id_kon').on('change',function(){
      var data = $(this).val();
       $.ajax({
          url: 'contoh.php',
          method: 'post',
          data: {datakon:data},
          success:function(data) {
            var data = JSON.parse(data);
            console.log(data);
            $('#idkon').val(data.id_kon)
            $('#kon').val(data.nama_kon)
            $('#no_plat').val(data.no_plat)
            $('#no_telp').val(data.no_telp)
            $('#alamat').val(data.alamat)
            $('#auth').val(data.auth)

          }
       })
    })

    $('#clik').click(function(e){
      e.preventDefault();
      var grand = 'grand';
        $.ajax({
          url: "contoh.php",
          method : "post",
          data : {getgrand:grand},
          success:function(data){
            $('#thgrand').html(data)
          }
      })
      setTimeout(function(){
        $('.jml').attr('disabled','disabled');
      },300)
      
      
      
    })

    function checkEnter(e){
     e = e || event;
     var txtArea = /textarea/i.test((e.target || e.srcElement).tagName);
     return txtArea || (e.keyCode || e.which || e.charCode || 0) !== 13;
    }
    document.querySelector('#hapus').onkeypress = checkEnter;


    $('.baranglainnya').click(function(e){
      e.preventDefault();
      var nama = $('#nama2').val()
      var harga_modal = $('#harga_modal').val()
      var harga_jual = $('#harga_jual').val()
      var ket = $('#ket2').val()
      var jml = $('#jml2').val();
      $.ajax({
          url: "contoh.php",
          method : "post",
          data : {nama2:nama,harga_modal:harga_modal,harga_jual:harga_jual,ket:ket,jumlah:jml},
          success:function(data){
            var pesan = JSON.parse(data)
            alert(pesan.pesan);
            $('#nama2').val("")
            $('#harga_modal').val("")
            $('#harga_jual').val("")
            $('#ket2').val("")
          }
      })
    })


    $('.lainnya').click(function(e){
      e.preventDefault();
      var nama = $('#nama').val()
      var harga = $('#harga').val()
      var ket = $('#ket').val()
      var jml = $('#jml').val();
      $.ajax({
          url: "contoh.php",
          method : "post",
          data : {nama:nama,harga:harga,ket:ket,jumlah:jml},
          success:function(data){
            var pesan = JSON.parse(data)
            alert(pesan.pesan);
            $('#nama').val("")
            $('#harga').val("")
            $('#ket').val("")
          }
      })
    })

    //  $(".jml").keyup(function(event) {
    //     if (event.keyCode === 13) {
    //         var jml = $(this).val();
    //         var id_tmp = $(this).attr('data-id');
    //         var id_brg = this.id
    //         var jenis = $(this).attr('data');
    //         // alert(jml)
    //         $.ajax({
    //           url:'contoh.php',
    //           method : 'post',
    //           data: {jml:jml,id_tmp:id_tmp,id_brg:id_brg,jenis:jenis},
    //           success:function(data){
    //             // alert(data)
    //             var data = JSON.parse(data)
    //             alert(data.pesan);
    //             // $(`#${pesan.barang}`).attr('disabled','disabled');
    //           }
    //         })
    //     }
    // });

    //   $('.jml').blur(function(jm){
    //   var jml = $(this).val();
    //   var id_tmp = $(this).attr('data-id');
    //   var id_brg = this.id
    //   var jenis = $(this).attr('data');
    //   $.ajax({
    //     url:'contoh.php',
    //     method : 'post',
    //     data: {jml:jml,id_tmp:id_tmp,id_brg:id_brg,jenis:jenis},
    //     success:function(data){
    //       var pesan = JSON.parse(data)
    //       alert(pesan.pesan);
    //     }
    //   })
    //   // alert(`${jml},${id_tmp},${id_brg}`)
    // })


    $('.jml').change(function(e){
      e.preventDefault()
      // e.preventDefault();
     var jml = $(this).val();
      var id_tmp = $(this).attr('data-id');
      var id_brg = this.id
      var jenis = $(this).attr('data');
      $.ajax({
        url:'contoh.php',
        method : 'post',
        data: {jml:jml,id_tmp:id_tmp,id_brg:id_brg,jenis:jenis},
        success:function(data){
          var pesan = JSON.parse(data)
          // alert(pesan.pesan);

          
        }
      })
      // alert(`${jml},${id_tmp},${id_brg}`)
    })


    function openUrl() {
      var win = window.open(`http://localhost/matahari/kasir/trx_cetak_bayar.php`,'_blank')
    }
    function openUrl2() {
      var win = window.open(`http://localhost/matahari/kasir/trx_cetak_bayar2.php`,'_blank')
    }
 
    // $('#klik').click(function(){
    //   var kon = $('#kon').val()
    //   var montir = $('#id_montir').val()
    //   if(kon ==='' || montir ==='' ) {
    //     alert('Data Konsumen atau Data Montir Tidak Boleh Kosong')
    //     document.location = 'transaksibaru.php'
    //   }else{
    //     $('#id_kon').val(kon)
    //     $('#mon').val(montir)
    //     // alert(`${kon} dan ${montir}`)
    //   }
    // })

    $('#cash').change(function(){
      var cash = $(this).val();
      var grand = $('#grand').val();
      var total = cash-grand
      var grandtotal = `Rp.${total}`
      $('#kembali').val(grandtotal)
    })
  </script>



</body>

</html>

<?php 
if(isset($_POST['simpan'])) {
  // var_dump($_POST['montir']);
  $tgl = date("Y-m-d");
  $namakon = htmlentities(strtoupper(strip_tags($_POST['kon'])));
  $no_plat = htmlentities(strtoupper(strip_tags($_POST['no_plat'])));
  $no_telp = htmlentities(strtoupper(strip_tags($_POST['no_telp'])));
  $alamat = htmlentities(strtoupper(strip_tags($_POST['alamat'])));
  $id_kon = $_POST['idkon'];
  $auth = $_POST['auth'];
  if($_POST['auth'] !=="") {
    $id_montir =$_POST['id_montir'];
    if($id_montir!== 0 ){
       $id_montir =$_POST['id_montir'];
     }else{
      $id_montir =0;
     }
    $stts = "done";
    $id_kasir = $_SESSION['id_kasir'];
    $grand=0;
    $grandmodal=0;
    $no = date('dmYHis');
    $catatan="";
    $id_kon = $_POST['idkon'];
    $query = "SELECT tmp_trx.*,barangjasa.* FROM tmp_trx,barangjasa WHERE tmp_trx.id_brg=barangjasa.id_brg AND tmp_trx.status = 'onprocess'";
    $exec = mysqli_query($conn,$query);
    while ($res =mysqli_fetch_assoc($exec)) {
      $ttl = $res['jml'] * $res['harga_jual'];
      $ttlmodal = $res['jml'] * $res['harga_modal'];
      $catatan = $res['id_brg'];
      $grand+=$ttl;
      $grandmodal+=$ttlmodal;
      $barang = $res['nama'];
      $jumlah = $res['jml'];
      $jenis = $res['jenis'];
      $harga_modal_barang = $res['harga_modal'];
      $harga_jual_barang = $res['harga_jual'];
      $harga_jasa = $res['harga_jual'];
      $penjualan = "INSERT INTO penjualan(tgl_penjualan,uraian,jenis,jumlah,harga_modal_barang,harga_jual_barang,harga_jasa,id_montir,id_kasir,id_kon,total) VALUES('$tgl','$barang','$jenis','$jumlah','$harga_modal_barang','$harga_jual_barang','$harga_jasa','$id_montir','$id_kasir','$id_kon','$ttl')";
      mysqli_query($conn,$penjualan);
      }


    // var_dump($grandmodal);
    $sqltmp = "UPDATE tmp_trx SET
        id_trx='". $no ."',
        status='". $stts ."',
        no_plat='".$no_plat."'
        WHERE status='onprocess'";
    $resstmp = mysqli_query($conn, $sqltmp);  

    if($resstmp){
      $sql = "INSERT INTO trx(id_trx,id_kon,tgl_trx,total,total_modal,id_kasir,id_montir) VALUES ('$no','$id_kon','$tgl','$grand','$grandmodal','$id_kasir','$id_montir')";
      $exec = mysqli_query($conn,$sql);
      if($exec){
        if($_POST['hanyabarang'] == 0){
           echo "<script>openUrl()</script>";
           echo "<script>alert('berhasil')</script>";
          echo "<script>document.location='transaksibaru.php'</script>";
        }else {
          echo "<script>openUrl2()</script>";
           echo "<script>alert('berhasil')</script>";
          echo "<script>document.location='transaksibaru.php'</script>";
         
      }
        }
    }
  }else {

     $query = "INSERT INTO konsumen(nama_kon,telp,no_plat,alamat) VALUES('$namakon','$no_telp','$no_plat','$alamat')";
      $exec = mysqli_query($conn,$query);
      if($exec) {
        $query = "SELECT * FROM konsumen ORDER BY id_kon DESC LIMIT 1";
        $exec = mysqli_query($conn,$query);
        $res = mysqli_fetch_assoc($exec);
        $kon = $res['id_kon'];
         $id_montir =$_POST['id_montir'];
         $id_montir =$_POST['id_montir'];
    if($id_montir!== 0 ){
       $id_montir =$_POST['id_montir'];
     }else{
      $id_montir =0;
     }
    $stts = "done";
    $id_kasir = $_SESSION['id_kasir'];
    $grand=0;
    $grandmodal=0;
    $no = date('dmYHis');
    $catatan="";
    $query = "SELECT tmp_trx.*,barangjasa.* FROM tmp_trx,barangjasa WHERE tmp_trx.id_brg=barangjasa.id_brg AND tmp_trx.status = 'onprocess'";
    $exec = mysqli_query($conn,$query);
    while ($res =mysqli_fetch_assoc($exec)) {
      $ttl = $res['jml'] * $res['harga_jual'];
      $ttlmodal = $res['jml'] * $res['harga_modal'];
      $catatan = $res['id_brg'];
      $grand+=$ttl;
      $grandmodal+=$ttlmodal;
      $barang = $res['nama'];
      $jumlah = $res['jml'];
      $jenis = $res['jenis'];
      $harga_modal_barang = $res['harga_modal'];
      $harga_jual_barang = $res['harga_jual'];
      $harga_jasa = $res['harga_jual'];
      $penjualan = "INSERT INTO penjualan(tgl_penjualan,uraian,jenis,jumlah,harga_modal_barang,harga_jual_barang,harga_jasa,id_montir,id_kasir,id_kon,total) VALUES('$tgl','$barang','$jenis','$jumlah','$harga_modal_barang','$harga_jual_barang','$harga_jasa','$id_montir','$id_kasir','$kon','$ttl')";
      mysqli_query($conn,$penjualan);
      }


    // var_dump($grandmodal);
    $sqltmp = "UPDATE tmp_trx SET
        id_trx='". $no ."',
        status='". $stts ."',
        no_plat='".$no_plat."'
        WHERE status='onprocess'";
    $resstmp = mysqli_query($conn, $sqltmp);  

    if($resstmp){
      $sql = "INSERT INTO trx(id_trx,id_kon,tgl_trx,total,total_modal,id_kasir,id_montir) VALUES ('$no','$kon','$tgl','$grand','$grandmodal','$id_kasir','$id_montir')";
      $exec = mysqli_query($conn,$sql);
      if($exec){
         if($_POST['hanyabarang'] == 0){
           echo "<script>openUrl()</script>";
           echo "<script>alert('berhasil')</script>";
          echo "<script>document.location='transaksibaru.php'</script>";
        }else {
          echo "<script>openUrl2()</script>";
           echo "<script>alert('berhasil')</script>";
          echo "<script>document.location='transaksibaru.php'</script>";
         
      }
    }
      }
    }
}
}

 ?>