<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<?php $today = date('Y-m-d'); ?>

<section class="booking-section d-flex align-items-center justify-content-center">
    <div class="container d-flex justify-content-center">

        <div class="booking-wrapper shadow mx-auto" style="max-width:900px; width:100%;">

            <a href="index.php" class="btn-back">
                ← Kembali
            </a>

            <div class="row g-0">

                <!-- LEFT PANEL -->
                <div class="col-12 col-lg-5 booking-left d-flex flex-column justify-content-center">

                    <small class="text-uppercase text-warning mb-2 d-block">
                        Peraturan Kunjungan
                    </small>

                    <h2 class="fw-bold mb-4">
                        Aturan Naik Menara
                    </h2>

                    <div class="booking-feature">
                        <div class="icon">🧕</div>
                        <div>
                            <h6>Berpakaian Sopan</h6>
                            <p>Gunakan pakaian yang menutup aurat dan rapi.</p>
                        </div>
                    </div>

                    <div class="booking-feature">
                        <div class="icon">🕒</div>
                        <div>
                            <h6>Tepat Waktu</h6>
                            <p>Datang sesuai sesi yang dipilih.</p>
                        </div>
                    </div>

                    <div class="booking-feature">
                        <div class="icon">🚫</div>
                        <div>
                            <h6>Dilarang Berisik</h6>
                            <p>Jaga ketenangan dan kenyamanan pengunjung lain.</p>
                        </div>
                    </div>

                    <div class="booking-feature">
                        <div class="icon">📵</div>
                        <div>
                            <h6>Ikuti Petugas</h6>
                            <p>Patuhi arahan dari petugas selama kunjungan.</p>
                        </div>
                    </div>

                </div>


                <!-- RIGHT FORM -->
                <div class="col-12 col-lg-7 bg-white p-4 booking-right">

                    <h4 class="fw-bold mb-3">
                        Formulir Pendaftaran
                    </h4>

                    <form
                        id="bookingForm"
                        novalidate
                        @submit.prevent="submitBooking($event)"
>

                        <div class="mb-3">
                            <label>Nama Lengkap</label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                placeholder="Masukkan Nama Lengkap"
                                oninput="this.value=this.value.replace(/[0-9]/g,'')"
                                required
                            >
                        </div>


                        <div class="mb-3">
                            <label>No Telepon / WhatsApp</label>

                            <input
                                type="tel"
                                name="no_wa"
                                class="form-control"
                                maxlength="15"
                                placeholder="Masukkan Nomor WhatsApp"
                                oninput="
                                    this.value=this.value.replace(/[^0-9]/g,'');
                                    if(this.value.startsWith('0')){
                                        this.value='62'+this.value.substring(1);
                                    }
                                "
                                required
                            >
                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Tanggal</label>

                                <input
                                    type="date"
                                    name="tanggal"
                                    class="form-control"
                                    v-model="tanggal"
                                    @change="cekKapasitas"
                                    min="<?= $today ?>"
                                    required
                                >
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>Jumlah Orang</label>

                                <input
                                    type="number"
                                    name="jumlah"
                                    class="form-control"
                                    min="1"
                                    max="200"
                                    step="1"
                                    oninput="
                                        if(this.value<1)this.value=1;
                                        if(this.value>200)this.value=200;
                                    "
                                    required
                                >
                            </div>

                        </div>


                        <!-- KAPASITAS -->
                        <div class="mb-3" v-if="kapasitas">

                            <div class="p-2 border rounded small bg-light">

                                <div class="d-flex justify-content-between">
                                    <span>Kapasitas</span>
                                    <strong>
                                        {{ kapasitas.terisi }} / {{ kapasitas.max }}
                                    </strong>
                                </div>

                                <div class="progress mt-2" style="height:6px;">
                                    <div
                                        class="progress-bar bg-success"
                                        :style="{ width: kapasitas.persen + '%' }">
                                    </div>
                                </div>

                                <small
                                  :class="kapasitas.sisa <=10 ? 'text-danger':'text-success'">
                                    Sisa {{ kapasitas.sisa }} orang
                                </small>

                            </div>

                        </div>


                        <!-- SESI -->
                        <div class="mb-3">

                            <label class="mb-2">Pilih Sesi</label>

                            <div class="d-flex gap-3 flex-wrap">

                                <label class="session-card flex-fill">
                                    <input
                                        type="radio"
                                        name="sesi"
                                        value="pagi"
                                        checked
                                        @change="cekKapasitas"
                                    >
                                    <div>
                                        <strong>Sesi Pagi</strong><br>
                                        <small>08:00 - 11:00</small>
                                    </div>
                                </label>

                                <label class="session-card flex-fill">
                                    <input
                                        type="radio"
                                        name="sesi"
                                        value="siang"
                                        @change="cekKapasitas"
                                    >
                                    <div>
                                        <strong>Sesi Siang</strong><br>
                                        <small>11:30 - 14:30</small>
                                    </div>
                                </label>

                                <label class="session-card flex-fill">
                                <input
                                        type="radio"
                                        name="sesi"
                                        value="sore"
                                        @change="cekKapasitas"
                                    >
                                    <div>
                                        <strong>Sesi Sore</strong><br>
                                        <small>15:00 - 18:00</small>
                                    </div>
                                </label>

                            </div>

                        </div>


                        <button
                            id="bookingBtn"
                            type="submit"
                            class="btn btn-warning w-100 mt-3"
                            :disabled="bookingLoading"
                        >

                            <span v-if="!bookingLoading">
                                Konfirmasi Pendaftaran →
                            </span>

                            <span v-else>
                                Memproses...
                            </span>

                        </button>


                        <p class="text-muted small mt-2 mb-0">
                            Setelah ini akan diarahkan ke WhatsApp
                            untuk melanjutkan pembayaran.
                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>

<?php include 'layout/footer.php'; ?>