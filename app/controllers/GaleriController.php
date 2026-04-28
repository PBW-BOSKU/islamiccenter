<?php

require_once 'app/models/GaleriModel.php';

/* ================= BASE CONTROLLER ================= */
if (!class_exists('Controller')) {

class Controller {

    protected function view($path,$data=[]){
        extract($data);
        require "app/views/$path.php";
    }

    protected function redirect($url){
        header("Location: $url");
        exit;
    }

}

}


class GaleriController extends Controller
{

/* ================= AUTH ================= */

private function checkAuth()
{
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['admin'])){

        header("Location:/admin");
        exit;

    }
}



/* ================= INDEX ================= */

public function index()
{
    $this->checkAuth();

    $galeri = getAllGaleri();

    $this->view(
        'admin/galeri',
        compact('galeri')
    );
}



/* ================= TAMBAH ================= */

public function tambah()
{
    $this->checkAuth();

    if($_SERVER['REQUEST_METHOD']==='POST'){

        $result =
            tambahGaleri(
                $_POST,
                $_FILES
            );

        if(!$result){

            return $this->redirect(
                '/admin/galeri?error=upload'
            );

        }

        return $this->redirect(
            '/admin/galeri?success=tambah'
        );

    }

    return $this->redirect(
        '/admin/galeri'
    );
}



/* ================= HAPUS ================= */

public function hapus()
{
    $this->checkAuth();

    $id =
        isset($_GET['id'])
        ? (int)$_GET['id']
        : 0;

    if($id>0){

        hapusGaleri($id);

        return $this->redirect(
            '/admin/galeri?success=hapus'
        );

    }

    return $this->redirect(
        '/admin/galeri?error=hapus'
    );
}



/* ================= UPDATE ================= */

public function update()
{
    $this->checkAuth();

    if($_SERVER['REQUEST_METHOD']==='POST'){

        $result =
            updateGaleri(
                $_POST,
                $_FILES
            );

        if(!$result){

            return $this->redirect(
                '/admin/galeri?error=update'
            );

        }

        return $this->redirect(
            '/admin/galeri?success=update'
        );

    }

    return $this->redirect(
        '/admin/galeri'
    );
}


}