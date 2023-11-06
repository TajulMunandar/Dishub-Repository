<nav class="navbar-classic navbar navbar-expand-lg">
    <a id="nav-toggle" href="#"><i class="fa-regular nav-icon fa-bars me-1"></i></a>
    <div class="ms-lg-3 d-none d-md-none d-lg-block"></div>

    <!--Navbar nav -->
    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
        <!-- List -->
        <li class="dropdown ms-2">
            <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="p-1 text-black fw-semibold p-2">
                    <i class="fa-solid fa-user mx-1"></i>
                    {{ auth()->user()->Staff->name }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                <ul class="list-unstyled">
                    <li>
                    <li>
                        <a class="dropdown-item"href="/profile">
                            <i class="fa-regular dropdown-item-icon fa-user me-1 fa-fw"></i>Profile
                        </a>
                    </li>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="dropdown-item">
                            <i class="fa-regular dropdown-item-icon fa-arrow-right-from-bracket me-1 fa-fw"></i>
                            Logout
                        </button>
                    </form>
            </div>
        </li>
    </ul>
    </ul>
</nav>
