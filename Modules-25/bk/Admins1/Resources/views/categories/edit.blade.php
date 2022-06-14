@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="" class="forms-sample" id="form-edit">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
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
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" value="{{ $data['detail']->title }}" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" placeholder="Mô tả" rows="4" class="form-control">{{ $data['detail']->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Vị trí</label>
                                <input type="text" name="sort" value="{{ $data['detail']->sort }}" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Thuộc danh mục</label>
                                <select name="parent_id" class="form-control col-md-3">
                                    {!! $data['category'] !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại danh mục</label>
                                <select name="type" class="form-control col-md-3">
                                    <option value=""></option>
                                    @foreach($type_cate as $row)
                                        <option @if($data['detail']->type == $row) selected @endif value="{{ $row }}">{{ $type_text[$row] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Url</label>
                                <input type="text" name="url" value="{{ $data['detail']->url }}" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="1" {{ ($data['detail']->status == 1) ? 'checked' : '' }}>
                                                @lang('admins::layer.status.active')
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="0" {{ ($data['detail']->status == 0) ? 'checked' : '' }}>
                                                @lang('admins::layer.status.no_active')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('error'))
                                <p class="alert alert-danger">{{$errors->first('error')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title seo</label>
                                <textarea type="text" name="title_seo" class="form-control" placeholder="">{{ $data['detail']->title_seo }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta des</label>
                                <textarea type="text" name="meta_des" class="form-control" placeholder="">{{ $data['detail']->meta_des }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta key</label>
                                <textarea type="text" name="meta_key" class="form-control" placeholder="">{{ $data['detail']->meta_key }}</textarea>
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
@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Category\EditRequest','#form-edit'); !!}
@endsection
