@extends('clients::layouts.index')

@section('content')
<main class="main">
    <div class="container">
        {{-- <div class="nd-breadcrumb">
            <div class="breadcrumb-custom">
                <a href="#">Trang chủ</a>
                <span><img src="./assets/images/icons/arrow.svg" alt=""></span>
                <span>Danh mục sản phẩm</span>
            </div>
        </div> --}}
        @include('clients::elements.extend.breadcrumb')
        @include('clients::elements.list_ecommerce')
        <section class="category-banner">
            <div class="row">
                <div class="col-lg-3">
                    @if(count($data['category_products']) > 0)
                        <div class="card sidebar-category">
                            <div class="card-header">
                                <img src="{{asset('assets/images/icons/menu.svg')}}" alt=""><span>Danh mục sản phẩm</span>
                            </div>
                            <ul class="list-group list-group-flush list-category">
                                @foreach ($data['category_products'] as $cate_item)
                                    @if ($cate_item->category->count())
                                        <li class="list-group-item">
                                            <div class="item-category">
                                                <a href="{{route('client.category.index', ['slug' => $cate_item->slug])}}">{{$cate_item->title}}</a>
                                                <div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                                            </div>
                                            <ul class="sub-menu">
                                                @foreach ($cate_item->category as $item)
                                                    <li>
                                                        <a href="{{route('client.category.index', ['slug' => $item->slug])}}" class="sub-item">{{$item->title}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="list-group-item"><a href="{{route('client.category.index', ['slug' => $cate_item->slug])}}">{{$cate_item->title}}</a></li>
                                    @endif                                
                                @endforeach
                            
                            </ul>
                        </div>
                    @endif
                    @include('clients::elements.news_coupon')
                </div>
                <div class="col-lg-9">
                    <section class="box-product box-list-category">
                        <div class="category-product-header">
                            <h2>
                                {{$data['category']->title}}
                            </h2>
                            {{-- <p class="category-review"> --}}
                                {{-- <p class="category-review">Đánh giá và nhận xét sản phẩm qua hàng loạt mô tả chi tiết. Giúp bạn có cái nhìn đầy đủ về sản phẩm mà bạn đang quan tâm</p> --}}
                                
                            {{-- </p> --}}
                            @php
                                if (strlen($data['category']->description)) {
                                    $style = "-webkit-line-clamp: 10;
                                            -webkit-box-orient: vertical;
                                            display: -webkit-box;
                                            font-size: 16px;
                                            line-height: 20px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;";
                                } else {
                                    $style="";
                                }
                            @endphp
                            <div class="description" style="{{$style}}">
                                {!!$data['category']->description!!}
                            </div>
                            @if($style != '')
                                <p class="read-more" style="cursor: pointer; color: #0D54BE">Xem thêm</p>
                            @endif
                        </div>
                        <div class="product-list category-list">
                            @foreach($data['list'] as $row)
                                @if($row->type == "crawler")
                                    <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}" title="{{ $row->title }}" class="item-product card-product">
                                        <div class="box-image">
                                            <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                            title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                                        </div>
                                        <div class="card-body">
                                            <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                            <h5 title="{{ $row->title }}" class="card-title product-title">{{ $row->title }}</h5>
                                            <p class="card-text note">Có {{ $row->count_suggest }} nơi bán</p>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                        title="{{ $row->title }}" rel="nofollow sponsored" class="item-product card-product">
                                        <div class="box-image">
                                            <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                            title="{{ $row->title }}" class="card-img-top" alt="{{ $row->title }}">
                                        </div>
                                        <div class="card-body">
                                            <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                            <h5 title="{{ $row->title }}" class="card-title product-title">{{ $row->title }}</h5>
                                            {{-- <p class="card-text note">Có {{ $row->count_suggest }} nơi bán</p> --}}
                                        </div>
                                    </a>
                                @endif
                            @endforeach                            
                        </div>
                        {{ $data['list']->links('clients::elements.extend.pagination') }}
                        {{-- <div class="category-buttom">
                            <a href="#" class="btn btn-all">Xem thêm</a>
                        </div> --}}
                        <div class="description" style="{{$style}}">
                                {!!$data['category']->description!!}
                        </div>
                        @if($style != '')
                            <p class="read-more" style="cursor: pointer; color: #0D54BE">Xem thêm</p>
                        @endif
                    </section>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@section('scripts')
    <style>
        .full-content {
            -webkit-line-clamp: unset !important;
        }
    </style>
    <script>
        $(function() {
            $('.read-more').click(function() {
                var name = $('.read-more').html();
                console.log(name);
                if (name == 'Xem thêm') {
                    $('.read-more').html('Rút gọn');
                    $('.description').addClass('full-content');
                } else if (name == 'Rút gọn') {
                    $('.read-more').html('Xem thêm');
                    $('.description').removeClass('full-content');
                }
            })
            $('.box-search input').attr('placeholder', 'Tìm kiếm sản phẩm');
        })
    </script>
@endsection