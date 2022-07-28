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
                            <select name="month" class="js-example-basic-single form-control form-select-search">
                                <option value="all">Chọn tháng</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option @if(request()->has('month') && request()->get('month') == $i){{'selected'}}@endif value="{{$i}}">
                                            Tháng {{$i}}
                                        </option>
                                    @endfor
                            </select>
                            <select name="year" class="js-example-basic-single form-control form-select-search">
                                <option value="all">Chọn năm</option>
                                    @for ($i = date('Y') - 1; $i <= date('Y'); $i++)
                                        <option @if(request()->has('year') && request()->get('year') == $i){{'selected'}}@endif value="{{$i}}">
                                            Năm {{$i}}
                                        </option>
                                    @endfor
                            </select>
                            <div class="input-group mb-0 mr-sm-2">
                                <select name="category_id" class="js-example-basic-single form-control form-select-search">
                                    {!! $data['category'] !!}
                                </select>
                            </div>
                            <div class="input-group mb-0 mr-sm-2">
                                <select name="type" class="js-example-basic-single form-control form-select-search">
                                    <option @if (request()->has('type') && request()->get('type') == 'all'){{'selected'}}@endif value="all">Tất cả bài viết</option>
                                    <option @if (request()->has('type') && request()->get('type') == 'crawl'){{'selected'}}@endif value="crawl">Bài viết Crawl</option>
                                    <option @if (request()->has('type') && request()->get('type') == 'handle'){{'selected'}}@endif value="handle">Bài viết tự viết</option>
                                </select>
                            </div>
                            <div class="input-group mb-0 mr-sm-2">
                                <select name="status" class="js-example-basic-single form-control form-select-search">
                                    <option @if (request()->has('status') && request()->get('status') == 'all'){{'selected'}}@endif value="all">Trạng thái</option>
                                    <option @if (request()->has('status') && request()->get('status') == 1){{'selected'}}@endif value="1">Đã Active</option>
                                    <option @if (request()->has('status') && request()->get('status') == -1){{'selected'}}@endif value="-1">Chưa Active</option>
                                </select>
                            </div>
                            <div class="input-group mb-0 mr-sm-2">
                                <select name="col_order" class="js-example-basic-single form-control form-select-search">
                                    <option @if (request()->has('col_order') && request()->get('col_order') == ''){{'selected'}}@endif value="id">Sắp xếp mặc định</option>
                                    <option @if (request()->has('col_order') && request()->get('col_order') == 'total_views'){{'selected'}}@endif value="total_views">Sắp xếp theo số lượt xem</option>
                                </select>
                            </div>
                            <div class="input-group mb-0 mr-sm-2">
                                <select name="type_order" class="js-example-basic-single form-control form-select-search">
                                    <option @if (request()->has('type_order') && request()->get('type_order') == ''){{'selected'}}@endif value="">Mặc định</option>
                                    <option @if (request()->has('type_order') && request()->get('type_order') == 'ASC'){{'selected'}}@endif value="ASC">Tăng dần</option>
                                    <option @if (request()->has('type_order') && request()->get('type_order') == 'DESC'){{'selected'}}@endif value="DESC">Giảm dần</option>
                                </select>
                            </div>
                            @if(in_array(ROLE_ADMIN, auth('admins')->user()->roles->pluck('name')->toArray()))
                                <div class="input-group mb-0 mr-sm-2">
                                    <select name="admin_id" class="js-example-basic-single form-control form-select-search">
                                        <option value="all">Tất cả tài khoản</option>
                                        @foreach ($data['admins'] as $adminItem)
                                            <option @if (request()->has('admin_id') && request()->get('admin_id') == $adminItem->id){{'selected'}}@endif value="{{$adminItem->id}}">
                                                {{$adminItem->username}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
                        </form>
                    </div>
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
        <form method="post" action="">
            @csrf()
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <p style="margin-bottom: 0px">
                        @if (in_array(ROLE_ADMIN, get_role_name()))
                            Tổng bài viết: <b>{{$data['list']->total()}}</b>
                        @else
                            Tổng bài viết đã duyệt: <b>{{$data['total_post_active']}}</b>
                        @endif
                    </p>
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
                                        <th style="width: 35px;"><input class="check-all" type="checkbox"/></th>
                                        <th width="50">@lang('admins::layer.table.stt')</th>
                                        <th>Ảnh</th>
                                        <th>@lang('admins::layer.table.title')</th>
                                        <th>Danh mục</th>
                                        <th>Lượt xem</th>
                                        <th>@lang('admins::layer.table.status')</th>
                                        <th>Nổi bật</th>
                                        <th>Share FB</th>
                                        {{--                                    <th>Slide</th>--}}
                                        {{--                                    <th>Choose 3</th>--}}
                                        {{--                                    <th>Choose 4</th>--}}
                                        <th>@lang('admins::layer.table.created')</th>
                                        <th>@lang('admins::layer.table.modified')</th>
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
                                                   href="{{ route('admin.post.edit', ['id' => $row->id, 'page' => $data['list']->currentPage()]) }}">
                                                    <i class="icon-note"></i>
                                                </a>
                                                <a class="icon-form status active"
                                                   href="{{ route('admin.post.status', ['id' => $row->id, 'field' => 'status']) }}">
                                                    {!! (($row->status == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                                <a class="icon-form"
                                                   href="javascript:confirmDelete('{{ route('admin.post.destroy', ['id' => $row->id]) }}','@lang('admins::layer.notify.confirm.delete')')">
                                                    <i class="icon-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ $row->category_title }}</td>
                                            <td class="text-center">{{ $row->total_views }}</td>
                                            <td>{{ \Helpers::renderStatus($row->status) }}</td>
                                            <td>
                                                <a class="icon-form status active"
                                                   href="{{ route('admin.post.status', ['id' => $row->id, 'field' => 'choose_1']) }}">
                                                    {!! (($row->choose_1 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                                </a>
                                            </td>
                                            @php
                                                $route = route('client.post.show', ['slug' => $row->slug])   
                                            @endphp
                                            <td>
                                                <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{$route}}', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,left=400,width=700,height=400,top=200')">
                                                    Share FB
                                                </a>
                                            </td>
                                            {{--                                        <td>--}}
                                            {{--                                            <a class="icon-form status active" href="{{ route('admin.post.status', ['id' => $row->id, 'field' => 'choose_2']) }}">--}}
                                            {{--                                                {!! (($row->choose_2 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </td>--}}
                                            {{--                                        <td>--}}
                                            {{--                                            <a class="icon-form status active" href="{{ route('admin.post.status', ['id' => $row->id, 'field' => 'choose_3']) }}">--}}
                                            {{--                                                {!! (($row->choose_3 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </td>--}}
                                            {{--                                        <td>--}}
                                            {{--                                            <a class="icon-form status active" href="{{ route('admin.post.status', ['id' => $row->id, 'field' => 'choose_4']) }}">--}}
                                            {{--                                                {!! (($row->choose_4 == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}--}}
                                            {{--                                            </a>--}}
                                            {{--                                        </td>--}}
                                            <td>{{ \Helpers::formatTime($row->created_at) }}</td>
                                            {{-- <td>{{ \Helpers::formatTime($row->date_edit) }}</td> --}}
                                            <td>
                                                @if ($row->date_edit != '')
                                                    {{ date('d/m/Y', strtotime($row->date_edit)) }}
                                                @endif
                                            </td>
                                            <td>{{ $row->id }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="" style="overflow: hidden; padding: 15px 0 0 0;">
                                    <select name="action" class="form-control col-md-3" style="width: 150px; float: left; margin-right: 5px; border: 1px solid #ddd; outline: 0;">
                                        <option value="">Hành động</option>
                                        <option value="1">Xoá lựa chọn</option>
                                    </select>
                                    <button type="submit" class="btn btn-success">
                                        Thực hiện
                                    </button>
                                </div>
                                {{ $data['list']->appends($_GET)->links('admins::elements.extend.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
