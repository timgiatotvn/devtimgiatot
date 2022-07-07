@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">

                <h4 class="mb-md-0 mb-4 mr-4">Từ khoá nổi bật</h4>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" name="keyword"
                                   value="{{ request()->has('keyword') ? request()->get('keyword') : '' }}"
                                   class="form-control mb-0 mr-sm-2"
                                   placeholder="Nhập từ khoá">
                            <input type="date" name="start"
                                   class="form-control mb-0 mr-sm-2"
                                   value="{{ request()->has('start') ? request()->get('start') : '' }}"
                                   placeholder="Từ ngày">
                            <input type="date" name="end"
                                   class="form-control mb-0 mr-sm-2"
                                   value="{{ request()->has('end') ? request()->get('end') : '' }}"
                                   placeholder="Tới ngày">
                            <button type="submit"
                                    class="btn btn-primary mb-0">Tìm kiếm</button>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="50">@lang('admins::layer.table.stt')</th>
                                        <th class="text-center">Từ khoá</th>
                                        <th class="text-center">Lượt tìm kiếm</th>
                                        <th class="text-center">Thời gian</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['list'] as $k=>$row)
                                        <tr>
                                            <td class="text-center">{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td class="text-center">{{ $row->total }}</td>
                                            <td class="text-center">
                                                @if(request()->has('start')&&request()->get('start')!='')
                                                    {{request()->get('start')}}
                                                @else
                                                    Từ trước
                                                @endif
                                                <b style="color:red">-</b>

                                                @if(request()->has('end')&&request()->get('end')!='')
                                                    {{request()->get('end')}}
                                                @else
                                                    Tới nay
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $data['list']->links('admins::elements.extend.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('style')
    <style type="text/css">
        .fix-content {
            word-break: break-all;
            white-space: pre-line;
        }

        .fix-content img {
            max-width: 300px;
        }
    </style>
@endsection
