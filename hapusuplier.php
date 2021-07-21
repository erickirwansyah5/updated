<?php 
include 'sess_check.php';
include '../koneksi.php';

if(isset($_GET['id_tmp'])) {
	$id_tmp=$_GET['id_tmp'];
	$jml = $_GET['jml'];
	$id_brg= $_GET['id_brg'];
	$query1 = mysqli_query($conn,"SELECT * FROM barangjasa where id_brg = '$id_brg' ORDER BY id_brg DESC");
    $res = mysqli_fetch_assoc($query1);
	$stokbaru = $res['stok'] + intval($jml);
	$query2 = "UPDATE barangjasa set stok = ".$stokbaru." WHERE id_brg =".$id_brg."";
    $exec = mysqli_query($conn,$query2);
    if($exec) {
    	$query = "DELETE FROM tmp_trx WHERE id_tmp = $id_tmp";
		$exec = mysqli_query($conn,$query);
		if($exec) {
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			echo "<script>document.location = 'transaksibaru.php'</script>";
			}
       
       }  
    }
    if(isset($_GET['id_trx'])) {
	$id_trx=$_GET['id_trx'];
    $query = "DELETE FROM trx WHERE id_trx = $id_trx";
	$exec = mysqli_query($conn,$query);
		if($exec) {
			echo "<script>alert('Data Berhasil Dihapus')</script>";
			echo "<script>document.location = 'datatransaksi.php'</script>";
			}
       
       }  

        if(isset($_GET['id_montir'])) {
			$id_montir=$_GET['id_montir'];
		    $query = "DELETE FROM montir WHERE id_montir = $id_montir";
			$exec = mysqli_query($conn,$query);
				if($exec) {
					echo "<script>alert('Data Berhasil Dihapus')</script>";
					echo "<script>document.location = 'datamontir.php'</script>";
			}
       
       }  
    
	
if(isset($_GET['id_kon'])) {
	$id=$_GET['id_kon'];
	$query = "DELETE FROM konsumen WHERE id_kon = $id";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		echo "<script>alert('Data Berhasil Dihapus')</script>";
		echo "<script>document.location = 'datakonsumen.php'</script>";
	}
}

 ?>