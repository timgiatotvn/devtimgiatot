@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">
                        Danh sách dịch vụ
                    </h4>
                    <div class="wrapper d-flex align-items-center">
                        {{-- <form class="form-inline">
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
                        </form> --}}
                    </div>
                </div>
                <br>
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                        <div class="d-flex mt-4 mt-md-0">
                            <a href="{{ route('admin.service.add') }}">
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
                                        <th>Ảnh</th>
                                        <th>@lang('admins::layer.table.title')</th>
                                        <th>Giá</th>
                                        <th>Liên hệ/Zalo</th>
                                        <th>Chuyên mục</th>
                                        <th>Đánh giá</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $key => $serviceItem)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                <img width="50px" src="{{$serviceItem->thumbnail}}" alt="">
                                            </td>
                                            <td>
                                                <a href="" target="_blank">
                                                    {{$serviceItem->title}}
                                                </a>
                                            </td>
                                            <td align="right">
                                                {{number_format($serviceItem->price)}}
                                            </td>
                                            <td>
                                                {{$serviceItem->hotline}}/{{$serviceItem->zalo}}
                                            </td>
                                            <td>
                                                {{$serviceItem->category->title}}
                                            </td>
                                            <td>
                                                {{$serviceItem->rate}}
                                            </td>
                                            <td>
                                                @if ($serviceItem->status)
                                                    <label class="text-success" for="">Đã Active</label>
                                                @else
                                                    <label class="text-danger" for="">Chưa Active</label>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <a href="{{route('admin.service.edit', ['id' => $serviceItem->id])}}">Sửa</a> / <a href="" onclick="return confirm('Bạn có chắc chắn muốn xóa')">Xóa</a>
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
