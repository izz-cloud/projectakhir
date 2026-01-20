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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard siswa untuk Sistem Informasi UKS - Kelola pengajuan keluhan kesehatan">
    <title>Dashboard User UKS</title>
    <link rel="stylesheet" href="dash.css?v=4">
</head>
<body>
<div class="container">
    <div class="page-header">
        <div class="title">
            <h2>Dashboard UKS Siswa</h2>
            <p>Laporkan keluhan dengan cepat dan pantau respon UKS.</p>
        </div>
        <div class="header-actions">
            <a href="logout.php" class="btn btn-logout" onclick="return confirm('Yakin ingin logout?')" aria-label="Keluar dari akun">
                Logout
            </a>
        </div>
    </div>

    <div class="summary-grid">
        <div class="summary-card">
            <h4>Total Pengajuan</h4>
            <div class="summary-value"><?= $total ?></div>
            <div class="summary-sub">Semua pengajuan yang kamu kirim</div>
        </div>
        <div class="summary-card">
            <h4>Menunggu Respon</h4>
            <div class="summary-value"><?= $pending ?></div>
            <div class="summary-sub">Menanti pengecekan UKS</div>
        </div>
        <div class="summary-card">
            <h4>Selesai / Diproses</h4>
            <div class="summary-value"><?= $selesai ?></div>
            <div class="summary-sub">Sudah ditindaklanjuti UKS</div>
        </div>
    </div>

    <div class="card" role="region" aria-labelledby="form-title">
        <h3 id="form-title">Form Keluhan</h3>
        <p>Isi data di bawah secara singkat agar petugas UKS dapat menindaklanjuti.</p>
        <form action="proses_pengajuan.php" method="POST" aria-label="Form pengajuan keluhan kesehatan">
            <div>
                <label for="nama_siswa">Nama Siswa</label>
                <input
                    id="nama_siswa"
                    type="text"
                    name="nama_siswa"
                    placeholder="Nama Siswa"
                    required
                    pattern="[A-Za-z\s]+"
                    title="Nama hanya boleh huruf dan spasi"
                    aria-required="true"
                    aria-describedby="nama-help"
                    autocomplete="name"
                >
                <small id="nama-help" class="form-helper">Hanya huruf dan spasi</small>
            </div>

            <div>
                <label for="kelas">Kelas</label>
                <input
                    id="kelas"
                    type="text"
                    name="kelas"
                    placeholder="Contoh: X RPL 3"
                    required
                    pattern="^(X|XI|XII)\s[A-Z]{2,4}\s[1-9]$"
                    title="Format kelas: X RPL 3 / XI TKJ 2 / XII DKV 1"
                    oninput="this.value = this.value.toUpperCase()"
                    aria-required="true"
                    aria-describedby="kelas-help"
                    autocomplete="off"
                >
                <small id="kelas-help" class="form-helper">Format: X RPL 3, XI TKJ 2, atau XII DKV 1</small>
            </div>

            <div>
                <label for="keluhan">Keluhan</label>
                <textarea
                    id="keluhan"
                    name="keluhan"
                    placeholder="Tuliskan keluhan kesehatan yang dirasakan"
                    required
                    rows="3"
                    aria-required="true"
                    aria-describedby="keluhan-help"
                    minlength="10"
                ></textarea>
                <small id="keluhan-help" class="form-helper">Minimal 10 karakter untuk memberikan informasi yang cukup</small>
            </div>

            <button type="submit" aria-label="Kirim pengajuan keluhan">Kirim Keluhan</button>
        </form>
    </div>

    <div class="table-card" role="region" aria-labelledby="table-title">
        <div class="table-toolbar">
            <h3 id="table-title">Riwayat Pengajuan</h3>
            <div class="search-box">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#5d6d6e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><line x1="16.65" y1="16.65" x2="21" y2="21"></line></svg>
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Cari keluhan, status, atau tanggal"
                    aria-label="Cari dalam riwayat pengajuan"
                >
            </div>
        </div>
        <div class="table-wrapper">
            <table role="table" aria-label="Riwayat pengajuan keluhan kesehatan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Jawaban UKS</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if($total === 0): ?>
                        <tr>
                            <td colspan="5" class="empty-state" data-label="Kosong">
                                <strong>Belum ada pengajuan</strong>
                                Kirim keluhan pertama Anda lewat formulir di atas.
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
                            <td data-label="Tanggal"><?= $row['tanggal_pengajuan'] ?></td>
                            <td data-label="Keluhan"><?= nl2br($row['keluhan']) ?></td>
                            <td data-label="Status">
                                <span class="status-badge <?= $statusClass ?>"><?= $statusLabel ?></span>
                            </td>
                            <td data-label="Jawaban UKS">
                                <?php if($row['status'] == 'Menunggu'): ?>
                                    <span class="badge-note">Menunggu respon UKS</span>
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
<script src="js/dashboard.js"></script>
</body>
</html>
