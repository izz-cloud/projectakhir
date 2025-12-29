<?php
session_start();
include "auth-uks/koneksi.php";

if (!isset($_SESSION['admin_login'])) {
    header("Location: auth-uks/login.php");
    exit;
}

/* Ambil filter */
$dari   = $_GET['dari'] ?? '';
$sampai = $_GET['sampai'] ?? '';
$kelas  = $_GET['kelas'] ?? '';
$cari   = $_GET['cari'] ?? '';
$status = $_GET['status'] ?? '';

$where = "WHERE 1";

if ($dari && $sampai) {
    $where .= " AND DATE(tanggal_pengajuan) BETWEEN '$dari' AND '$sampai'";
}
if ($kelas) {
    $where .= " AND kelas LIKE '%$kelas%'";
}
if ($cari) {
    $where .= " AND (nama_siswa LIKE '%$cari%' OR keluhan LIKE '%$cari%')";
}
if ($status) {
    $where .= " AND status='$status'";
}

/* Data utama */
$query = mysqli_query($koneksi, "
    SELECT pengajuan_uks.*, users.username
    FROM pengajuan_uks
    JOIN users ON pengajuan_uks.user_id = users.id
    $where
    ORDER BY tanggal_pengajuan DESC
");

/* Statistik */
$total     = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pengajuan_uks"));
$menunggu  = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pengajuan_uks WHERE status='Menunggu'"));
$selesai   = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM pengajuan_uks WHERE status='Selesai'"));
?>
<!DOCTYPE html>
<html>
<head>
<title>Tracking Admin UKS</title>

<style>
*{box-sizing:border-box;font-family:'Segoe UI',Tahoma,sans-serif}
body{
    background:linear-gradient(135deg,#2b333a,#839697);
    padding:30px;min-height:100vh
}
.container{
    max-width:1200px;margin:auto;background:#fff;
    padding:25px;border-radius:14px;
    box-shadow:0 12px 30px rgba(0,0,0,.15)
}
.header{display:flex;justify-content:space-between;align-items:center}
.header h2{color:#2b333a}
.btn-back{
    background:#839697;color:#fff;text-decoration:none;
    padding:10px 18px;border-radius:8px;font-weight:600
}
.stats{display:flex;gap:15px;margin:20px 0}
.stat-box{flex:1;background:#f2f2f2;padding:15px;border-radius:10px;text-align:center}
.stat-box b{display:block;font-size:20px}

.filter-form{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:20px}
.filter-form input, .filter-form select{
    padding:10px;border-radius:8px;border:1px solid #ccc
}
.filter-form button{
    background:#2e7d32;color:#fff;border:none;
    padding:10px 18px;border-radius:8px;font-weight:600
}
.filter-form a{
    background:#9e9e9e;color:#fff;text-decoration:none;
    padding:10px 18px;border-radius:8px
}

/* Table */
table{width:100%;border-collapse:collapse;background:#e9e9e9;border-radius:12px;overflow:hidden}
th{background:#839697;color:#fff;padding:12px}
td{padding:12px;border-bottom:1px solid #ddd;vertical-align:top}
tr:hover{background:#f5f9ff}

/* Badge status */
.badge{
    padding:6px 12px;border-radius:20px;
    font-size:13px;font-weight:600;display:inline-block
}
.badge.menunggu{background:#fff3e0;color:#ef6c00}
.badge.selesai{background:#e8f5e9;color:#2e7d32}

/* Timeline */
.timeline{display:flex;gap:6px;margin-top:6px}
.step{
    font-size:11px;padding:4px 8px;border-radius:6px;
    background:#ccc;color:#333
}
.step.done{background:#c8e6c9;color:#2e7d32}
.step.active{background:#fff3e0;color:#ef6c00}

/* Aksi */
.btn-delete{color:#d32f2f;font-weight:600;text-decoration:none}
.btn-delete:hover{text-decoration:underline}

/* Responsive */
@media(max-width:768px){
    .stats{flex-direction:column}
    table,thead,tbody,th,td,tr{display:block}
    th{display:none}
    tr{margin-bottom:15px;background:#fff;padding:10px;border-radius:10px}
    td::before{
        content:attr(data-label);
        font-weight:600;display:block;color:#2b333a
    }
}
</style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Tracking Diagnosis UKS</h2>
        <a href="admin_dashboard.php" class="btn-back">← Dashboard</a>
    </div>

    <!-- Statistik -->
    <div class="stats">
        <div class="stat-box">Total<b><?= $total ?></b></div>
        <div class="stat-box">Menunggu<b><?= $menunggu ?></b></div>
        <div class="stat-box">Selesai<b><?= $selesai ?></b></div>
    </div>

    <!-- Filter -->
    <form class="filter-form" method="GET">
        <input type="date" name="dari" value="<?= $dari ?>">
        <input type="date" name="sampai" value="<?= $sampai ?>">
        <input type="text" name="kelas" placeholder="X / XI / XII" value="<?= $kelas ?>">
        <input type="text" name="cari" placeholder="Nama / keluhan" value="<?= $cari ?>">
        <select name="status">
            <option value="">Semua Status</option>
            <option value="Menunggu" <?= $status=='Menunggu'?'selected':'' ?>>Menunggu</option>
            <option value="Selesai" <?= $status=='Selesai'?'selected':'' ?>>Selesai</option>
        </select>
        <button type="submit">Filter</button>
        <a href="admin_tracking.php">Reset</a>
    </form>

    <!-- Table -->
    <table>
        <tr>
            <th>No</th><th>User</th><th>Nama</th><th>Kelas</th>
            <th>Keluhan</th><th>Status</th><th>Tanggal</th><th>Aksi</th>
        </tr>

        <?php $no=1; while($row=mysqli_fetch_assoc($query)): ?>
        <tr>
            <td data-label="No"><?= $no++ ?></td>
            <td data-label="User"><?= $row['username'] ?></td>
            <td data-label="Nama"><?= $row['nama_siswa'] ?></td>
            <td data-label="Kelas"><?= $row['kelas'] ?></td>
            <td data-label="Keluhan"><?= nl2br($row['keluhan']) ?></td>
            <td data-label="Status">
                <span class="badge <?= strtolower($row['status']) ?>">
                    <?= $row['status'] ?>
                </span>
            </td>
            <td data-label="Tanggal"><?= $row['tanggal_pengajuan'] ?></td>
            <td data-label="Aksi">
                <a class="btn-delete"
                   href="hapus_pengajuan.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Yakin hapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
