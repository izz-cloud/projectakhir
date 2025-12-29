<?php
session_start();
include "auth-uks/koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: auth-uks/login.php");
    exit;
}

$user_id = $_SESSION['id'];

$query = mysqli_query($koneksi, "
    SELECT * FROM pengajuan_uks
    WHERE user_id='$user_id'
    ORDER BY tanggal_pengajuan DESC
");
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard User UKS</title> 
<link rel="stylesheet" href="dash.css?v=1">
</head>
<body>
<div class="container">
<h2>Dashboard UKS Siswa</h2>

<h3>Form Keluhan</h3>
<form action="proses_pengajuan.php" method="POST">

    <!-- NAMA SISWA -->
    <input 
        type="text" 
        name="nama_siswa" 
        placeholder="Nama Siswa"
        required
        pattern="[A-Za-z\s]+"
        title="Nama hanya boleh huruf dan spasi"
    ><br><br>

    <!-- KELAS -->
    <input 
        type="text" 
        name="kelas" 
        placeholder="Contoh: X RPL 3"
        required
        pattern="^(X|XI|XII)\s[A-Z]{2,4}\s[1-9]$"
        title="Format kelas: X RPL 3 / XI TKJ 2 / XII DKV 1"
        oninput="this.value = this.value.toUpperCase()"
    ><br><br>

    <!-- KELUHAN -->
    <input 
        type="text" 
        name="keluhan" 
        placeholder="Keluhan"
        required
    ><br><br>

    <button type="submit">Kirim</button>
</form>

<hr>

<h3>Riwayat Pengajuan</h3>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Keluhan</th>
    <th>Status</th>
    <th>Jawaban UKS</th>
</tr>

<?php if(mysqli_num_rows($query) == 0): ?>
<tr>
    <td colspan="5" align="center">Belum ada pengajuan</td>
</tr>
<?php endif; ?>

<?php $no=1; while($row = mysqli_fetch_assoc($query)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['tanggal_pengajuan'] ?></td>
    <td><?= nl2br($row['keluhan']) ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <?php if($row['status'] == 'Menunggu'): ?>
            Menunggu respon UKS
        <?php else: ?>
            <b>Diagnosis:</b> <?= $row['diagnosis'] ?><br>
            <b>Tindakan:</b> <?= $row['tindakan'] ?><br>
            <small><?= $row['tanggal_respon'] ?></small>
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
    <div class="header-actions">
        <a href="logout.php" class="btn btn-logout"
           onclick="return confirm('Yakin ingin logout?')">
           Logout
        </a>
    </div>
  </div>
</body>
</html>
