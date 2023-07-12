@extends('clients::layouts.index')

@section('content')
<main class="main">
    <div class="container">
        <section class="category-banner">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card sidebar-category">
                        <div class="card-header">
                            <img src="./assets/images/icons/menu.svg" alt=""><span>Danh mục</span>
                        </div>
                        {!! showCategories($data['categories']) !!}
                        {{-- <ul class="list-group list-group-flush list-category">
                            @foreach ($data['category_products'] as $cate_item)
                                @if ($cate_item->category->count() > 0)
                                    <li class="list-group-item">
                                        <div class="item-category">
                                            <a href="{{route('client.category.index', ['slug' => $cate_item->slug])}}">{{$cate_item->title}}</a>
                                            <div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                                        </div>
                                        <ul class="sub-menu">
                                            @foreach ($cate_item->category->sortBy('sort') as $item)
                                                @if($item->category->count() > 0)
                                                    <li>
                                                        <div class="item-sub-category"><a href="{{route('client.category.index', ['slug' => $item->slug])}}" class="sub-item">{{$item->title}}</a><div class="sub-sub-btn-primary"><i class="fa-solid fa-chevron-right sub-dropdown"></i></div></div>
                                                        <ul class="sub-sub-menu-primary">
                                                            @foreach ($item->category->sortBy('sort') as $subItem)
                                                                <li><a href="{{route('client.category.index', ['slug' => $subItem->slug])}}">{{$subItem->title}}</a></li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                    </li>
                                                    
                                                @else
                                                <li>
                                                    <a href="{{route('client.category.index', ['slug' => $item->slug])}}" class="sub-item">{{$item->title}}</a>
                                                    
                                                </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="list-group-item"><a href="{{route('client.category.index', ['slug' => $cate_item->slug])}}">{{$cate_item->title}}</a></li>
                                @endif                                
                            @endforeach
                        </ul> --}}
                    </div>
                </div>
                <div class="col-lg-9">
                    @include('clients::elements.list_deal')
                    <div class="banner">
                        <a target="_blank" href="{{$data['ads_home']->url}}" rel="nofollow">
                            <img src="{{ \App\Helpers\Helpers::renderThumb($data['ads_home']->thumbnail, 'slide') }}" alt="" class="image-banner">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        {{-- {!! showCategories($data['categories']) !!} --}}
        @include('clients::elements.list_ecommerce')
        <section class="box-product">
            <div class="product-header">
                <h2>
                    Thông tin mới cập nhật
                </h2>
                <a href="https://timgiatot.vn/blog/">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
            </div>
            @if (!empty($data["widget"]["image_most_search"]) && $data["widget"]["image_most_search"]->content != "")
                <div class="row">
                    @foreach (json_decode($data["widget"]["image_most_search"]->content, true) as $key => $imageItem)
                        <div class="{{$key == 0 ? 'col-lg-6 mb-4' : 'd-none d-sm-none d-md-block col-lg-6 mb-4'}}">
                            <div class="box-image-ads">
                                <a href="{{ !empty($imageItem['url']) ? $imageItem['url'] : '' }}" target="_blank">
                                    <img src="{{ !empty($imageItem['image'] ) ? $imageItem['image'] : ''}}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
    {{--                 
                    <div class="d-none d-sm-none d-md-block col-lg-6 mb-4">
                        <div class="box-image-ads">
                            <img src="{{asset('assets/images/products/image_ads.jpg')}}" alt="">
                        </div>
                    </div> --}}
                </div>
            @endif
            <div class="row news-list">
                @foreach ($data["news_most_search"] as $newsItem)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 news-item">
                        <div class="item-product item-product card-product">
                            <div class="box-image">
                                <a rel="sponsored" title="{{ $newsItem['title']['rendered'] }}" href="{{ $newsItem['link'] }}" class="">
                                    <img src="{{ !empty($newsItem['_embedded']['wp:featuredmedia'][0]['source_url']) ? $newsItem['_embedded']['wp:featuredmedia'][0]['source_url'] : '' }}" title="" style="object-fit: cover" class="card-img-top">
                                </a>
                                <div class="time">
                                    <span class="date">{{ date("d", strtotime($newsItem["date"])) }}</span> <br>
                                    <span class="month">Th{{ date("m", strtotime($newsItem["date"])) }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title product-title">
                                    <a class="text-decoration-none" href="{{ $newsItem['link'] }}">
                                        {{ html_entity_decode($newsItem["title"]["rendered"]) }}
                                    </a>
                                </h3>
                                <p class="card-text note  line-clamp-2">
                                    {{ html_entity_decode(strip_tags($newsItem["excerpt"]["rendered"])) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="box-product">
            <div class="product-header">
                <h2>
                    Ưu đãi đối tác
                </h2>
                <a href="https://timgiatot.vn/blog/uu-dai-tu-doi-tac">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
            </div>
            @if (!empty($data["widget"]["image_coupon_partner"]) && $data["widget"]["image_coupon_partner"]->content != "")
                <div class="row">
                    @foreach (json_decode($data["widget"]["image_coupon_partner"]->content, true) as $key => $imageItem)
                        <div class="{{$key == 0 ? 'col-lg-6 mb-4' : 'd-none d-sm-none d-md-block col-lg-6 mb-4'}}">
                            <div class="box-image-ads">
                                <a href="{{ !empty($imageItem['url']) ? $imageItem['url'] : '' }}" target="_blank">
                                    <img src="{{ !empty($imageItem['image'] ) ? $imageItem['image'] : ''}}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
    {{--                 
                    <div class="d-none d-sm-none d-md-block col-lg-6 mb-4">
                        <div class="box-image-ads">
                            <img src="{{asset('assets/images/products/image_ads.jpg')}}" alt="">
                        </div>
                    </div> --}}
                </div>
            @endif
            <div class="row news-list">
                @foreach ($data["news_coupon"] as $newsItem)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 news-item">
                        <div class="item-product item-product card-product">
                            <div class="box-image">
                                <a rel="sponsored" title="{{ $newsItem['title']['rendered'] }}" href="{{ $newsItem['link'] }}" class="">
                                    <img src="{{ !empty($newsItem['_embedded']['wp:featuredmedia'][0]['source_url']) ? $newsItem['_embedded']['wp:featuredmedia'][0]['source_url'] : '' }}" title="" style="object-fit: cover" class="card-img-top">
                                </a>
                                <div class="time">
                                    <span class="date">{{ date("d", strtotime($newsItem["date"])) }}</span> <br>
                                    <span class="month">Th{{ date("m", strtotime($newsItem["date"])) }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title product-title">
                                    <a class="text-decoration-none" href="{{ $newsItem['link'] }}">
                                        {{ html_entity_decode($newsItem["title"]["rendered"]) }}
                                    </a>
                                </h3>
                                <p class="card-text note  line-clamp-2">
                                    {{ html_entity_decode(strip_tags($newsItem["excerpt"]["rendered"])) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</main>
@endsection