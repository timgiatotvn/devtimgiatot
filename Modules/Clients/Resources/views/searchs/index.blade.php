@extends('clients::layouts.index')

@section('content')
<main class="main">
    <div class="container">
        <div class="nd-breadcrumb">
            <div class="breadcrumb-custom">
                <a href="/">Trang chủ</a>
                <span><img src="./assets/images/icons/arrow.svg" alt=""></span>
                <span>Tìm kiếm kết quả</span>
            </div>
        </div>
        <section class="box-trading">
            <div class="box-trading-floor">
                <div class="item-trading shopee">
                    <div class="box-info">
                        <div class="icon">
                            <img src="./assets/images/icons/shopee.svg" alt="">
                        </div>
                        <div class="content">
                            <h4>Shopee</h4>
                            <p>
                                Freeship toàn quốc
                                </p>
                        </div>
                    </div>
                    <a href="" class="item-link">Mua sắm ngay</a>
                    <div class="date-sale"></div>
                    <div class="number-date">10.10</div>
                </div>
                <div class="item-trading lazada">
                    <div class="box-info">
                        <div class="icon">
                            <img src="./assets/images/icons/lazada.svg" alt="">
                        </div>
                        <div class="content">
                            <h4>Lazada</h4>
                            <p>
                                Freeship toàn quốc
                                </p>
                        </div>
                    </div>
                    <a href="" class="item-link">Mua sắm ngay</a>
                    <div class="date-sale"></div>
                    <div class="number-date">10.10</div>
                </div>
                <div class="item-trading tiki">
                    <div class="box-info">
                        <div class="icon">
                            <img src="./assets/images/icons/tiki.jpg" alt="">
                        </div>
                        <div class="content">
                            <h4>Tiki</h4>
                            <p>
                                Freeship toàn quốc
                                </p>
                        </div>
                    </div>
                    <a href="" class="item-link">Mua sắm ngay</a>
                    <div class="date-sale"></div>
                    <div class="number-date">10.10</div>
                </div>
                <div class="item-trading sendo">
                    <div class="box-info">
                        <div class="icon">
                            <img src="./assets/images/icons/sendo.svg" alt="">
                        </div>
                        <div class="content">
                            <h4>Sendo</h4>
                            <p>
                                Freeship toàn quốc
                                </p>
                        </div>
                    </div>
                    <a href="" class="item-link">Mua sắm ngay</a>
                    <div class="date-sale"></div>
                    <div class="number-date">10.10</div>
                </div>
            </div>
        </section>
        <section class="box-product">
            <p>
                <b>Kết quả tìm kiếm:</b> <span>{{number_format($data['list']->total())}} sản phẩm cho “{{$data['keyword']}}”</span>
            </p>
            <div class="product-list">
                @foreach ($data['list'] as $row)
                    <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}" title="{{ $row->title }}" class="item-product card-product">
                        <div class="box-image">
                            <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                            title="{{ $row->title }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                            <h5 title="{{ $row->title }}" class="card-title product-title">{{ $row->title }}</h5>
                            <p class="card-text note">Có {{ $row->count_suggest }} nơi bán</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <br>
            {{ $data['list']->links('clients::elements.extend.pagination') }}
        </section>
    </div>
</main>
@endsection