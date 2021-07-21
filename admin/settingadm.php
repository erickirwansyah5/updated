<?php include 'header.php';
include 'koneksi.php'; 

$query = "SELECT * FROM admin WHERE nama_adm = '$_SESSION[admin]'";
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
                                            <input type="text" value="<?= $ress['nama_adm'] ?>" required name="nama" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" value="<?= $ress['user_adm'] ?>" required name="user" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input value="<?= $ress['pass_adm'] ?>" type="text"required name="pass" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" value="<?= $ress['telp_adm'] ?>" required name="telp" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Telp Admin">
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
        $nama =  strip_tags(strtoupper(htmlentities($_POST['nama'])));
        $user =  strip_tags(strtoupper(htmlentities($_POST['user'])));
        $pass =  strip_tags(strtoupper(htmlentities($_POST['pass'])));
        $telp =  strip_tags(strtoupper(htmlentities($_POST['telp'])));

        $exec = mysqli_query($conn, "UPDATE admin SET 
                nama_adm = '".$nama."',
                user_adm = '".$user."',
                pass_adm = '".$pass."',
                telp_adm = '".$telp."' WHERE id_adm = '".$_SESSION['id_adm']."'

            ");
        if($exec) {
            echo "<script> alert('Data berhasil diedit')</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        }

     }


     ?>
    <?php include 'footer.php'; ?>