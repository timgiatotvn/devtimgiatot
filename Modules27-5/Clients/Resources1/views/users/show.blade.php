@extends('clients::layouts.cart')

@section('content')
    <section id="user-page">
        <div class="wrap-user-page">
            <h1>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</h1>
            <div class="main-user-page">
                <form method="post" action="{{ route('client.user.update') }}" id="form-update">
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên đầy đủ</label>
                        <input type="text" name="name" value="{{ !empty($data['detail']->name) ? $data['detail']->name : '' }}" class="form-control" id="name" />
                    </div>
                    <div class="form-group">
                        <label for="username">Tài khoản</label>
                        <input type="text" name="username" readonly="readonly" disabled value="{{ !empty($data['detail']->username) ? $data['detail']->username : '' }}" class="form-control" id="username" />
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
                        <input type="email" name="email" readonly="readonly" disabled value="{{ !empty($data['detail']->email) ? $data['detail']->email : '' }}" class="form-control" id="email" />
                    </div>
                    <button type="submit" class="btn btn-danger">Đăng ký</button>
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