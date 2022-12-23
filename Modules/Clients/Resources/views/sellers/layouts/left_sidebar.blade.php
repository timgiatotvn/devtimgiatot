<div class="leftside-menu leftside-menu-detached">

    <div class="leftbar-user">
        <a href="javascript: void(0);">
            <img src="{{asset('sellers/assets/images/users/avatar-1.jpg')}}" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <span class="leftbar-user-name">
                {{auth('users')->user()->shop_name}}
            </span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">

        {{-- <li class="side-nav-title side-nav-item">Navigation</li>

        <li class="side-nav-item">
            <a href="{{route('seller.index')}}" class="side-nav-link">
                <i class="uil-home-alt"></i>
                <span> Dashboards </span>
            </a>
            <div class="collapse" id="sidebarDashboards">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="dashboard-analytics.html">Analytics</a>
                    </li>
                    <li>
                        <a href="index.html">Ecommerce</a>
                    </li>
                    <li>
                        <a href="dashboard-projects.html">Projects</a>
                    </li>
                    <li>
                        <a href="dashboard-wallet.html">E-Wallet <span class="badge rounded bg-danger font-10 float-end">New</span></a>
                    </li>
                </ul>
            </div>
        </li> --}}

        {{-- <li class="side-nav-title side-nav-item">Apps</li> --}}

        <li class="side-nav-item">
            <a href="{{route('seller.product.list')}}" class="side-nav-link">
                <i class="uil-store"></i>
                <span>Sản phẩm </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="{{route('seller.order.list')}}" class="side-nav-link">
                <i class="uil-calender"></i>
                <span>Đơn hàng </span>
            </a>
        </li>
    </ul>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->

</div>