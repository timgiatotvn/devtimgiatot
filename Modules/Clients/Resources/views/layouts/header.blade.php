<header class="header">
    {{-- <div class="download-app">
        <div class="box-app">
            <button onclick="closeDiv('download-app')" class="close-download"><img src="{{asset('assets/images/icons/close-m.svg')}}" alt=""></button>
            <div class="info-app">
                <div class="box-icon">
                    <img src="{{asset('assets/images/icons/logo_app.webp')}}" alt="">
                </div>
                <div class="content-app">
                    <h4>TIMGIATOT.VN</h4>
                    <p class="mb-0">Thiết kế website, quảng cáo online, SEO tổng thể</p>
                </div>
            </div>
        </div>
        <div class="btn-download">
            <a href="https://web89.vn/" target="_blank" class="btn">Xem ngay</a>
        </div>
    </div> --}}
    <div class="menu-layout" id="clickMenuLayout"></div>
    {{-- <section class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="menu-bar-left">
                        <li><a href="/gioi-thieu-ve-chung-toi.html">Giới thiệu</a></li>
                        <li><a href="/kien-thuc">Kiến thức</a></li>
                        <li><a href="/tin-tuc">Tin tức</a></li>
                        <li><a href="/doi-tac">Đối tác</a></li>
                        <li><a href="/lien-he">Liên hệ</a></li>
                        <li><a href="/dich-vu">Dịch vụ</a></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="d-flex align-items-center menu-bar-right">
                        <li><div class="gmail"><img src="{{asset('assets/images/icons/Email_red.svg')}}" alt=""><a href="">info@timgiatot.vn</a></div></li>
                        <li>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/twitter.png')}}" alt=""></a>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/facebook.png')}}" alt=""></a>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/youtube.png')}}" alt=""></a>
                            <a class="icon" href=""><img src="{{asset('assets/images/icons/zalo.svg')}}" alt=""></a>
                        </li>
                        <li>
                            <a href="{{ route('seller.index') }}" class="auth">Người bán</a>
                            <a href="{{ route('client.user.login') }}" class="auth">Đăng nhập</a>
                            <a href="{{ route('client.user.register') }}" class="auth">Đăng ký</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="menu-primary">
       <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="box-logo">
                    <div class="icon-menu"><button class="button-open-menu" type="button" id="clickOpenMenu"><img src="{{asset('assets/images/icons/menu.svg')}}" alt=""></button></div>
                    <a class="logo" href="/"><img src="{{asset('assets/images/icons/timgiatotvn2.svg')}}" alt=""></a>
                    <div class="user-icon">
                        <a href="/users/dang-nhap">
                            <img src="{{asset('assets/images/icons/users.svg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="navbar-mobile" id="menu_mobile">
                    <div class="close-navbar"><button type="button" id="closeMenu"><img src="{{asset('assets/images/icons/close-m.svg')}}" alt=""></button></div>
                    <ul class="menu-mobile">
                        <li><a href="/">Trang chủ</a></li>
                        <li>
                            <div class="nav-item">
                                <a href="#">Danh mục</a><div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                            </div>
                            {!! showCategoryMobile($data_share['categories']) !!}
                            {{-- <ul class="sub-menu-primary">
                                @foreach ($data_share['category_products'] as $cate_items)
                                    @if ($cate_items->category->count() > 0)
                                        <li>
                                            <div class="sub-nav-item">
                                                {{$cate_items->title}}</a>
                                                <div class="sub-sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                                            </div>
                                            <ul class="sub-sub-nav-item">
                                                @foreach ($cate_items->category->sortBy('sort') as $cate_item)
                                                    <li>
                                                        <div class="sub-nav-item">
                                                            <a href="{{route('client.category.index', ['slug' => $cate_item->slug])}}">{{$cate_item->title}}</a>
                                                            @if ($cate_item->category->count() > 0)
                                                            <div class="sub-sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                                                            @endif
                                                        </div>
                                                        @if ($cate_item->category->count() > 0)
                                                            <ul class="sub-sub-nav-item">
                                                                @foreach ($cate_item->category->sortBy('sort') as $item)
                                                                    <li>
                                                                        <a href="{{route('client.category.index', ['slug' => $item->slug])}}">{{$item->title}}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="{{route('client.category.index', ['slug' => $cate_items->slug])}}">{{$cate_items->title}}</a></li>
                                    @endif
                                @endforeach
                            </ul> --}}
                        </li>
                        {{-- <li><a href="/gioi-thieu-ve-chung-toi.html">Giới thiệu</a></li>
                        <li>
                            <div class="nav-item">
                                <a href="/kien-thuc">Kiến thức</a><div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                            </div>
                            <ul class="sub-menu-primary">
                                @foreach ($data_share['cate_kien_thuc'] as $categoryItem)
                                    <a href="{{route('client.category.index', ['slug' => $categoryItem->slug])}}">
                                        <li>
                                            {{$categoryItem->title}}
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="/tin-tuc">Tin tức</a></li>
                        <li><a href="/doi-tac">Đối tác</a></li>
                        <li><a href="/lien-he">Liên hệ</a></li> --}}
                    </ul>
                    <hr>
                    <div class="info">
                        <p><img src="{{asset('assets/images/icons/email1.svg')}}" alt=""><a href="#">info@timgiatot.vn</a></p>
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
                    <button class="back-btn" id="btn_back"><img style="display: none" src="{{asset('assets/images/icons/arrow_back.svg')}}" alt=""></button>
                    <div class="box-search">
                        <form action="{{route('client.category.search')}}" method="GET">
                            <input autocomplete="off" type="text" name="keyword" class="form-control input-search" id="inputSearch" placeholder="Nhập từ khóa sản phẩm cần tìm giá">
                            <img src="{{asset('assets/images/icons/search-normal-1.svg')}}" class="icon-search" alt="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
       </div>
       <div style="display: none" class="box-result-search" id="box_result">
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