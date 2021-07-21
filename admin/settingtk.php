<?php include 'header.php';
include 'koneksi.php'; 
// $id_info = $_GET['id_info'];
$query = "SELECT * FROM info";
$exec = mysqli_query($conn,$query);
$ress = mysqli_fetch_assoc($exec);


?>
<div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                 <img width="100%" height="100%" src="foto/foto2.jpg">
                            </div>
                            <div class="col-md-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit Data</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="hidden" name="id_info" value="<?= $ress['id_info'] ?>">
                                            <input type="text" value="<?= $ress['nama_bengkel'] ?>" required name="nama" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" value="<?= $ress['alamat_bengkel'] ?>" required name="alamat" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Alamat Bengkel">
                                        </div>
                                        <div class="form-group">
                                            <input value="<?= $ress['no_telp'] ?>" type="text"required name="no_telp" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Nomor Telpon">
                                        </div>
                                        
                                         
                                        <button type="submit" name="edit" class="btn btn-primary btn-user btn-block">Edit</button>
                                        <hr>
                                    </form>
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <?php 
     if(isset($_POST['edit'])) {
        $id = $_POST['id_info'];
        $nama =  strip_tags(strtoupper(htmlentities($_POST['nama'])));
        $user =  strip_tags(strtoupper(htmlentities($_POST['alamat'])));
        $telp =  strip_tags(strtoupper(htmlentities($_POST['no_telp'])));
        $exec = mysqli_query($conn, "UPDATE info SET 
                nama_bengkel = '".$nama."',
                alamat_bengkel = '".$user."',
                no_telp = '".$pass."' WHERE id_info = '".$id."'

            ");
        if($exec) {
            echo "<script> alert('Data berhasil diedit')</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        }

     }


     ?>
    <?php include 'footer.php'; ?>