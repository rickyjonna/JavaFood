<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
        @auth
            <a class="navbar-brand ms-3" href="/dashboard">Back To Dashboard</a>
        @else
            <a class="navbar-brand ms-3" href="/" style="color: red">JavaFood.</a>
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu Navigasi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 ps-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                            href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('menu') && !Request::has('category') ? 'active' : '' }}"
                            href="/menu">Daftar Menu</a>
                    </li>
                    <li class="nav-item dropdown  me-auto">
                        <a class="nav-link dropdown-toggle {{ Request::has('category') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/menu?category=makanan">Makanan</a>
                                <ul class="dropdown-menu dropdown-submenu">
                                    <li>
                                        <a class="dropdown-item" href="/sub_categories/ayam">Ayam</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/sub_categories/daging">Daging</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/sub_categories/nasi">Nasi</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/sub_categories/mie">Mie</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/menu?category=minuman">Minuman</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/menu?category=jajanan">Jajanan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/cities">Makanan Khas Daerah</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">Tentang</a>
                    </li>
                    @auth
                        <li class="nav-item me-3">
                            <form action="/logout" method="post">
                                @csrf
                                <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" href="/logout">
                                    <button type="submit" class="dropdown-item">
                                        Keluar
                                    </button>
                                </a>
                            </form>
                        </li>
                    @else
                        <li class="nav-item me-3">
                            <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">
                                <button type="submit" class="dropdown-item">
                                    Masuk
                                </button>
                            </a>
                        </li>
                    @endauth
                </ul>
                <form action="/menu" class="d-flex mt-3 mt-lg-0" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-danger" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>
