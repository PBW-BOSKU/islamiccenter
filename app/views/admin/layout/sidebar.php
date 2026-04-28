<aside class="sidebar"
    :class="{ active: showSidebar }">

    <!-- BRAND -->
    <div class="sidebar-brand">
        <div class="brand-logo">
            <img src="/assets/images/menaraislamic.png" alt="Logo">
        </div>
    </div>

    <ul class="nav flex-column mt-4">

        <li class="nav-item">
            <a href="/admin/dashboard"
            class="nav-link <?= ($_GET['page'] ?? '')=='dashboard' ? 'active' : '' ?>">
                <i class="bi bi-house icon"></i>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/pengunjung"
            class="nav-link <?= ($_GET['page'] ?? '')=='pengunjung' ? 'active' : '' ?>">
                <i class="bi bi-people icon"></i>
                <span class="text">Pengunjung</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/galeri"
            class="nav-link <?= ($_GET['page'] ?? '')=='galeri' ? 'active' : '' ?>">
                <i class="bi bi-image icon"></i>
                <span class="text">Galeri</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/admin/review"
            class="nav-link <?= ($_GET['page'] ?? '')=='review' ? 'active' : '' ?>">
                <i class="bi bi-chat-quote icon"></i>
                <span class="text">Review</span>
            </a>
        </li>

    </ul>

</aside>