<?php include 'layout/header.php'; ?>

<div class="admin-layout">

<?php include 'layout/sidebar.php'; ?>

<div class="admin-main">
<div class="main-content" id="appTable">

<?php include 'layout/topbar.php'; ?>

<!-- BACK -->
<div class="mb-3">
    <a href="index.php?page=pengunjung" class="text-muted small">
        ← Kembali ke Pengunjung
    </a>
</div>

<!-- TITLE -->
<div class="mb-4">
    <h2 class="fw-bold mb-1">Edit Data Pengunjung</h2>
    <p class="text-muted small">
        Perbarui informasi pengunjung dan pastikan data sesuai dengan booking.
    </p>
</div>

<div class="row g-4">

<!-- ================= FORM ================= -->
<div class="col-md-7">

<div class="card admin-card p-4">

<form action="index.php?page=update_pengunjung" method="POST">

<input type="hidden" name="id" v-model="editData.id">

<!-- NAMA -->
<div class="mb-3">
    <label class="form-label fw-semibold">Nama Pengunjung</label>
    <input v-model="editData.nama" name="nama" class="form-control modern-input">
</div>

<!-- WA -->
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">No WhatsApp</label>
        <input v-model="editData.no_wa" name="no_wa" class="form-control modern-input">
    </div>
</div>

<!-- SESI + TANGGAL -->
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Sesi Kunjungan</label>
        <select v-model="editData.sesi" name="sesi" class="form-select modern-input">
            <option>Pagi</option>
            <option>Siang</option>
            <option>Sore</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Tanggal Kunjungan</label>
            <input 
                type="date"
                name="tanggal_kunjungan"
                class="form-control modern-input"
                v-model="editData.tanggal"
            >
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select modern-input">
            <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
            <option value="Dibayar">Dibayar</option>
            <option value="Selesai">Selesai</option>
            <option value="Dibatalkan">Dibatalkan</option>
        </select>
    </div>
</div>

<!-- JUMLAH -->
<div class="mb-3">
    <label class="form-label fw-semibold">Jumlah Pengunjung</label>
    <input v-model="editData.jumlah" name="jumlah" class="form-control modern-input">
</div>

<!-- ACTION -->
<div class="mt-4 d-flex gap-2">

    <button class="btn btn-success px-4">
        💾 Simpan Perubahan
    </button>

    <a href="index.php?page=pengunjung" class="btn btn-outline-secondary">
        Batal
    </a>

</div>

</form>

</div>

</div>

<!-- ================= SIDE INFO ================= -->
<div class="col-md-5">

<!-- CARD INFO -->
<div class="card admin-card p-4">

    <h6 class="mb-3">Ringkasan Data</h6>

    <div class="d-flex flex-column gap-2 small">

        <div>
            <span class="text-muted">Nama</span><br>
            <strong>{{ editData.nama }}</strong>
        </div>

        <div>
            <span class="text-muted">Email</span><br>
            {{ editData.email || '-' }}
        </div>

        <div>
            <span class="text-muted">WhatsApp</span><br>
            {{ editData.no_wa || '-' }}
        </div>

        <div>
            <span class="text-muted">Sesi</span><br>
            <span class="badge bg-light text-dark">{{ editData.sesi }}</span>
        </div>

        <div>
            <span class="text-muted">Status</span><br>
            {{ editData.status  || '-'}}
        </div>

        <div>
            <span class="text-muted">Jumlah</span><br>
            <strong>{{ editData.jumlah }} orang</strong>
        </div>

    </div>

</div>

<!-- STATUS INFO -->
<div class="card admin-card p-4 mt-3">

    <h6>Status & Info</h6>

    <div class="mt-3">
        <span class="badge bg-success">Data Aktif</span>
    </div>

    <div class="mt-3 small text-muted">
        Update terakhir<br>
        <?= date('d M Y H:i') ?>
    </div>

</div>

</div>

</div>

</div>

<script>
window.initialData = {
    editData: {
        id: <?= $pengunjung['id'] ?? 'null' ?>,
        nama: "<?= $pengunjung['nama'] ?? '' ?>",
        email: "<?= $pengunjung['email'] ?? '' ?>",
        no_wa: "<?= $pengunjung['no_wa'] ?? '' ?>",
        sesi: "<?= $pengunjung['sesi'] ?? 'Pagi' ?>",
        jumlah: <?= $pengunjung['jumlah'] ?? 1 ?>,
        tanggal: "<?= $pengunjung['tanggal_kunjungan'] ?? '' ?>",
        status: "<?= $pengunjung['status'] ?? 'Tunggu' ?>"
    }
};
</script>

<?php include 'layout/footer.php'; ?>

</div>
</div>