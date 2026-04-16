<?php include 'layout/header.php'; ?>

<div class="admin-layout">

<?php include 'layout/sidebar.php'; ?>

<div class="admin-main">
<div class="main-content" id="appTable">

<?php include 'layout/topbar.php'; ?>

<!-- TITLE -->
<div class="mb-4">
    <h2 class="fw-bold mb-1">Tambah Pengunjung</h2>
    <p class="text-muted small">
        Isi data pengunjung baru dengan lengkap dan pastikan sesuai jadwal kunjungan.
    </p>
</div>

<div class="row g-4">

<!-- ================= FORM ================= -->
<div class="col-md-7">

<div class="card admin-card p-4">

<form action="index.php?page=tambah_pengunjung" method="POST">

    <!-- NAMA + EMAIL -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Nama</label>
            <input v-model="nama" name="nama" class="form-control modern-input" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input v-model="email" name="email" type="email" class="form-control modern-input" required>
        </div>
    </div>

    <!-- WA + JUMLAH -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">No WhatsApp</label>
            <input v-model="no_wa" name="no_wa" type="text" class="form-control modern-input" 
                placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Jumlah Pengunjung</label>
            <input v-model="jumlah" name="jumlah" type="number" min="1" class="form-control modern-input" required>
        </div>
    </div>

    <!-- TANGGAL + SESI -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Tanggal Kunjungan</label>
            <input v-model="tanggal" type="date" name="tanggal_kunjungan" class="form-control modern-input" required>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Sesi</label>
            <select v-model="sesi" name="sesi" class="form-select modern-input">
                <option>Pagi</option>
                <option>Siang</option>
                <option>Sore</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select modern-input">
                <option value="Tunggu">Tunggu</option>
                <option value="Check-in">Check-in</option>
                <option value="Selesai">Selesai</option>
                <option value="Dibatalkan">Dibatalkan</option>
            </select>
        </div>
    </div>

    <!-- ACTION -->
    <div class="d-flex justify-content-between mt-4">

        <a href="index.php?page=pengunjung" class="btn btn-outline-secondary">
            ← Kembali
        </a>

        <button class="btn btn-success px-4">
            Simpan Data →
        </button>

    </div>

</form>

</div>

</div>

<!-- ================= SIDE INFO ================= -->
<div class="col-md-5">

<!-- PREVIEW -->
<div class="card admin-card p-4">

    <h6 class="mb-3">Preview Data</h6>

    <div class="small d-flex flex-column gap-2">

        <div>
            <span class="text-muted">Nama</span><br>
            <strong>{{ nama || '-' }}</strong>
        </div>

        <div>
            <span class="text-muted">Email</span><br>
            {{ email || '-' }}
        </div>

        <div>
            <span class="text-muted">WhatsApp</span><br>
            {{ no_wa || '-' }}
        </div>

        <div>
            <span class="text-muted">Tanggal</span><br>
            {{ tanggal || '-' }}
        </div>

        <div>
            <span class="text-muted">Sesi</span><br>
            <span class="badge bg-light text-dark">{{ sesi }}</span>
        </div>

        <div>
            <span class="text-muted">Status</span><br>
            {{ status  || '-'}}
        </div>

        <div>
            <span class="text-muted">Jumlah</span><br>
            <strong>{{ jumlah }} orang</strong>
        </div>

    </div>

</div>

<!-- INFO BOX -->
<div class="card admin-card p-4 mt-3">

    <h6>Informasi</h6>

    <ul class="small text-muted mt-2 mb-0">
        <li>Pastikan tanggal sesuai dengan jadwal operasional</li>
        <li>Satu sesi memiliki kapasitas terbatas</li>
        <li>Gunakan nomor aktif untuk konfirmasi</li>
    </ul>

</div>

</div>

</div>

</div>

<?php include 'layout/footer.php'; ?>

</div>
</div>