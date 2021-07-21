<?php session_start();
if(!isset($_SESSION['kasir'])) {
    header("location: ../loginauth.php");
} ?>