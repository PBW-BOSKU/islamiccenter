<?php

$conn = mysqli_connect("localhost", "root", "", "islamic_center");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}