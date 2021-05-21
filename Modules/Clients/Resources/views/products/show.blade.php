@extends('clients::layouts.product')

@section('content')
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
        <div class="col-12 col-md-6 col-lg-6 col-xl-6 bg1">
            dsa
        </div>
    </div>
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
