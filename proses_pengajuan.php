<?php
session_start();
include "auth-uks/koneksi.php";

$user_id = $_SESSION['id'];
$nama = $_POST['nama_siswa'];
$kelas = $_POST['kelas'];
$keluhan = $_POST['keluhan'];

mysqli_query($koneksi, "INSERT INTO pengajuan_uks 
(user_id, nama_siswa, kelas, keluhan, tanggal_pengajuan)
VALUES ('$user_id','$nama','$kelas','$keluhan',NOW())");

header("Location: dashboard.php");
