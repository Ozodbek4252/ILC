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
                        <i class="uil-image"></i>
                        <span>{{ __('body.Banners') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.requests.index') }}" class="waves-effect">
                        <i class="uil-comment-alt-message"></i>
                        <span>{{ __('body.Requests') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dash.news.index') }}" class="waves-effect">
                        <i class="uil-newspaper"></i>
                        <span>{{ __('body.News') }}</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-comment-info"></i>
                        <span>{{ __('body.Info') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ Route('dash.abouts.index') }}">{{ __('body.About') }}</a></li>
                        <li><a href="{{ Route('dash.contacts.index') }}">{{ __('body.Contacts') }}</a></li>
                        <li><a href="{{ Route('dash.socials.index') }}">{{ __('body.Socials') }}</a></li>
                        <li><a href="{{ Route('dash.services.index') }}">{{ __('body.Services') }}</a></li>
                        <li><a href="{{ Route('dash.faqs.index') }}">{{ __('body.Answers on questions') }}</a></li>
                        <li><a href="{{ Route('dash.partners.index') }}">{{ __('body.Our partners') }}</a></li>
                        <li><a href="{{ Route('dash.advantages.index') }}">{{ __('body.Advantages') }}</a></li>
                        <li><a href="{{ Route('dash.counters.index') }}">{{ __('body.Counters') }}</a></li>
                        <li><a href="{{ Route('dash.tariffs.index') }}">{{ __('body.Tariffs') }}</a></li>
                    </ul>
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
                        <li><a href="{{ Route('dash.seos.index') }}">{{ __('body.SEO') }}</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
