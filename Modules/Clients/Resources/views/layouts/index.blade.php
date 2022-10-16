<!DOCTYPE html>
<html lang="vi">
<head>
    @include('clients::elements.extend.meta')
    @include('clients::elements.extend.style')
</head>
<body>
    {!! !empty($data_common['setting']->code_body) ? $data_common['setting']->code_body : '' !!}
    <div class="wrapper">
        @include('clients::layouts.header')
        @yield('content')
        @include('clients::layouts.footer')
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>
    @yield('validate')
    @yield('scripts')
    <script>
        function closeDiv(class_name) {
            $('.' + class_name).hide();
        }
    </script>
</body>
</html>