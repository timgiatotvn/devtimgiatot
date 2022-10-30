@extends('clients::layouts.index')

@section('content')
<main class="main">
    <div class="container">
        <section class="category-banner">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card sidebar-category">
                        <div class="card-header">
                            <img src="./assets/images/icons/menu.svg" alt=""><span>Danh mục sản phẩm</span>
                        </div>
                        <ul class="list-group list-group-flush list-category">
                            {{-- <li class="list-group-item">
                                <div class="item-category"><a href="">list danh mục sản phẩm</a><div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div></div>
                                <ul class="sub-menu">
                                    <li><a href="#" class="sub-item">Sub Item 01</a></li>
                                    <li><a href="#" class="sub-item">Sub Item 02</a></li>
                                </ul>
                            </li> --}}
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
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                   <div class="promotion">
                    <ul class="box-promotion">
                        <li><a href="#">Deal Vạn năng - Mua 1 tặng 1</a></li>
                        <li><a href="#">Địa Gia Dụng - Giảm 50%</a></li>
                        <li><a href="#">Bắt Trend Giá Sốc</a></li>
                        <li><a href="#">Triệu Deal 0 Đồng</a></li>
                        <li><a href="#">Sale Shop Mới - Giảm 69%</a></li>
                    </ul>
                   </div>
                    <div class="banner">
                        <a target="_blank" href="{{$data['ads_home']->url}}" rel="nofollow">
                            <img src="{{ \App\Helpers\Helpers::renderThumb($data['ads_home']->thumbnail, 'slide') }}" alt="" class="image-banner">
                        </a>
                        
                    </div>
                </div>
            </div>
        </section>
        @include('clients::elements.list_ecommerce')
        <section class="box-product product-top">
            <div class="product-header">
                <h2>Tìm kiếm nhiều</h2>
                <a href="#">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
            </div>
            <div class="owl-carousel owl-theme owl-product">
                @foreach($data['products'] as $row)
                    @if($row->type == "crawler")
                        <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}" class="card item-product">
                            <div class="box-image">
                                <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumnail), 'list_product') }}"
                                title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                            </div>
                            <div class="card-body">
                                <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                <h3 class="card-title product-title" title="{{ $row->title }}">
                                    {{ $row->title }}
                                </h3>
                                <p class="card-text note">Có {{ $row->count_suggest }} nơi bán</p>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}" class="card item-product">
                            <div class="box-image">
                                <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                            </div>
                            <div class="card-body">
                                <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                <h3 class="card-title product-title" title="{{ $row->title }}">
                                    {{ $row->title }}
                                </h3>
                                <p class="card-text note"></p>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </section>
        @foreach($data['cate'] as $cate)
            <section class="box-product">
                <div class="product-header">
                    <h2>{{$cate['name']}}</h2>
                    <a href="{{ route('client.category.index', ['slug' => $cate['slug']])}}">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="box-image-ads">
                            <img src="{{asset('assets/images/products/image_ads.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="d-none d-sm-none d-md-block col-lg-6 mb-4">
                        <div class="box-image-ads">
                            <img src="{{asset('assets/images/products/image_ads.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    @foreach($cate['data'] as $row)
                        @if($row->type == "crawler")
                            <a rel="nofollow sponsored" title="{{ $row->title }}" href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}" class="item-product card-product">
                                <div class="box-image">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                    title="{{ $row->title }}" class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                    <h3 class="card-title product-title">{{ $row->title }}</h3>
                                    <p class="card-text note">Có {{ $row->count_suggest }} nơi bán</p>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                title="{{ $row->title }}" rel="nofollow sponsored" class="item-product card-product">
                                <div class="box-image">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                    title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                                </div>
                                <div class="card-body">
                                    <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                    <h3 class="card-title product-title">{{ $row->title }}</h3>
                                    <p class="card-text note"></p>
                                </div>
                            </a>
                        @endif
                        
                    @endforeach
                </div>
            </section>
        @endforeach
        <section class="box-product new-promotion">
            <div class="product-header">
                <h2>{{ !empty($data['cat_tintuc']->title) ? $data['cat_tintuc']->title : '' }}</h2>
                <a class="d-none d-sm-block" href="{{ !empty($data['cat_tintuc']->id) ? route('client.category.index', ['slug' => $data['cat_tintuc']->slug]) : '' }}">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
            </div>
            <div class="promotion_mobile">
                @foreach($data['news'] as $row)
                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}" class="card item-promotion">
                        <div class="box-image">
                            <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new') }}"
                                title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                        </div>
                        <div class="card-body">
                            <h3 class="promotion-title" title="{{ $row->title }}">{{ $row->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
            <hr>
            <a href="{{ !empty($data['cat_tintuc']->id) ? route('client.category.index', ['slug' => $data['cat_tintuc']->slug]) : '' }}" class="read-more-mobile">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
            <div class="owl-carousel owl-theme owl-promotion promotion_desktop">
                @foreach($data['news'] as $row)
                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                        title="{{ $row->title }}" class="card item-promotion">
                        <div class="box-image">
                            <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new') }}"
                            title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                        </div>
                        <div class="card-body">
                            <h3 class="promotion-title" title="{{ $row->title }}">{{ $row->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <section class="box-product knowledge">
            <div class="product-header">
                <h2>{{ !empty($data['cat_kienthuc']->title) ? $data['cat_kienthuc']->title : '' }}</h2>
                <a class="d-none d-sm-block" href="{{ !empty($data['cat_kienthuc']->id) ? route('client.category.index', ['slug' => $data['cat_kienthuc']->slug]) : '' }}"
                    title="Xem tất cả">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
            </div>
            <div class="knowledge_mobile">
                <div class="row">
                    @foreach($data['kienthuc'] as $row)
                        <div class="col-lg-4 mb-4">
                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                title="{{ $row->title }}" class="card item-knowledge">
                                <div class="box-image">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new') }}" class="card-img-top" alt="{{ $row->title }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="knowledge-title">{{ $row->title }}</h5>
                                    <div class="overview">{{$row->description}}</div>
                                    <div class="box-user">
                                        <div class="avatar-user">
                                            <img src="{{asset('assets/images/products/avatar.svg')}}" alt="">
                                        </div>
                                        <div class="view"><i class="fa-regular fa-eye"></i><span>{{$row->total_views}}</span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <hr>
                    <a href="{{ !empty($data['cat_kienthuc']->id) ? route('client.category.index', ['slug' => $data['cat_kienthuc']->slug]) : '' }}" class="read-more-mobile">Xem thêm <img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></a>
                </div>
            </div>
            <div class="owl-carousel owl-theme owl-knowledge knowledge_desktop">
                @foreach($data['kienthuc'] as $row)
                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                        title="{{ $row->title }}" class="card item-knowledge">
                        <div class="box-image">
                            <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new') }}"
                            title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                        </div>
                        <div class="card-body">
                            <h3 class="knowledge-title">
                                {{ $row->title }}
                            </h3>
                            <div class="overview">
                                {{$row->description}}
                            </div>
                            <div class="box-user">
                                <div class="avatar-user">
                                    <img src="{{asset('assets/images/products/avatar.svg')}}" alt="">
                                </div>
                                <div class="view"><i class="fa-regular fa-eye"></i><span>{{$row->total_views}}</span></div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        {{-- <section class="box-product knowledge">
            <div class="product-header">
                <h2>Kiến thức</h2>
                <a href="#" class="read-more-desktop">Xem thêm <img src="images/icons/arrow.svg" alt=""></a>
            </div>
            <div class="owl-carousel owl-theme owl-knowledge knowledge_desktop">
                <a href="#" class="card item-knowledge">
                    <div class="box-image">
                        <img src="images/products/Rectangle.svg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="knowledge-title">Có nên mua máy giặt LG 9kg cửa ngang?</h5>
                        <div class="overview">lorem ipsum dolor sit amet consectetuer adipiscing elit  lorem ipsum dolor sit a...</div>
                        <div class="box-user">
                            <div class="avatar-user">
                                <img src="images/products/avatar.svg" alt="">
                            </div>
                            <div class="view"><i class="fa-regular fa-eye"></i><span>300</span></div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card item-knowledge">
                    <div class="box-image">
                        <img src="images/products/Rectangle.svg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="knowledge-title">Có nên mua máy giặt LG 9kg cửa ngang?</h5>
                        <div class="overview">lorem ipsum dolor sit amet consectetuer adipiscing elit  lorem ipsum dolor sit a...</div>
                        <div class="box-user">
                            <div class="avatar-user">
                                <img src="images/products/avatar.svg" alt="">
                            </div>
                            <div class="view"><i class="fa-regular fa-eye"></i><span>300</span></div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card item-knowledge">
                    <div class="box-image">
                        <img src="images/products/Rectangle.svg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="knowledge-title">Có nên mua máy giặt LG 9kg cửa ngang?</h5>
                        <div class="overview">lorem ipsum dolor sit amet consectetuer adipiscing elit  lorem ipsum dolor sit a...</div>
                        <div class="box-user">
                            <div class="avatar-user">
                                <img src="images/products/avatar.svg" alt="">
                            </div>
                            <div class="view"><i class="fa-regular fa-eye"></i><span>300</span></div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card item-knowledge">
                    <div class="box-image">
                        <img src="images/products/Rectangle.svg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="knowledge-title">Có nên mua máy giặt LG 9kg cửa ngang?</h5>
                        <div class="overview">lorem ipsum dolor sit amet consectetuer adipiscing elit  lorem ipsum dolor sit a...</div>
                        <div class="box-user">
                            <div class="avatar-user">
                                <img src="images/products/avatar.svg" alt="">
                            </div>
                            <div class="view"><i class="fa-regular fa-eye"></i><span>300</span></div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card item-knowledge">
                    <div class="box-image">
                        <img src="images/products/Rectangle.svg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="knowledge-title">Có nên mua máy giặt LG 9kg cửa ngang?</h5>
                        <div class="overview">lorem ipsum dolor sit amet consectetuer adipiscing elit  lorem ipsum dolor sit a...</div>
                        <div class="box-user">
                            <div class="avatar-user">
                                <img src="images/products/avatar.svg" alt="">
                            </div>
                            <div class="view"><i class="fa-regular fa-eye"></i><span>300</span></div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card item-knowledge">
                    <div class="box-image">
                        <img src="images/products/Rectangle.svg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="knowledge-title">Có nên mua máy giặt LG 9kg cửa ngang?</h5>
                        <div class="overview">lorem ipsum dolor sit amet consectetuer adipiscing elit  lorem ipsum dolor sit a...</div>
                        <div class="box-user">
                            <div class="avatar-user">
                                <img src="images/products/avatar.svg" alt="">
                            </div>
                            <div class="view"><i class="fa-regular fa-eye"></i><span>300</span></div>
                        </div>
                    </div>
                </a>
                <a href="#" class="card item-knowledge">
                    <div class="box-image">
                        <img src="images/products/Rectangle.svg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="knowledge-title">Có nên mua máy giặt LG 9kg cửa ngang?</h5>
                        <div class="overview">lorem ipsum dolor sit amet consectetuer adipiscing elit  lorem ipsum dolor sit a...</div>
                        <div class="box-user">
                            <div class="avatar-user">
                                <img src="images/products/avatar.svg" alt="">
                            </div>
                            <div class="view"><i class="fa-regular fa-eye"></i><span>300</span></div>
                        </div>
                    </div>
                </a>
            </div>
        </section> --}}
    </div>
</main>
@endsection