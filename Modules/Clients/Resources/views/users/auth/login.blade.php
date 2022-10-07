@extends('clients::layouts.index')
@section('style')
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
@endsection
@section('content')
<main class="main">
    <div class="container login">
        <div class="nd-breadcrumb">
            <div class="breadcrumb-custom">
                <a href="/">Trang chủ</a>
                <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
                <span>Đăng nhập</span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 right">
                <h3 class="title">Đăng nhập</h3>
                <form method="post" id="form-login">
                    @csrf
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" name="username" id="username" placeholder="Tài khoản">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/password.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input name="password" id="password" type="password" placeholder="Mật khẩu">
                        </div>
                    </div>
                    <p class="t-right">
                        <a class="a-none" href="">Quên mật khẩu</a>
                    </p>
                    <div class="form-item" style="justify-content: center">
                        <button type="submit" class="w-100">
                            Đăng nhập
                        </button>
                    </div>
                    @if (Session::has('success'))
                    <div class="alert alert-success mt-3"> {!! Session::get('success') !!}</div>
                    @endif
                    @if($errors->has('accountNotFound'))
                        <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                    @endif
                    @if(session('error'))
                        <p class="alert alert-danger mt-3">{{session('error')}}</p>
                    @endif
                    <p class="t-center">
                        Bạn có tài khoản chưa? <a href="{{ route('client.user.register') }}" class="a-none f-bold text-primary">Đăng ký</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\User\LoginRequest','#form-login'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection