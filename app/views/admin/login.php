<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <link rel="icon" type="image/png" href="/assets/images/logonewislamic.png">

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
        <form 
        action="index.php?page=proses_login"
        method="POST"
        id="loginForm"
        novalidate>

            <!-- USERNAME -->
            <div class="mb-3 text-start">
                <label class="form-label">Nama Pengguna</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" autofocus>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3 text-start">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password">
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

document.getElementById(
'loginForm'
).addEventListener(
'submit',
function(e){

e.preventDefault();

const user=
document.querySelector(
'[name="username"]'
);

const pass=
document.querySelector(
'[name="password"]'
);

if(!user.value.trim()){

Swal.fire({
icon:'warning',
title:'Username kosong',
text:'Masukkan username'
});

user.focus();
return;
}

if(!pass.value.trim()){

Swal.fire({
icon:'warning',
title:'Password kosong',
text:'Masukkan password'
});

pass.focus();
return;
}

document.getElementById(
'loginBtn'
).disabled=true;

document.getElementById(
'btnText'
).innerHTML='Memproses...';

this.submit();

});

</script>

</body>
</html>