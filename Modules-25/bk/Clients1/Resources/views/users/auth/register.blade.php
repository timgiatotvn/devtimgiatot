@extends('clients::layouts.auth.login')

@section('content')
    <section id="login">
        <div class="wrap-login">
            <h1>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</h1>
            <form method="post" action="" id="form-register">
                @csrf()
                <div class="form-group">
                    <label for="name">Tên đầy đủ</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" />
                </div>
                <div class="form-group">
                    <label for="username">Tài khoản</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="username" />
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" />
                </div>
                <div class="form-group">
                    <label for="re-password">Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" id="re-password" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" />
                </div>
                <button type="submit" class="btn btn-danger">Đăng ký</button>
                @if($errors->has('accountNotFound'))
                    <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                @endif
            </form>
        </div>
    </section>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\User\RegisterRequest','#form-register'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection