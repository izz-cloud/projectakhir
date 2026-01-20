<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Halaman registrasi untuk Sistem Informasi UKS - Daftar akun baru untuk mengakses layanan UKS">
  <title>Registrasi - Sistem Informasi UKS</title>
  <link rel="stylesheet" href="style.css?v=6">
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

        <form action="proses_register.php" method="POST" id="registerForm" novalidate aria-label="Form registrasi akun UKS">
          <div class="form-group">
            <label class="form-label" for="reg_username">Username</label>
            <div class="input-wrapper">
              <input
                id="reg_username"
                type="text"
                name="username"
                placeholder="Username akun sekolah"
                required
                aria-required="true"
                aria-describedby="username-help"
                autocomplete="username"
              >
            </div>
            <small id="username-help" class="form-helper">Minimal 3 karakter, hanya huruf, angka, dan underscore</small>
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
                aria-required="true"
                aria-describedby="email-help"
                autocomplete="email"
              >
            </div>
            <small id="email-help" class="form-helper">Masukkan alamat email yang valid</small>
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
                aria-required="true"
                aria-describedby="password-help"
                autocomplete="new-password"
              >
              <button 
                type="button" 
                class="password-toggle" 
                data-target="reg_password"
                aria-label="Tampilkan atau sembunyikan kata sandi"
                aria-pressed="false"
              >👁</button>
            </div>
            <small id="password-help" class="form-helper">Minimal 6 karakter untuk keamanan akun</small>
          </div>

          <button type="submit" aria-label="Kirim form registrasi">
            Daftar
          </button>
        </form>

        <div class="link">
          <a href="login.php" aria-label="Pergi ke halaman login">Sudah punya akun? Masuk</a>
        </div>
      </div>
    </div>
  </div>

  <script src="transisi.js"></script>
  <script src="form-validation.js"></script>
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
