<?php
require_once __DIR__ . '/../../config/koneksi.php';

/* ================= GET ALL ================= */
function getAllPengunjung() {
    global $conn;

    $query = $conn->query("SELECT * FROM pengunjung ORDER BY id DESC");

    if (!$query) {
        error_log("DB ERROR: " . $conn->error);
        return [];
    }

    return $query->fetch_all(MYSQLI_ASSOC);
}


/* ================= GET BY TANGGAL ================= */
function getAllPengunjungByTanggal($tanggal) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT * FROM pengunjung
        WHERE DATE(tanggal_kunjungan) = ?
        ORDER BY id DESC
    ");

    if (!$stmt) return [];

    $stmt->bind_param("s", $tanggal);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


/* ================= TAMBAH ================= */
function tambahPengunjung($data) {
    global $conn;

    $stmt = $conn->prepare("
        INSERT INTO pengunjung 
        (kode_booking, nama, no_wa, jumlah, sesi, tanggal_kunjungan, status, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    if (!$stmt) {
        error_log("Prepare error: " . $conn->error);
        return false;
    }

    $stmt->bind_param(
        "ssiisss",
        $data['kode_booking'],
        $data['nama'],
        $data['no_wa'],
        $data['jumlah'],
        $data['sesi'],
        $data['tanggal_kunjungan'],
        $data['status']
    );

    if (!$stmt->execute()) {
        error_log("Execute error: " . $stmt->error);
        return false;
    }

    return $conn->insert_id;
}


/* ================= UPDATE ================= */
function updatePengunjung($data) {
    global $conn;

    $stmt = $conn->prepare("
        UPDATE pengunjung SET
        nama=?,
        no_wa=?,
        jumlah=?,
        sesi=?,
        tanggal_kunjungan=?,
        status=?
        WHERE id=?
    ");

    if (!$stmt) return false;

    $stmt->bind_param(
        "ssisssi",
        $data['nama'],
        $data['no_wa'],
        $data['jumlah'],
        $data['sesi'],
        $data['tanggal_kunjungan'],
        $data['status'],
        $data['id']
    );

    return $stmt->execute();
}


/* ================= GET BY ID ================= */
function getPengunjungById($id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT * FROM pengunjung WHERE id = ?
    ");

    if (!$stmt) return null;

    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}


/* ================= HAPUS ================= */
function hapusPengunjung($id) {
    global $conn;

    $stmt = $conn->prepare("
        DELETE FROM pengunjung WHERE id = ?
    ");

    if (!$stmt) return false;

    $stmt->bind_param("i", $id);

    return $stmt->execute();
}


/* ================= LATEST ================= */
function getLatestPengunjung($limit = 5) {
    global $conn;

    $limit = (int)$limit; // penting

    $query = $conn->query("
        SELECT * FROM pengunjung 
        ORDER BY id DESC 
        LIMIT $limit
    ");

    if (!$query) return [];

    return $query->fetch_all(MYSQLI_ASSOC);
}


/* ================= KAPASITAS ================= */
function getKapasitasByTanggal($tanggal) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT SUM(jumlah) as total 
        FROM pengunjung 
        WHERE tanggal_kunjungan = ?
    ");

    if (!$stmt) return 0;

    $stmt->bind_param("s", $tanggal);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    return $result['total'] ?? 0;
}


/* ================= STATISTIK ================= */
function getStatistikByTanggal($tanggal) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT status, COUNT(*) as total 
        FROM pengunjung 
        WHERE DATE(created_at) = ?
        GROUP BY status
    ");

    if (!$stmt) return [];

    $stmt->bind_param("s", $tanggal);
    $stmt->execute();

    $result = $stmt->get_result();

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[$row['status']] = $row['total'];
    }

    return $data;
}

function cekBookingDuplikat($no_wa, $tanggal, $sesi) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT id FROM pengunjung 
        WHERE no_wa = ? AND tanggal_kunjungan = ? AND sesi = ?
        LIMIT 1
    ");

    $stmt->bind_param("sss", $no_wa, $tanggal, $sesi);
    $stmt->execute();

    return $stmt->get_result()->num_rows > 0;
}