<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="javascript:void(0);">PMB</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="javascript:void(0);">P</a>
        </div>

        <ul class="sidebar-menu">

            @if (auth('web')->check())

                <li class="menu-header">Dashboard</li>
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-fire"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-header">Manajemen User</li>
                <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fas fa-users"></i><span>Daftar User</span>
                    </a>
                </li>

                <li class="menu-header">Master</li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fa-solid fa-plus"></i><span>Master</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->routeIs('prodi.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('prodi.index') }}">Prodi</a>
                        </li>
                        <li class="{{ request()->routeIs('periode.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('periode.index') }}">Periode Penerimaan</a>
                        </li>
                        <li class="{{ request()->routeIs('sesi-ujian.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('sesi-ujian.index') }}">Sesi Ujian</a>
                        </li>
                        <li class="{{ request()->routeIs('ruang-ujian.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ruang-ujian.index') }}">Ruang Ujian</a>
                        </li>
                        <li class="{{ request()->routeIs('jadwal-ujian.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('jadwal-ujian.index') }}">Jadwal Ujian</a>
                        </li>
                    </ul>
                </li>

                <li class="menu-header">Penilaian</li>
                <li class="{{ request()->routeIs('nilai.*') ? 'active' : '' }}">
                    <a href="{{ route('nilai.index') }}" class="nav-link">
                        <i class="fa-solid fa-pen-clip"></i><span>Penilaian</span>
                    </a>
                </li>

                <li class="menu-header">Data Pendaftar</li>
                <li class="{{ request()->routeIs('pendaftar.*') ? 'active' : '' }}">
                    <a href="{{ route('pendaftar.index') }}" class="nav-link">
                        <i class="fa-solid fa-users"></i><span>Data Pendaftar</span>
                    </a>
                </li>

                <li class="menu-header">Yudisium & Kelulusan</li>
                <li class="{{ request()->routeIs('yudisium.*') ? 'active' : '' }}">
                    <a href="{{ route('yudisium.index') }}" class="nav-link">
                        <i class="fas fa-graduation-cap"></i><span>Yudisium & Kelulusan</span>
                    </a>
                </li>

                <li class="menu-header">Verifikasi</li>
                <li class="{{ request()->routeIs('verifikasi.*') ? 'active' : '' }}">
                    <a href="{{ route('verifikasi.index') }}" class="nav-link">
                        <i class="fa-solid fa-file"></i><span>Verifikasi Dokumen</span>
                    </a>
                </li>

            @endif

            @if (auth('pendaftar')->check())

                <li class="menu-header">Pendaftar</li>

                <li class="{{ request()->routeIs('mahasiswa.periode.*') ? 'active' : '' }}">
                    <a href="{{ route('mahasiswa.periode.index') }}" class="nav-link">
                        <i class="fas fa-info-circle"></i><span>Info Pendaftaran</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('pendaftar.verifikasi.*') ? 'active' : '' }}">
                    <a href="{{ route('pendaftar.verifikasi.index') }}" class="nav-link">
                        <i class="fa-solid fa-file"></i><span>Dokumen Saya</span>
                    </a>
                </li>
                 <li class="menu-header">Data Pendaftar</li>
                <li class="{{ request()->routeIs('pendaftar.data') ? 'active' : '' }}">
                    <a href="{{ route('pendaftar.data') }}" class="nav-link">
                        <i class="fa-solid fa-users"></i><span>Data Pendaftar</span>
                    </a>
                </li>
                 <li class="menu-header">Cek Kelulusan</li>
                <li class="{{ request()->routeIs('cek.kelulusan') ? 'active' : '' }}">
                    <a href="{{ route('cek.kelulusan') }}" class="nav-link">
                        <i class="fa-solid fa-check-circle"></i><span>Cek Kelulusan</span>
                    </a>
                </li>

            @endif

        </ul>
    </aside>
</div>
