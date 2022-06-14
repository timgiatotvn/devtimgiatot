@extends('clients::layouts.cart')

@section('content')
    <section id="user-page">
        <div class="wrap-user-page">
            <h1>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</h1>
            @if (Session::has('success'))
                <div class="alert alert-success mt-3"> {!! Session::get('success') !!}</div>
            @endif
            @if($errors->has('accountNotFound'))
                <p class="alert alert-danger mt-3">{{$errors->first('accountNotFound')}}</p>
            @endif
            <div class="main-user-page">
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
            </div>

            <h1>Thông tin</h1>
            <div class="main-user-page">
                <form method="post" action="{{ route('client.card.store') }}" class="form-payment" id="form-cart">
                    @csrf()
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" {{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? 'readonly="readonly"' : '' }} value="{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->name : '' }}" class="form-control" id="name"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" {{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? 'readonly="readonly"' : '' }} value="{{ \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->check() ? \Illuminate\Support\Facades\Auth::guard(\Helpers::renderGuard(1))->user()->email : '' }}" class="form-control" id="email"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Điện thoại</label>
                        <input type="text" name="phone" class="form-control" id="phone"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" id="address"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Yêu cầu thêm</label>
                        <textarea name="content" placeholder="Yêu cầu thêm" rows="5" class="form-control mb-3"></textarea>
                    </div>
                    <div class="wrap-action-cart">
                        <button type="submit" class="btn btn-sm btn-danger">Thanh toán</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\Cart\CreateRequest','#form-cart'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection