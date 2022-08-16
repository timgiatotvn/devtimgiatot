@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="{{route('admin.config.store-template-email')}}" class="forms-sample" id="form-create">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">
                            Sửa mẫu Email
                        </h4>
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.config.list-template-email') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        @lang('admins::layer.button.cancel')
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
                                <label>Ký tự viết tắt:</label>
                                <ul>
                                    <li>
                                        <b>[full_name]</b>: Tên khách hàng
                                    </li>
                                    <li>
                                        <b>[url]</b>: URL kích xác thực
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>Chủ đề</label>
                                <input value="{{$email->subject}}" autocomplete="off" name="subject" type="text" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label style="display: block">Loại Email</label>
                                <select name="code" class="js-example-basic-single  form-control col-md-12">
                                    @foreach (TYPE_EMAIL_TEMPLATES as $key => $item)
                                        <option @if($key == $email->code){{'selected'}}@endif value="{{$key}}">
                                            {{$item}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="tinymce" name="content">{{$email->content}}</textarea>
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
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.category.index') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        @lang('admins::layer.button.cancel')
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
