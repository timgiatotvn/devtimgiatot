@extends('clients::layouts.index')

@section('style')
<link rel="stylesheet" href="{{asset('assets/css/contact.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/global.css')}}">
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
    <div class="container contact">
        <div class="nd-breadcrumb">
            <div class="breadcrumb-custom">
                <a href="#">Trang chủ</a>
                <span><img src="./assets/images/icons/arrow.svg" alt=""></span>
                <span>Liên hệ</span>
            
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-6 left">
                <p>
                    <img class="banner" src="./assets/images/contacts/1.svg" alt="">
                </p>
                <ul>
                    <li class="row">
                        <div class="icon col-2 col-sm-1 col-lg-1">
                            <div>
                                <img src="./assets/images/icons/location.svg" alt="">
                            </div>
                        </div>
                        <div class="text col-10 col-sm-11 col-lg-11">
                            <span>
                                Tầng 12, Tòa nhà Licogi 13, Số 164 Khuất Duy Tiến, P. Nhân Chính, Q. Thanh Xuân, Hà Nội.
                            </span>
                        </div>
                    </li>
                    <li class="row">
                        <div class="icon col-2 col-sm-1 col-lg-1">
                            <div>
                                <img src="./assets/images/icons/phone.svg" alt="">
                            </div>
                        </div>
                        <div class="text col-10 col-sm-11 col-lg-11">
                            <span>
                                0246.29.27.089 / 0981.185.620
                            </span>
                        </div>
                    </li>
                    <li class="row">
                        <div class="icon col-2 col-sm-1 col-lg-1">
                            <div>
                                <img src="./assets/images/icons/web.svg" alt="">
                            </div>
                        </div>
                        <div class="text col-10 col-sm-11 col-lg-11">
                            <span>
                                <a href="">https://timgiatot.vn</a>
                            </span>
                        </div>
                    </li>
                    <li class="row">
                        <div class="icon col-2 col-sm-1 col-lg-1">
                            <div>
                                <img src="./assets/images/icons/email.svg" alt="">
                            </div>
                        </div>
                        <div class="text col-10 col-sm-11 col-lg-11">
                            <span>
                                info@timgiatot.vn
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-lg-6 right">
                <p class="title">
                    Liên hệ
                </p>
                <p>
                    {{-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the indus. --}}
                </p>
                @if (Session::has('success'))
                    <div class="alert alert-success mb-3"> {!! Session::get('success') !!}</div>
                @endif
                @if($errors->has('accountNotFound'))
                    <p class="alert alert-danger mb-3">{{$errors->first('accountNotFound')}}</p>
                @endif
                <form method="post" action="" class="form-payment" id="form-contact">
                    @csrf
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Họ và tên">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/email.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Địa chỉ Email">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/phone.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone" placeholder="Số điện thoại">
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons/location.svg')}}" alt="">
                        </div>
                        <div class="input">
                            <input type="text" name="address" value="{{ old('address') }}" id="address" placeholder="Địa chỉ">
                        </div>
                    </div>
                    <div class="form-item">
                        <textarea name="content" placeholder="Yêu cầu thêm" id="" cols="30" rows="10">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-item" style="justify-content: center">
                        <button>
                            Gửi đi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\Contact\CreateRequest','#form-contact'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection