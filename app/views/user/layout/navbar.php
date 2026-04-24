<?php if (!isset($_GET['page']) || $_GET['page'] != 'booking'): ?>

<nav class="navbar navbar-expand-lg fixed-top navbar-custom">
    <div class="container-fluid px-4">

        <a class="navbar-brand" href="#">
            <img src="assets/images/menaraislamic.png" alt="Logo Menara Islamic Center" width="50" height="auto">
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link fw-bold fs-5" href="#beranda">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold fs-5" href="#galeri">Galeri</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold fs-5" href="#filosofi">Filosofi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold fs-5" href="#fasilitas">Fasilitas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold fs-5" href="#review">Review</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold fs-5" href="#lokasi">Lokasi</a>
                </li>

            </ul>
        </div>

    </div>
</nav>

<?php endif; ?>