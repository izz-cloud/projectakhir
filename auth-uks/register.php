<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function togglePassword(id, icon) {
    const input = document.getElementById(id);

    if (input.type === "password") {
      input.type = "text";
      icon.innerHTML = "🙈";
    } else {
      input.type = "password";
      icon.innerHTML = "👁️";
    }
  }
</script>

</head>
<body>

<div class="card">
  <h2>Register</h2>
  <form action="proses_register.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Daftar</button>
  </form>

  <div class="link">
    <a href="login.php">Sudah punya akun?</a>
  </div>
</div>
<script src="transisi.js"></script>
</body>
</html>
