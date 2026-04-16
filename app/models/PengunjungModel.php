<?php
require_once __DIR__ . '/../../config/koneksi.php';

function getAllPengunjung() {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM pengunjung ORDER BY id DESC");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function tambahPengunjung($data) {
    global $conn;

    $nama = $data['nama'];
    $email = $data['email'];
    $no_wa = $data['no_wa'];
    $jumlah = $data['jumlah'];
    $sesi = $data['sesi'];
    $tanggal = $data['tanggal_kunjungan'];
    $status =$data['status'];

    mysqli_query($conn, "
        INSERT INTO pengunjung 
        (nama, email, no_wa, jumlah, sesi, tanggal_kunjungan, status, created_at)
        VALUES
        ('$nama', '$email', '$no_wa', '$jumlah', '$sesi', '$tanggal', '$status', NOW())
    ");
}

function updatePengunjung($data) {
    global $conn;

    // VALIDASI ID
    $id = isset($data['id']) ? (int)$data['id'] : 0;
    if ($id <= 0) {
        die("ID tidak valid");
    }

    // ESCAPE DATA
    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $no_wa = mysqli_real_escape_string($conn, $data['no_wa']);
    $jumlah = (int)$data['jumlah'];
    $sesi = $data['sesi'];
    $tanggal = $data['tanggal_kunjungan'];
    $status = $data['status'] ?? 'Tunggu';

    $query = "
        UPDATE pengunjung SET
        nama='$nama',
        email='$email',
        no_wa='$no_wa',
        jumlah='$jumlah',
        sesi='$sesi',
        tanggal_kunjungan='$tanggal',
        status='$status'
        WHERE id=$id
    ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
}

function getPengunjungById($id) {
    global $conn;

    $id = (int)$id;

    $result = mysqli_query($conn, "
        SELECT * FROM pengunjung WHERE id = $id
    ");

    return mysqli_fetch_assoc($result);
}

function hapusPengunjung($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pengunjung WHERE id=$id");
}

function getLatestPengunjung($limit = 5) {
    global $conn;

    $query = mysqli_query($conn, "
        SELECT * FROM pengunjung 
        ORDER BY id DESC 
        LIMIT $limit
    ");

    return mysqli_fetch_all($query, MYSQLI_ASSOC);
}
function getKapasitasByTanggal($tanggal) {
    global $conn;

    $query = mysqli_query($conn, "
        SELECT SUM(jumlah) as total 
        FROM pengunjung 
        WHERE tanggal_kunjungan = '$tanggal'
    ");

    $data = mysqli_fetch_assoc($query);

    return $data['total'] ?? 0;
}

function getStatistikByTanggal($tanggal) {
    global $conn;

    $query = mysqli_query($conn, "
        SELECT status, COUNT(*) as total 
        FROM pengunjung 
        WHERE tanggal_kunjungan = '$tanggal'
        GROUP BY status
    ");

    $result = [
        'Check-in' => 0,
        'Tunggu' => 0,
        'Dibatalkan' => 0,
        'Selesai' => 0
    ];

    while ($row = mysqli_fetch_assoc($query)) {
        $result[$row['status']] = $row['total'];
    }

    return $result;
}

