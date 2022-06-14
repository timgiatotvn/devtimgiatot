@extends('clients::layouts.auth.login')

@section('content')
    <section id="login">
        <div class="wrap-login">
            <h1>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</h1>
            <form method="post" action="" id="form-login">
                @csrf()
                <div class="form-group">
                    <label for="username">Tài khoản</label>
                    <input type="text" class="form-control" name="username" id="username" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" />
                </div>
                <button type="submit" class="btn btn-danger">Đăng nhập</button>
                @if (Session::has('success'))
                    <div class="alert alert-success mt-3"> {!! Session::get('success') !!}</div>
                @endif
                @if($errors->has('accountNotFound'))
                    <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                @endif
            </form>
        </div>
    </section>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\User\LoginRequest','#form-login'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection
