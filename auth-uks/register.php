<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi - Sistem Informasi UKS</title>
  <link rel="stylesheet" href="style.css?v=5">
</head>
<body>
  <div class="auth-wrapper">
    <div class="card">
      <div class="card-inner">
        <div class="card-header">
          <div class="card-badge">Sistem Informasi UKS</div>
          <h1 class="card-title">Daftar</h1>
          <p class="card-subtitle">Buat akun baru UKS.</p>
        </div>

        <form action="proses_register.php" method="POST" id="registerForm">
          <div class="form-group">
            <label class="form-label" for="reg_username">Username</label>
            <div class="input-wrapper">
              <input
                id="reg_username"
                type="text"
                name="username"
                placeholder="Username akun sekolah"
                required
              >
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="reg_email">Email</label>
            <div class="input-wrapper">
              <input
                id="reg_email"
                type="email"
                name="email"
                placeholder="contoh: example@gmail.com"
                pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                required
              >
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="reg_password">Kata Sandi</label>
            <div class="input-wrapper">
              <input
                id="reg_password"
                type="password"
                name="password"
                placeholder="Minimal 6 karakter"
                minlength="6"
                required
              >
              <button type="button" class="password-toggle" data-target="reg_password">👁</button>
            </div>
          </div>

          <button type="submit">
            Daftar
          </button>
        </form>

        <div class="link">
          <a href="login.php">Sudah punya akun? Masuk</a>
        </div>
      </div>
    </div>
  </div>

  <script src="transisi.js"></script>
  <script>
    // Form validation
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const email = document.getElementById('reg_email').value;
      const password = document.getElementById('reg_password').value;
      
      // Validasi email
      const emailPattern = /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/i;
      if (!emailPattern.test(email)) {
        e.preventDefault();
        alert('Format email tidak valid. Silakan gunakan email yang benar.');
        return false;
      }
      
      // Validasi password minimal 6 karakter
      if (password.length < 6) {
        e.preventDefault();
        alert('Password minimal harus 6 karakter.');
        return false;
      }
    });

    // Show error pop-up if error parameter exists
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const success = urlParams.get('success');
    
    if (error || success) {
      const toast = document.createElement('div');
      toast.className = 'toast' + (success ? ' success' : '');
      toast.innerHTML = `
        <span class="toast-icon">${success ? '✓' : '⚠'}</span>
        <span class="toast-content">${error || success}</span>
        <button class="toast-close" onclick="this.parentElement.remove()">×</button>
      `;
      document.body.appendChild(toast);
      
      // Trigger animation
      setTimeout(() => toast.classList.add('show'), 100);
      
      // Auto remove after 5 seconds
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
      }, 5000);
      
      // Clean URL
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  </script>
</body>
</html>
