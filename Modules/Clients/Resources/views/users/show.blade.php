@extends('clients::layouts.cart')
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
<section id="user-page">
    <div class="wrap-user-page">
        <h1>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</h1>
        <div class="main-user-page">
            <form method="post" action="{{ route('client.user.update') }}" id="form-update">
                @csrf()
                {{-- <div class="form-group">
                    <label for="name">Tên đầy đủ</label>
                    <input type="text" name="name" value="{{ !empty($data['detail']->name) ? $data['detail']->name : '' }}" class="form-control" id="name" />
                </div> --}}
                <div class="form-item">
                    <div class="icon">
                        <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                    </div>
                    <div class="input">
                        <input type="text" value="{{ !empty($data['detail']->name) ? $data['detail']->name : '' }}" name="name" id="name" placeholder="Tên đầy đủ">
                    </div>
                </div>
                <div class="form-item">
                    <div class="icon">
                        <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                    </div>
                    <div class="input">
                        <input type="text" value="{{ !empty($data['detail']->username) ? $data['detail']->username : '' }}" name="username" id="username" placeholder="Tài khoản">
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
                <div class="form-item">
                    <div class="icon">
                        <img src="{{asset('assets/images/icons/password.svg')}}" alt="">
                    </div>
                    <div class="input">
                        <input name="password_confirmation" id="re-password" type="password" placeholder="Nhập lại mật khẩu">
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="username">Tài khoản</label>
                    <input type="text" name="username" readonly="readonly" disabled value="{{ !empty($data['detail']->username) ? $data['detail']->username : '' }}" class="form-control" id="username" />
                </div> --}}
                {{-- <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" />
                </div>
                <div class="form-group">
                    <label for="re-password">Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" id="re-password" />
                </div> --}}
                <div class="form-item">
                    <div class="icon">
                        <img src="{{asset('assets/images/icons/email.svg')}}" alt="">
                    </div>
                    <div class="input">
                        <input type="email" name="email" disabled id="email" value="{{ !empty($data['detail']->email) ? $data['detail']->email : '' }}" placeholder="Địa chỉ Email">
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" readonly="readonly" disabled value="{{ !empty($data['detail']->email) ? $data['detail']->email : '' }}" class="form-control" id="email" />
                </div> --}}
                <div class="form-item" style="justify-content: center">
                    <button type="submit" class="w-100">
                        Cập nhật
                    </button>
                </div>
                {{-- <button type="submit" class="btn btn-danger">Đăng ký</button> --}}
                @if (Session::has('success'))
                    <div class="alert alert-success mt-3"> {!! Session::get('success') !!}</div>
                @endif
                @if($errors->has('accountNotFound'))
                    <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                @endif
            </form>
        </div>
    </div>
</section>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\User\UpdateRequest','#form-update'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection