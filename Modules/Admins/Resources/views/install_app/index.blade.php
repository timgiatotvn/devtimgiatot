@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">Thống kê lượt cài đặt app</h4>
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" name="city" value="{{ request()->has('city') ? request()->get('city') : '' }}" class="form-control mb-0 mr-sm-2"
                                   placeholder="Nhập tỉnh thành phố">
                            <button type="submit"
                                    class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
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
                                    <th width="50">@lang('admins::layer.table.stt')</th>
                                    <th>Khu vực</th>
                                    <th width="30%">Lượt cài đặt</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($devices) > 0)
                                    @foreach($devices as $k => $device)
                                        @if (!empty($device->city))
                                            <tr>
                                                <td>{{ $k+1 }}</td>
                                                <td>{{ $device->city }}</td>
                                                <td>{{ $device->total }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {{ $devices->links('admins::elements.extend.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
