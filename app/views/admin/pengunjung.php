<?php include 'layout/header.php'; ?>

<div class="admin-layout">

    <?php include 'layout/sidebar.php'; ?>

        <div v-if="showSidebar"
            class="sidebar-overlay"
            @click="showSidebar = false">
    </div>

    <div class="admin-main">

        <div class="main-content">

            <!--  ROOT VUE HARUS BERSIH -->
            <div id="app">

                <?php include 'layout/topbar.php'; ?>

                <!-- TITLE -->
                <div class="mb-4">
                    <h2 class="fw-bold">Data Pengunjung</h2>
                    <p class="text-muted small">
                        Kelola log masuk harian, validasi pemesanan, dan pantau status kehadiran pengunjung secara real-time.
                    </p>
                </div>

                <!-- FILTER -->
                <div class="card admin-card p-3 mb-4 fade-up">
                    <div class="row g-3 align-items-end">

                        <!-- SEARCH -->
                        <div class="col-md-3">
                            <input 
                                type="text" 
                                class="form-control search-input"
                                placeholder="Cari nama atau ID..."
                                v-model="search"
                            >
                        </div>

                        <!-- FILTER SESI -->
                        <div class="col-md-2">
                            <select class="form-select filter-select" v-model="filterSesi">
                                <option value="">Semua Sesi</option>
                                <option>Pagi</option>
                                <option>Siang</option>
                                <option>Sore</option>
                            </select>
                        </div>

                        <!-- FILTER STATUS -->
                        <div class="col-md-2">
                            <select class="form-select filter-select" v-model="filterStatus">
                                <option value="">Semua Status</option>
                                <option>Menunggu Pembayaran</option>
                                <option>Dibayar</option>
                                <option>Selesai</option>
                                <option>Dibatalkan</option>
                            </select>
                        </div>

                        <!-- TOGGLE SEMUA DATA -->
                        <div class="col-md-2">
                        <button 
                            class="btn btn-outline-primary w-100"
                            onclick="window.location.href='index.php?page=pengunjung'">
                            Tampilkan Semua Data
                        </button>
                        </div>

                        <!-- TAMBAH -->
                        <div class="col-md-3 text-end">
                            <a href="index.php?page=tambah_pengunjung_form" 
                            class="btn btn-add">
                                <i class="bi bi-person-plus"></i>
                                Tambah
                            </a>
                        </div>

                    </div>
                </div>

                <div class="row">

                    <!-- TABLE -->
                    <div class="col-md-8">
                        <div class="card admin-card p-3 fade-up">
                        <div class="mb-2 text-muted small">
                            <?php if (isset($_GET['tanggal'])): ?>
                                Menampilkan data tanggal <?= date('d M Y', strtotime($tanggal)) ?>
                            <?php else: ?>
                                Menampilkan semua data
                            <?php endif; ?>
                        </div>
                        <div class="table-responsive mobile-scroll">
                            <table class="table admin-table">
                                <thead>
                                    <tr>
                                        <th>Nama Pengunjung</th>
                                        <th>ID Booking</th>
                                        <th>Sesi</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr v-if="filteredData.length === 0">
                                        <td colspan="6" class="text-center text-muted">
                                            Data tidak ditemukan
                                        </td>
                                    </tr>

                                    <tr v-for="p in filteredData" :key="p.id">

                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-mini">
                                                    {{ p.nama.charAt(0).toUpperCase() }}
                                                </div>
                                                <div>
                                                    <strong>{{ p.nama }}</strong><br>
                                                    <small class="text-muted">{{ p.no_wa || '-' }}</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{ p.kode_booking }}</td>

                                        <td>
                                            <span class="badge bg-light text-dark">
                                                {{ p.sesi.charAt(0).toUpperCase() + p.sesi.slice(1) }}
                                            </span>
                                        </td>

                                        <td>{{ p.jumlah }}</td>

                                        <td>
                                            <span :class="'badge ' + statusClass(p.status)">
                                                {{ p.status }}
                                            </span>
                                    </td>

                                    <td class="action-cell">
                                        <div class="action-group">

                                        <a :href="'index.php?page=edit_pengunjung&id=' + p.id"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                        </a>

                                        <button
                                        class="btn btn-sm btn-danger"
                                        @click="confirmDelete('index.php?page=hapus_pengunjung&id=' + p.id)">
                                        Hapus
                                        </button>

                                        <a v-if="p.status === 'Dibayar'"
                                        :href="'https://wa.me/' + p.no_wa + '?text=' + encodeURIComponent(
                                        'TIKET KUNJUNGAN\n\n' +
                                        'Kode Booking: ' + p.kode_booking + '\n' +
                                        'Nama: ' + p.nama + '\n' +
                                        'Tanggal: ' + p.tanggal_kunjungan + '\n' +
                                        'Sesi: ' + p.sesi + '\n' +
                                        'Jumlah: ' + p.jumlah + ' orang'
                                        )"
                                        target="_blank"
                                        class="btn btn-sm btn-success">
                                        Kirim Tiket
                                        </a>

                                        <span v-else class="ticket-placeholder"></span>

                                        </div>

                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT PANEL -->
                    <div class="col-md-4">

                        <div class="card admin-card p-3 mb-3 text-center">
                            <small>Total Hari Ini</small>
                            <h2 class="fw-bold"><?= $total_hari_ini ?? 0 ?></h2>
                            <small class="text-success">Live Data</small>
                        </div>

                        <div class="card admin-card p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>Filter Tanggal</h6>

                                <form method="GET">
                                    <input type="hidden" name="page" value="pengunjung">

                                    <input type="date" 
                                        name="tanggal"
                                        value="<?= $_GET['tanggal'] ?? date('Y-m-d') ?>"
                                        onchange="this.form.submit()">
                                </form>
                            </div>

                            <h6>Kapasitas <?= date('d M Y', strtotime($tanggal)) ?></h6>
                            <small>Max <?= $max_kapasitas ?></small>

                            <h4><?= $total_hari_ini ?? 0 ?> / <?= $max_kapasitas ?></h4>

                            <small><?= round($persen ?? 0) ?>% terisi</small>

                            <div class="progress mt-2">
                                <div class="progress-bar 
                                    <?= $persen > 80 ? 'bg-danger' : ($persen > 50 ? 'bg-warning' : 'bg-success') ?>"
                                    style="width:<?= $persen ?? 0 ?>%">
                                </div>
                            </div>

                        </div>

                        <div class="card admin-card p-3">
                            <h6>Statistik Hari Ini</h6>

                            <div class="card admin-card p-3">
                                <h6>Statistik Hari Ini</h6>

                                <div class="d-flex justify-content-between mt-3">
                                    
                                    <div>
                                        <small>Menunggu Pembayaran</small>
                                        <h5 class="text-warning"><?= $menunggu_pembayaran ?? 0 ?></h5>
                                    </div>

                                    <div>
                                        <small>Dibayar</small>
                                        <h5 class="text-success"><?= $dibayar ?? 0 ?></h5>
                                    </div>

                                    <div>
                                        <small>Selesai</small>
                                        <h5 class="text-primary"><?= $selesai ?? 0 ?></h5>
                                    </div>

                                    <div>
                                        <small>Dibatalkan</small>
                                        <h5 class="text-danger"><?= $dibatalkan ?? 0 ?></h5>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div> <!-- END #app -->

        </div> <!-- main-content -->

        <?php include 'layout/footer.php'; ?>

    </div> <!-- admin-main -->

</div> <!-- admin-layout -->