<?php
require_once 'app/models/GaleriModel.php';
require_once 'app/models/ReviewModel.php';
require_once __DIR__ . '/../models/PengunjungModel.php';

/* ================= TAMBAHAN (AMAN) ================= */
class Controller {

    protected function view($path, $data = []) {
        extract($data);
        require "app/views/$path.php";
    }

    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }
}

/* ================= CONTROLLER ASLI (TIDAK DIUBAH BESAR) ================= */
class HomeController extends Controller {

    public function index() {

        $galeri = getAllGaleri();

        $reviewModel = new ReviewModel();
        $review = $reviewModel->getAll();

        // ❗ tetap kirim variabel lama (biar view tidak rusak)
        $this->view('user/beranda', compact('galeri', 'review'));
    }

    public function booking() {
        $this->view('user/booking');
    }

public function proses_booking() {

    header('Content-Type: application/json');

    $nama    = trim($_POST['nama'] ?? '');
    $no_wa   = trim($_POST['no_wa'] ?? '');
    $jumlah  = abs((int)($_POST['jumlah'] ?? 0));
    $tanggal = $_POST['tanggal'] ?? '';
    $sesi    = $_POST['sesi'] ?? 'pagi';

    // ================= VALIDASI DASAR =================
    if (!$nama || !$no_wa || $jumlah <= 0 || !$tanggal) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Semua field wajib diisi'
        ]);
        exit;
    }

    // ================= VALIDASI NAMA =================
    if (!preg_match('/^[a-zA-Z\s\.\'\-]+$/', $nama)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Nama tidak boleh mengandung angka atau simbol aneh'
        ]);
        exit;
    }

    // ================= VALIDASI TANGGAL =================
    $today = date('Y-m-d');
    if ($tanggal < $today) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Tanggal tidak boleh di masa lalu'
        ]);
        exit;
    }

    // ================= VALIDASI JUMLAH =================
    if ($jumlah < 1 || $jumlah > 200) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Jumlah orang harus antara 1 - 200'
        ]);
        exit;
    }

    // ================= NORMALISASI NOMOR =================
    $no_wa = preg_replace('/[^0-9+]/', '', $no_wa);

    if (substr($no_wa, 0, 3) == '+62') {
        $no_wa = substr($no_wa, 1);
    }

    if (substr($no_wa, 0, 1) == '0') {
        $no_wa = '62' . substr($no_wa, 1);
    }

    // ================= VALIDASI NOMOR =================
    if (!preg_match('/^62[0-9]+$/', $no_wa)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Nomor WhatsApp tidak valid'
        ]);
        exit;
    }

    $panjang = strlen($no_wa);
    if ($panjang < 11 || $panjang > 15) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Panjang nomor tidak sesuai'
        ]);
        exit;
    }

    // ================= CEK DUPLIKAT =================
    if (cekBookingDuplikat($no_wa, $tanggal, $sesi)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Anda sudah booking di sesi ini'
        ]);
        exit;
    }

    // ================= CEK KAPASITAS =================
    $max = 200;
    $terisi = getKapasitasByTanggal($tanggal);

    if ($terisi + $jumlah > $max) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Kuota sudah penuh'
        ]);
        exit;
    }

    // ================= GENERATE =================
    $kode  = 'IC-' . date('Ymd') . '-' . rand(1000,9999);
    $total = $jumlah * 15000;

    $data = [
        'nama' => $nama,
        'no_wa' => $no_wa,
        'jumlah' => $jumlah,
        'sesi' => $sesi,
        'tanggal_kunjungan' => $tanggal,
        'status' => 'Tunggu'
    ];

    $result = tambahPengunjung($data);

    if (!$result) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan server'
        ]);
        exit;
    }

    // ================= WHATSAPP =================
    $pesan = "Halo Admin Islamic Center Samarinda,\n\n";
    $pesan .= "Saya ingin konfirmasi booking:\n\n";
    $pesan .= "Kode Booking: $kode\n";
    $pesan .= "Nama: $nama\n";
    $pesan .= "No WA: $no_wa\n";
    $pesan .= "Jumlah: $jumlah orang\n";
    $pesan .= "Tanggal: $tanggal\n";
    $pesan .= "Sesi: $sesi\n\n";
    $pesan .= "Total Bayar: Rp " . number_format($total, 0, ',', '.') . "\n\n";
    $pesan .= "Mohon info pembayaran ya 🙏";

    $pesan = urlencode($pesan);
    $nomorAdmin = "6282146218068";

    // ================= SUCCESS =================
    echo json_encode([
        'status' => 'success',
        'url' => "https://wa.me/$nomorAdmin?text=$pesan"
    ]);
    exit;
}

    public function tambahReview() {

        $nama = trim($_POST['nama'] ?? '');
        $komentar = trim($_POST['komentar'] ?? '');
        $rating = (int)($_POST['rating'] ?? 0);

        if (!$nama || !$komentar || $rating < 1 || $rating > 5) {
            return $this->json([
                'success' => false,
                'error' => 'Data tidak valid'
            ], 400);
        }

        $model = new ReviewModel();

        $id = $model->tambah([
            'nama' => $nama,
            'komentar' => $komentar,
            'rating' => $rating
        ]);

        if (!$id) {
            return $this->json([
                'success' => false,
                'error' => 'Gagal menyimpan ke database'
            ], 500);
        }

        return $this->json([
            'success' => true,
            'data' => ['id' => $id]
        ]);
    }

    public function kapasitas() {

        $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
        $max = 200;

        $terisi = getKapasitasByTanggal($tanggal);
        $sisa = max(0, $max - $terisi);

        return $this->json([
            'tanggal' => $tanggal,
            'terisi' => (int)$terisi,
            'max' => $max,
            'sisa' => (int)$sisa,
            'persen' => $max > 0 ? round(($terisi/$max)*100) : 0
        ]);
    }
}