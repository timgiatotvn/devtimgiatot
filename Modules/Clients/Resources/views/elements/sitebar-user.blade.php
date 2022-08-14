<nav id="sitebar-user">
    <div class="wrap-menu-user">
        <label class="head">Chức năng</label>
        <ul>
            <li>
                <a href="{{ route('client.user.show') }}" class="{{ Request::routeIs('client.user.show') ? 'active' : '' }}" title="Thông tin cá nhân">Thông tin cá nhân</a>
            </li>
            {{-- <li>
                <a href="{{ route('client.card.index') }}" class="{{ Request::routeIs('client.card.index') ? 'active' : '' }}" title="Giỏ hàng">Giỏ hàng</a>
            </li> --}}
            <li>
                <a href="{{ route('client.user.notification') }}" class="{{ Request::routeIs('client.user.notification') ? 'active' : '' }}" title="Giỏ hàng">Push Notification</a>
            </li>
            <li>
                <a href="{{ route('client.user.logout') }}" title="Đăng xuất">Đăng xuất</a>
            </li>
        </ul>
    </div>

    {!! !empty($data_common['setting']->ads3) ? $data_common['setting']->ads3 : '' !!}

</nav>