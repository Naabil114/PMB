<nav class="navbar navbar-expand-lg main-navbar">

    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">

            @if (Auth::guard('web')->check())
                <li>
                    <a href="#" class="nav-link nav-link-lg main-sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </a>

                </li>
            @endif

        </ul>
    </form>

    @php
        $admin = Auth::guard('web')->check() ? Auth::guard('web')->user() : null;

        $pendaftar = Auth::guard('pendaftar')->check() ? Auth::guard('pendaftar')->user() : null;
    @endphp

    @if ($admin || $pendaftar)
        <ul class="navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">



                    <div class="d-sm-none d-lg-inline-block">
                        @if ($admin)
                            Hi, {{ $admin->username }}
                        @elseif($pendaftar)
                            Hi, {{ $pendaftar->nama_lengkap }}
                        @endif
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-right">

                    <a href="#" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>

                    {{-- LOGOUT --}}
                    @if ($admin)
                        <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-admin').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>

                        <form id="logout-admin" action="{{ route('admin.logout') }}" method="POST"
                            style="display:none;">
                            @csrf
                        </form>
                    @elseif($pendaftar)
                        <a href="{{ route('pendaftar.logout') }}" class="dropdown-item has-icon text-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-pendaftar').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>

                        <form id="logout-pendaftar" action="{{ route('pendaftar.logout') }}" method="POST"
                            style="display:none;">
                            @csrf
                        </form>
                    @endif

                </div>
            </li>
        </ul>
    @endif

</nav>
