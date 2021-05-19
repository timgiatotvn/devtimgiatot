<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('admin.index') }}">
            <img src="{{ asset("/static/admin/assets/images/logo.svg") }}" alt="logo" class="logo-dark"/>
            <img src="{{ asset("/static/admin/assets/images/logo-light.svg") }}" alt="logo-light" class="logo-light">
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.index') }}">
            <img src="{{ asset("/static/admin/assets/images/logo-mini.svg") }}" alt="logo"/>
        </a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">{{ !empty($data['common']['flag']) ? $data['common']['flag'] : '' }}</h5>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <img class="img-xs rounded-circle ml-2" src="{{ asset("/static/admin/assets/images/faces/face8.jpg") }}" alt="Profile image">
                    <span class="font-weight-normal"> {{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard())->user()->username }} </span></a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset("/static/admin/assets/images/faces/face8.jpg") }}" alt="Profile image">
                        <p class="mb-1 mt-3">{{ substr(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard())->user()->name, 0, 15) }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard())->user()->username }}</p>
                    </div>
                    {{--<a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile--}}
                        {{--<span class="badge badge-pill badge-danger">1</span></a>--}}
                    {{--<a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i>--}}
                        {{--Messages</a>--}}
                    {{--<a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i>--}}
                        {{--Activity</a>--}}
                    {{--<a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a>--}}
                    <a class="dropdown-item" href="{{ route('admin.account.logout') }}"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>