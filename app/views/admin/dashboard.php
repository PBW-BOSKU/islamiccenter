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
        <h1>Selamat Datang, Admin 👋</h1>
        <p>
            Mengelola operasional Menara Islamic Center Samarinda dengan presisi dan efisiensi.
        </p>

        <small class="text-light">
            <?= date('l, d F Y') ?>
        </small>
    </div>

</section>


<!-- STATS -->
<div class="row admin-stats mt-4">

    <div class="col-md-4">
        <div class="stat-card fade-in">
            <small>Total Pengunjung</small>
            <h3 class="counter" data-target="<?= $total ?? 12842 ?>">0</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card fade-in">
            <small>Pendaftar Hari Ini</small>
            <h3 class="counter" data-target="<?= $hari_ini ?? 148 ?>">0</h3>
        </div>
    </div>

        <div class="col-md-4">
            <div class="stat-card fade-in">
                <small>Kapasitas <?= date('d M Y', strtotime($tanggal)) ?></small>

                <h3><?= $hari_ini ?? 0 ?> / <?= $max_kapasitas ?? 200 ?></h3>

                <div class="progress mt-2" style="height:6px;">
                    <div class="progress-bar bg-success"
                        style="width: <?= $persen ?? 0 ?>%">
                    </div>
                </div>

                <small class="text-muted">
                    <?= round($persen ?? 0) ?>%
                </small>
            </div>
        </div>

</div>

<!-- CONTENT -->
<div class="row mt-4">

    <!-- AKSI CEPAT -->
<div class="col-md-4">
    <div class="card admin-card p-3 fade-in">

        <h6 class="section-title mb-3">Aksi Cepat</h6>

        <div class="quick-actions">

            <a href="index.php?page=pengunjung" class="quick-item">
                <div class="icon bg-primary">
                    <i class="bi bi-people"></i>
                </div>
                <div class="info">
                    <strong>Data Pengunjung</strong>
                    <small>Lihat & kelola pengunjung</small>
                </div>
            </a>

            <a href="index.php?page=tambah_pengunjung_form&redirect=dashboard" class="quick-item">
                <div class="icon bg-success">
                    <i class="bi bi-person-plus"></i>
                </div>
                <div class="info">
                    <strong>Tambah Pengunjung</strong>
                    <small>Input data baru</small>
                </div>
            </a>

            <a href="index.php?page=galeri" class="quick-item">
                <div class="icon bg-warning">
                    <i class="bi bi-image"></i>
                </div>
                <div class="info">
                    <strong>Kelola Galeri</strong>
                    <small>Atur foto & dokumentasi</small>
                </div>
            </a>

        </div>

    </div>
</div>

    <!-- AKTIVITAS -->
<div class="col-md-8">
    <div class="card admin-card p-3 fade-in">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

            <h6 class="section-title mb-0">
                Aktivitas <?= date('d M Y', strtotime($tanggal ?? date('Y-m-d'))) ?>
            </h6>

            <div class="d-flex align-items-center gap-2">

                <form method="GET" class="d-flex align-items-center gap-2 m-0">
                    <input type="hidden" name="page" value="dashboard">

                    <input type="date" 
                        name="tanggal"
                        value="<?= $_GET['tanggal'] ?? date('Y-m-d') ?>"
                        class="form-control form-control-sm date-filter"
                        onchange="this.form.submit()">
                </form>

                <div class="d-flex align-items-center gap-1">
                    <span class="live-dot"></span>
                    <small class="text-muted">Live</small>
                </div>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table admin-table mt-2 align-middle">
                <thead>
                    <tr>
                        <th>Pengunjung</th>
                        <th>Sesi</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (!empty($aktivitas)): ?>
                    <?php $i = 0; foreach ($aktivitas as $p): ?>
                    <tr class="fade-in table-row" style="animation-delay: <?= $i++ * 0.1 ?>s">

                        <!-- NAMA -->
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-mini">
                                    <?= strtoupper(substr($p['nama'], 0, 1)) ?>
                                </div>
                                <div>
                                    <strong><?= $p['nama'] ?></strong><br>
                                    <small class="text-muted"><?= $p['email'] ?? '-' ?></small>
                                </div>
                            </div>
                        </td>

                        <!-- SESI -->
                        <td>
                            <span class="badge bg-light text-dark">
                                <?= $p['sesi'] ?>
                            </span>
                        </td>

                        <!-- JUMLAH -->
                        <td>
                            <strong><?= $p['jumlah'] ?> </strong>
                        </td>

                        <!-- TANGGAL -->
                        <td>
                            <?= date('d M Y', strtotime($p['tanggal_kunjungan'])) ?>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php if ($p['status'] == 'Menunggu Pembayaran'): ?>
                                <span class="badge status-badge warning">Menunggu Pembayaran</span>

                            <?php elseif ($p['status'] == 'Dibayar'): ?>
                                <span class="badge status-badge success">Dibayar</span>

                            <?php elseif ($p['status'] == 'Selesai'): ?>
                                <span class="badge status-badge info">Selesai</span>

                            <?php elseif ($p['status'] == 'Dibatalkan'): ?>
                                <span class="badge status-badge danger">Dibatalkan</span>

                            <?php else: ?>
                                <span class="badge status-badge secondary">-</span>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>

                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada aktivitas pada tanggal ini
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>
            </table>

        </div>

    </div>
</div>

</div> <!-- main-content -->

<?php include 'layout/footer.php'; ?>

</div> <!-- admin-main -->

</div> <!-- admin-layout -->