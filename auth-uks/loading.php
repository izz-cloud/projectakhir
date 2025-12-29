<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Loading...</title>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}

body {
  height: 100vh;
  background: linear-gradient(135deg, #2b333a, #839697);
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  animation: fadeIn 0.8s ease forwards;
}

@keyframes fadeIn {
  to { opacity: 1; }
}

.fade-out {
  animation: fadeOut 0.8s ease forwards;
}

@keyframes fadeOut {
  to { opacity: 0; }
}

.loading-box {
  background: rgba(171, 149, 149, 0.7);
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
  text-align: center;
}

.spinner {
  width: 60px;
  height: 60px;
  border: 6px solid #ccc;
  border-top: 6px solid #777;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin: 0 auto 20px;
}

@keyframes spin {
  100% { transform: rotate(360deg); }
}
</style>

<script>
setTimeout(() => {
  document.body.classList.add("fade-out");
  setTimeout(() => {
    window.location.href = "login.php";
  }, 500);
}, 2000);
</script>
</head>

<body>

<div class="loading-box">
  <div class="spinner"></div>
  <h2>Memuat Sistem</h2>
  <p>Sistem Informasi UKS</p>
</div>

</body>
</html>
