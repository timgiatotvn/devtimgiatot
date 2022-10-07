@extends('clients::layouts.product')
@section('content')
    <section id="detail-product">
        <div class="row no-gutters">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="pr-4">
                    <a class="fancybox-thumbs" data-fancybox-group="thumb"
                       href="{{ \App\Helpers\Helpers::renderThumb((!empty($data['detail']->thumbnail_cr) ? $data['detail']->thumbnail_cr : $data['detail']->thumbnail), 'product_detail_zoom') }}">
                        <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($data['detail']->thumbnail_cr) ? $data['detail']->thumbnail_cr : $data['detail']->thumbnail), 'product_detail') }}"
                             title="{{ $data['detail']->title }}">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="wrap-info-product mb-4">
                    <h1>
                        <a href="{{ route('client.product.showSosanh', ['slug' => $data['detail']->slug.'-'.$data['detail']->id]) }}"
                           title="{{ $data['detail']->title }}" rel="nofollow sponsored">
                            {{ $data['detail']->title }}
                        </a>
                    </h1>
                    <div class="des">{!! $data['detail']->description !!}</div>
                    <div class="price">
                        <span>{{ \App\Helpers\Helpers::formatPrice($data['detail']->price) }}đ</span>
                        <span>{{ !empty($data['detail']->price_root) ? \App\Helpers\Helpers::formatPrice($data['detail']->price_root).'đ' : '' }}</span>
                    </div>
                    @php
                        $ws = @json_decode($data['detail']->website_map, true);
                    @endphp
                    @if(!empty($ws[0]["crawler_website"]["id"]) && !empty($ws[0]["article"]["id"]))
                        <div class="price-cheapest">
                            Nơi Bán Rẻ Nhất: <a href="{{ $ws[0]["article"]["href"] }}" target="_blank" title="{{ $data['detail']->title }}"
                                                rel="nofollow sponsored">{{ $ws[0]["crawler_website"]["title"] }}</a>
                        </div>
                        <div class="btn-product">
                            <a href="{{ $ws[0]["article"]["href"] }}" target="_blank"
                               title="{{ $data['detail']->title }}" rel="nofollow sponsored">
                                <button type="button" class="btn">TỚI NƠI BÁN RẺ NHẤT</button>
                            </a>
                        </div>
                    @endif
                    @if($errors->has('accountNotFound'))
                        <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                    @endif
                </div>
                <div class="fb-share-button"
                     data-href="{{ route('client.product.showSosanh', ['slug' => $data['detail']->slug.'-'.$data['detail']->id]) }}"
                     data-layout="button"
                     data-size="small">
                    <a target="_blank"
                       href="{{ route('client.product.showSosanh', ['slug' => $data['detail']->slug.'-'.$data['detail']->id]) }}"
                       class="fb-xfbml-parse-ignore">Chia sẻ</a>
                </div>
            </div>
        </div>
        <div class="wrap-product-show">
            <div class="box-tab">
                <!-- tab -->
                <ul class="nav nav-pills tab-fix">
                    <li class="nav-item">
                        <a href="#tab1" data-toggle="tab" class="nav-link active">So sánh giá</a>
                    </li>
                </ul>

                <!-- Nội dung -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="list-product-compare mb-5">
                            @foreach($data['sosanh'] as $row)
                                <div class="list-compare-item">
                                    <ul>
                                        <li>
                                            @if (!empty($row->crawlerCategory->crawlerWebsite->id))
                                                <img src="{{ $row->crawlerCategory->crawlerWebsite->thumbnail }}" class="mw-100">
                                                <label class="title-website" style="display:none;">{{ $row->crawlerCategory->crawlerWebsite->title }}{{ $row->crawlerCategory->crawlerWebsite->thumbnail }} </label>
                                            @endif
                                        </li>
                                        <li>
                                            <label class="title-cp-sp">{{ $row->name }}</label>
                                            <label class="title-cp-href">{{ $row->href }}</label>
                                            <label class="title-cp-nb">Nơi bán: Toàn Quốc</label>
                                        </li>
                                        <li>
                                            <label class="title-cp-price">{{ \App\Helpers\Helpers::formatPrice($row->price) }} đ</label><br/>
                                            <label class="title-cp-vat">Đã có VAT</label>
                                        </li>
                                        <li>
                                            <a href="{{ $row->href }}" target="_blank"
                                               title="{{ $row->title }}" rel="nofollow sponsored">
                                                <button type="button" class="btn btn-primary btn-sm">Tới nơi bán</button>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            @endforeach
                        </div>
                        {{ $data['sosanh']->links('admins::elements.extend.pagination') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-product-show">
            <div class="box-tab">
                <!-- tab -->
                <ul class="nav nav-pills tab-fix">
                    <li class="nav-item">
                        <a href="#tab1nd" data-toggle="tab" class="nav-link active">Nội dung</a>
                    </li>
                    {{--                <li class="nav-item"> <a href="#tab2" data-toggle="tab" class="nav-link">Tab đầu tiên</a></li>--}}
                </ul>

                <!-- Nội dung -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1nd">
                        <div class="ctct">
                            {!! !empty($data['sosanh'][0]->content) ? @preg_replace('/(<[^>]+) style=".*?"/i', '$1',$data['sosanh'][0]->content) : $data['detail']->content !!}
                        </div>
                    </div>
                    {{--                <div class="tab-pane container fade" id="tab2"> <p>Thử thay đổi gì đó khi chuyển tab.</p></div>--}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/static/client/js/fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.5') }}"/>
    <link rel="stylesheet"
          href="{{ asset('/static/client/js/fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}"/>
@endsection

@section('scripts')
    <script type="text/javascript"
            src="{{ asset('/static/client/js/fancybox-2.1.7/source/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/static/client/js/fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.fancybox-thumbs').fancybox({
                prevEffect: 'none',
                nextEffect: 'none',

                closeBtn: false,
                arrows: false,
                nextClick: true,

                helpers: {
                    thumbs: {
                        width: 50,
                        height: 50
                    }
                }
            });
        });
    </script>
@endsection
