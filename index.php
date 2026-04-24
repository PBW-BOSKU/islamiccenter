<?php

$page = $_GET['page'] ?? 'beranda';

$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '/assets/') !== false) {
    return false;
}

/* ================= USER ================= */

if ($page == 'beranda') {
    require_once 'app/controllers/HomeController.php';
    $home = new HomeController();
    $home->index(); 
}

elseif ($page == 'booking') {

    require_once 'app/controllers/HomeController.php';
    $home = new HomeController();
    $home->booking();

}

elseif ($page == 'proses_booking') {

    require_once 'app/controllers/HomeController.php';
    $home = new HomeController();
    $home->proses_booking();

}

elseif ($page == 'tambahReview') {

    require_once 'app/controllers/HomeController.php';
    $home = new HomeController();
    $home->tambahReview();

}

elseif ($page == 'kapasitas') {
    require_once 'app/controllers/HomeController.php';
    (new HomeController())->kapasitas();
}



/* ================= ADMIN ================= */

elseif ($page == 'login') {
    include 'app/views/admin/login.php';
}

elseif ($page == 'proses_login') {
    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->login();
}

elseif ($page == 'logout') {
    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->logout();
}

elseif ($page == 'dashboard') {
    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->dashboard();
}

elseif ($page == 'pengunjung') {

    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->pengunjung();

}

elseif ($page == 'tambah_pengunjung_form') {
    include 'app/views/admin/tambah_pengunjung.php';
}

elseif ($page == 'tambah_pengunjung') {

    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->tambah();

}

elseif ($page == 'edit_pengunjung') {
    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->editForm();
}

elseif ($page == 'update_pengunjung') {
    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->update();
}

elseif ($page == 'hapus_pengunjung') {

    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->hapus();

}

elseif ($page == 'galeri') {
    require_once 'app/controllers/GaleriController.php';
    $galeri = new GaleriController();
    $galeri->index();
}

elseif ($page == 'tambah_galeri') {
    require_once 'app/controllers/GaleriController.php';
    $galeri = new GaleriController();
    $galeri->tambah();
}

elseif ($page == 'hapus_galeri') {
    require_once 'app/controllers/GaleriController.php';
    $galeri = new GaleriController();
    $galeri->hapus();
}

elseif ($page == 'review') {
    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->reviewList();
}

elseif ($page == 'hapus_review') {
    require_once 'app/controllers/AdminController.php';
    $admin = new AdminController();
    $admin->hapusReview();
}

elseif ($page == 'update_galeri') {
    require_once 'app/controllers/GaleriController.php';
    $galeri = new GaleriController();
    $galeri->update();
}


/* ================= DEFAULT ================= */

else {

    echo "Halaman tidak ditemukan";

}