<?php
session_start();
include "auth-uks/koneksi.php";

if (!isset($_SESSION['admin_login'])) {
    header("Location: auth-uks/login.php");
    exit;
}

$id = $_POST['id'];
$diagnosis = $_POST['diagnosis'];
$tindakan = $_POST['tindakan'];

mysqli_query($koneksi, "
    UPDATE pengajuan_uks SET
    diagnosis = '$diagnosis',
    tindakan = '$tindakan',
    status = 'Selesai',
    tanggal_respon = NOW()
    WHERE id = '$id'
");

header("Location: admin_dashboard.php");
exit;
