@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">Danh sách quyền truy cập</h4>
                    <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                        <div class="d-flex mt-4 mt-md-0">
                            <a href="{{ route('admin.setting.permission.add') }}">
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
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên</th>
                                            <th>Mã</th>
                                            <th>Mô tả</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($group_pms as $gr_item)
                                            <tr style="background: #ecf0f4">
                                                <td colspan="5">
                                                    {{$gr_item->name}}
                                                </td>
                                            </tr>
                                            @foreach ($gr_item->permissions as $key => $permissionItem)
                                                <tr>
                                                    <td>
                                                        {{$key + 1}}
                                                    </td>
                                                    <td>
                                                        {{str_replace('-', ' ', $permissionItem->name)}}
                                                    </td>
                                                    <td>
                                                        {{$permissionItem->name}}
                                                    </td>
                                                    <td>
                                                        {{$permissionItem->description}}
                                                    </td>
                                                    <td>
                                                        <a class="icon-form" title="edit" href="{{ route('admin.setting.permission.edit_form', ['id' => $permissionItem->id]) }}">
                                                            <i class="icon-note"></i>
                                                        </a>
                                                        <a class="icon-form" href="javascript:confirmDelete('{{ route('admin.setting.permission.delete', ['id' => $permissionItem->id]) }}','Bạn có chắc chắn muốn xóa')">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
