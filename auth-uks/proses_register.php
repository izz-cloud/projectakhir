<?php
include 'koneksi.php';

$u = $_POST['username'];
$e = $_POST['email'];
$p = password_hash($_POST['password'], PASSWORD_BCRYPT);

$cek = mysqli_query($koneksi,
  "SELECT * FROM users WHERE username='$u' OR email='$e'"
);

if (mysqli_num_rows($cek) > 0) {
  echo "Username atau email sudah digunakan";
  exit;
}

mysqli_query($koneksi,
  "INSERT INTO users (username, email, password)
   VALUES ('$u', '$e', '$p')"
);

header("Location: login.php");
exit;
