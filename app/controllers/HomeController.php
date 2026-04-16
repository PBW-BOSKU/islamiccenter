<?php
require_once 'app/models/GaleriModel.php';
require_once 'app/models/ReviewModel.php';

class HomeController {

    public function index() {

        $galeri = getAllGaleri();
        $review = getReview();

        require_once 'app/views/user/beranda.php';
    }

    public function booking() {
        require_once 'app/views/user/booking.php';
    }

    public function tambahReview() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        tambahReview($_POST);

        header("Location: index.php");
        exit;
    }
    }
}