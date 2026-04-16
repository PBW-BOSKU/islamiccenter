<?php
require_once __DIR__ . '/../../config/koneksi.php';

function getAllGaleri() {
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function tambahGaleri($data, $file) {
    global $conn;

    $judul = mysqli_real_escape_string($conn, $data['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);

    // ================= VALIDASI FILE =================
    if ($file['gambar']['error'] == 0) {

        $namaFile = $file['gambar']['name'];
        $tmp = $file['gambar']['tmp_name'];

        // ambil ekstensi
        $ext = pathinfo($namaFile, PATHINFO_EXTENSION);

        // buat nama unik biar tidak tabrakan
        $namaBaru = time() . '_' . uniqid() . '.' . $ext;

        // pindahkan file
        move_uploaded_file($tmp, __DIR__ . '/../../assets/images/' . $namaBaru);

    } else {
        $namaBaru = null;
    }

    // ================= SIMPAN DATABASE =================
    mysqli_query($conn, "
        INSERT INTO galeri (judul, deskripsi, gambar, created_at)
        VALUES ('$judul','$deskripsi','$namaBaru', NOW())
    ");
}

function hapusGaleri($id) {
    global $conn;

    $id = (int)$id;

    // ambil nama file dulu
    $query = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id=$id");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $file = "assets/images/" . $data['gambar'];

        if (file_exists($file)) {
            unlink($file); 
        }
    }

    // hapus dari database
    mysqli_query($conn, "DELETE FROM galeri WHERE id=$id");
}

function updateGaleri($data, $files) {
    global $conn;

    $id = (int)$data['id'];
    $judul = mysqli_real_escape_string($conn, $data['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);

    // ambil gambar lama
    $old = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id=$id");
    $oldData = mysqli_fetch_assoc($old);
    $oldFile = $oldData['gambar'] ?? null;

    // cek upload baru
    if (!empty($files['gambar']['name'])) {

        $namaFile = time() . '_' . basename($files['gambar']['name']);
        $tmp = $files['gambar']['tmp_name'];
        $path = "assets/images/" . $namaFile;

        if (move_uploaded_file($tmp, $path)) {

            // hapus gambar lama (kalau ada)
            if ($oldFile && file_exists("assets/images/" . $oldFile)) {
                unlink("assets/images/" . $oldFile);
            }

            mysqli_query($conn, "
                UPDATE galeri SET
                judul='$judul',
                deskripsi='$deskripsi',
                gambar='$namaFile'
                WHERE id=$id
            ");

        }

    } else {

        // tanpa upload gambar baru
        mysqli_query($conn, "
            UPDATE galeri SET
            judul='$judul',
            deskripsi='$deskripsi'
            WHERE id=$id
        ");
    }
}