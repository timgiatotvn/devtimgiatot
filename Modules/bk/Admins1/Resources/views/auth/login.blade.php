@extends('admins::layouts.login')
@section('content')
    <div class="container-scroller" id="app">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <h2>@lang("admins::layer.login.title")</h2>
                            </div>
                            <form action="" class="pt-3" id="form-login" method="post">
                                @csrf()
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="remember_token" class="form-check-input">
                                            <i class="input-helper"></i>
                                            @lang("admins::layer.login.remember")
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">{{__('admins::layer.login.button.submit')}}</button>
                                </div>
                                @if($errors->has('accountNotFound'))
                                    <p class="alert alert-danger">{{$errors->first('accountNotFound')}}</p>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\LoginRequest','#form-login'); !!}
@endsection
