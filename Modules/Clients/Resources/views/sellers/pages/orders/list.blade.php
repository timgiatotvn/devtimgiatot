@extends('clients::sellers.layouts.index')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">Danh sách đơn hàng</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('clients::sellers.includes.alert')
                        {{-- <form method="GET">
                            <div class="row">
                                <div class="col-lg-3">
                                    <input type="text" name="key_search" class="form-control" placeholder="Tên sản phẩm...">
                                </div>
                                <div class="col-lg-2">
                                    <select name="category_id" class="form-control select2" data-toggle="select2">
                                        <option value="-1">Tất cả</option>
                                        @foreach ($categories as $cateItem)
                                            <option value="{{$cateItem->id}}">
                                                {{$cateItem->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    <a href="{{url()->current()}}" class="btn btn-danger">Tải lại</a>
                                    <a href="{{route('seller.product.form-add-product')}}" class="btn btn-success">Thêm mới</a>
                                </div>
                            </div>
                        </form> --}}
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>Time</th>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $orderItem)
                                        @if (!empty($orderItem->cart))
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    {{$orderItem->cart->created_at->format('H:i d/m/Y')}}
                                                </td>
                                                <td>
                                                    {{$orderItem->cart->code}}
                                                </td>
                                                <td>
                                                    @if (!empty($orderItem->productDetail))
                                                    {{$orderItem->sl}} x <a target="_blank" href="{{ route('client.product.show', ['slug' => $orderItem->productDetail->slug.'-'.$orderItem->product_id]) }}">
                                                            {{$orderItem->productDetail->title}}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p>
                                                        {{$orderItem->cart->name}}
                                                    </p>
                                                    <p>
                                                        {{$orderItem->cart->email}}
                                                    </p>
                                                    <p>
                                                        {{$orderItem->cart->phone}}
                                                    </p>
                                                    <p>
                                                        {{$orderItem->cart->address}}
                                                    </p>
                                                </td>
                                                <td align="right">
                                                    <b>
                                                        {{number_format($orderItem->sl * $orderItem->price)}} vnđ
                                                    </b>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection