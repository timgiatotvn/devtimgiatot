<header id="header">
    <div class="main-width">
        <div class="row no-gutters">
            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                <a href="{{ route('client.home') }}">
                    <img src="{{ !empty($data_common['logo']->thumbnail) ? \App\Helpers\Helpers::renderThumb(asset($data_common['logo']->thumbnail), 'logo') : '' }}"/>
                </a>
            </div>
            <div class="col-12 col-md-7 col-lg-7 col-xl-7">
                <form method="get" action="{{ route('client.category.search') }}" class="wrap-form-search">
                    <input type="text" name="keyword" class="form-control" placeholder="Keyword" />
                    <button type="submit" class="btn btn-primary mb-2">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                <div class="wrap-user">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div>
                        <a href="#" title="">Đăng nhập</a> / <a href="#" title="">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>