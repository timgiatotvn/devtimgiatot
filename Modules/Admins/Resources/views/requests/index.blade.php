@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">
                        Danh sách yêu cầu tư vấn từ khách hàng
                    </h4>
                </div>
                <br>
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                        <div class="d-flex mt-4 mt-md-0">
                            <a href="{{ route('admin.post.create') }}">
                                <button type="button" class="btn btn-success">
                                    @lang('admins::layer.button.add')
                                </button>
                            </a>
                        </div>
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
                                        <th width="50">@lang('admins::layer.table.stt')</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Địa chỉ</th>
                                        <th>Yêu cầu thêm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $key => $requestItem)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$requestItem->full_name}}
                                            </td>
                                            <td>
                                                {{$requestItem->email}}
                                            </td>
                                            <td>
                                                {{$requestItem->phone}}
                                            </td>
                                            <td>
                                                {{$requestItem->address}}
                                            </td>
                                            <td>
                                                {{$requestItem->description}}
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
@endsection
