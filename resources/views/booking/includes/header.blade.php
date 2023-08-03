<div class="position-relative">
    <div class="top_name_header">
        <div id="al-topbar">
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="col-6 d-none d-lg-block">
                        <span class="topbar-widget tb-social d-flex gap-4">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </span>
                    </div>
                    <div class="col-lg-6 col-12 text-end">
                        <div class="al-topbar-right d-flex gap-4 justify-content-lg-end justify-content-between">
                            <span><a href="mailto:info@allwayslegal.com"><i class="fas fa-envelope me-2"
                                        style="font-size: 14px;"></i>info@allwayslegal.com</a></span>
                            <span><a href="tel:+1 587 5992959"><i class="fas fa-phone me-2"
                                        style="transform: rotate(100deg); font-size: 14px;"></i>+1 587
                                    5992959</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header>
            <nav class="navbar navbar-expand-lg h-100 px_30px">
                <div class="container-fluid d-flex align-items-center px-md-0">
                    <div class="d-flex">
                        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                            <div class="d-flex align-items-center">
                                <figure class="mb-0 al-brand">
                                    <img src="{{ asset('assets/frontend/media/logo.png') }}" alt="logo">
                                </figure>
                                <span class="d-md-block d-none">Allways Legal</span>
                            </div>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse justify-content-center mobile-offcanvas " id="navbarNav">
                        <div class="offcanvas-header d-lg-none d-flex justify-content-between">
                            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                                <div class="d-flex align-items-center">
                                    <figure class="mb-0 al-brand">
                                        <img src="{{ asset('assets/frontend/media/logo.png') }}" alt="logo">
                                    </figure>
                                    <span class="text-primary">Allways Legal</span>
                                </div>
                            </a>
                            <button class="btn-close float-end shadow-none"></button>
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-center right_dec_text">
                        @if (Route::has('login'))
                            <div class="d-flex align-items-center gap-3">
                                @auth
                                    <div class="dropdown">
                                        <a href=" @if (Auth::user()->roles()->first()->id == 2) {{ route('lawyer.dashboard') }} @else {{ route('client.dashboard') }} @endif"
                                            class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu db_head_dropdown dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton1">

                                            <li>
                                                @if (Auth::user()->roles()->first()->id == 2)
                                                    <a class="dropdown-item @if (Route::is('lawyer.dashboard')) active @endif"
                                                        href="{{ route('lawyer.dashboard') }}">Dashboard</a>
                                                @else
                                                    <a class="dropdown-item @if (Route::is('client.dashboard')) active @endif"
                                                        href="{{ route('client.dashboard') }}">Dashboard</a>
                                                @endif
                                            </li>
                                            <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                    <button class="btn btn-primary" type="button"  id="toggle_btn">
                                        <i class="fa fa-bars" style="color:#fff"></i>
                                      </button>
                                @else
                                    <a href="{{ route('login') }}">
                                        <i class="fas fa-user"></i>
                                    </a>
                                @endauth
                            </div>
                        @endif
                        @auth
                        @else
                            {{-- <div class="dropdown">
                    <i class="fab fa-searchengin" style="font-size: 30px;" data-bs-toggle="dropdown"
                        aria-expanded="false"></i>
                    <ul class="dropdown-menu p-3">
                        <li class="search_form">
                            <form action="search" class="d-flex align-items-center">
                                <input type="text" placeholder="search here..">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                    </ul>
                </div> --}}
                            <div class="header_get_started"><a href="{{ route('booking') }}">Booking</a></div>
                            <div>
                                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                            @endauth
                    </div>

                </div>
            </nav>
        </header>
    </div>
</div>
