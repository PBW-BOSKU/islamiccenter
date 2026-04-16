<?php
require_once 'app/models/GaleriModel.php';

class GaleriController {

    public function index() {
        $galeri = getAllGaleri();
        include 'app/views/admin/galeri.php';
    }

    public function tambah() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            tambahGaleri($_POST, $_FILES);

            // redirect biar refresh data
            header("Location: index.php?page=galeri");
        }
    }

    public function hapus() {

        require_once __DIR__ . '/../models/GaleriModel.php';

        if (isset($_GET['id'])) {
            hapusGaleri($_GET['id']);
        }

        header("Location: index.php?page=galeri");
        exit;
    }

    public function update() {
        require_once __DIR__ . '/../models/GaleriModel.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            updateGaleri($_POST, $_FILES);
        }

        header("Location: index.php?page=galeri&updated=1");
        exit;
    }
}