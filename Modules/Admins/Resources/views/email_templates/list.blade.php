@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">
                        Danh sách mẫu Email
                    </h4>
                    {{-- <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" name="search" value="{{ request()->has('search') ? request()->get('search   ') : '' }}" class="form-control mb-0 mr-sm-2"
                                   placeholder="@lang('admins::layer.search.form.keyword')">
                            <button type="submit"
                                    class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
                            <a href="{{url()->current()}}" style="margin-left: 10px"
                                    class="btn btn-danger mb-0">
                                Reload
                            </a>
                        </form>
                    </div> --}}
                    <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                        <div class="d-flex mt-4 mt-md-0">
                            <a href="{{ route('admin.config.add-template-email') }}">
                                <button type="button" class="btn btn-success">
                                    Thêm mới
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
                                        <th>STT</th>
                                        <th>Mã</th>
                                        <th>Tên mẫu Email</th>
                                        <th>Chủ đề</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $key => $item)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                {{$item->code}}
                                            </td>
                                            <td>
                                                {{$item->name}}
                                            </td>
                                            <td>
                                                {{$item->subject}}
                                            </td>
                                            <td>
                                                <a href="{{route('admin.config.edit-template-email', ['id' => $item->id])}}">Sửa</a>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.config.delete-template-email', ['id' => $item->id])}}">Xóa</a>
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
