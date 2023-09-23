<header id="header-section">
    <nav class="navbar navbar-expand-lg fixed-top bg-white border-bottom">
        <div class="container py-2">

            <a class="navbar-brand fs-26 fw-medium" href="#">
                <span class="text-bluesky d-sm-inline d-none">{{ Str::substr(env('APP_NAME'), 0, 4) }}</span><span class="text-navysky d-sm-inline d-none">{{ Str::substr(env('APP_NAME'), 4, 8) }}.</span>
                <span class="text-bluesky d-sm-none d-inline">{{ Str::substr(env('APP_NAME'), 0, 1) }}</span><span class="text-navysky d-sm-none d-inline">{{ Str::substr(env('APP_NAME'), 4, 2) }}.</span>
            </a>

            <button class="navbar-toggler border border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">

                    @if (session('username'))
                        <li class="nav-item ms-lg-3 ms-0 text-lg-start text-center">
                            <a
                                class="nav-link nav-color {{ url()->current() == url('') ? 'active' : '' }}"
                                href="{{ url('') }}"
                            >
                                Home
                            </a>
                        </li>
                        <li class="nav-item ms-lg-3 ms-0 text-lg-start text-center">
                            <a
                                class="nav-link nav-color {{ url()->current() == url('admin') || url()->current() == url('dashboard') ? 'active' : '' }}"
                                href="{{ session('username') == 'admin' ? url('admin') : url('dashboard') }}"
                            >
                                Dashboard
                            </a>
                        </li>
                        @if (session('username') == 'admin')
                            <li class="nav-item ms-lg-3 ms-0 text-lg-start text-center">
                                <a
                                    class="nav-link nav-color {{ strpos(url()->full(), 'admin/customer') == true ? 'active' : '' }}"
                                    href="{{ url('admin/customer') }}"
                                >
                                    Customer
                                </a>
                            </li>
                        @endif
                        <li class="nav-item ms-lg-3 ms-0 text-lg-start text-center">
                            <a
                                class="nav-link nav-color {{ strpos(url()->full(), 'admin/service') == true || strpos(url()->full(), 'service') == true ? 'active' : '' }}"
                                href="{{ session('username') == 'admin' ? url('admin/service') : url('service') }}"
                            >
                                Service
                            </a>
                        </li>
                        <li class="nav-item ms-lg-3 ms-0 mb-lg-0 mb-3 text-lg-start text-center">
                            <a
                                class="nav-link nav-color {{ strpos(url()->full(), 'admin/order') == true || strpos(url()->full(), 'order') == true ? 'active' : '' }}"
                                href="{{ session('username') == 'admin' ? url('admin/order') : url('order') }}"
                            >
                                Order
                            </a>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3 ms-0 text-lg-start text-center">
                            <a class="nav-link nav-color active" href="#home-main">Home</a>
                        </li>
                        <li class="nav-item ms-lg-3 ms-0 text-lg-start text-center">
                            <a class="nav-link nav-color" href="#why-choose-us-main">Why Choose Us?</a>
                        </li>
                        <li class="nav-item ms-lg-3 ms-0 mb-lg-0 mb-3 text-lg-start text-center">
                            <a class="nav-link nav-color" href="#about-us-main">About Us</a>
                        </li>
                    @endif

                    @if (session()->has('username'))
                        <li class="nav-item dropdown ms-lg-4 ms-0 text-lg-start text-center">
                            <a class="btn btn-primary w-100 px-xl-5 px-4 py-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ explode(" ", $getGivenData['name'])[0] }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end animate slideIn">
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" href="{{ session('username') == 'admin' ? url('admin/profile') : url('profile') }}">
                                        <div class="ms-1">Profile</div>
                                        <span class="me-2"><i class="fa-solid fa-user"></i></span>
                                    </a>
                                </li>

                                @if (session('username') == 'admin')
                                    <li>
                                        <a class="dropdown-item d-flex justify-content-between" href="{{ session('username') == 'admin' ? url('admin/history') : url('history') }}">
                                            <div class="ms-1">History</div>
                                            <span class="me-2"><i class="fa-solid fa-clock-rotate-left"></i></span>
                                        </a>
                                    </li>
                                @endif

                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" href="{{ url('logout') }}">
                                        <div class="ms-1">Logout</div>
                                        <span class="me-2"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-lg-4 ms-0 text-lg-start text-center">
                            <a id="change-button-navbar" class="btn btn-primary w-100 px-xl-5 px-4 py-2" href="{{ url('login') }}">Login</a>
                        </li>
                    @endif

                </ul>
            </div>

        </div>
    </nav>
</header>
