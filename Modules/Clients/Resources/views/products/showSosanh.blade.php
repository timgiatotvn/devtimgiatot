@extends('clients::layouts.index')

@section('content')
<main class="main">
    <div class="container">
        @include('clients::elements.extend.breadcrumb')
        <section class="category-banner page-detail">
            <div class="row">
                <div class="col-lg-9">
                    <section class="product-detail">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image-product">
                                    <a href="{{ \App\Helpers\Helpers::renderThumb((!empty($data['detail']->thumbnail_cr) ? $data['detail']->thumbnail_cr : $data['detail']->thumbnail), 'product_detail_zoom') }}">
                                        <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($data['detail']->thumbnail_cr) ? $data['detail']->thumbnail_cr : $data['detail']->thumbnail), 'product_detail') }}"
                                    title="{{ $data['detail']->title }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="content-detail">
                                    <h4><a class="a-none" href="{{ route('client.product.showSosanh', ['slug' => $data['detail']->slug.'-'.$data['detail']->id]) }}"
                                        title="{{ $data['detail']->title }}" rel="nofollow sponsored">{{ $data['detail']->title }}</a>
                                    </h4>
                                    <div class="des">{!! $data['detail']->description !!}</div>
                                    {{-- @if(empty($ws[0]["crawler_website"]["id"]) && empty($ws[0]["article"]["id"]))
                                        <p style="font-weight: bold; font-size: 40px" class="price">{{ \App\Helpers\Helpers::formatPrice($data['detail']->price) }}đ</p>
                                    @endif --}}
                                    @php
                                        $ws = @json_decode($data['detail']->website_map, true);
                                    @endphp
                                    @if(!empty($ws[0]["crawler_website"]["id"]) && !empty($ws[0]["article"]["id"]))
                                        <div class="box-place-sale">
                                            <p>Nơi Bán Rẻ Nhất:</p>
                                            <div class="box-price">
                                                <div class="box-image">
                                                    <img src="{{asset('assets/images/icons/shopee.svg')}}" alt="">
                                                </div>
                                                <div class="content">
                                                    <p class="price">
                                                        {{ \App\Helpers\Helpers::formatPrice($data['detail']->price) }}đ
                                                    </p>
                                                    <p class="time-update">Cập nhật {{ \Carbon\Carbon::parse($ws[0]["crawler_website"]["created_at"])->diffForHumans()}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @endif
                                    <div class="box-social">
                                        <span>Chia sẻ</span>
                                        <div class="item-social"><img src="{{asset('assets/images/icons/twitter.png')}}" alt=""></div>
                                        <div class="item-social"><img src="{{asset('assets/images/icons//facebook.png')}}" alt=""></div>
                                        <div class="item-social"><img src="{{asset('assets/images/icons/zalo.svg')}}" alt=""></div>
                                    </div>
                                    <div class="group-button">
                                        @if(!empty($ws[0]["crawler_website"]["id"]) && !empty($ws[0]["article"]["id"]))
                                            @php
                                                $route = $ws[0]["article"]["href"];
                                            @endphp
                                            <button onclick="window.open('{{$route}}')" class="btn btn-go" type="button">Tới điểm bán</button>
                                        @endif
                                        <button class="btn btn-join" type="button">Tham gia Group</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>
                    <section class="compare">
                        <h3>So sánh giá</h3>
                        <div class="list-compare">
                            @foreach($data['sosanh'] as $row)
                                <div class="item-compare">
                                    <div class="image-compare">
                                        <img src="{{ $row->crawlerCategory->crawlerWebsite->thumbnail }}" alt="">
                                    </div>
                                    <div class="content-compare">
                                        <h4>{{ $row->name }}</h4>
                                        <div class="compare-price">
                                            <div class="box-price">
                                                <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }} đ</p>
                                                <p class="saling-place">Nơi bán: Toàn Quốc</p>
                                            </div>
                                            <div class="button">
                                                <a href="{{ $row->href }}" target="_blank"
                                                    title="{{ $row->title }}" rel="nofollow sponsored"><button class="btn btn-go-sale">Tới điểm bán</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $data['sosanh']->links('admins::elements.extend.pagination') }}
                    </section>
                    <section class="content-detail mt-4">
                        <h3>Nội dung</h3>
                        <div class="overview">
                            {!! !empty($data['sosanh'][0]->content) ? @preg_replace('/(<[^>]+) style=".*?"/i', '$1',$data['sosanh'][0]->content) : $data['detail']->content !!}
                        </div>
                        {{-- <div class="read-more">
                            <a href="#"><span>Xem thêm</span> <i class="fa-solid fa-chevron-down"></i></a>
                        </div> --}}
                    </section>
                    
                </div>
                @include('clients::elements.sidebar-product')
            </div>
        </section>
    </div>
</main>
@endsection