{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js" lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    @include('clients::elements.extend.meta')
    @include('clients::elements.extend.style')
</head>
<body>
{!! !empty($data_common['setting']->code_body) ? $data_common['setting']->code_body : '' !!}
@include('clients::elements.header')
@include('clients::elements.menu')
<div class="main-width">
    @include('clients::elements.extend.breadcrumb')
    <div class="row no-gutters mb-5">
        @if(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check())
            <div class="col-12 col-md-3 col-lg-2 col-xl-2">
                @include('clients::elements.sitebar-user')
            </div>
            <div class="col-12 col-md-9 col-lg-10 col-xl-10">
                <div class="pl-4 fix-pr-4">
                    @yield('content')
                </div>
            </div>
        @else
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                @yield('content')
                </div>
        @endif
    </div>
</div>
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html> --}}


<!DOCTYPE html>
<html lang="vi">
<head>
    @include('clients::elements.extend.meta')
    @include('clients::elements.extend.style')
    <style>
        #sitebar-user {
            background: #fafafa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        #sitebar-user ul {
            padding-left: 0px;
            list-style-type: none;
        }
        #sitebar-user ul li {
            padding: 10px 0px;
            border-bottom: 1px dotted;
        }
        #sitebar-user ul li a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    {!! !empty($data_common['setting']->code_body) ? $data_common['setting']->code_body : '' !!}
    <div class="wrapper">
        @include('clients::layouts.header')
        <br>
        <main>
            <div class="container">
                @include('clients::elements.extend.breadcrumb')
                <div class="row">
                    @if(\Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check())
                        <div class="col-12 col-md-4 col-lg-3 col-xl-3">
                            @include('clients::elements.sitebar-user')
                        </div>
                        <div class="col-12 col-md-8 col-lg-9 col-xl-9">
                            <div class="pl-4 fix-pr-4">
                                @yield('content')
                            </div>
                        </div>
                    @else
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            @yield('content')
                            </div>
                    @endif
                </div>
            </div>
        </main>
        @include('clients::layouts.footer')
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>
    @yield('validate')
    @yield('scripts')
</body>
</html>