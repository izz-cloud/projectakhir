<?php
include 'koneksi.php';

$token = $_POST['token'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$cek = mysqli_query($conn, "SELECT * FROM users WHERE reset_token='$token'");
if (mysqli_num_rows($cek) == 0) {
    echo "Token tidak valid";
    exit;
}

mysqli_query($conn, "UPDATE users SET password='$password', reset_token=NULL WHERE reset_token='$token'");
echo "Password berhasil diubah";
