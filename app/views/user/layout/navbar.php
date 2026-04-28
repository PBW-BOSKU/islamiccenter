<?php if (!isset($_GET['page']) || $_GET['page'] != 'booking'): ?>

<nav class="navbar navbar-expand-lg fixed-top navbar-custom">
<div class="container-fluid px-4">

    <!-- LOGO -->
    <a class="navbar-brand" href="/beranda" data-section="beranda">
        <div class="logo-wrap">
            <img
                src="assets/images/logonewislamic.png"
                alt="Logo Menara Islamic Center">
        </div>
    </a>


    <!-- TOGGLER -->
    <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navMenu">

        <span class="navbar-toggler-icon"></span>

    </button>


    <!-- MENU -->
    <div class="collapse navbar-collapse justify-content-end" id="navMenu">

        <ul class="navbar-nav">

            <li class="nav-item">
                <a
                href="/beranda"
                class="nav-link"
                data-section="beranda">
                Beranda
                </a>
            </li>


            <li class="nav-item">
                <a
                href="/galeri"
                class="nav-link"
                data-section="galeri">
                Galeri
                </a>
            </li>


            <li class="nav-item">
                <a
                href="/filosofi"
                class="nav-link"
                data-section="filosofi">
                Filosofi
                </a>
            </li>


            <li class="nav-item">
                <a
                href="/fasilitas"
                class="nav-link"
                data-section="fasilitas">
                Fasilitas
                </a>
            </li>


            <li class="nav-item">
                <a
                href="/review"
                class="nav-link"
                data-section="review">
                Review
                </a>
            </li>


            <li class="nav-item">
                <a
                href="/lokasi"
                class="nav-link"
                data-section="lokasi">
                Lokasi
                </a>
            </li>

        </ul>

    </div>

</div>
</nav>

<?php endif; ?>