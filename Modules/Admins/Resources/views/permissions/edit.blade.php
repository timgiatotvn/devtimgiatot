@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="{{route('admin.setting.permission.update', ['id' => $permission->id])}}" class="forms-sample" id="form-create">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">Sửa quyền truy cập - {{$permission->name}}</h4>
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    Lưu
                                </button>
                                <a href="{{ route('admin.setting.permission.list') }}">
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
                        @if($errors->has('name'))
                            <p class="alert alert-danger">{{$errors->first('name')}}</p>
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên quyền truy cập <span style="color: red">*</span></label>
                                <input type="text" value="{{str_replace('-', ' ', $permission->name)}}" name="name" placeholder="Viết tiếng anh" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label for="">Nhóm quyền truy cập <span style="color: red">*</span></label>
                                <select name="group_permission_id" class="form-control" id="">
                                    @foreach ($group_pms as $item)
                                        <option @if($item->group_permission_id == $item->id){{'selected'}}@endif value="{{$item->id}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{$permission->description}}</textarea>
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
                                <a href="{{ route('admin.setting.permission.list') }}">
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
