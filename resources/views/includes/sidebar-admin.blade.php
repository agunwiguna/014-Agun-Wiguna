<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Menu</div>

            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}" href="/admin/dashboard">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <a class="nav-link  {{ (request()->is('admin/absensi*')) ? 'active' : '' }}" href="/admin/absensi">
                <div class="nav-link-icon"><i data-feather="clock"></i></div>
                Absensi
            </a>
            <a class="nav-link  {{ (request()->is('admin/user*')) ? 'active' : '' }}" href="/admin/user">
                <div class="nav-link-icon"><i data-feather="users"></i></div>
                Data User
            </a>
            <a class="nav-link  {{ (request()->is('admin/instansi*')) ? 'active' : '' }}" href="/admin/instansi">
                <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                Data Instansi
            </a>
            <a class="nav-link  {{ (request()->is('admin/report*')) ? 'active' : '' }}" href="/admin/report">
                <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                Laporan
            </a>
            <a class="nav-link {{ (request()->is('admin/setting*')) ? 'active' : '' }}" href="/admin/setting">
                <div class="nav-link-icon"><i data-feather="settings"></i></div>
                Pengaturan
            </a>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">Agun Wiguna</div>
        </div>
    </div>
</nav>