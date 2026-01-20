<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Sistem Informasi UKS - Loading">
<title>Memuat Sistem UKS...</title>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}

body {
  height: 100vh;
  background: linear-gradient(135deg, #2b333a, #839697); /* fallback if image not found */
  background-image: url('images/bgs.jpg?v=3');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  animation: fadeIn 0.8s ease forwards;
}

body::before {
  content: "";
  position: fixed;
  inset: 0;
  background: rgba(43, 51, 58, 0.5); /* reduced overlay opacity for better visibility */
  z-index: -1;
  pointer-events: none;
}

@keyframes fadeIn {
  to { opacity: 1; }
}

.fade-out {
  animation: fadeOut 0.6s ease forwards;
}

@keyframes fadeOut {
  to { opacity: 0; }
}

.loading-box {
  background: rgba(171, 149, 149, 0.82);
  padding: 32px 34px 26px;
  border-radius: 22px;
  box-shadow: 0 16px 42px rgba(0,0,0,0.38);
  text-align: center;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.loading-box::before {
  content: "";
  position: absolute;
  inset: -40%;
  background: radial-gradient(circle at top, rgba(255,255,255,0.35), transparent 60%);
  opacity: 0.9;
  pointer-events: none;
}

.loading-inner {
  position: relative;
  z-index: 1;
}

.logo-text {
  font-size: 13px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #3f4246;
  margin-bottom: 10px;
}

.spinner-ring {
  width: 64px;
  height: 64px;
  margin: 0 auto 18px;
  border-radius: 50%;
  border: 4px solid rgba(255,255,255,0.6);
  border-top-color: #2b333a;
  border-right-color: #2b333a;
  animation: spin 1s linear infinite;
  box-shadow: 0 0 0 1px rgba(0,0,0,0.08);
}

@keyframes spin {
  100% { transform: rotate(360deg); }
}

.loading-title {
  font-size: 20px;
  font-weight: 700;
  color: #24272b;
  margin-bottom: 4px;
}

.loading-subtitle {
  font-size: 13px;
  color: #4d5358;
  margin-bottom: 10px;
}

.dots {
  display: inline-block;
  font-size: 18px;
  letter-spacing: 3px;
  color: #2b333a;
  animation: blink 1.2s infinite steps(4, jump-both);
}

@keyframes blink {
  0% { opacity: 0.2; }
  50% { opacity: 1; }
  100% { opacity: 0.2; }
}
</style>

<script>
setTimeout(() => {
  document.body.classList.add("fade-out");
  setTimeout(() => {
    window.location.href = "auth-uks/login.php";
  }, 400);
}, 2000);
</script>
</head>

<body>

<div class="loading-box" role="status" aria-live="polite" aria-label="Memuat sistem">
  <div class="loading-inner">
    <div class="logo-text">Sistem Informasi UKS</div>
    <div class="spinner-ring" aria-hidden="true"></div>
    <div class="loading-title">Memuat sistem</div>
    <div class="loading-subtitle">Menyiapkan halaman login untuk Anda<span class="dots" aria-hidden="true">...</span></div>
  </div>
</div>

</body>
</html>


