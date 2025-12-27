<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2>Login</h2>
    <form action="proses_login.php" method="POST">
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
    </form>

    <div class="link">
        <a href="lupa_password.php">Lupa password?</a><br>
        <a href="register.php">Buat akun</a>
    </div>
</div>

</body>
</html>
