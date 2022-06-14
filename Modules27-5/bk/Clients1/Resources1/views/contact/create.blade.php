@extends('clients::layouts.contact')

@section('content')

    <section id="box-new-detail">
        <div class="nrd-head">
            <h1>Liên hệ</h1>
        </div>
        <div class="wrap-info-new-detail">
            <div class="content-view">
                <div class="ctct">{!! !empty($data_common['setting']->content_contact) ? $data_common['setting']->content_contact : '' !!}</div>
            </div>
        </div>
    </section>

    <section id="user-page" style="background: #ddd;">

        @if (Session::has('success'))
            <div class="alert alert-success mb-3"> {!! Session::get('success') !!}</div>
        @endif
        @if($errors->has('accountNotFound'))
            <p class="alert alert-danger mb-3">{{$errors->first('accountNotFound')}}</p>
        @endif

        <div class="wrap-user-page">
            <div class="main-user-page">
                <form method="post" action="" class="form-payment" id="form-contact">
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Yêu cầu thêm</label>
                        <textarea name="content" placeholder="Yêu cầu thêm" rows="5" class="form-control mb-3">{{ old('content') }}</textarea>
                    </div>
                    <div class="wrap-action-cart">
                        <button type="submit" class="btn btn-sm btn-primary">Gửi đi</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\Contact\CreateRequest','#form-contact'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection