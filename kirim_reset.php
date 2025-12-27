<?php
include 'koneksi.php';

$email = $_POST['email'];
$token = bin2hex(random_bytes(32));

$cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($cek) == 0) {
    echo "Email tidak ditemukan";
    exit;
}

mysqli_query($conn, "UPDATE users SET reset_token='$token' WHERE email='$email'");

$link = "http://localhost/auth-system/reset_password.php?token=$token";

$subject = "Reset Password Akun Anda";
$message = "Klik link berikut untuk reset password:\n\n$link";
$headers = "From: no-reply@uks-system.com";

mail($email, $subject, $message, $headers);

echo "Link reset telah dikirim ke email Anda";
