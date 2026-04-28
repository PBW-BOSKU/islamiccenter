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


function tambahPengunjung($data)
{
    global $conn;

    /* =========================
       GENERATE KODE BOOKING
    ========================= */

    do {

        $kode_booking =
            'IC-' .
            date('Ymd') .
            '-' .
            rand(1000, 9999);

        $cek = $conn->prepare("
            SELECT id
            FROM pengunjung
            WHERE kode_booking = ?
        ");

        if (!$cek) {
            error_log(
                "Prepare cek gagal: " .
                $conn->error
            );
            return false;
        }

        $cek->bind_param(
            "s",
            $kode_booking
        );

        $cek->execute();

        $result = $cek->get_result();

        $exists =
            $result->num_rows > 0;

        $cek->close();

    } while ($exists);

    if(strlen($data['nama']) > 50){
        return false;
        }

        if(!preg_match('/^62[0-9]{8,13}$/',$data['no_wa'])){
        return false;
        }

        if(
        $data['jumlah'] <1 ||
        $data['jumlah'] >10
        ){
        return false;
        }



    /* =========================
       INSERT DATA
    ========================= */

    $stmt = $conn->prepare("
        INSERT INTO pengunjung
        (
            kode_booking,
            nama,
            no_wa,
            jumlah,
            sesi,
            tanggal_kunjungan,
            status,
            created_at
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?, NOW()
        )
    ");

    if (!$stmt) {

        error_log(
            "Prepare insert gagal: " .
            $conn->error
        );

        return false;
    }


    $stmt->bind_param(
        "sssisss",
        $kode_booking,
        $data['nama'],
        $data['no_wa'],
        $data['jumlah'],
        $data['sesi'],
        $data['tanggal_kunjungan'],
        $data['status']
    );


    if (!$stmt->execute()) {

        error_log(
            "Execute gagal: " .
            $stmt->error
        );

        return false;
    }


    $insertId =
        $conn->insert_id;

    $stmt->close();

    return $insertId;
}


/* ================= UPDATE ================= */
function updatePengunjung($data)
{
    global $conn;

    if(
        isset($data['status']) &&
        $data['status']=='Tunggu'
    ){
        $data['status']=
        'Menunggu Pembayaran';
    }

    if(strlen($data['nama']) > 50){
        return false;
        }

        if(!preg_match('/^62[0-9]{8,13}$/',$data['no_wa'])){
        return false;
        }

        if(
        $data['jumlah'] <1 ||
        $data['jumlah'] >10
        ){
        return false;
        }

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

    if(!$stmt){
        return false;
    }

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
function getKapasitasByTanggal($tanggal)
{
    global $conn;

    $stmt = $conn->prepare("
        SELECT
            COALESCE(
                SUM(jumlah),
                0
            ) AS total
        FROM pengunjung
        WHERE tanggal_kunjungan = ?
        AND status IN
        (
            'Menunggu Pembayaran',
            'Tunggu',
            'Dibayar',
            'Selesai'
        )
    ");

    if(!$stmt){
        return 0;
    }

    $stmt->bind_param(
        "s",
        $tanggal
    );

    $stmt->execute();

    $result =
        $stmt->get_result()
            ->fetch_assoc();

    $stmt->close();

    return
        (int)($result['total'] ?? 0);
}

/* ======= KAPASITAS PER SESI =======*/
function getKapasitasByTanggalDanSesi($tanggal,$sesi)
{
    global $conn;

    $stmt = $conn->prepare("
        SELECT
            COALESCE(
                SUM(jumlah),
                0
            ) AS total
        FROM pengunjung
        WHERE tanggal_kunjungan = ?
        AND sesi = ?
        AND status IN
        (
            'Menunggu Pembayaran',
            'Tunggu',
            'Dibayar',
            'Selesai'
        )
    ");

    if(!$stmt){
        return 0;
    }

    $stmt->bind_param(
        "ss",
        $tanggal,
        $sesi
    );

    $stmt->execute();

    $result =
        $stmt->get_result()
            ->fetch_assoc();

    $stmt->close();

    return
        (int)($result['total'] ?? 0);
}


/* ================= STATISTIK ================= */
function getStatistikByTanggal($tanggal)
{
    global $conn;

    $stmt = $conn->prepare("
        SELECT
            status,
            COUNT(*) as total
        FROM pengunjung
        WHERE tanggal_kunjungan = ?
        GROUP BY status
    ");

    if(!$stmt){
        return [];
    }

    $stmt->bind_param(
        "s",
        $tanggal
    );

    $stmt->execute();

    $result =
        $stmt->get_result();

    $stat = [];

    while(
        $row = $result->fetch_assoc()
    ){
        $stat[
            $row['status']
        ] = $row['total'];
    }

    $stmt->close();

    return $stat;
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