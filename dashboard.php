<?php
include 'koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2>Dashboard</h2>
    <p>Selamat datang, <?= $_SESSION['username']; ?></p>
    <a href="logout.php"><button>Logout</button></a>
</div>

</body>
</html>
