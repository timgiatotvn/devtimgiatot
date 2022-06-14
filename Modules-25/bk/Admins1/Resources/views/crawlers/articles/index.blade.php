@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" name="keyword"
                                   value="{{ request()->has('keyword') ? request()->get('keyword') : '' }}"
                                   class="form-control mb-0 mr-sm-2"
                                   placeholder="@lang('admins::layer.search.form.keyword')">
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
                                    <th width="60">Ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Website</th>
                                    <th>Giá bán</th>
                                    <th>Giá gốc</th>
                                    <th>@lang('admins::layer.table.status')</th>
                                    <th width="50">@lang('admins::layer.table.created')</th>
                                    <th width="50">@lang('admins::layer.table.modified')</th>
                                    <th width="50">@lang('admins::layer.table.id')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list'] as $k=>$row)
                                    <tr>
                                        <td>{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                        <td><img src="{{ $row->thumbnail }}" class="mw-100"></td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ !empty($row->crawlerCategory->domain_url) ? $row->crawlerCategory->domain_url : '' }}</td>
                                        <td>{{ \App\Helpers\Helpers::formatPrice($row->price) }}</td>
                                        <td>{{ \App\Helpers\Helpers::formatPrice($row->price_root) }}</td>
                                        <td>{{ \Helpers::renderStatus($row->status) }}</td>
                                        <td>{{ \Helpers::formatDate($row->created_at) }}</td>
                                        <td>{{ \Helpers::formatDate($row->updated_at) }}</td>
                                        <td>{{ $row->id }}</td>
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
    </div>
@endsection
