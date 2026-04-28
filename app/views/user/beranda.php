<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<div id="app" v-cloak>

<!-- ================= HERO ================= -->
<section id="beranda" class="hero-section text-white fade-section cinematic-parallax">
    <div class="container">

        <transition name="fade-up">
            <div v-show="showHero" class="col-lg-7">

                <h1 class="display-3 fw-bold mb-4">
                    Keajaiban di Tepi <span class="text-warning">Mahakam</span>
                </h1>

                <p class="lead mb-4">
                    Berdiri kokoh sebagai ikon kebanggaan Samarinda. Menara Islamic Center menawarkan lanskap memukau dan pengalaman visual yang tak terlupakan dari puncaknya.
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

    <div class="text-center mb-4 galeri-title">
        <h2 class="fw-bold">
            Pesona Menara Utama
        </h2>

        <p class="text-muted">
            Mengabadikan keagungan arsitektur dan pesona visual ikon religi kebanggaan Samarinda.
        </p>
    </div>


    <div class="galeri-review-scroll">

        <?php if(!empty($galeri)): ?>
            <?php foreach($galeri as $g): ?>

            <div class="galeri-review-item">

                <div
                    class="galeri-card reveal tilt-card"
                    @click="openImage(
                    '/assets/images/<?= $g['gambar'] ?>',
                    '<?= htmlspecialchars($g['judul'],ENT_QUOTES) ?>',
                    '<?= htmlspecialchars($g['deskripsi'] ?: 'Tidak ada deskripsi', ENT_QUOTES) ?>'
                    )"
                
                >

                    <img
                        src="/assets/images/<?= $g['gambar'] ?>"
                        alt="<?= htmlspecialchars($g['judul']) ?>"
                    >

                    <div class="overlay">
                        <h6>
                            <?= htmlspecialchars($g['judul']) ?>
                        </h6>
                    </div>

                </div>

            </div>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>

</section>


<!-- ================= MODAL ================= -->
<div
v-if="selectedImage"
v-cloak
class="galeri-modal"
@click="closeImage"
>

<div
class="modal-card"
@click.stop
>

<span
class="close-btn"
@click="closeImage"
>
&times;
</span>

<img
:src="selectedImage"
class="modal-img"
>

<div class="modal-body">

<h4>
{{ selectedTitle }}
</h4>

<p class="modal-description">
{{ selectedDesc || 'Tidak ada deskripsi' }}
</p>

</div>

</div>

</div>

<!-- ================= FILOSOFI ================= -->
<section id="filosofi" class="py-5 filosofi-section fade-section">
    <div class="container">

        <div class="row filosofi-row">

            <!-- IMAGE -->
                <div class="col-md-6 d-flex">

                    <transition name="slide-left">

                        <div
                            v-if="showFilosofi"
                            class="filosofi-img full-height-image"
                        >
                            <img
                                src="/assets/images/menara.jpg"
                                alt="Menara Islamic Center"
                            >
                        </div>

                    </transition>

                </div>

            <!-- TEXT -->
            <div class="col-md-6">

                <transition name="fade-up">
                    <div>

                        <small class="text-uppercase text-muted">
                            FILOSOFI ISLAMIC
                        </small>

                        <h2 class="fw-bold mb-4">
                            Keindahan yang Bermakna
                        </h2>

                        <div class="d-flex flex-column gap-3">

                            <!-- CARD 1 -->
                            <div class="filosofi-card reveal">
                                <div class="tilt-card">
                                <h5>Menara Islamic Center Samarinda</h5>
                                <p>Menara utama setinggi 99 meter melambangkan Asmaul Husna (99 nama Allah), 
                                    sebagai pengingat keagungan dan sifat-sifat Allah</p>
                                </div>
                            </div>

                            <!-- CARD 2 -->
                            <div class="filosofi-card reveal">
                                <div class="tilt-card">
                                <h5>Bentuk Ahad pada Ceiling</h5>
                                <p>Ornamen ini terinspirasi dari bentuk tulisan “Ahad” dalam huruf Arab. 
                                    Tidak termasuk kaligrafi, melainkan hanya mengambil bentuk visualnya sebagai elemen desain.</p>
                                </div>
                            </div>

                            <!-- CARD 3 -->
                            <div class="filosofi-card reveal">
                                <div class="tilt-card">
                                <h5>Masjid Baitul Muttaqien</h5>
                                <p>Masjid megah di tepi Sungai Mahakam ini melambangkan rukun Islam melalui lima pintu gerbangnya.</p>
                                </div>
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

