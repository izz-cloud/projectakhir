<?php
include 'koneksi.php';

$u = $_POST['username'];
$e = $_POST['email'];
$pwd = $_POST['password'];

// Validasi email
if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
  header("Location: register.php?error=" . urlencode("Format email tidak valid. Silakan gunakan email yang benar."));
  exit;
}

// Validasi password minimal 6 karakter
if (strlen($pwd) < 6) {
  header("Location: register.php?error=" . urlencode("Password minimal harus 6 karakter."));
  exit;
}

$p = password_hash($pwd, PASSWORD_BCRYPT);

$cek = mysqli_query($koneksi,
  "SELECT * FROM users WHERE username='$u' OR email='$e'"
);

if (mysqli_num_rows($cek) > 0) {
  header("Location: register.php?error=" . urlencode("Username atau email sudah digunakan. Silakan gunakan yang lain."));
  exit;
}

$insert = mysqli_query($koneksi,
  "INSERT INTO users (username, email, password)
   VALUES ('$u', '$e', '$p')"
);

if ($insert) {
  header("Location: login.php?success=" . urlencode("Registrasi berhasil! Silakan login dengan akun Anda."));
} else {
  header("Location: register.php?error=" . urlencode("Terjadi kesalahan. Silakan coba lagi."));
}
exit;
