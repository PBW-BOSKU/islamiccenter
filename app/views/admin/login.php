<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS ADMIN -->
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>

<body class="admin-page">
<div id="app">
    
<div class="login-wrapper d-flex justify-content-center align-items-center">

    <div class="login-card text-center">

        <!-- ICON -->
        <div class="login-icon">
            <img src="/assets/images/logoislamic.jpg" alt="Logo">
        </div>

        <!-- TITLE -->
        <h4 class="fw-bold">Menara Islamic Center Samarinda</h4>
        <small class="text-warning d-block mb-4">PORTAL ADMINISTRASI</small>

        <!-- ERROR MESSAGE -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center mb-3">
                Username atau password salah!
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="index.php?page=proses_login" method="POST" id="loginForm">

            <!-- USERNAME -->
            <div class="mb-3 text-start">
                <label class="form-label">Nama Pengguna</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3 text-start">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <!-- SHOW PASSWORD -->
            <div class="form-check text-start mb-3">
                <input class="form-check-input" type="checkbox" id="showPass">
                <label class="form-check-label">
                    Tampilkan Password
                </label>
            </div>

            <!-- BUTTON -->
            <button class="btn btn-success w-100" id="loginBtn">
                <span id="btnText">MASUK →</span>
            </button>

            <div class="login-popup" :class="{ active: showErrorPopup }">
                <div class="popup-content">
                    <div class="popup-icon">❌</div>
                    <h5>Login Gagal</h5>
                    <p>Username atau password salah</p>
                    <button onclick="closePopup()">Coba Lagi</button>
                </div>
            </div>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>

    // SHOW PASSWORD
    document.getElementById('showPass').addEventListener('change', function() {
        const pass = document.getElementById('password');
        pass.type = this.checked ? 'text' : 'password';
    });

    // LOADING BUTTON + DISABLE
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        const text = document.getElementById('btnText');

        btn.disabled = true;
        text.innerHTML = "Memproses...";
    });

</script>

<!-- ERROR SHAKE EFFECT -->
<?php if (isset($_GET['error'])): ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelector('.login-card').classList.add('login-error');
    });
</script>
<?php endif; ?>

</body>
</html>