<?php
require_once __DIR__ . '/../models/PengunjungModel.php';
require_once __DIR__ . '/../../config/koneksi.php';

/* ================= BASE CONTROLLER (JIKA BELUM ADA) ================= */
if (!class_exists('Controller')) {
    class Controller {
        protected function view($path, $data = []) {
            extract($data);
            require "app/views/$path.php";
        }

        protected function redirect($url) {
            header("Location: $url");
            exit;
        }
    }
}

class AdminController extends Controller {

    private function checkAuth() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?page=login");
            exit;
        }
    }

    /* ================= LOGIN ================= */
        public function login() {

            global $conn;

            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!$username || !$password) {
                return $this->redirect("index.php?page=login&error=login");
            }

            $stmt = $conn->prepare("
                SELECT * FROM admin WHERE username = ?
            ");

            if (!$stmt) {
                return $this->redirect("index.php?page=login&error=login");
            }

            $stmt->bind_param("s", $username);
            $stmt->execute();

            $user = $stmt->get_result()->fetch_assoc();

            // 🔐 PASSWORD HASH VERIFY
            if ($user && password_verify($password, $user['password'])) {

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                session_regenerate_id(true);

                $_SESSION['admin'] = $user['username'];

                return $this->redirect("index.php?page=dashboard");
            }

            return $this->redirect("index.php?page=login&error=login");
        }

    /* ================= LOGOUT ================= */
    public function logout() {

        session_start();
        session_unset();
        session_destroy();

        return $this->redirect("index.php?page=beranda&success=logout");
    }

    /* ================= DASHBOARD ================= */
    public function dashboard() {
    $this->checkAuth();

        date_default_timezone_set('Asia/Jakarta');

        $tanggal = $_GET['tanggal'] ?? date('Y-m-d');

        $all = getAllPengunjung();
        $total = count($all);

        $hari_ini = count(array_filter($all, function($p) use ($tanggal) {
            return $p['tanggal_kunjungan'] == $tanggal;
        }));

        $max_kapasitas = 200;

        $persen = $max_kapasitas > 0 
            ? ($hari_ini / $max_kapasitas) * 100 
            : 0;

        $aktivitas = array_filter($all, function($p) use ($tanggal) {
            return $p['tanggal_kunjungan'] == $tanggal;
        });

        $aktivitas = array_slice($aktivitas, 0, 5);

        usort($aktivitas, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $this->view('admin/dashboard', compact(
            'total', 'hari_ini', 'persen', 'aktivitas', 'tanggal'
        ));
    }

    /* ================= PENGUNJUNG ================= */
    public function pengunjung() {
        $this->checkAuth();

        $tanggal = $_GET['tanggal'] ?? null;

        if ($tanggal) {
            $pengunjung = getAllPengunjungByTanggal($tanggal);
        } else {
            $pengunjung = getAllPengunjung();
            $tanggal = date('Y-m-d');
        }

        $max_kapasitas = 200;
        $total_hari_ini = getKapasitasByTanggal($tanggal);
        $stat = getStatistikByTanggal($tanggal);

        $menunggu_pembayaran = $stat['Menunggu Pembayaran'] ?? 0;
        $dibayar = $stat['Dibayar'] ?? 0;
        $selesai = $stat['Selesai'] ?? 0;
        $dibatalkan = $stat['Dibatalkan'] ?? 0;

        $persen = $max_kapasitas > 0 
            ? ($total_hari_ini / $max_kapasitas) * 100 
            : 0;

        $this->view('admin/pengunjung', compact(
            'pengunjung',
            'tanggal',
            'total_hari_ini',
            'persen',
            'menunggu_pembayaran',
            'dibayar',
            'selesai',
            'dibatalkan',
            'max_kapasitas'
        ));
    }

    /* ================= TAMBAH ================= */
    public function tambah() {
        $this->checkAuth();

        if ($_POST) {

            $result = tambahPengunjung($_POST);

            $redirect = $_POST['redirect'] ?? 'pengunjung';

            if ($redirect == 'dashboard') {
                return $this->redirect("index.php?page=dashboard&success=tambah_pengunjung");
            }

            return $this->redirect("index.php?page=pengunjung&success=tambah_pengunjung");
        }
    }

    /* ================= HAPUS ================= */
    public function hapus() {
        $this->checkAuth();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id > 0) {
            hapusPengunjung($id);
        }

        return $this->redirect("index.php?page=pengunjung");
    }

    /* ================= EDIT FORM ================= */
    public function editForm() {
        $this->checkAuth();

        $id = (int)($_GET['id'] ?? 0);
        $pengunjung = getPengunjungById($id);

        $this->view('admin/edit_pengunjung', compact('pengunjung'));
    }

    /* ================= UPDATE ================= */
    public function update() {
        $this->checkAuth();

        $result = updatePengunjung($_POST);

        if ($result) {
            return $this->redirect("index.php?page=pengunjung&success=update_pengunjung");
        }

        return $this->redirect("index.php?page=pengunjung&error=1");
    }

    /* ================= UPDATE GALERI ================= */
    public function updateGaleri() {
        $this->checkAuth();

        global $conn;

        $id = (int)$_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];

        if (!empty($_FILES['gambar']['name'])) {

            $gambar = $_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/images/" . $gambar);

            $stmt = $conn->prepare("
                UPDATE galeri SET judul=?, deskripsi=?, gambar=? WHERE id=?
            ");

            $stmt->bind_param("sssi", $judul, $deskripsi, $gambar, $id);
            $stmt->execute();

        } else {

            $stmt = $conn->prepare("
                UPDATE galeri SET judul=?, deskripsi=? WHERE id=?
            ");

            $stmt->bind_param("ssi", $judul, $deskripsi, $id);
            $stmt->execute();
        }

        return $this->redirect("index.php?page=galeri");
    }
}