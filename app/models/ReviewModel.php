<?php

class ReviewModel {

    private $conn;

    private $maxNama = 50;
    private $maxKomentar = 300;

    public function __construct() {

        require __DIR__ . '/../../config/koneksi.php';
        $this->conn = $conn;
    }


/* ================= GET ALL ================= */

public function getAll(){

$query=$this->conn->query("
SELECT *
FROM review
ORDER BY created_at DESC
");

if(!$query){
error_log("DB ERROR: ".$this->conn->error);
return [];
}

return $query->fetch_all(MYSQLI_ASSOC);

}



/* ================= TAMBAH ================= */

public function tambah($data,$file=null){

$nama=trim($data['nama'] ?? '');
$komentar=trim($data['komentar'] ?? '');
$rating=(int)($data['rating'] ?? 0);
$sesi=trim($data['sesi'] ?? 'Pagi');

if(
!$nama ||
!$komentar ||
$rating<1 ||
$rating>5
){
return false;
}

if(strlen($nama)>50){
return false;
}

if(strlen($komentar)>300){
return false;
}

$allowedSesi=['Pagi','Siang','Sore'];

if(!in_array($sesi,$allowedSesi)){
return false;
}

/* ================= UPLOAD ================= */

$gambarPath=null;

if(
isset($file['gambar']) &&
$file['gambar']['error']==0
){

$allowedExt=['jpg','jpeg','png','webp'];

$ext=strtolower(
pathinfo(
$file['gambar']['name'],
PATHINFO_EXTENSION
)
);

if(!in_array($ext,$allowedExt)){
return false;
}

if(
$file['gambar']['size'] >
2*1024*1024
){
return false;
}

$mime=mime_content_type(
$file['gambar']['tmp_name']
);

$allowedMime=[
'image/jpeg',
'image/png',
'image/webp'
];

if(
!in_array(
$mime,
$allowedMime
)
){
return false;
}

if(
!getimagesize(
$file['gambar']['tmp_name']
)
){
return false;
}

$namaFile=
"time_".time().
"_".uniqid().
".".$ext;

$folder='assets/images/review/';

if(!is_dir($folder)){
mkdir(
$folder,
0777,
true
);
}

if(
!move_uploaded_file(
$file['gambar']['tmp_name'],
$folder.$namaFile
)
){
return false;
}

$gambarPath=
$folder.$namaFile;

}

/* ================= INSERT DATABASE ================= */

$stmt=$this->conn->prepare("
INSERT INTO review
(
nama,
komentar,
rating,
sesi,
gambar,
created_at
)
VALUES
(
?,?,?,?,?,
NOW()
)
");

if(!$stmt){
error_log(
$this->conn->error
);
return false;
}

$stmt->bind_param(
"ssiss",
$nama,
$komentar,
$rating,
$sesi,
$gambarPath
);

if(!$stmt->execute()){

error_log(
$stmt->error
);

return false;
}

$id=$this->conn->insert_id;

$stmt->close();

return $id;

}


/* ================= DELETE ================= */

public function deleteById($id){

$id=(int)$id;

if($id<=0){
return false;
}


# ambil gambar dulu supaya bisa dihapus

$get=$this->conn->prepare("
SELECT gambar
FROM review
WHERE id=?
");

$get->bind_param("i",$id);
$get->execute();

$res=$get->get_result()->fetch_assoc();

if(
$res &&
!empty($res['gambar']) &&
file_exists($res['gambar'])
){
unlink($res['gambar']);
}


$stmt=$this->conn->prepare("
DELETE FROM review
WHERE id=?
");

if(!$stmt){
return false;
}

$stmt->bind_param("i",$id);

$stmt->execute();

$affected=$stmt->affected_rows;

$stmt->close();

return $affected>0;

}

}