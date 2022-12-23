<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Đăng ký trở thành người bán</title>
        @include('clients::elements.extend.style')
        <link rel="stylesheet" href="{{asset('assets/css/global.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        <style>
            .form-item {
                position: relative
            }
            .form-item .invalid-feedback {
                position: absolute;
                left: 0px;
                bottom: -21px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
        @include('clients::layouts.header')
        <main class="main">
            <div class="container login">
                <div class="nd-breadcrumb">
                    <div class="breadcrumb-custom">
                        <a href="/">Trang chủ</a>
                        <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
                        <span>Đăng ký trở thành người bán</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-5 col-lg-4 right">
                        <h3 class="title">Đăng ký trở thành người bán</h3>
                        <form method="POST" action="{{route('seller.update-name-shop')}}">
                            @csrf
                            <div class="form-item">
                                <div class="icon">
                                    <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                                </div>
                                <div class="input">
                                    <input type="text" name="shop_name" placeholder="Nhập tên shop">
                                </div>
                            </div>
                            <div class="form-item" style="justify-content: center">
                                <button type="submit" class="w-100">
                                    Đăng ký
                                </button>
                            </div>
                            @if (Session::has('success'))
                            <div class="alert alert-success mt-3"> {!! Session::get('success') !!}</div>
                            @endif
                            @if($errors->has('error'))
                                <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                            @endif
                            @if(session('error'))
                                <p class="alert alert-danger mt-3">{{session('error')}}</p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </main>
        @include('clients::layouts.footer')
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>
</html>