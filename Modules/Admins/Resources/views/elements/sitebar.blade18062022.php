<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item navbar-brand-mini-wrapper">
            <a class="nav-link navbar-brand brand-logo-mini" href="{{ route('admin.index') }}">
                <img src="{{ asset('/static/admin/assets/images/logo-mini.svg') }}" alt="logo"/>
            </a>
        </li>
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{ asset('/static/admin/assets/images/faces/face8.jpg') }}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{ substr(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard())->user()->name, 0, 15) }}</p>
                    <p class="designation">{{ substr(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard())->user()->username, 0, 15) }}</p>
                </div>
                {{--<div class="icon-container">--}}
                    {{--<i class="icon-bubbles"></i>--}}
                    {{--<div class="dot-indicator bg-danger"></div>--}}
                {{--</div>--}}
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">@lang('admins::layer.dashboard.title')</span>
        </li>
        <li class="nav-item {{ Request::routeIs('client.home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('client.home') }}" target="_blank">
                <span class="menu-title">@lang('admins::layer.menu.parent.home')</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">@lang('admins::layer.menu.parent.function')</span>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.category.*')? 'active' : '' }} {{ Request::routeIs('admin.post.*')? 'active' : '' }} {{ Request::routeIs('admin.product.*')? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="false"
               aria-controls="basic-ui">
                <span class="menu-title">@lang('admins::layer.menu.parent.post')</span>
                <i class="icon-layers menu-icon"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.category.*')? 'show' : '' }} {{ Request::routeIs('admin.post.*')? 'show' : '' }} {{ Request::routeIs('admin.product.*')? 'show' : '' }}" id="basic-ui">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.category.*')? 'active' : '' }}" href="{{ route('admin.category.index') }}">@lang('admins::layer.menu.parent.post.category.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.post.*')? 'active' : '' }}" href="{{ route('admin.post.index') }}">@lang('admins::layer.menu.parent.post.post.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.product.*')? 'active' : '' }}" href="{{ route('admin.product.index') }}">@lang('admins::layer.menu.parent.product.product.title')</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.crawler.*')? 'active' : '' }} {{ Request::routeIs('admin.productCrawler.*')? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#basic-ui" aria-expanded="false"
               aria-controls="basic-ui">
                <span class="menu-title">@lang('admins::layer.menu.parent.crawler')</span>
                <i class="icon-layers menu-icon"></i>
            </a>
            <div class="collapse {{ Request::routeIs('admin.crawler.*')? 'show' : '' }} {{ Request::routeIs('admin.productCrawler.*')? 'show' : '' }}" id="basic-ui">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.crawler.website.*')? 'active' : '' }}" href="{{ route('admin.crawler.website.index') }}">@lang('admins::layer.menu.parent.crawler.website.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.crawler.article.*')? 'active' : '' }}" href="{{ route('admin.crawler.article.index') }}">@lang('admins::layer.menu.parent.crawler.article.title')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.productCrawler.*')? 'active' : '' }}" href="{{ route('admin.productCrawler.index') }}">@lang('admins::layer.menu.parent.product.product.title')</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{ Request::routeIs('admin.post.*')? 'active' : '' }}" href="{{ route('admin.post.index') }}">@lang('admins::layer.menu.parent.post.post.title')</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{ Request::routeIs('admin.product.*')? 'active' : '' }}" href="{{ route('admin.product.index') }}">@lang('admins::layer.menu.parent.product.product.title')</a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.cart.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.cart.index') }}">
                <span class="menu-title">Giỏ hàng</span>
                <i class="icon-doc menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.link.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.link.index') }}">
                <span class="menu-title">Liên kết</span>
                <i class="icon-doc menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.logo.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.logo.index') }}">
                <span class="menu-title">Logo</span>
                <i class="icon-doc menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.slideshow.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.slideshow.index') }}">
                <span class="menu-title">Slide</span>
                <i class="icon-doc menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.advertisement.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.advertisement.index') }}">
                <span class="menu-title">Quảng cáo</span>
                <i class="icon-doc menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.setting.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.setting.update',["id" => 1]) }}">
                <span class="menu-title">Cấu hình website</span>
                <i class="mdi mdi-settings-box menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Request::routeIs('admin.account.*')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.account.index') }}">
                <span class="menu-title">Tài khoản</span>
                <i class="icon-bell menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>