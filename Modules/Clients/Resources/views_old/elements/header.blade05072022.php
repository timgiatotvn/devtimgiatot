<header id="header">
    <div class="main-width">
        @if(!empty($data['page_home']))
        <div style="opacity: 0; display: none;">
            <h1>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</h1>
        </div>
        @endif
        <div class="row no-gutters">
            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                <a href="{{ route('client.home') }}">
                    <img src="{{ !empty($data_common['logo']->thumbnail) ? \App\Helpers\Helpers::renderThumb(asset($data_common['logo']->thumbnail), 'logo') : '' }}"/>
                </a>
            </div>
            <div class="col-12 col-md-7 col-lg-7 col-xl-7">
                <form method="get" action="{{ route('client.category.search') }}" class="wrap-form-search">
                    <input type="text" name="keyword" value="{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}" class="form-control" placeholder="Keyword"/>
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                <div class="wrap-user">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div>
                        @if(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check())
                            Xin chào: {{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->name }} / <a href="{{ route('client.user.show') }}" title="Thông tin">Thông tin</a>
                        @else
                            <a href="{{ route('client.user.login') }}" title="Đăng nhập">Đăng nhập</a> / <a
                                    href="{{ route('client.user.register') }}" title="Đăng ký">Đăng ký</a>
                        @endif
                            / <a
                                    href="{{ route('client.card.index') }}" title="Đăng ký">Giỏ hàng({{ !empty($_SESSION['shopping_cart']) ? count($_SESSION['shopping_cart']) : 0 }})</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>