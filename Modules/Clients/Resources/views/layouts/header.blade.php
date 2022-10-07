<header class="header">
    <div class="menu-layout" id="clickMenuLayout"></div>
    <section class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="menu-bar-left">
                        <li><a href="infomation.html">Giới thiệu</a></li>
                        <li><a href="/kien-thuc">Kiến thức</a></li>
                        <li><a href="/tin-tuc">Tin tức</a></li>
                        <li><a href="/doi-tac">Đối tác</a></li>
                        <li><a href="/lien-he">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="d-flex align-items-center menu-bar-right">
                        <li><div class="gmail"><img src="{{asset('assets/images/icons/Email.svg')}}" alt=""><a href="">info@timgiatot.vn</a></div></li>
                        <li>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/twitter.png')}}" alt=""></a>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/facebook.png')}}" alt=""></a>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/youtube.png')}}" alt=""></a>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/zalo.svg')}}" alt=""></a>
                        </li>
                        <li><a href="{{ route('client.user.login') }}" class="auth">Đăng nhập</a><a href="{{ route('client.user.register') }}" class="auth">Đăng ký</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="menu-primary">
       <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="box-logo">
                    <div class="icon-menu"><button class="button-open-menu" type="button" id="clickOpenMenu"><img src="{{asset('assets/images/icons/menu.svg')}}" alt=""></button></div>
                    <a class="logo" href="/"><img src="{{asset('assets/images/icons/timgiatotvn2.svg')}}" alt=""></a>
                    <div class="user-icon"><img src="{{asset('assets/images/icons/users.svg')}}" alt=""></div>
                </div>
                <div class="navbar-mobile" id="menu_mobile">
                    <div class="close-navbar"><button type="button" id="closeMenu"><img src="{{asset('assets/images/icons/close-m.svg')}}" alt=""></button></div>
                    <ul class="menu-mobile">
                        <li><a href="/">Trang chủ</a></li>
                        <li>
                            <div class="nav-item">
                                <a href="#">Danh mục sản phẩm</a><div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                            </div>
                            <ul class="sub-menu-primary">
                                <li>
                                   <div class="sub-nav-item">
                                        <a href="#">list danh mục sản phẩm</a>
                                        <div class="sub-sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                                   </div>
                                   <ul class="sub-sub-nav-item">
                                        <li><a href="#">Item menu</a></li>
                                        <li><a href="#">Item menu</a></li>
                                        <li><a href="#">Item menu</a></li>
                                   </ul>
                                </li>
                                <li><a href="#">list danh mục sản phẩm</a></li>
                                <li><a href="#">list danh mục sản phẩm</a></li>
                                <li><a href="#">list danh mục sản phẩm</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Kiến thức</a></li>
                        <li><a href="#">Tin tức</a></li>
                        <li><a href="#">Đối tác</a></li>
                    </ul>
                    <hr>
                    <div class="info">
                        <p><img src="{{asset('assets/images/icons/Email.svg')}}" alt=""><a href="#">info@timgiatot.vn</a></p>
                        <div class="social-header">
                            <div class="item-social"><img src="{{asset('assets/images/icons/twitter.png')}}" alt=""></div>
                            <div class="item-social"><img src="{{asset('assets/images/icons/facebook.png')}}" alt=""></div>
                            <div class="item-social"><img src="{{asset('assets/images/icons/youtube.png')}}" alt=""></div>
                            <div class="item-social"><img src="{{asset('assets/images/icons/zalo.svg')}}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex align-items-center menu-primary-right">
                    <button class="back-btn" id="btn_back"><img src="./assets/images/icons/arrow_back.svg" alt=""></button>
                    <div class="box-search">
                        <form action="{{route('client.category.search')}}" method="GET">
                            <input type="text" name="keyword" class="form-control input-search" id="inputSearch" placeholder="Nhập từ khóa sản phẩm cần tìm giá">
                            <img src="./assets/images/icons/search-normal-1.svg" class="icon-search" alt="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
       </div>
       <div class="box-result-search" id="box_result">
            <p class="text-search">Tìm kiếm gần đây</p>
            <div class="list-product-search">
                <div class="item-search">
                    <div class="name-product">Tên sản phẩm</div>
                    <button type="button"><img src="./assets/images/icons/close-m.svg" alt=""></button>
                </div>
                <div class="item-search">
                    <div class="name-product">Tên sản phẩm</div>
                    <button type="button"><img src="./assets/images/icons/close-m.svg" alt=""></button>
                </div>
                <div class="item-search">
                    <div class="name-product">Tên sản phẩm</div>
                    <button type="button"><img src="./assets/images/icons/close-m.svg" alt=""></button>
                </div>
                <div class="item-search">
                    <div class="name-product">Tên sản phẩm</div>
                    <button type="button"><img src="./assets/images/icons/close-m.svg" alt=""></button>
                </div>
                <div class="item-search">
                    <div class="name-product">Tên sản phẩm</div>
                    <button type="button"><img src="./assets/images/icons/close-m.svg" alt=""></button>
                </div>
                <div class="item-search">
                    <div class="name-product">Tên sản phẩm</div>
                    <button type="button"><img src="./assets/images/icons/close-m.svg" alt=""></button>
                </div>
            </div>
       </div>
    </section>
</header>