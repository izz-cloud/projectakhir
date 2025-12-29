<?php
session_start();
include "auth-uks/koneksi.php";

if (!isset($_SESSION['admin_login'])) {
    header("Location: auth-uks/login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM pengajuan_uks WHERE id='$id'");

header("Location: admin_tracking.php");
exit;
