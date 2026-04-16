<aside class="sidebar" :class="{ collapsed: !showSidebar }">

    <!-- BRAND -->
    <div class="sidebar-brand">
        <div class="brand-logo">
            <img src="/assets/images/logoislamic.jpg" alt="Logo">
        </div>
    </div>

    <ul class="nav flex-column mt-4">

            <li class="nav-item">
                <a href="index.php?page=dashboard"
                class="nav-link <?= ($_GET['page'] ?? '') == 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-house icon"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="index.php?page=pengunjung"
                class="nav-link <?= ($_GET['page'] ?? '') == 'pengunjung' ? 'active' : '' ?>">
                    <i class="bi bi-people icon"></i>
                    <span class="text">Pengunjung</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="index.php?page=galeri"
                class="nav-link <?= ($_GET['page'] ?? '') == 'galeri' ? 'active' : '' ?>">
                    <i class="bi bi-image icon"></i>
                    <span class="text">Galeri</span>
                </a>
            </li>

    </ul> 

    <div class="sidebar-user mt-auto">
        <strong>Admin Utama</strong><br>
        <small>Administrator</small>
    </div>

</aside>