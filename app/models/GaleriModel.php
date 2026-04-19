<?php
require_once __DIR__ . '/../../config/koneksi.php';

/* ================= GET ALL ================= */
function getAllGaleri() {
    global $conn;

    $query = $conn->query("SELECT * FROM galeri ORDER BY id DESC");

    if (!$query) {
        error_log("DB ERROR (getAllGaleri): " . $conn->error);
        return [];
    }

    return $query->fetch_all(MYSQLI_ASSOC);
}


/* ================= TAMBAH ================= */
function tambahGaleri($data, $file) {
    global $conn;

    $judul = trim($data['judul'] ?? '');
    $deskripsi = trim($data['deskripsi'] ?? '');

    if (!$judul || !$deskripsi) {
        return false;
    }

    $namaBaru = null;

    // ================= VALIDASI FILE =================
    if (isset($file['gambar']) && $file['gambar']['error'] === 0) {

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $namaFile = $file['gambar']['name'];
        $tmp = $file['gambar']['tmp_name'];

        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            return false;
        }

        if ($file['gambar']['size'] > 2 * 1024 * 1024) { // max 2MB
            return false;
        }

        $namaBaru = time() . '_' . uniqid() . '.' . $ext;
        $path = __DIR__ . '/../../assets/images/' . $namaBaru;

        if (!move_uploaded_file($tmp, $path)) {
            return false;
        }
    }

    // ================= INSERT =================
    $stmt = $conn->prepare("
        INSERT INTO galeri (judul, deskripsi, gambar, created_at)
        VALUES (?, ?, ?, NOW())
    ");

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }

    $stmt->bind_param("sss", $judul, $deskripsi, $namaBaru);

    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        return false;
    }

    return $conn->insert_id;
}


/* ================= HAPUS ================= */
function hapusGaleri($id) {
    global $conn;

    $id = (int)$id;

    // ambil file lama
    $stmt = $conn->prepare("SELECT gambar FROM galeri WHERE id = ?");
    if (!$stmt) return false;

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if ($data && !empty($data['gambar'])) {
        $file = __DIR__ . '/../../assets/images/' . $data['gambar'];

        if (file_exists($file)) {
            unlink($file);
        }
    }

    // hapus dari DB
    $stmt = $conn->prepare("DELETE FROM galeri WHERE id = ?");
    if (!$stmt) return false;

    $stmt->bind_param("i", $id);

    return $stmt->execute();
}


/* ================= UPDATE ================= */
function updateGaleri($data, $files) {
    global $conn;

    $id = (int)($data['id'] ?? 0);
    $judul = trim($data['judul'] ?? '');
    $deskripsi = trim($data['deskripsi'] ?? '');

    if ($id <= 0 || !$judul || !$deskripsi) {
        return false;
    }

    // ambil gambar lama
    $stmt = $conn->prepare("SELECT gambar FROM galeri WHERE id = ?");
    if (!$stmt) return false;

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $old = $stmt->get_result()->fetch_assoc();
    $oldFile = $old['gambar'] ?? null;

    $namaBaru = $oldFile;

    // ================= CEK UPLOAD BARU =================
    if (isset($files['gambar']) && $files['gambar']['error'] === 0) {

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($files['gambar']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) return false;
        if ($files['gambar']['size'] > 2 * 1024 * 1024) return false;

        $namaBaru = time() . '_' . uniqid() . '.' . $ext;
        $path = __DIR__ . '/../../assets/images/' . $namaBaru;

        if (!move_uploaded_file($files['gambar']['tmp_name'], $path)) {
            return false;
        }

        // hapus file lama
        if ($oldFile && file_exists(__DIR__ . '/../../assets/images/' . $oldFile)) {
            unlink(__DIR__ . '/../../assets/images/' . $oldFile);
        }
    }

    // ================= UPDATE =================
    $stmt = $conn->prepare("
        UPDATE galeri SET
        judul = ?,
        deskripsi = ?,
        gambar = ?
        WHERE id = ?
    ");

    if (!$stmt) return false;

    $stmt->bind_param("sssi", $judul, $deskripsi, $namaBaru, $id);

    return $stmt->execute();
}