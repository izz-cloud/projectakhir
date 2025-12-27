<?php
include 'koneksi.php';
$token = $_GET['token'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2>Password Baru</h2>
    <form action="update_password.php" method="POST">
        <input type="hidden" name="token" value="<?= $token ?>">
        <div class="input-group">
            <input type="password" name="password" placeholder="Password baru" required>
        </div>
        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
