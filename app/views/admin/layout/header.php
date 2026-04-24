<?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

if (!isset($_SESSION['admin'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- BENAR — Bootstrap dulu, baru admin.css -->
<link rel="stylesheet" href="path/to/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/admin.css">
</head>

<body class="admin-page">
<div id="app">
<div class="admin-layout">