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
<form
id="galeriForm"
action="/admin/galeri"
method="POST"
enctype="multipart/form-data"
novalidate>

<div class="row g-4 align-items-start fade-up">

<!-- LEFT -->
<div class="col-md-5">
<div
class="upload-box text-center p-4"
@click="$refs.file.click()"

@dragover.prevent="dragOver=true"
@dragleave="dragOver=false"
@drop.prevent="handleDrop"

:class="{ 'drag-active': dragOver }"
>

<input
type="file"
name="gambar"
id="gambarGaleri"
ref="file"
required
accept="image/*"
@change="previewImage"
hidden>

<div v-if="!preview">
<i class="bi bi-cloud-upload fs-1"></i>
<p class="mt-2 mb-0">
Seret atau klik untuk upload gambar
</p>
</div>

<img
v-if="preview"
:src="preview"
class="preview-img mt-2">

</div>
</div>


<!-- RIGHT -->
<div class="col-md-7">
<div class="d-flex flex-column gap-3">

<input
type="text"
id="judulGaleri"
name="judul"
class="form-control modern-input"
placeholder="Masukkan judul galeri"
maxlength="80">

<small class="text-muted">
Maksimal 80 karakter
</small>


<textarea
name="deskripsi"
class="form-control modern-input"
rows="5"
maxlength="500"
placeholder="Deskripsi Opsional">
</textarea>

<small class="text-muted">
Maksimal 500 karakter
</small>


<button
type="submit"
class="btn btn-success align-self-start px-4">
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
            src="/assets/images/<?= $g['gambar'] ?>"
            @click='previewFull(
            <?= json_encode($g["gambar"]) ?>,
            <?= json_encode($g["judul"]) ?>,
            <?= json_encode($g["deskripsi"]) ?>
            )'
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
                    @click.stop="confirmDelete('/admin/hapus-galeri?id=<?= $g['id'] ?>')"
                >
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

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="editModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content p-3">

    <h5 class="mb-3">Edit Galeri</h5>

    <form action="/admin/update-galeri" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" :value="editData.id">

        <!-- JUDUL -->
        <div class="mb-2">
        <label class="small">
        Judul
        <small class="text-muted">
        ({{ countWords(editData.judul) }}/10 kata)
        </small>
        </label>

        <input
        type="text"
        name="judul"
        v-model="editData.judul"
        class="form-control"
        maxlength="50"  
        required>
        </textarea>

        <small class="text-muted">
        Maksimal 10 kata
        </small>

        </div>


        <!-- DESKRIPSI -->
        <div class="mb-2">
        <label class="small">
        Deskripsi
        <small class="text-muted">
        ({{ countWords(editData.deskripsi) }}/50 kata)
        </small>
        </label>

        <textarea
        name="deskripsi"
        rows="3"
        maxlength="100"
        v-model="editData.deskripsi"
        class="form-control"
        required

        oninput="
        let words=this.value.trim().split(/\s+/);


        "></textarea>

        <small class="text-muted">
        Maksimal 50 kata
        </small>

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
                :src="editPreview ? editPreview : '/assets/images/' + editData.gambar" 
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
<!-- MODAL -->
<div class="modal fade" id="previewModal" tabindex="-1">
<div class="modal-dialog modal-lg">

<div class="modal-content p-0 rounded overflow-hidden">

<img
:src="'/assets/images/' + previewImageFull"
class="img-fluid w-100">

<div class="p-4 bg-white text-start">

<h4 class="mb-2">
{{ selectedTitle }}
</h4>

<p class="modal-description mb-0">
{{ selectedDesc }}
</p>

</div>

</div>

</div>
</div>

<script>
document.addEventListener(
'DOMContentLoaded',
function(){

const form =
document.getElementById(
'galeriForm'
);

if(!form) return;

form.addEventListener(
'submit',
function(e){

e.preventDefault();

const judul =
document.getElementById(
'judulGaleri'
).value.trim();

const fileInput =
document.getElementById(
'gambarGaleri'
);


/* VALIDASI FILE REAL */
if(
!fileInput ||
!fileInput.files ||
fileInput.files.length===0
){

Swal.fire({
icon:'warning',
title:'Upload gambar dulu',
text:'Belum ada gambar dipilih'
});

return;
}


/* VALIDASI JUDUL */
if(!judul){

Swal.fire({
icon:'warning',
title:'Judul kosong',
text:'Masukkan judul galeri'
});

return;
}


/* CONFIRM */
Swal.fire({
title:'Publikasikan galeri?',
text:'Pastikan data sudah benar',
icon:'question',
showCancelButton:true,
confirmButtonText:'Publikasikan',
cancelButtonText:'Batal',
reverseButtons:true

}).then((result)=>{

if(result.isConfirmed){

form.submit();

}

});

});

});
</script>

<?php include 'layout/footer.php'; ?>
</div>
</div>