<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

/* =======================
   1. LOGIN ADMIN (HARDCODE)
   ======================= */
if ($username === "admin" && $password === "admin123") {
    $_SESSION['admin_login'] = true;
    $_SESSION['admin_username'] = "admin";

    header("Location: ../admin_dashboard.php");
    exit;
}

/* =======================
   2. LOGIN USER DATABASE
   ======================= */
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username='$username' OR email='$username'"
);

$data = mysqli_fetch_assoc($query);

if ($data && password_verify($password, $data['password'])) {

    // 🔥 WAJIB ADA
    $_SESSION['login'] = true;
    $_SESSION['id'] = $data['id'];           
    $_SESSION['username'] = $data['username'];
    $_SESSION['email'] = $data['email'];

    header("Location: ../dashboard.php");
    exit;
}

/* =======================
   3. GAGAL LOGIN
   ======================= */
echo "Login gagal. Username / Email atau password salah.";
exit;
