<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2>Register</h2>
    <form action="proses_register.php" method="POST">
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Daftar</button>
    </form>
    <div class="link">
        <a href="index.php">Sudah punya akun?</a>
    </div>
</div>

</body>
</html>
