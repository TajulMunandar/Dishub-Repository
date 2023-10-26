<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand text-center" href="{{ route('dashboard.index') }}">
            <img class="logo-brand" src="{{ asset('images/logos/logo.png') }}" alt="diskominfo sumut"
                style="
          width:80%" />
        </a>

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <i class="fa-regular nav-icon fa-house me-2 fa-fw"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/berita*') ? 'active' : '' }}"
                    href="/dashboard/berita">
                    <i class="fa-solid fa-calendar-week me-2 fa-fw"></i>
                    Berita Acara
                </a>
            </li>
            @if (auth()->user()->isAdmin == 1)
                <li class="nav-item px-5">
                    <hr class=" nav-link text-white p-0">
                </li>

                <li class="nav-item">
                    <a class="nav-link has-arrow {{ Request::is('dashboard/jabatan') ? 'active' : '' }}"
                        href="/dashboard/jabatan">
                        <i class="fa-regular nav-icon fa-list me-2 fa-fw"></i>
                        Jabatan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link has-arrow {{ Request::is('dashboard/staff') ? 'active' : '' }}"
                        href="/dashboard/staff">
                        <i class="fa-sharp fa-regular fa-user-police me-2 fa-fw"></i>
                        Staff
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link has-arrow {{ Request::is('dashboard/user') ? 'active' : '' }}"
                        href="/dashboard/user">
                        <i class="fa-solid fa-user me-2 fa-fw"></i>
                        User
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
