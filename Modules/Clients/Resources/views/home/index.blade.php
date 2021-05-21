@extends('clients::layouts.app')

@section('content')
    <section id="box-category-suggest">
        <div class="cs-head">
            <label>TÌM GIÁ TỐT & KHUYẾN MÃI HOT</label>
            <div class="line"></div>
        </div>
        <div class="cs-list">
            <ul>
                @foreach($data['link'] as $row)
                    <li>
                        <div class="cs-item">
                            <div class="cs-item-right">
                                <a href="{{ $row->url_title }}" title="{{ $row->title }}" target="_blank">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'link') }}"
                                         title="{{ $row->title }}">
                                </a>
                            </div>
                            <div class="cs-item-left">
                                <label>{{ $row->title }}</label>
                                <p>{{ \App\Helpers\Helpers::shortDesc($row->description, 42) }}</p>
                                <a href="{{ $row->url }}" title="{{ $row->url_title }}" target="_blank">
                                    {{ $row->url_title }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section id="box-product">
        <div class="pr-head">
            <label>TÌM KIẾM NHIỀU</label>
        </div>
        <div class="pr-content">
            <ul>
                @foreach($data['products'] as $row)
                    <li>
                        <div class="pr-item">
                            <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                               title="{{ $row->title }}">
                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                     title="{{ $row->title }}">
                            </a>
                            <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                            <h3>
                                <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                   title="{{ $row->title }}">
                                    {{ $row->title }}
                                </a>
                            </h3>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section>
        <div class="wrap-ads">
            <ul>
                <li>
                    <a href="" title="">
                        <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/ads/shopee-5-5-pc.jpeg', 'ads_home') }}"
                             title="" alt=""/>
                    </a>
                </li>
                <li>
                    <a href="" title="">
                        <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/ads/shopee-5-5-pc.jpeg', 'ads_home') }}"
                             title="" alt=""/>
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <section id="box-new">
        <div class="nr-head">
            <label>KIẾN THỨC MUA SẮM</label>
            <p>Đánh giá và nhận xét sản phẩm qua hàng loạt mô tả chi tiết.<br>
                Giúp bạn có cái nhìn đầy đủ về sản phẩm mà bạn đang quan tâm</p>
        </div>
        <div class="nr-content">
            <ul>
                @foreach($data['kienthuc'] as $row)
                    <li>
                        <div class="pr-item">
                            <a href="{{ route('client.post.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                               title="{{ $row->title }}">
                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new') }}"
                                     title="{{ $row->title }}">
                            </a>
                            <h3>
                                <a href="{{ route('client.post.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                   title="{{ $row->title }}">
                                    {{ $row->title }}
                                </a>
                            </h3>
                            <p>{{ \App\Helpers\Helpers::shortDesc($row->description, 150) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section>
        <div class="wrap-ads">
            <ul>
                <li>
                    <a href="" title="">
                        <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/ads/shopee-5-5-pc.jpeg', 'ads_home') }}"
                             title="" alt=""/>
                    </a>
                </li>
                <li>
                    <a href="" title="">
                        <img src="{{ \App\Helpers\Helpers::renderThumb('/storage/photos/ads/shopee-5-5-pc.jpeg', 'ads_home') }}"
                             title="" alt=""/>
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <section id="box-new">
        <div class="nr-head">
            <label>TIN KHUYẾN MÃI</label>
            <p>Cập nhật các thông tin khuyến mãi mới nhất từ các sàn thương mại điện tử và các trang bán hàng online,
                cửa hàng gần nhất!</p>
        </div>
        <div class="nr-content">
            <ul>
                @foreach($data['news'] as $row)
                    <li>
                        <div class="pr-item">
                            <a href="{{ route('client.post.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                               title="{{ $row->title }}">
                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new') }}"
                                     title="{{ $row->title }}">
                            </a>
                            <h3>
                                <a href="{{ route('client.post.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                   title="{{ $row->title }}">
                                    {{ $row->title }}
                                </a>
                            </h3>
                            <p>{{ \App\Helpers\Helpers::shortDesc($row->description, 150) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

@endsection
