@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="{{route('admin.setting.role.create')}}" class="forms-sample" id="form-create">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">Thêm mới</h4>
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    Lưu
                                </button>
                                <a href="{{ route('admin.setting.role.list') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        Hủy
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        @if($errors->has('error'))
                            <p class="alert alert-danger">{{$errors->first('error')}}</p>
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên role <span style="color: red">*</span></label>
                                <input type="text" required name="name" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Quyền truy cập</label>
                                @foreach ($group_pms as $group_pms_item)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <b>{{$group_pms_item->name}}</b>
                                        </div>
                                        @foreach ($group_pms_item->permissions as $pms_item)
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$pms_item->id}}">
                                                        {{str_replace('-', ' ', $pms_item->name)}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    Lưu
                                </button>
                                <a href="{{ route('admin.setting.role.list') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        Hủy
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
