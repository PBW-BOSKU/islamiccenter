<?php
require_once __DIR__ . '/../../config/koneksi.php';

function getReview() {
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC");

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function tambahReview($data) {
    global $conn;

    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $komentar = mysqli_real_escape_string($conn, $data['komentar']);
    $rating = (int)$data['rating'];

    mysqli_query($conn, "
        INSERT INTO review (nama, komentar, rating)
        VALUES ('$nama','$komentar','$rating')
    ");
}