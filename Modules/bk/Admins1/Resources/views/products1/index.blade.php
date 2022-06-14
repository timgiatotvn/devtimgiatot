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
                            <div class="input-group mb-0 mr-sm-2">
                                <select name="category_id" class="form-control form-select-search">
                                    {!! $data['category'] !!}
                                </select>
                            </div>
                            <button type="submit"
                                    class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
                        </form>
                    </div>
                    <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                        <div class="d-flex mt-4 mt-md-0">
                            <a href="{{ route('admin.product.create') }}">
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
                                        <th style="width: 35px;"><input class="check-all" type="checkbox"/></th>
                                        <th width="50">@lang('admins::layer.table.stt')</th>
                                        <th width="60">Ảnh</th>
                                        <th>@lang('admins::layer.table.title')</th>
                                        <th>Danh mục</th>
                                        <th>Mã</th>
                                        <th>Giá bán</th>
                                        <th>Số lượng</th>
                                        <th>@lang('admins::layer.table.status')</th>
                                        {{--                                    <th>Nổi bật</th>--}}
                                        {{--                                    <th>Slide</th>--}}
                                        {{--                                    <th>Choose 3</th>--}}
                                        {{--                                    <th>Choose 4</th>--}}
                                        <th width="90">@lang('admins::layer.table.created')</th>
                                        <th width="90">@lang('admins::layer.table.modified')</th>
                                        <th width="50">@lang('admins::layer.table.id')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['list'] as $k=>$row)
                                        <tr>
                                            <td><input type="checkbox" name="check[]" value="{{$row->id}}"/></td>
                                            <td>{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                            <td><img src="{{ asset($row->thumbnail) }}" class="mw-100"></td>
                                            <td>
                                                {{ $row->title }}
                                                <div class="clearfix mb-3"></div>
                                                <a class="icon-form" title="edit"
                                                   href="{{ route('admin.product.edit', ['id' => $row->id, 'page' => $data['list']->currentPage()]) }}">
                                                    <i class="icon-note"></i>
                                                </a>
                                                <a class="icon-form status active"
                                                   href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'status']) }}">
                                                    {!! (($row->status == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                                <a class="icon-form"
                                                   href="javascript:confirmDelete('{{ route('admin.product.destroy', ['id' => $row->id]) }}','@lang('admins::layer.notify.confirm.delete')')">
                                                    <i class="icon-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ $row->category_title }}</td>
                                            <td>{{ $row->code }}</td>
                                            <td>{{ \App\Helpers\Helpers::formatPrice($row->price) }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>{{ \Helpers::renderStatus($row->status) }}</td>
                                            {{--                                        <td>--}}
                                            {{--                                            <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_1']) }}">--}}
                                            {{--                                                {!! (($row->choose_1 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </td>--}}
                                            {{--                                        <td>--}}
                                            {{--                                            <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_2']) }}">--}}
                                            {{--                                                {!! (($row->choose_2 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </td>--}}
                                            {{--                                        <td>--}}
                                            {{--                                            <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_3']) }}">--}}
                                            {{--                                                {!! (($row->choose_3 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </td>--}}
                                            {{--                                        <td>--}}
                                            {{--                                            <a class="icon-form status active" href="{{ route('admin.product.status', ['id' => $row->id, 'field' => 'choose_4']) }}">--}}
                                            {{--                                                {!! (($row->choose_4 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </td>--}}
                                            <td>{{ \Helpers::formatTime($row->created_at) }}</td>
                                            <td>{{ \Helpers::formatTime($row->updated_at) }}</td>
                                            <td>{{ $row->id }}</td>

                                        </tr>
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
