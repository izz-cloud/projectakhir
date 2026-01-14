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

$pengajuan = [];
while ($row = mysqli_fetch_assoc($query)) {
    $pengajuan[] = $row;
}

$total = count($pengajuan);
$pending = count(array_filter($pengajuan, function($p) {
    return $p['status'] === 'Menunggu';
}));
$selesai = count(array_filter($pengajuan, function($p) {
    return $p['status'] !== 'Menunggu';
}));
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard UKS</title>
<link rel="stylesheet" href="dash.css?v=2">
</head>
<body>

<div class="container">
    <div class="page-header">
        <div class="title">
            <h2>Dashboard Admin UKS</h2>
            <p>Kelola pengajuan siswa, berikan diagnosis, dan tindak lanjut.</p>
        </div>
        <div class="header-actions">
            <a href="admin_tracking.php" class="btn btn-track">Tracking</a>
            <a href="logout.php" class="btn btn-logout" onclick="return confirm('Yakin ingin logout?')">
               Logout
            </a>
        </div>
    </div>

    <div class="summary-grid">
        <div class="summary-card">
            <h4>Total Pengajuan</h4>
            <div class="summary-value"><?= $total ?></div>
            <div class="summary-sub">Semua tiket siswa</div>
        </div>
        <div class="summary-card">
            <h4>Menunggu</h4>
            <div class="summary-value"><?= $pending ?></div>
            <div class="summary-sub">Belum direspon</div>
        </div>
        <div class="summary-card">
            <h4>Selesai / Diproses</h4>
            <div class="summary-value"><?= $selesai ?></div>
            <div class="summary-sub">Sudah ada tindakan</div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-toolbar">
            <h3>Data Pengajuan</h3>
            <div class="search-box">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#5d6d6e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><line x1="16.65" y1="16.65" x2="21" y2="21"></line></svg>
                <input type="text" id="searchInput" placeholder="Cari nama, kelas, keluhan, atau status">
            </div>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Respon UKS</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if($total === 0): ?>
                        <tr>
                            <td colspan="7" class="empty-state" data-label="Kosong">
                                <strong>Belum ada pengajuan</strong>
                                Semua laporan akan tampil di sini setelah siswa mengirimkan keluhan.
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php $no=1; foreach($pengajuan as $row): ?>
                        <?php
                            $statusClass = $row['status'] === 'Menunggu' ? 'status-menunggu' : 'status-selesai';
                            $statusLabel = $row['status'];
                        ?>
                        <tr>
                            <td data-label="No"><?= $no++ ?></td>
                            <td data-label="User"><?= $row['username'] ?></td>
                            <td data-label="Nama"><?= $row['nama_siswa'] ?></td>
                            <td data-label="Kelas"><?= $row['kelas'] ?></td>
                            <td data-label="Keluhan"><?= nl2br($row['keluhan']) ?></td>
                            <td data-label="Status">
                                <span class="status-badge <?= $statusClass ?>"><?= $statusLabel ?></span>
                            </td>
                            <td data-label="Respon UKS">
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
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="auth-uks/transisi.js"></script>
<script>
    const searchInput = document.getElementById('searchInput');
    const rows = Array.from(document.querySelectorAll('#tableBody tr'));

    searchInput?.addEventListener('input', () => {
        const term = searchInput.value.toLowerCase();
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
</script>
</body>
</html>
