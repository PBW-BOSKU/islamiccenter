<?php
require_once 'app/models/GaleriModel.php';

/* ================= OPTIONAL BASE (biar konsisten) ================= */
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

class GaleriController extends Controller {

    private function checkAuth() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?page=login");
            exit;
        }
    }

    /* ================= INDEX ================= */
    public function index() {
        $this->checkAuth();

        $galeri = getAllGaleri();

        // ❗ tetap kirim variabel lama
        $this->view('admin/galeri', compact('galeri'));
    }

    /* ================= TAMBAH ================= */
    public function tambah() {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $result = tambahGaleri($_POST, $_FILES);

            // kalau gagal (optional handling)
            if (!$result) {
                return $this->redirect("index.php?page=galeri&error=upload");
            }

            return $this->redirect("index.php?page=galeri");
        }
    }

    /* ================= HAPUS ================= */
    public function hapus() {
        $this->checkAuth();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id > 0) {
            hapusGaleri($id);
        }

        return $this->redirect("index.php?page=galeri");
    }

    /* ================= UPDATE ================= */
    public function update() {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $result = updateGaleri($_POST, $_FILES);

            if (!$result) {
                return $this->redirect("index.php?page=galeri&error=update");
            }
        }

        return $this->redirect("index.php?page=galeri&updated=1");
    }
}