<div class="container" style="max-width:1100px;">

    <div class="text-center mb-5">
        <h2 class="fw-bold">
            Fasilitas & Keunggulan
        </h2>

        <p class="text-muted">
            Menghadirkan kenyamanan maksimal untuk setiap momen kunjungan Anda.
        </p>
    </div>


    <div class="row g-4 mt-3 justify-content-center">

        <!-- CARD 1 -->
        <div class="col-md-6">

            <div
                class="fasilitas-card reveal fasilitas-click"
                data-gallery="
                cafeteria.jpg,
                lobby.jpeg,
                lobby2.jpeg">

                <div class="tilt-card">

                    <img
                        src="/assets/images/cafeteria.jpg"
                        class="fasilitas-img"
                        alt="Cafeteria"
                    >

                    <div class="content">

                        <div class="facility-body">
                            <h5>
                                Cafeteria Nyaman
                            </h5>

                            <p>
                                Area bersantai dengan suasana nyaman
                                serta pilihan makanan dan minuman
                                yang beragam.
                            </p>
                        </div>

                        <span class="facility-readmore">
                            Lihat Detail →
                        </span>

                    </div>

                </div>

            </div>

        </div>



        <!-- CARD 2 -->
        <div class="col-md-6">

            <div
                class="fasilitas-card reveal fasilitas-click"
                data-gallery="
                lift.jpg,
                lift1.jpeg,
                lift2.jpeg">

                <div class="tilt-card">

                    <img
                        src="/assets/images/lift.jpg"
                        class="fasilitas-img"
                        alt="Lift"
                    >

                    <div class="content">

                        <div class="facility-body">
                            <h5>
                                Akses Lift Modern
                            </h5>

                            <p>
                                Fasilitas lift modern yang menjamin perjalanan cepat, aman, dan nyaman menuju puncak menara.
                            </p>
                        </div>

                        <span class="facility-readmore">
                            Lihat Detail →
                        </span>

                    </div>

                </div>

            </div>

        </div>



        <!-- CARD 3 -->
        <div class="col-md-6">

            <div
                class="fasilitas-card reveal fasilitas-click"
                data-gallery="
                parkiran.jpeg,
                viewatas1.jpeg,
                pintumasuk1.jpg">

                <div class="tilt-card">

                    <img
                        src="assets/images/parkiran.jpeg"
                        class="fasilitas-img"
                        alt="Parkir"
                    >

                    <div class="content">

                        <div class="facility-body">
                            <h5>
                                Area Parkir Luas
                            </h5>

                            <p>
                                Kapasitas parkir yang memadai, tertata rapi, dan mudah diakses untuk berbagai jenis kendaraan.
                            </p>
                        </div>

                        <span class="facility-readmore">
                            Lihat Detail →
                        </span>

                    </div>

                </div>

            </div>

        </div>



        <!-- CARD 4 -->
        <div class="col-md-6">

            <div
                class="fasilitas-card reveal fasilitas-click"
                data-gallery="
                informasi.jpeg,
                informasi1.jpeg,
                informasi2.jpeg">

                <div class="tilt-card">

                    <img
                        src="assets/images/informasi.jpeg"
                        class="fasilitas-img"
                        alt="Informasi"
                    >

                    <div class="content">

                        <div class="facility-body">
                            <h5>
                                Informasi terkait menara
                            </h5>

                            <p>
                                Pelajari nilai historis bangunan ini sekaligus nikmati pesona lanskap Kota Samarinda dari ketinggian.
                            </p>
                        </div>

                        <span class="facility-readmore">
                            Lihat Detail →
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</section>



<!-- ================= LIGHTBOX MODAL ================= -->

<div id="fasilitasModal" class="fasilitas-modal">

    <div class="fasilitas-modal-box">

        <button
            id="closeFasilitasModal"
            class="fasilitas-close">
            &times;
        </button>


        <button
            id="prevFacility"
            class="facility-nav prev">
            ‹
        </button>


        <img
            id="facilityImage"
            src=""
            alt=""
        >


        <button
            id="nextFacility"
            class="facility-nav next">
            ›
        </button>


        <!-- DOTS -->
        <div
            id="facilityDots"
            class="facility-dots">
        </div>


        <!-- THUMBNAILS -->
        <div
            id="facilityThumbs"
            class="facility-thumbs">
        </div>

    </div>

</div>

<!-- ================= REVIEW ================= -->
<section id="review" class="review-section py-5 fade-section">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Jejak Kesan & Pesan</h2>
            <p class="text-muted">
                Dengarkan langsung cerita dan pengalaman berharga dari mereka yang telah berkunjung.
            </p>
        </div>

        <!-- SUMMARY -->
        <div class="text-center mb-4">
            <?php
                $total = count($review);
                $avg = 0;

                if ($total > 0) {
                    $sum = array_sum(array_column($review,'rating'));
                    $avg = round($sum / $total,1);
                }
            ?>

            <h3 class="fw-bold"><?= $avg ?> ⭐</h3>

            <small class="text-muted">
                Dari <?= $total ?> pengunjung
            </small>
        </div>

        <!-- BUTTON TRIGGER -->
        <div class="text-center mb-5">
            <button
            class="btn btn-warning"
            @click="openReviewForm"
            :class="{ 'review-bounce': reviewButtonAnimate }"
            >
            Tambah Review
            </button>
        </div>


        <!-- REVIEW GALLERY -->
        <div class="review-gallery">

            <template v-if="reviews.length > 0">

                <div
                    v-for="r in reviews"
                    :key="r.id"
                    class="review-grid-item">

                    <div
                        class="review-card-xl reveal tilt-card"
                        @click="openReviewDetail(r)">

                        <!-- IMAGE -->
                        <div
                            v-if="r.gambar"
                            class="review-image-wrap">

                            <img
                                :src="r.gambar"
                                :alt="r.nama"
                                class="review-image">

                        </div>


                        <div class="review-card-body">

                            <div class="review-meta">

                                <div class="stars">
                                    {{ '⭐'.repeat(r.rating) }}
                                </div>

                                <small class="review-time">
                                    {{ r.created_at }}
                                </small>

                            </div>


                            <h5 class="review-name">
                                {{ r.nama }}
                            </h5>


                            <p class="review-comment truncate-text">
                                {{ r.komentar }}
                            </p>


                            <span class="read-more">
                                Baca selengkapnya →
                            </span>

                        </div>

                    </div>

                </div>

            </template>


            <p
                v-else
                class="text-center text-muted">

                Belum ada review

            </p>

        </div>

    </div>
</section>



<!-- ================= MODAL FORM REVIEW ================= -->
<div
    v-if="showReviewModal"
    class="review-modal-backdrop"
    @click="showReviewModal=false">

    <div
        class="review-modal-card"
        @click.stop>

        <button
            class="review-close"
            @click="showReviewModal=false">

            &times;

        </button>


        <h3 class="mb-4">
            Tambah Review
        </h3>


        <form
            novalidate
            @submit.prevent="submitReview"
            enctype="multipart/form-data">

            <!-- FOTO -->
            <div class="mb-3">

                <label>Upload Foto</label>

                <input
                    type="file"
                    class="form-control"
                    accept="image/*"
                    @change="handleReviewImage"
                >

                <small class="text-muted d-block mt-1">
                    Format: JPG, PNG, JPEG (Maks 2MB)
                </small>

            </div>


            <!-- NAMA -->
            <div class="mb-3">

                <label>Nama</label>

                <input
                    type="text"
                    maxlength="50"
                    v-model="form.nama"
                    class="form-control"
                >

                <small>
                    {{ form.nama.length }}/50
                </small>

                <div
                    v-if="reviewErrors.nama"
                    class="review-error"
                >
                    ⚠ {{ reviewErrors.nama }}
                </div>

            </div>


            <!-- SESI -->
            <div class="mb-3">

                <label>Sesi Kunjungan</label>

                <select
                    v-model="form.sesi"
                    class="form-control"
                    >

                    <option value="Pagi">Pagi</option>
                    <option value="Siang">Siang</option>
                    <option value="Sore">Sore</option>

                </select>

            </div>


            <!-- KOMENTAR -->
            <div class="mb-3">

                <label>Pengalaman</label>

                <textarea
                    maxlength="300"
                    v-model="form.komentar"
                    class="form-control"
                ></textarea>

                <small>
                    {{ form.komentar.length }}/300
                </small>

                    <div
                        v-if="reviewErrors.komentar"
                        class="review-error"
                    >
                        ⚠ {{ reviewErrors.komentar }}
                    </div>

            </div>


            <!-- STAR -->
            <div class="star-rating mb-4">

                <span
                    v-for="i in 5"
                    :key="i"
                    class="star"
                    :class="{ active: i <= (hoverRating || rating) }"
                    @click="rating=i"
                    @mouseover="hoverRating=i"
                    @mouseleave="hoverRating=0"
                >
                    ★
                </span>

                    <div
                        v-if="reviewErrors.rating"
                        class="review-rating-error"
                    >
                        ⚠ {{ reviewErrors.rating }}
                    </div>

            </div>


            <div class="d-flex gap-3">

                <button
                    type="button"
                    class="btn btn-secondary"
                    @click="showReviewModal=false">

                    Cancel

                </button>


                <button
                    type="submit"
                    class="btn btn-success">

                    Submit Review

                </button>

            </div>

        </form>

    </div>

</div>




<!-- ================= MODAL DETAIL REVIEW ================= -->
<div
v-if="activeReview"
class="review-modal-backdrop"
@click="activeReview=null"
>

<div
class="review-modal-card detail-mode"
@click.stop
>

<button
class="review-close"
@click="activeReview=null"
>
&times;
</button>


<div
v-if="activeReview.gambar"
class="detail-image-wrap"
>
<img
:src="activeReview.gambar"
class="detail-image"
>
</div>


<div class="review-detail-content">

<h4 class="review-detail-title">
{{ activeReview.nama }}
</h4>


<div class="review-detail-meta">

<span class="review-session-badge">
{{ activeReview.sesi }}
</span>

<span>
{{ activeReview.created_at }}
</span>

</div>


<p class="review-detail-text">
{{ activeReview.komentar }}
</p>

</div>

</div>

</div>

<!-- ================= MAPS ================= -->
<section id="lokasi" class="maps-section py-5 fade-section">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Rencanakan Kunjungan Anda</h2>
            <p class="text-muted">Temukan kemudahan akses menuju Menara Islamic Center dan nikmati kemegahannya dari dekat.</p>
        </div>

        <!-- MAP CARD -->
        <div class="map-card reveal float-depth">

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

<transition name="toast-pop">
    <div v-if="showReviewToast" class="floating-toast">
        ✅ Review berhasil dikirim!
    </div>
</transition>

</div>

<?php include 'layout/footer.php'; ?>

<script id="initialReview" type="application/json">
<?= json_encode($review) ?>
</script>