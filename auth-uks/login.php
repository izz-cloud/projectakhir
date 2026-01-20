<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Halaman login untuk Sistem Informasi UKS - Masuk ke akun Anda untuk mengakses layanan UKS">
  <title>Login - Sistem Informasi UKS</title>
  <link rel="stylesheet" href="style.css?v=6">
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

        <form action="proses_login.php" method="POST" aria-label="Form login akun UKS">
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
                aria-required="true"
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
                aria-required="true"
              >
              <button 
                type="button" 
                class="password-toggle" 
                data-target="password"
                aria-label="Tampilkan atau sembunyikan kata sandi"
                aria-pressed="false"
              >👁</button>
            </div>
          </div>

          <div class="form-row">
            <label class="remember-me">
              <input type="checkbox" name="remember_dummy" aria-label="Ingat saya di perangkat ini">
              <span>Ingat saya di perangkat ini</span>
            </label>
          </div>
            <br>
          <button type="submit" aria-label="Kirim form login">
            Masuk
          </button>
        </form>
        <div class="link">
          <a href="register.php" aria-label="Pergi ke halaman registrasi">Belum punya akun? Daftar</a>
        </div>
      </div>
    </div>
  </div>

  <script src="transisi.js"></script>
  <script>
    // Show error/success pop-up if URL parameter exists
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const success = urlParams.get('success');
    
    if (error || success) {
      const toast = document.createElement('div');
      toast.className = 'toast' + (success ? ' success' : '');
      toast.setAttribute('role', 'alert');
      toast.setAttribute('aria-live', 'polite');
      toast.innerHTML = `
        <span class="toast-icon" aria-hidden="true">${success ? '✓' : '⚠'}</span>
        <span class="toast-content">${error || success}</span>
        <button class="toast-close" onclick="this.parentElement.remove()" aria-label="Tutup notifikasi">×</button>
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
