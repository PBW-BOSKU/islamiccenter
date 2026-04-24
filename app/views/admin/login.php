<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS ADMIN -->
    <link rel="stylesheet" href="/assets/css/admin.css">

    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="admin-page login-page">
<div id="app">
    
<div class="login-wrapper d-flex justify-content-center align-items-center">

    <div class="login-card text-center">

        <!-- ICON -->
        <div class="login-icon">
            <img src="/assets/images/menaraislamic.png" alt="Logo">
        </div>

        <!-- TITLE -->
        <h4 class="fw-bold">Menara Islamic Center Samarinda</h4>
        <small class="text-warning d-block mb-4">PORTAL ADMINISTRASI</small>

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

    // LOADING BUTTON
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        const text = document.getElementById('btnText');

        btn.disabled = true;
        text.innerHTML = "Memproses...";
    });

    // ================= GLOBAL POPUP =================
    const urlParams = new URLSearchParams(window.location.search);

    const success = urlParams.get('success');
    const error = urlParams.get('error');

    if (success === 'login') {
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: 'Selamat datang di dashboard',
            timer: 1500,
            showConfirmButton: false
        });

        window.history.replaceState({}, document.title, window.location.pathname);
    }

    if (error === 'login') {
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: 'Username atau password salah'
        });

        // efek shake tetap dipakai
        document.querySelector('.login-card').classList.add('login-error');

        window.history.replaceState({}, document.title, window.location.pathname);
    }

</script>

</body>
</html>