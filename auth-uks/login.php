<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Informasi UKS</title>
  <link rel="stylesheet" href="style.css?v=5">
</head>
<body>
  <div class="auth-wrapper">
    <div class="card">
      <div class="card-inner">
        <div class="card-header">
          <div class="card-badge">Sistem Informasi UKS</div>
          <h1 class="card-title">Masuk</h1>
          <p class="card-subtitle">Login ke akun UKS Anda.</p>
        </div>

        <form action="proses_login.php" method="POST">
          <div class="form-group">
            <label class="form-label" for="username">Username / Email</label>
            <div class="input-wrapper">
              <input
                id="username"
                name="username"
                type="text"
                placeholder="Masukkan username atau email"
                autocomplete="username"
                required
              >
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="password">Kata Sandi</label>
            <div class="input-wrapper">
              <input
                id="password"
                name="password"
                type="password"
                placeholder="Masukkan kata sandi"
                autocomplete="current-password"
                required
              >
              <button type="button" class="password-toggle" data-target="password">👁</button>
            </div>
          </div>

          <div class="form-row">
            <label class="remember-me">
              <input type="checkbox" name="remember_dummy">
              <span>Ingat saya di perangkat ini</span>
            </label>
          </div>
            <br>
          <button type="submit">
            Masuk
          </button>
        </form>
        <div class="link">
          <a href="register.php">Belum punya akun? Daftar</a>
        </div>
      </div>
    </div>
  </div>

  <script src="transisi.js"></script>
  <script>
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
