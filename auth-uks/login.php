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
    <input name="username" placeholder="Username/Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Login</button>
  </form>

  <div class="link">
    <a href="register.php">Belum punya akun?</a>
  </div>
</div>

<script src="transisi.js"></script>
</body>
</html>
