<?php

/* =========================
DETEKSI REQUEST PATH
========================= */

$request = trim(
    parse_url(
        $_SERVER['REQUEST_URI'],
        PHP_URL_PATH
    ),
'/');


/* jangan ganggu assets */
if (strpos($request,'assets/') === 0) {
    return false;
}


/* =========================
MAPPING ROUTE 
========================= */

switch($request){

/* USER */
case '':
case 'beranda':
case 'filosofi':
case 'fasilitas':
case 'lokasi':
$_GET['page']='beranda';
break;


/* ADMIN */
case 'admin':
$_GET['page']='login';
break;

case 'admin/dashboard':
$_GET['page']='dashboard';
break;

case 'admin/pengunjung':
$_GET['page']='pengunjung';
break;

case 'admin/tambah-pengunjung':
$_GET['page']='tambah_pengunjung_form';
break;

case 'admin/store-pengunjung':
$_GET['page']='tambah_pengunjung';
break;

case 'admin/edit-pengunjung':
$_GET['page']='edit_pengunjung';
break;

case 'admin/update-pengunjung':
$_GET['page']='update_pengunjung';
break;

case 'admin/hapus-pengunjung':
$_GET['page']='hapus_pengunjung';
break;

case 'admin/galeri':
$_GET['page']='galeri';
break;

case 'admin/review':
$_GET['page']='review';
break;

case 'admin/logout':
$_GET['page']='logout';
break;

case 'admin/update-galeri':
$_GET['page']='update_galeri';
break;

case 'admin/hapus-galeri':
$_GET['page']='hapus_galeri';
break;

}


/* =========================
PAGE PARAMETER
========================= */

$page = $_GET['page'] ?? 'beranda';



/* =========================
USER CONTROLLER
========================= */

if($page=='beranda'){

    require_once 'app/controllers/HomeController.php';

    $home = new HomeController();
    $home->index();

}


elseif($page=='booking'){

    require_once 'app/controllers/HomeController.php';

    (new HomeController())->booking();

}


elseif($page=='proses_booking'){

    require_once 'app/controllers/HomeController.php';

    (new HomeController())->proses_booking();

}


elseif($page=='tambahReview'){

    require_once 'app/controllers/HomeController.php';

    (new HomeController())->tambahReview();

}


elseif($page=='kapasitas'){

    require_once 'app/controllers/HomeController.php';

    (new HomeController())->kapasitas();

}



/* =========================
ADMIN
========================= */

elseif($page=='login'){

    include 'app/views/admin/login.php';

}


elseif($page=='proses_login'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->login();

}


elseif($page=='logout'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->logout();

}


elseif($page=='dashboard'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->dashboard();

}


elseif($page=='pengunjung'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->pengunjung();

}


elseif($page=='tambah_pengunjung_form'){

    include 'app/views/admin/tambah_pengunjung.php';

}


elseif($page=='tambah_pengunjung'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->tambah();

}


elseif($page=='edit_pengunjung'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->editForm();

}


elseif($page=='update_pengunjung'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->update();

}


elseif($page=='hapus_pengunjung'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->hapus();

}


elseif($page=='galeri'){

require_once 'app/controllers/GaleriController.php';

$galeri = new GaleriController();

if($_SERVER['REQUEST_METHOD']=='POST'){
$galeri->tambah();
}else{
$galeri->index();
}

}


elseif($page=='tambah_galeri'){

    require_once 'app/controllers/GaleriController.php';

    (new GaleriController())->tambah();

}


elseif($page=='hapus_galeri'){

    require_once 'app/controllers/GaleriController.php';

    (new GaleriController())->hapus();

}


elseif($page=='update_galeri'){

    require_once 'app/controllers/GaleriController.php';

    (new GaleriController())->update();

}


elseif($page=='review'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->reviewList();

}


elseif($page=='hapus_review'){

    require_once 'app/controllers/AdminController.php';

    (new AdminController())->hapusReview();

}



/* =========================
DEFAULT
========================= */

else{

    header("Location:/");
    exit;

}