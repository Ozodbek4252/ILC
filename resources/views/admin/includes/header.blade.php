<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ Route('dash.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('/' . $logo->small_logo) }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/' . $logo->main_logo) }}" alt="" height="20">
                    </span>
                </a>

                <a href="{{ Route('dash.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('/' . $logo->small_logo) }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/' . $logo->main_logo) }}" alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            {{--  <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="uil-search"></span>
                </div>
            </form>  --}}
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="/{{ $currenctLang->icon }}" alt="Header Language" width="20;" height="auto">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    @foreach ($langsForHeader as $lang)
                        <a href="{{ Route('dash.lang.change', $lang) }}" class="dropdown-item notify-item">
                            <img src="/{{ $lang->icon }}" style="width: 20px; height: auto;" alt="user-image"
                                class="me-1">
                            <span class="align-middle">{{ $lang->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="uil-minus-path"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (auth()->user()->profile_image)
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Header Avatar">
                    @else
                        <i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"
                            style="font-size: 25px !important;"></i>
                    @endif
                    <span
                        class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ auth()->user()->name }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ Route('dash.profile') }}"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">{{ __('body.View profile') }}</span></a>
                    <form action="{{ Route('dash.logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item">
                            <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted">
                            </i> <span class="align-middle">{{ __('body.log_out') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
