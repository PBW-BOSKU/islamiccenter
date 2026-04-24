<?php include 'layout/header.php'; ?>

<div class="admin-layout">

<?php include 'layout/sidebar.php'; ?>

    <div v-if="showSidebar"
            class="sidebar-overlay"
            @click="showSidebar = false">
    </div>

<div class="admin-main">

<div class="main-content">

<?php include 'layout/topbar.php'; ?>

<!-- HERO -->
<section class="admin-hero fade-in">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Kelola Review <i class="bi bi-chat-quote"></i></h1>
        <p>Lihat dan hapus ulasan yang dikirim oleh pengunjung.</p>
        <small class="text-light"><?= date('l, d F Y') ?></small>
    </div>
</section>

<!-- FLASH MESSAGE -->
<div class="mt-3">
    <?php if ($success === 'hapus_review'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            Review berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($error === 'invalid_id'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            ID review tidak valid.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($error === 'hapus_gagal'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Gagal menghapus review. Review mungkin sudah tidak ada.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</div>

<!-- TABEL REVIEW -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card admin-card p-3 fade-in">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="section-title mb-0">
                    Daftar Review Pengunjung
                    <span class="badge bg-secondary ms-2"><?= count($reviews) ?></span>
                </h6>
            </div>

            <div class="table-responsive">
                <table class="table admin-table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (!empty($reviews)): ?>
                        <?php $i = 1; foreach ($reviews as $r): ?>
                        <tr class="fade-in table-row">

                            <td><?= $i++ ?></td>

                            <!-- NAMA -->
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-mini">
                                        <?= strtoupper(substr($r['nama'], 0, 1)) ?>
                                    </div>
                                    <strong><?= htmlspecialchars($r['nama']) ?></strong>
                                </div>
                            </td>

                            <!-- RATING -->
                            <td>
                                <?php for ($s = 1; $s <= 5; $s++): ?>
                                    <i class="bi bi-star<?= $s <= $r['rating'] ? '-fill text-warning' : ' text-muted' ?>"></i>
                                <?php endfor; ?>
                                <small class="ms-1 text-muted">(<?= $r['rating'] ?>/5)</small>
                            </td>

                            <!-- KOMENTAR -->
                            <td style="max-width: 300px;">
                                <span class="text-wrap">
                                    <?= htmlspecialchars($r['komentar']) ?>
                                </span>
                            </td>

                            <!-- TANGGAL -->
                            <td>
                                <?php
                                    // Ikuti pola dashboard: pakai created_at jika ada, fallback ke id
                                    $tgl = $r['created_at'] ?? null;
                                    echo $tgl
                                        ? date('d M Y, H:i', strtotime($tgl))
                                        : '-';
                                ?>
                            </td>

                            <!-- AKSI -->
                            <td>
                                <button
                                    class="btn btn-sm btn-danger"
                                    @click="confirmDelete('index.php?page=hapus_review&id=<?= $r['id'] ?>')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-chat-square-text me-2"></i>
                                Belum ada review dari pengunjung.
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</div> <!-- main-content -->

<?php include 'layout/footer.php'; ?>

</div> <!-- admin-main -->

</div> <!-- admin-layout -->