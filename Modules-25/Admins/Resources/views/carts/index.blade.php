@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="50">@lang('admins::layer.table.stt')</th>
                                        <th>User</th>
                                        <th>Điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Nội dung</th>
                                        <th>@lang('admins::layer.table.status')</th>
                                        <th width="90">@lang('admins::layer.table.created')</th>
                                        <th width="50">@lang('admins::layer.table.id')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['list'] as $k=>$row)
                                        <tr style="background: rgb(32 56 144); color: #fff;">
                                            <td>{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                            <td>
                                                @if(!empty($row['userDetail']->id))
                                                    {!! 'Account: '. $row['userDetail']->username .'<br>'.'Email: '.$row['userDetail']->email !!}
                                                @else
                                                    {!! 'Tên khách: '. $row->name .'<br>'.'Email: '.$row->email !!}
                                                @endif
                                            </td>
                                            <td>{{ $row->phone }}</td>
                                            <td>{{ $row->address }}</td>
                                            <td>{{ $row->content }}</td>
                                            <td>{{ \Helpers::renderStatus($row->status) }}</td>
                                            <td>{{ \Helpers::formatTime($row->created_at) }}</td>
                                            <td>{{ $row->id }}</td>
                                        </tr>
                                        @if(!empty($row['cartItems']))
                                            <tr>
                                                <td colspan="8">
                                                    <div style="">
                                                        <table class="table table-striped table-bordered table-hover"
                                                               style="background: #fff;">
                                                            <thead>
                                                            <tr class="table-danger" style="font-weight: bold;">
                                                                <th style="font-weight: bold; padding: 12px;"
                                                                    width="50">@lang('admins::layer.table.stt')</th>
                                                                <th style="font-weight: bold; padding: 12px;">Ảnh</th>
                                                                <th style="font-weight: bold; padding: 12px;">Tên sản
                                                                    phẩm
                                                                </th>
                                                                <th style="font-weight: bold; padding: 12px;">Số lượng
                                                                </th>
                                                                <th style="font-weight: bold; padding: 12px;">Giá</th>
                                                                <th style="font-weight: bold; padding: 12px;">Tổng
                                                                    tiền
                                                                </th>
                                                                <th style="font-weight: bold; padding: 12px;"
                                                                    width="50">@lang('admins::layer.table.id')</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($row['cartItems'] as $key=>$val)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>
                                                                        <img src="{{ asset(!empty($val['productDetail']->id) ? $val['productDetail']->thumbnail : '') }}"
                                                                             style="width: 25px;"></td>
                                                                    <td>{{ !empty($val['productDetail']->id) ? $val['productDetail']->title : '' }}</td>
                                                                    <td>{{ $val->sl }}</td>
                                                                    <td>{{ \App\Helpers\Helpers::formatPrice($val->price) }}
                                                                        đ
                                                                    </td>
                                                                    <td>{{ \App\Helpers\Helpers::formatPrice($val->sum_price) }}
                                                                        đ
                                                                    </td>
                                                                    <td>{{ $val->id }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="" style="overflow: hidden; padding: 15px 0 0 0;">
                                    <select name="action" class="form-control col-md-3"
                                            style="width: 150px; float: left; margin-right: 5px; border: 1px solid #ddd; outline: 0;">
                                        <option value="">Hành động</option>
                                        <option value="1">Xoá lựa chọn</option>
                                    </select>
                                    <button type="submit" class="btn btn-success">
                                        Thực hiện
                                    </button>
                                </div>
                                {{ $data['list']->links('admins::elements.extend.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
