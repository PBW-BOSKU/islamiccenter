<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<div id="app">

<!-- ================= HERO ================= -->
<section id="beranda" class="hero-section text-white fade-section">
    <div class="container">

        <transition name="fade-up">
            <div v-show="showHero" class="col-lg-7">

                <h1 class="display-3 fw-bold mb-4">
                    Keajaiban di Tepi <span class="text-warning">Mahakam</span>
                </h1>

                <p class="lead mb-4">
                    Menara Islamic Center Samarinda menjulang megah dengan pesona yang memikat, 
                    menghadirkan panorama indah dari ketinggian yang membuat siapa pun tertarik untuk melihatnya lebih dekat.
                </p>

                <a href="index.php?page=booking" class="btn btn-warning me-3">
                    PESAN TIKET
                </a>

            </div>
        </transition>

    </div>
</section>

<!-- ================= GALERI ================= -->
<section id="galeri" class="fade-section">
    <div class="text-center mb-5 galeri-title">
        <h2 class="fw-bold">Galeri Menara Islamic Center Samarinda</h2>
        <p class="text-muted">
            Keindahan arsitektur dan suasana yang memukau
        </p>
    </div>

    <div class="galeri-wrapper">
        <div class="row g-4 justify-content-center">

            <?php if (!empty($galeri)): ?>
                <?php foreach ($galeri as $g): ?>

                <div class="col-md-6">

                    <div class="galeri-item besar"
                        @click="openImage(
                            'assets/images/<?= $g['gambar'] ?>',
                            '<?= htmlspecialchars($g['judul']) ?>',
                            '<?= htmlspecialchars($g['deskripsi']) ?>'
                        )">

                        <img 
                            src="assets/images/<?= $g['gambar'] ?>" 
                            alt="<?= htmlspecialchars($g['judul']) ?>"
                        >

                        <div class="overlay">
                            <h5><?= htmlspecialchars($g['judul']) ?></h5>
                            <p>
                                <?= strlen($g['deskripsi']) > 80 
                                    ? substr($g['deskripsi'], 0, 80) . '...' 
                                    : $g['deskripsi'] ?>
                            </p>
                        </div>

                    </div>

                </div>

                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>


<!-- ================= MODAL ================= -->
<div v-if="selectedImage" class="galeri-modal" @click="closeImage">

    <div class="modal-card" @click.stop>

        <!-- CLOSE -->
        <span class="close-btn" @click="closeImage">&times;</span>

        <!-- IMAGE -->
        <img :src="selectedImage" class="modal-img">

        <!-- INFO -->
        <div class="modal-body">
            <h4>{{ selectedTitle }}</h4>
            <p>{{ selectedDesc }}</p>
        </div>

    </div>

</div>

<!-- ================= FILOSOFI ================= -->
<section id="filosofi" class="py-5 filosofi-section fade-section">
    <div class="container">

        <div class="row align-items-center">

            <!-- IMAGE -->
            <div class="col-md-6">
                <transition name="slide-left">
                    <div v-if="showFilosofi" class="filosofi-img">
                        <img src="assets/images/menara.jpg" class="img-fluid">
                    </div>
                </transition>
            </div>

            <!-- TEXT -->
            <div class="col-md-6">

                <transition name="fade-up">
                    <div v-if="showFilosofi">

                        <small class="text-uppercase text-muted">
                            FILOSOFI ISLAMIC
                        </small>

                        <h2 class="fw-bold mb-4">
                            Keindahan yang Bermakna
                        </h2>

                        <div class="d-flex flex-column gap-3">

                            <!-- CARD 1 -->
                            <div class="filosofi-card">
                                <h5>Menara Islamic Center Samarinda</h5>
                                <p>Menara utama setinggi 99 meter melambangkan Asmaul Husna (99 nama Allah), 
                                    sebagai pengingat keagungan dan sifat-sifat Allah</p>
                            </div>

                            <!-- CARD 2 -->
                            <div class="filosofi-card">
                                <h5>Bentuk Ahad pada Ceiling</h5>
                                <p>Ornamen ini terinspirasi dari bentuk tulisan “Ahad” dalam huruf Arab. 
                                    Tidak termasuk kaligrafi, melainkan hanya mengambil bentuk visualnya sebagai elemen desain.</p>
                            </div>

                            <!-- CARD 3 -->
                            <div class="filosofi-card">
                                <h5>Masjid Baitul Muttaqien</h5>
                                <p>Masjid megah di tepi Sungai Mahakam ini melambangkan rukun Islam melalui lima pintu gerbangnya.</p>
                            </div>

                        </div>

                    </div>
                </transition>

            </div>

        </div>

    </div>
</section>

<!-- ================= FASILITAS ================= -->
<section id="fasilitas" class="py-5 bg-light fade-section">
    <div class="container" style="max-width: 1100px;">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Fasilitas & Keunggulan</h2>
            <p class="text-muted">Nikmati layanan terbaik</p>
        </div>

        <div class="row g-4 mt-3 justify-content-center">

            <!-- CARD 1 -->
            <div class="col-md-6">
                <div class="fasilitas-card">

                    <img src="assets/images/cafeteria.jpg" class="fasilitas-img">

                    <div class="content">
                        <h5>Cafeteria Nyaman</h5>
                        <p>
                            Area bersantai dengan suasana nyaman serta pilihan makanan dan minuman yang beragam, 
                            cocok untuk beristirahat setelah berkeliling.
                        </p>
                    </div>

                </div>
            </div>

            <!-- CARD 2 -->
            <div class="col-md-6">
                <div class="fasilitas-card">

                    <img src="assets/images/lift.jpg">

                    <div class="content">
                        <h5>Akses Lift Modern</h5>
                        <p>
                            Dilengkapi lift yang memudahkan pengunjung menjangkau puncak menara dengan cepat, 
                            aman, dan nyaman.
                        </p>
                    </div>

                </div>
            </div>

            <!-- CARD 3 -->
            <div class="col-md-6">
                <div class="fasilitas-card">

                    <img src="assets/images/parkiran.jpeg" class="fasilitas-img">

                    <div class="content">
                        <h5>Area Parkir yang luas</h5>
                        <p>
                        Area parkir yang luas dan tertata rapi, mudah diakses, 
                        serta mampu menampung berbagai jenis kendaraan dengan nyaman dan aman bagi pengunjung.
                        </p>
                    </div>

                </div>
            </div>
            
            <!-- CARD 4 -->
            <div class="col-md-6">
                <div class="fasilitas-card">

                    <img src="assets/images/informasi.jpeg" class="fasilitas-img">

                    <div class="content">
                        <h5>Informasi terkait menara</h5>
                        <p>
                        Menara ini menjadi ikon utama dengan pemandangan indah dari ketinggian.
                        </p>
                    </div>

                </div>
            </div>

        </div>
</section>

<!-- ================= REVIEW ================= -->
<section id="review" class="review-section py-5 fade-section">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Apa Kata Pengunjung?</h2>
            <p class="text-muted">Pengalaman mereka di Menara Islamic Center</p>
        </div>

        <!-- RATING SUMMARY -->
        <div class="text-center mb-4">
            <?php 
                $total = count($review);
                $avg = 0;

                if ($total > 0) {
                    $sum = array_sum(array_column($review, 'rating'));
                    $avg = round($sum / $total, 1);
                }
            ?>
            <h3 class="fw-bold"><?= $avg ?> ⭐</h3>
            <small class="text-muted">Dari <?= $total ?> pengunjung</small>
        </div>


        <!-- FORM INPUT -->
        <div class="review-form-card mb-5">

            <h5 class="mb-3">Tulis Review Anda</h5>

            <form action="index.php?page=tambahReview" method="POST">
            <form @submit="if(rating === 0){ alert('Pilih rating dulu!'); return false }" ...>

                <div class="row g-3 align-items-center">

                    <!-- NAMA -->
                    <div class="col-md-6">
                        <input type="text" name="nama" class="form-control modern-input" placeholder="Nama Anda" required>
                    </div>

                    <!-- BINTANG -->
                    <div class="col-md-6">
                        <div class="star-rating">

                            <input type="hidden" name="rating" v-model="rating">

                            <span v-for="i in 5"
                                :key="i"
                                class="star"
                                :class="{ active: i <= (hoverRating || rating) }"
                                @click="rating = i"
                                @mouseover="hoverRating = i"
                                @mouseleave="hoverRating = 0">
                                ★
                            </span>

                        </div>
                    </div>

                    <!-- KOMENTAR -->
                    <div class="col-md-12">
                        <textarea name="komentar" class="form-control modern-input"
                            placeholder="Tulis pengalaman Anda..." required></textarea>
                    </div>

                    <!-- BUTTON -->
                    <div class="col-md-12 text-end">
                        <button class="btn btn-success px-4">Kirim Review</button>
                    </div>

                    <div class="toast-success" v-if="showToast">
                        Review berhasil dikirim!
                    </div>

                </div>

            </form>

        </div>

        <!-- CARD REVIEW -->
        <div class="row g-4 justify-content-center">

            <?php if (!empty($review)): ?>
                <?php foreach ($review as $r): ?>

                <div class="col-md-4">
                    <div class="review-card">

                        <div class="stars">
                            <?= str_repeat('⭐', $r['rating']) ?>
                        </div>

                        <p>"<?= htmlspecialchars($r['komentar']) ?>"</p>

                        <h6>- <?= htmlspecialchars($r['nama']) ?></h6>

                    </div>
                </div>

                <?php endforeach; ?>
            <?php else: ?>

                <p class="text-center text-muted">Belum ada review</p>

            <?php endif; ?>

        </div>

    </div>
</section>

<!-- ================= MAPS ================= -->
<section id="lokasi" class="maps-section py-5 fade-section">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Lokasi Kami</h2>
            <p class="text-muted">Temukan Menara Islamic Center Samarinda</p>
        </div>

        <!-- MAP CARD -->
        <div class="map-card">

            <iframe 
                src="https://www.google.com/maps?q=Islamic+Center+Samarinda&output=embed"
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>

        </div>

        <!-- BUTTON -->
        <div class="text-center mt-4">
            <a href="https://www.google.com/maps?q=Islamic+Center+Samarinda" 
            target="_blank"
            class="btn btn-success px-4">
            Buka di Google Maps
            </a>
        </div>

    </div>
</section>
</div>
<?php include 'layout/footer.php'; ?>