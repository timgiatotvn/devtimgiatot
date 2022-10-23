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
        @include('clients::elements.extend.breadcrumb')
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="info-order">
                    <h3>Thông tin đơn hàng</h3>
                    @if (Session::has('success'))
                        <div class="alert alert-success mt-3"> {!! Session::get('success') !!}</div>
                    @endif
                    @if($errors->has('accountNotFound'))
                        <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
                    @endif
                    @php
                        $dem = 0;
                        $sum_money = 0;
                    @endphp
                    @foreach($data['list'] as $k => $row)
                        @php
                            $dem ++;
                            $sl = !empty($row['sl']) ? $row['sl'] : 1;
                            $row = $row['detail'];
                            $price = $row->price * $sl;
                            $sum_money += $price;
                            @endphp
                        <div class="row">
                            <div class="col-3 col-sm-2 col-md-2 col-lg-2">
                                <img class="w-100" src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}" alt="">
                            </div>
                            <div class="col-9 col-sm-8 col-md-8 col-lg-8">
                                <p style="margin-bottom: 0px">
                                    <b>{{ $row->title }}</b>
                                </p>
                                <p>
                                    <b style="color: #C81C3D">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</b>
                                </p>
                                
                            </div>
                            <div class="col-12 col-lg-2">
                                <form id="form-{{$row->id}}" method="post" action="{{ route('client.card.update', ['id' => $row->id]) }}"
                                    style="width: inherit !important;">
                                  @csrf()
                                  <div class="amount">
                                        <img onclick="onDown({{$row->id}})" style="cursor: pointer" src="{{asset('assets/images/icons/down.svg')}}" alt="">
                                        <input style="width: 50px;
                                        border: 0px;
                                        outline: none;" type="number" name="soluong" value="{{ $sl }}"/>
                                        <img onclick="onUp({{$row->id}})" style="cursor: pointer" src="{{asset('assets/images/icons/up.svg')}}" alt="">
                                  </div>
                                    
                                    {{-- <button type="submit" class="btn btn-sm btn-secondary">Cập nhật</button> --}}
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if(count($data['list']) > 0)
                        <div class="row">
                            <div class="col-lg-12">
                                <p style="text-align: right">
                                    <b>Tổng tiền:</b> 
                                    <b style="color: #C81C3D; font-size: 28px">{{ \App\Helpers\Helpers::formatPrice($sum_money) }} đ</b>
                                </p>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="main-user-page">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr class="thead-light">
                                <th scope="col" width="50">STT</th>
                                <th scope="col" width="80">Hình ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col" width="160">Số lượng</th>
                                <th scope="col" width="145">Tổng tiền</th>
                                <th scope="col" width="50"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $dem = 0;
                                $sum_money = 0;
                            @endphp
                            @foreach($data['list'] as $k => $row)
                                @php
                                    $dem ++;
                                    $sl = !empty($row['sl']) ? $row['sl'] : 1;
                                    $row = $row['detail'];
                                    $price = $row->price * $sl;
                                    $sum_money += $price;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $dem }}</th>
                                    <td>
                                        <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                             title="{{ $row->title }}">
                                    </td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ \App\Helpers\Helpers::formatPrice($row->price) }}</td>
                                    <td>
                                        <form method="post" action="{{ route('client.card.update', ['id' => $row->id]) }}"
                                              style="width: inherit !important;">
                                            @csrf()
                                            <input type="number" name="soluong" value="{{ $sl }}"
                                                   class="form-control form-control-sm"
                                                   style="width: 55px; float: left; margin-right: 3px;"/>
                                            <button type="submit" class="btn btn-sm btn-secondary">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td>{{ \App\Helpers\Helpers::formatPrice($price) }}</td>
                                    <td>
                                        <a href="javascript:confirmDelete('{{ route('client.card.destroy', ['id' => $row->id]) }}','@lang('clients::layer.notify.confirm.delete')')"
                                           title="">
                                            <button type="button" class="btn btn-sm btn-primary">Xoá</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" align="right">
                                    <label class="title-sum-money">Tổng tiền</label>
                                </td>
                                <td colspan="2" align="left">
                                    <label class="sum-money">{{ \App\Helpers\Helpers::formatPrice($sum_money) }} đ</label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="wrap-action-cart">
                            <a href="{{ route('client.category.search', ['key' => 1]) }}" title="">
                                <button type="button" class="btn btn-sm btn-primary">Tiếp tục mua hàng</button>
                            </a>
                        </div>
                    </div> --}}
                </div>
                <br>
                <div class="info-order">
                    <h3>Thông tin thanh toán</h3>
                    <form method="post" action="{{ route('client.card.store') }}" class="form-payment" id="form-cart">
                        @csrf()
                        {{-- <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" name="name" {{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? 'readonly="readonly"' : '' }} value="{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->name : '' }}" class="form-control" id="name"/>
                        </div> --}}
                        <div class="form-item">
                            <div class="icon">
                                <img src="{{asset('assets/images/icons/full_name.svg')}}" alt="">
                            </div>
                            <div class="input">
                                <input value="{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->name : '' }}" type="text" name="name" id="name" placeholder="Họ và tên">
                            </div>
                        </div>
                        @error('name')
                            <p class="text text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-item">
                            <div class="icon">
                                <img src="{{asset('assets/images/icons/email.svg')}}" alt="">
                            </div>
                            <div class="input">
                                <input value="{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->email : '' }}" type="email" name="email" id="email" placeholder="Địa chỉ Email">
                            </div>
                        </div>
                        @error('email')
                            <p class="text text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-item">
                            <div class="icon">
                                <img src="{{asset('assets/images/icons/phone.svg')}}" alt="">
                            </div>
                            <div class="input">
                                <input value="{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->phone : '' }}" type="text" name="phone" id="phone" placeholder="Số điện thoại">
                            </div>
                        </div>
                        @error('phone')
                            <p class="text text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-item">
                            <div class="icon">
                                <img src="{{asset('assets/images/icons/location.svg')}}" alt="">
                            </div>
                            <div class="input">
                                <input type="text" name="address" id="address" placeholder="Địa chỉ">
                            </div>
                        </div>
                        @error('address')
                            <p class="text text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-item">
                            <textarea name="content" placeholder="Yêu cầu thêm" id="" cols="30" rows="10">{{ old('content') }}</textarea>
                        </div>
                        {{-- <div class="form-item"> --}}
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                    <a href="{{ route('client.category.search', ['key' => 1]) }}" title="">
                                        <button class="continue-buy" style="background: unset; color: #23262F; border: 1px solid #777E90;" type="button" class="btn btn-sm btn-primary">Tiếp tục mua sắm</button>
                                    </a>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                    <p style="text-align: right">
                                        <button class="payment" type="submit">Thanh toán</button>
                                    </p>
                                    
                                </div>
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" {{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? 'readonly="readonly"' : '' }} value="{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->email : '' }}" class="form-control" id="email"/>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="phone">Điện thoại</label>
                            <input type="text" name="phone" class="form-control" id="phone"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" id="address"/>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="address">Yêu cầu thêm</label>
                            <textarea name="content" placeholder="Yêu cầu thêm" rows="5" class="form-control mb-3"></textarea>
                        </div> --}}
                        {{-- <div class="wrap-action-cart">
                            <button type="submit" class="btn btn-sm btn-danger">Thanh toán</button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    function onDown(id) {
        var value_input = $('#form-' + id + ' input[type="number"]').val();
        $('#form-' + id + ' input[type="number"]').val(value_input - 1);
        $("#form-" + id).submit();
    }
    function onUp(id) {
        var value_input = $('#form-' + id + ' input[type="number"]').val();
        $('#form-' + id + ' input[type="number"]').val(parseInt(value_input) + 1);
        $("#form-" + id).submit();
    }
</script>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\Cart\CreateRequest','#form-cart'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection