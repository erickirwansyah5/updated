<?php
include "sess_check.php";
 include 'koneksi.php';

if(isset($_GET['id_sup'])) {
	$id_sup=$_GET['id_sup'];
	$query = "DELETE FROM suplier WHERE id_sup = $id_sup";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		echo "<script>alert('Data Berhasil Dihapus')</script>";
		echo "<script>document.location = 'datasuplier.php'</script>";
	}
}

if(isset($_GET['id_brg'])) {
	$id_brg=$_GET['id_brg'];
	$query = "DELETE FROM barangjasa WHERE id_brg = $id_brg";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		echo "<script>alert('Data Berhasil Dihapus')</script>";
		echo "<script>document.location = 'barangjasa.php'</script>";
	}
}
if(isset($_GET['id_jasa'])) {
	$id_brg=$_GET['id_jasa'];
	$query = "DELETE FROM barangjasa WHERE id_brg = $id_brg";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		echo "<script>alert('Data Berhasil Dihapus')</script>";
		echo "<script>document.location = 'barangjasa.php'</script>";
	}
}
if(isset($_GET['id_trx'])) {
	$id_trx=$_GET['id_trx'];
	$query = "DELETE FROM trxbarang WHERE id_trx = $id_trx";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		echo "<script>alert('Data Berhasil Dihapus')</script>";
		echo "<script>document.location = 'barangmasuk.php'</script>";
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

 if(isset($_GET['id_montir'])) {
			$id_montir=$_GET['id_montir'];
		    $query = "DELETE FROM montir WHERE id_montir = $id_montir";
			$exec = mysqli_query($conn,$query);
				if($exec) {
					echo "<script>alert('Data Berhasil Dihapus')</script>";
					echo "<script>document.location = 'datamontir.php'</script>";
			}
       
       }  


 ?>