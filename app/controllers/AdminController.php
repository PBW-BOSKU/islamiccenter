<?php
require_once __DIR__ . '/../models/PengunjungModel.php';
require_once __DIR__ . '/../../config/koneksi.php';

class AdminController {

    public function login() {

    require_once __DIR__ . '/../../config/koneksi.php';
    global $conn;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "
        SELECT * FROM admin 
        WHERE username='$username' AND password='$password'
    ");

    $user = mysqli_fetch_assoc($query);

    if ($user) {

        session_start();
        $_SESSION['admin'] = $user['username'];

        header("Location: index.php?page=dashboard");

    } else {
        header("Location: index.php?page=login&error=1");
        exit;
    }
}

public function logout() {

    session_start();
    session_unset();
    session_destroy();

    header("Location: index.php?page=beranda");
    exit;
}

public function dashboard() {

    require_once __DIR__ . '/../models/PengunjungModel.php';

    date_default_timezone_set('Asia/Jakarta');

    //  ambil tanggal dari filter
    $tanggal = $_GET['tanggal'] ?? date('Y-m-d');

    //  ambil semua data
    $all = getAllPengunjung();

    //  total semua
    $total = count($all);

    //  filter sesuai tanggal_kunjungan (INI YANG BENAR)
    $hari_ini = count(array_filter($all, function($p) use ($tanggal) {
        return $p['tanggal_kunjungan'] == $tanggal;
    }));

    //  kapasitas
    $max_kapasitas = 200;

    //  persen aman
    $persen = $max_kapasitas > 0 ? ($hari_ini / $max_kapasitas) * 100 : 0;

    //  aktivitas sesuai tanggal
    $aktivitas = array_filter($all, function($p) use ($tanggal) {
        return $p['tanggal_kunjungan'] == $tanggal;
    });

    $aktivitas = array_slice($aktivitas, 0, 5);

    // urutkan terbaru
    usort($aktivitas, function($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });

    include __DIR__ . '/../views/admin/dashboard.php';
}

public function pengunjung() {

    require_once __DIR__ . '/../models/PengunjungModel.php';

    $pengunjung = getAllPengunjung(); 
    $tanggal = $_GET['tanggal'] ?? date('Y-m-d');

    $max_kapasitas = 200;


    $total_hari_ini = getKapasitasByTanggal($tanggal);
    $stat = getStatistikByTanggal($tanggal);

    $checkin = $stat['Check-in'];
    $tunggu = $stat['Tunggu'];
    $batal = $stat['Dibatalkan'];
    $selesai =$stat['Selesai'];

    $persen = $max_kapasitas > 0 
        ? ($total_hari_ini / $max_kapasitas) * 100 
        : 0;
    include __DIR__ . '/../views/admin/pengunjung.php';
}

    public function tambah() {
        if ($_POST) {
        tambahPengunjung($_POST);

        $redirect = $_POST['redirect'] ?? 'pengunjung';

        if ($redirect == 'dashboard') {
            header("Location: index.php?page=dashboard");
        } else {
            header("Location: index.php?page=pengunjung");
        }

        exit;
    }
}

    public function hapus() {
        if (isset($_GET['id'])) {
            hapusPengunjung($_GET['id']);
            header("Location: index.php?page=pengunjung");
        }
    }

    public function editForm() {
    require_once __DIR__ . '/../models/PengunjungModel.php';

        $id = $_GET['id'];
        $pengunjung = getPengunjungById($id);

        include __DIR__ . '/../views/admin/edit_pengunjung.php';
    }

    public function update() {

    require_once __DIR__ . '/../models/PengunjungModel.php';

        updatePengunjung($_POST);

        header("Location: index.php?page=pengunjung");
        exit;
    }

    public function updateGaleri() {
        global $conn;

        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];

        if (!empty($_FILES['gambar']['name'])) {

            $gambar = $_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/images/" . $gambar);

            mysqli_query($conn, "
                UPDATE galeri SET 
                judul='$judul',
                deskripsi='$deskripsi',
                gambar='$gambar'
                WHERE id=$id
            ");

        } else {

            mysqli_query($conn, "
                UPDATE galeri SET 
                judul='$judul',
                deskripsi='$deskripsi'
                WHERE id=$id
            ");
        }

        header("Location: index.php?page=galeri");
    }
}