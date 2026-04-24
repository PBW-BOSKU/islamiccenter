<div class="admin-topbar d-flex justify-content-between align-items-center">

    <!-- LEFT -->
    <div class="d-flex align-items-center gap-3">

        <button
        @click="showSidebar = true"
        class="mobile-menu-btn"
        aria-label="Open Sidebar">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <h5 class="mb-0 fw-bold">Admin</h5>
            <small class="text-muted">
                Ringkasan aktivitas hari ini
            </small>
        </div>

    </div>


    <!-- RIGHT -->
    <div class="d-flex align-items-center gap-3">

        <div class="admin-profile d-flex align-items-center gap-2">

            <div class="avatar">A</div>

            <div class="d-flex flex-column lh-sm">
                <small class="fw-semibold">Admin</small>
                <small class="text-muted">Administrator</small>
            </div>

        </div>

        <a href="index.php?page=logout"
        class="btn btn-sm btn-danger px-3">
            Logout
        </a>

    </div>

</div>