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
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
        text-align: center;
    -moz-appearance: textfield;
    }
    .info-order {
        background: #fff;
        padding: 20px;
    }
</style>
@endsection
@section('content')
<main class="main page-cart">
    <div class="container">
        <div class="nd-breadcrumb">
            <div class="breadcrumb-custom">
                <a href="{{ route('client.home') }}">Trang chủ</a>
                <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
                <a class="a-none" href="#">
                    Thanh toán
                </a>
            </div>
        </div>
        {{-- @include('clients::elements.extend.breadcrumb') --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h4>Thanh toán đơn hàng</h4>

                <div class="info-order">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <center>
                                <p>
                                    Bước 1: Quét mã/Chuyển tiền
                                </p>
                                @if (!empty($paymentSetting))
                                    <img style="max-width: 100%" src="{{$paymentSetting->qr_code}}" alt="">
                                @else
                                    <img src="{{asset('assets/images/icons/qrcode.svg')}}" alt="">
                                @endif
                            </center>
                            <p class="d-flex justify-content-between" style="margin-top: 20px">
                                <span>Tên ngân hàng:</span>
                                <span style="color: #0D54BE; font-weight: 700">
                                    {{!empty($paymentSetting) ? $paymentSetting->bank_name : ''}}
                                </span>
                            </p>
                            <p class="d-flex justify-content-between">
                                <span>Số tài khoản:</span>
                                <span style="color: #0D54BE; font-weight: 700">
                                    {{!empty($paymentSetting) ? $paymentSetting->bank_account_number : ''}}
                                </span>
                            </p>
                            <p class="d-flex justify-content-between">
                                <span>Chủ tài khoản</span>
                                <span style="color: #0D54BE; font-weight: 700">
                                    {{!empty($paymentSetting) ? $paymentSetting->bank_account_name : ''}}
                                </span>
                            </p>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <p>
                                Bước 2 (quan trọng): Nhập số tiền, nội dung chuyển tiền
                            </p>
                            <p class="d-flex justify-content-between">
                                <span>Số tiền:</span>
                                <span style="font-size: 28px; color: #C81C3D; font-weight: 700">{{ \App\Helpers\Helpers::formatPrice($total) }}đ</span>
                            </p>
                            <p class="d-flex justify-content-between align-items-center">
                                <span>Nội dung:</span>
                                <button style="background: #0D54BE; border: 0px; border-radius: 4px; color: #fff; padding: 10px; font-weight: bold; font-size: 28px">
                                    {{$order->code}}
                                </button>
                            </p>
                            <p>
                                Trạng thái
                            </p>
                            <center>
                                <img src="{{asset('assets/images/icons/loading.svg')}}" alt="">
                                <p style="margin-top: 20px">
                                    Chờ chuyển tiền
                                </p>
                            </center>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <p style="text-align:center">
                                <a class="a-none" href="{{ route('client.category.search', ['key' => 1]) }}">
                                    <button style="border: 1px solid #777E90; border-radius: 10px; padding: 12px 16px; color: #23262F">
                                        Tiếp tục mua hàng
                                    </button>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection