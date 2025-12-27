<?php
include 'koneksi.php';

$username = $_POST['username'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "Username atau email sudah digunakan";
    exit;
}

mysqli_query($conn, "INSERT INTO users VALUES (NULL,'$username','$email','$password',NULL)");
header("Location: index.php");