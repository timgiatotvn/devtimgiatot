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
                <span>Đăng ký</span>
               
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 right">
                <h3 class="title">Đăng ký</h3>
                <form  method="POST" id="form-register">
                    @csrf
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Tên đầy đủ">
                        </div>
                    </div>
                    <span id="name"></span>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Tài khoản">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/phone.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Số điện thoại">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/email.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Địa chỉ Email">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/password.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/password.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="password" name="password_confirmation" id="re-password" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/key.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" placeholder="Mã xác thực">
                        </div>
                    </div>
                    <p class="t-right">
                        <a class="a-none text-primary" href="">Hướng dẫn lấy mã</a>
                    </p>
                    <div class="form-item" style="justify-content: center">
                        <button type="submit" class="w-100">
                            Đăng ký
                        </button>
                    </div>
                    @if($errors->has('accountNotFound'))
                        <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                    @endif
                    <p class="t-center">
                        Bạn đã có tài khoản? <a href="{{ route('client.user.login') }}" class="a-none f-bold text-primary">Đăng nhập</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\User\RegisterRequest','#form-register'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection