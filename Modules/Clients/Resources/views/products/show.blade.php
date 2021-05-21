@extends('clients::layouts.product')

@section('content')
    <section id="detail-product">
        <div class="row no-gutters">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="pr-4">
                    <a class="fancybox-thumbs" data-fancybox-group="thumb"
                       href="{{ \App\Helpers\Helpers::renderThumb($data['detail']->thumbnail, 'product_detail_zoom') }}">
                        <img src="{{ \App\Helpers\Helpers::renderThumb($data['detail']->thumbnail, 'product_detail') }}"
                             title="{{ $data['detail']->title }}">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                <div class="wrap-info-product">
                    <h1>
                        <a href="{{ route('client.product.show', ['slug' => $data['detail']->slug.'-'.$data['detail']->id]) }}"
                           title="{{ $data['detail']->title }}">
                            {{ $data['detail']->title }}
                        </a>
                    </h1>
                    <div class="des">{{ $data['detail']->description }}</div>
                    <div class="price">
                        <span>{{ \App\Helpers\Helpers::formatPrice($data['detail']->price) }}đ</span>
                        <span>{{ !empty($data['detail']->price_root) ? \App\Helpers\Helpers::formatPrice($data['detail']->price_root).'đ' : '' }}</span>
                    </div>
                    <div class="btn-product">
                        <a href="{{ $data['detail']->url_buy }}" title="{{ $data['detail']->title }}" target="_blank">
                            <button type="button" class="btn">MUA SẢN PHẨM</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-product-show">
            <div class="box-tab">
                <!-- tab -->
                <ul class="nav nav-pills tab-fix">
                    <li class="nav-item">
                        <a href="#tab1" data-toggle="tab" class="nav-link active">Nội dung</a>
                    </li>
                    {{--                <li class="nav-item"> <a href="#tab2" data-toggle="tab" class="nav-link">Tab đầu tiên</a></li>--}}
                </ul>

                <!-- Nội dung -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="ctct">
                            {{ $data['detail']->content }}
                        </div>
                    </div>
                    {{--                <div class="tab-pane container fade" id="tab2"> <p>Thử thay đổi gì đó khi chuyển tab.</p></div>--}}
                </div>
            </div>
        </div>
        <div class="wrap-list-product">
            <label>Sản Phẩm Liên Quan</label>
            <div class="pr-content">
                <ul>
                    @foreach($data['related'] as $row)
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
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/static/client/js/fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.5') }}"/>
    <link rel="stylesheet" href="{{ asset('/static/client/js/fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}"/>
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
