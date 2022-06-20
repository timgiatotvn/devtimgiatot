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
                                <label>Slug</label>
                                <input type="text" name="slug" value="{{ $data['detail']->slug }}" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label id="urlfull" data-url="{{ asset("/") }}">Link: <a href="{{ asset("/").$data['detail']->slug.".html" }}">{{ asset("/").$data['detail']->slug.".html" }}</a></label>
                            </div>
                            <div class="form-group">
                                <label>Danh mục chính</label>
                                <select name="category_id" class="form-control col-md-3">
                                    {!! $data['category']['select'] !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục liên quan</label>
                                <div class="multi-category">
                                    <ul>
                                        <li>
                                            @php $dem = 0; @endphp
                                            @foreach($data['category']['list'] as $k => $row)
                                                @php
                                                    if($dem) if(!strpos('string'.$row, '--')) echo '</li><li>';
                                                    $dem ++;
                                                @endphp
                                                <div>
                                                    <label>
                                                        <input type="checkbox" {{ (in_array($k, explode('|', $data['detail']->category_multi))) ? 'checked' : '' }} name="category_multi[]" value="{{ $k }}">
                                                        {{ $row }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset($data['detail']->thumbnail) }}" width="150" class="mb-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" value="{{ $data['detail']->thumbnail }}" type="text" name="thumbnail"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="ckeditor-mini" name="description">{{ $data['detail']->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="ckeditor" name="content">{{ $data['detail']->content }}</textarea>
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
@section('scripts')
    <script type="text/javascript">
        $("input[name='slug']").keyup(function(){
            var url = $("#urlfull").data("url");
            $("#urlfull a").attr("href", url + $(this).val() + ".html");
            $("#urlfull a").html(url + $(this).val() + ".html");
        });

    </script>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Post\EditRequest','#form-edit'); !!}
@endsection
