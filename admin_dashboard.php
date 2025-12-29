<?php
session_start();
include "auth-uks/koneksi.php";

if (!isset($_SESSION['admin_login'])) {
    header("Location: auth-uks/login.php");
    exit;
}

$query = mysqli_query($koneksi, "
    SELECT pengajuan_uks.*, users.username
    FROM pengajuan_uks
    JOIN users ON pengajuan_uks.user_id = users.id
    ORDER BY tanggal_pengajuan DESC
");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard UKS</title>
<link rel="stylesheet" href="dash.css?v=1">
</head>
<body>

<div class="container">
<h2>Dashboard Admin UKS</h2>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>User</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
    <th>Keluhan</th>
    <th>Status</th>
    <th>Respon UKS</th>
</tr>

<?php $no=1; while($row = mysqli_fetch_assoc($query)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['username'] ?></td>
    <td><?= $row['nama_siswa'] ?></td>
    <td><?= $row['kelas'] ?></td>
    <td><?= nl2br($row['keluhan']) ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <?php if($row['status'] == 'Menunggu'): ?>
            <form action="proses_admin.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <textarea name="diagnosis" required placeholder="Diagnosis.."></textarea><br>
                <textarea name="tindakan" required placeholder="Tindakan.."></textarea><br>
                <button type="submit">Kirim</button>
            </form>
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
        <a href="admin_tracking.php" class="btn btn-track">Tracking</a>
        <a href="logout.php" class="btn btn-logout"
           onclick="return confirm('Yakin ingin logout?')">
           Logout
        </a>
    </div>
</body>
</html>
