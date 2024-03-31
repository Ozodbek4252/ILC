<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ Route('dash.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('/' . $logo->small_logo) }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('/' . $logo->main_logo) }}" style="max-height: 30px; height: auto" alt="">
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

    <div data-simplebar class="sidebar-menu-scroll">

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ Route('dash.banners.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Banners') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.partners.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Our partners') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.requests.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Requests') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.faqs.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Answers on questions') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.news.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.News') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.advantages.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Advantages') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.services.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Services') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.counters.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Counters') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.tariffs.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Tariffs') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.socials.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Socials') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.contacts.index') }}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>{{ __('body.Contacts') }}</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-cog"></i>
                        <span>{{ __('body.Settings') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ Route('dash.langs.index') }}">{{ __('body.Lang') }}</a></li>
                        <li><a href="{{ Route('dash.icons.index') }}">{{ __('body.Icons') }}</a></li>
                        <li><a href="{{ Route('dash.logos.index') }}">{{ __('body.Logo') }}</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
