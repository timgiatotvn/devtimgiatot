@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">
                        Khách hàng
                    </h4>
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" name="search" value="{{ request()->has('search') ? request()->get('search   ') : '' }}" class="form-control mb-0 mr-sm-2"
                                   placeholder="@lang('admins::layer.search.form.keyword')">
                            <button type="submit"
                                    class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
                            <a href="{{url()->current()}}" style="margin-left: 10px"
                                    class="btn btn-danger mb-0">
                                Reload
                            </a>
                            {{-- <button type="submit" style="margin-left: 10px"
                                    class="btn btn-success mb-0">
                                Xuất Excel
                            </button> --}}
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
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Khách hàng</th>
                                        <th>Tên shop</th>
                                        <th>SL sản phẩm</th>
                                        <th>SL đơn</th>
                                        <th>Duyệt bán hàng</th>
                                        <th>Giới hạn push</th>
                                        <th>Tổng Push Notification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $key => $item)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <p>
                                                    {{$item->username}}
                                                </p>
                                                <p>{{$item->name}}</p>
                                                <p>{{$item->email}}</p>
                                                <p>{{$item->phone}}</p>
                                            </td>
                                            <td>
                                                {{$item->shop_name}}
                                            </td>
                                            <td align="center">
                                                {{number_format($item->products_count)}}
                                            </td>
                                            <td align="center">
                                                {{number_format($item->cart_items_count)}}
                                            </td>
                                            <td>
                                                @if ($item->status_sale)
                                                    <a onclick="return confirm('Bạn có chắc chắn?')" href="{{route('admin.accept-seller', ['id' => $item->id, 'status' => 0])}}" class="btn btn-danger" href="">
                                                        Từ chối bán
                                                    </a>
                                                @else
                                                    <a onclick="return confirm('Bạn có chắc chắn?')" href="{{route('admin.accept-seller', ['id' => $item->id, 'status' => 1])}}" class="btn btn-success" href="">
                                                        Duyệt bán
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{route('admin.customer.update-push-number', ['id' => $item->id])}}">
                                                    @csrf
                                                    <input name="push_number" value="{{$item->push_number}}" type="text" class="form-control"><br>
                                                    <button class="btn btn-primary">Cập nhật</button>
                                                </form>
                                            </td>
                                            <td align="center">{{$item->notifications->count()}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $customers->appends($inputs)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
