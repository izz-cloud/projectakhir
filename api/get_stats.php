<?php
/**
 * API Endpoint for Dashboard Statistics
 * Returns JSON data for dynamic content loading
 */
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

include "../auth-uks/koneksi.php";

$user_id = $_SESSION['id'];

// Get all submissions for the user
$query = mysqli_query($koneksi, "
    SELECT * FROM pengajuan_uks
    WHERE user_id='$user_id'
    ORDER BY tanggal_pengajuan DESC
");

$pengajuan = [];
while ($row = mysqli_fetch_assoc($query)) {
    $pengajuan[] = $row;
}

// Calculate statistics
$total = count($pengajuan);
$pending = count(array_filter($pengajuan, function($p) {
    return $p['status'] === 'Menunggu';
}));
$selesai = count(array_filter($pengajuan, function($p) {
    return $p['status'] !== 'Menunggu';
}));

// Return JSON response
echo json_encode([
    'success' => true,
    'stats' => [
        'total' => $total,
        'pending' => $pending,
        'selesai' => $selesai
    ],
    'timestamp' => date('Y-m-d H:i:s')
]);


