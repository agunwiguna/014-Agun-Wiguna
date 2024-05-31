<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Menu</div>

            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link {{ (request()->is('user/dashboard-user')) ? 'active' : '' }}" href="{{ route('user-dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <a class="nav-link {{ (request()->is('user/absensi') || request()->is('user/absensi-pulang') || request()->is('user/absensi-izin')) ? 'active' : '' }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseSettings">
                <div class="nav-link-icon"><i data-feather="clock"></i></div>
                Absensi
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ (request()->is('user/absensi') || request()->is('user/absensi-pulang*') || request()->is('user/absensi-izin')) ? 'show' : '' }}" id="collapseTransaksi" data-bs-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <a class="nav-link {{ (request()->is('user/absensi')) ? 'active' : '' }}" href="{{ route('absensi.index') }}">Absen Masuk</a>
                    <a class="nav-link {{ (request()->is('user/absensi-pulang')) ? 'active' : '' }}" href="{{ route('absensi-pulang') }}">Absen Pulang</a>
                    <a class="nav-link {{ (request()->is('user/absensi-izin')) ? 'active' : '' }}" href="{{ route('absensi-izin') }}">Absen Izin/Sakit</a>
                </nav>
            </div>
            <a class="nav-link  {{ (request()->is('user/report-user*')) ? 'active' : '' }}" href="{{ route('report-user.index') }}">
                <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                Laporan
            </a>
            <a class="nav-link {{ (request()->is('user/setting-user*')) ? 'active' : '' }}" href="{{ route('setting-user.index') }}">
                <div class="nav-link-icon"><i data-feather="settings"></i></div>
                Pengaturan
            </a>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>