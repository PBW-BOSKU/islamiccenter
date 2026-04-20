<?php include 'layout/header.php'; ?>

<div class="admin-layout">

<?php include 'layout/sidebar.php'; ?>

    <div v-if="showSidebar"
            class="sidebar-overlay"
            @click="showSidebar = false">
    </div>

<div class="admin-main">
<div class="main-content" id="appTable">

<?php include 'layout/topbar.php'; ?>

<!-- ================= TITLE ================= -->
<h2 class="fw-bold mb-4">Unggah Galeri Baru</h2>

<!-- ================= FORM ================= -->
<form action="index.php?page=tambah_galeri" method="POST" enctype="multipart/form-data">

<div class="row g-4 align-items-start fade-up">

    <!-- LEFT -->
    <div class="col-md-5">
        <div class="upload-box text-center p-4" @click="$refs.file.click()">

            <input type="file" 
                name="gambar" 
                ref="file"
                @change="previewImage"
                hidden>

            <div v-if="!preview">
                <i class="bi bi-cloud-upload fs-1"></i>
                <p class="mt-2 mb-0">Seret atau klik untuk upload gambar</p>
            </div>

            <img v-if="preview" :src="preview" class="preview-img mt-2">

        </div>
    </div>

    <!-- RIGHT -->
    <div class="col-md-7">
        <div class="d-flex flex-column gap-3">

            <input 
                type="text" 
                name="judul" 
                class="form-control modern-input"
                placeholder="Judul Galeri"
                required
            >

            <textarea 
                name="deskripsi" 
                class="form-control modern-input" 
                rows="5"
                placeholder="Deskripsi narasi..."
            ></textarea>

            <button class="btn btn-success align-self-start px-4">
                Publikasikan →
            </button>

        </div>
    </div>

</div>

</form>

<!-- ================= LIST ================= -->
<div class="row g-4 mt-3">

<?php if (!empty($galeri)): ?>

<?php foreach ($galeri as $g): ?>

<div class="col-md-4 fade-up">
    <div class="galeri-card">

        <!-- IMAGE -->
        <img 
            src="assets/images/<?= $g['gambar'] ?>" 
            @click="previewFull('<?= $g['gambar'] ?>')"
        >

        <!-- OVERLAY -->
        <div class="galeri-overlay">

            <h6 class="mb-1"><?= $g['judul'] ?></h6>

            <small class="d-block mb-2">
                <?= date('d M Y', strtotime($g['created_at'])) ?>
            </small>

            <p class="small mb-2">
                <?= substr($g['deskripsi'], 0, 60) ?>...
            </p>

            <div class="d-flex gap-2">

                <!-- EDIT -->
                <button 
                    class="btn btn-sm btn-warning"
                    @click.stop="openEditFromElement($event)"
                    
                    data-id="<?= $g['id'] ?>"
                    data-judul="<?= htmlspecialchars($g['judul']) ?>"
                    data-deskripsi="<?= htmlspecialchars($g['deskripsi']) ?>"
                    data-gambar="<?= $g['gambar'] ?>"
                >
                    Edit
                </button>

                <!-- DELETE -->
                <button 
                    class="btn btn-sm btn-danger"
                    @click.stop="confirmDelete('index.php?page=hapus_galeri&id=<?= $g['id'] ?>')">
                    Hapus
                </button>

            </div>

        </div>

    </div>
</div>

    <?php endforeach; ?>
<?php else: ?>

<p class="text-muted">Belum ada galeri</p>

<?php endif; ?>

</div>

<!-- ================= MODAL EDIT (PINDAH KE LUAR LOOP) ================= -->
<div class="modal fade" id="editModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content p-3">

    <h5 class="mb-3">Edit Galeri</h5>

    <form action="index.php?page=update_galeri" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" :value="editData.id">

        <!-- JUDUL -->
        <div class="mb-2">
            <label class="small">Judul</label>
            <input type="text" 
                name="judul" 
                class="form-control"
                v-model="editData.judul"
                required>
        </div>

        <!-- DESKRIPSI -->
        <div class="mb-2">
            <label class="small">Deskripsi</label>
            <textarea 
                name="deskripsi"
                class="form-control"
                rows="3"
                v-model="editData.deskripsi"></textarea>
        </div>

        <!-- GAMBAR BARU -->
        <div class="mb-2">
            <label class="small">Ganti Gambar (Opsional)</label>
            <input type="file" 
                name="gambar" 
                class="form-control"
                @change="previewEditImage">
        </div>

        <!-- PREVIEW -->
        <div class="text-center mt-2">
            <img 
                :src="editPreview ? editPreview : 'assets/images/' + editData.gambar" 
                class="img-fluid rounded"
                style="max-height:200px">
        </div>

        <button class="btn btn-success w-100 mt-3">
            Simpan Perubahan
        </button>

    </form>

</div>
</div>
</div>

<div class="modal fade" id="previewModal" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content bg-dark text-center p-3">

        <img :src="'assets/images/' + previewImageFull" class="img-fluid rounded">

    </div>
</div>
</div>

</div>
<?php include 'layout/footer.php'; ?>
</div>
</div>