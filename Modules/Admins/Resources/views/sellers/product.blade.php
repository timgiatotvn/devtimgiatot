@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" name="keyword" value="{{isset($inputs['keyword']) ? $inputs['keyword'] : ''}}" 
                                   class="form-control mb-0 mr-sm-2"
                                   placeholder="@lang('admins::layer.search.form.keyword')">
                            <select name="status" class="js-example-basic-single form-control form-select-search">
                                <option value="-1">Trạng thái</option>
                                <option @if(isset($inputs['status']) && $inputs['status'] == 0){{'selected'}}@endif value="0">Chưa duyệt</option>
                                <option @if(isset($inputs['status']) && $inputs['status'] == 1){{'selected'}}@endif value="1">Đã duyệt</option>
                            </select>
                            <select name="category_id" class="js-example-basic-single form-control form-select-search">
                                <option value="-1">Danh mục</option>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->title}}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
                            <a href="{{url()->current()}}" class="btn btn-danger mb-0">Tải lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
            <p class="alert alert-success">{{Session::get('success')}}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert alert-danger">{{Session::get('error')}}</p>
        @endif
        <form method="post" action="">
            @csrf()
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    Tổng có {{number_format($total)}} sản phẩm
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Shop</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Chuyên mục</th>
                                        <th>View</th>
                                        <th>TT</th>
                                        <th>HĐ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $index => $productItem)
                                            <tr>
                                                <td>
                                                    {{$index + 1}}
                                                </td>
                                                <td>
                                                    <img src="{{$productItem->thumbnail}}" width="50px" alt="">
                                                </td>
                                                <td>
                                                    {{$productItem->user->shop_name}}
                                                </td>
                                                <td>
                                                    {{$productItem->title}}
                                                </td>
                                                <td>
                                                    <p>
                                                        Giá bán: <b>{{number_format($productItem->price)}} vnđ</b>
                                                    </p>
                                                    <p>
                                                        Giá gốc: <b>{{number_format($productItem->price_root)}} vnđ</b>
                                                    </p>
                                                </td>
                                                <td>
                                                    {{$productItem->category->title}}
                                                </td>
                                                <td>
                                                    {{$productItem->view}}
                                                </td>
                                                <td>
                                                    @if ($productItem->status)
                                                        <span class="badge bg-success">Đã duyệt</span>
                                                    @else
                                                        <span class="badge bg-danger">Chưa duyệt</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($productItem->status)
                                                    <a href="{{route('admin.seller.product.change-status', ['id' => $productItem->id, 'status' => 0])}}" onclick="return confirm('Bạn có chắc chắn?')" class="btn btn-danger">Từ chối</a>
                                                    @else
                                                    <a href="{{route('admin.seller.product.change-status', ['id' => $productItem->id, 'status' => 1])}}" onclick="return confirm('Bạn có chắc chắn?')" class="btn btn-success">Duyệt</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->appends($inputs)->links('admins::elements.extend.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
