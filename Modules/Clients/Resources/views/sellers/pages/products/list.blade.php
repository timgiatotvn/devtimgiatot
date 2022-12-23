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
                    <h4 class="page-title">Danh sách sản phẩm</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('clients::sellers.includes.alert')
                        <form method="GET">
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
                        </form>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Chuyên mục</th>
                                        <th scope="col">View</th>
                                        <th scope="col">TT</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $productItem)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                <img src="{{$productItem->thumbnail}}" width="50px" alt="">
                                            </td>
                                            <td style="width: 200px">
                                                <a target="_blank" href="{{ route('client.product.show', ['slug' => $productItem->slug.'-'.$productItem->id]) }}">
                                                    {{$productItem->title}}
                                                </a>
                                            </td>
                                            <td>
                                                <p>
                                                    Giá bán: <b>{{number_format($productItem->price)}}</b>
                                                </p>
                                                <p>
                                                    Giá gốc: <b>{{number_format($productItem->price_root)}}</b>
                                                </p>
                                            </td>
                                            <td>
                                                {{$productItem->category->title}}
                                            </td>
                                            <td>
                                                {{number_format($productItem->view)}}
                                            </td>
                                            <td>
                                                @if (!$productItem->status)
                                                    <span class="badge bg-danger">Chưa duyệt</span>
                                                @else
                                                    <span class="badge bg-success">Đã duyệt</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('seller.product.form-edit-product', ['id' => $productItem->id])}}" class="btn btn-warning">Sửa</a>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('seller.product.delete-product', ['id' => $productItem->id])}}" class="btn btn-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection