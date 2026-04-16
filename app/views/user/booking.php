<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<section class="booking-section d-flex align-items-center">
    <div class="container">

        <div class="booking-wrapper shadow">
            <a href="index.php" class="btn-back">
        ← Kembali
        </a>

            <div class="row g-0">

                <!-- LEFT INFO -->
                <div class="col-md-5 booking-left d-flex flex-column justify-content-center">

                    <div>

                        <small class="text-uppercase text-warning mb-2 d-block">
                            Filosofi Kunjungan
                        </small>

                        <h2 class="fw-bold mb-4">
                            Keindahan yang Bermakna
                        </h2>

                        <div class="booking-feature">
                            <div class="icon">🕌</div>
                            <div>
                                <h6>Enam Menara Suci</h6>
                                <p>Melambangkan Rukun Islam dan keindahan arsitektur.</p>
                            </div>
                        </div>

                        <div class="booking-feature">
                            <div class="icon">♿</div>
                            <div>
                                <h6>Aksesibilitas Modern</h6>
                                <p>Fasilitas ramah untuk semua pengunjung.</p>
                            </div>
                        </div>

                        <div class="booking-feature">
                            <div class="icon">📚</div>
                            <div>
                                <h6>Pusat Literasi</h6>
                                <p>Koleksi literatur Islam klasik hingga modern.</p>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- RIGHT FORM -->
                <div class="col-md-7 bg-white p-4">

                    <h4 class="fw-bold mb-3">Formulir Pendaftaran</h4>

                    <form action="index.php?page=proses_booking" method="POST">

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>No Telepon / WhatsApp</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jumlah Orang</label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">Pilih Sesi</label>

                            <div class="d-flex gap-3">

                                <label class="session-card flex-fill">
                                    <input type="radio" name="sesi" value="pagi" checked>
                                    <div>
                                        <strong>Sesi Pagi</strong><br>
                                        <small>08:00 - 12:00</small>
                                    </div>
                                </label>

                                <label class="session-card flex-fill">
                                    <input type="radio" name="sesi" value="sore">
                                    <div>
                                        <strong>Sesi Sore</strong><br>
                                        <small>13:00 - 17:00</small>
                                    </div>
                                </label>

                            </div>
                        </div>

                        <button class="btn btn-warning w-100 mt-3">
                            Konfirmasi Pendaftaran →
                        </button>

                        <p class="text-muted small mt-2 mb-0">
                            Setelah ini akan diarahkan ke WhatsApp untuk melanjutkan ke tahap pembayaran.
                        </p>

                    </form>

                </div>

            </div>
    
        </div>

    </div>
</section>

