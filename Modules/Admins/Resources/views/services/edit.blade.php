@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="POST" action="{{route('admin.service.update', ['id' => $service->id])}}" class="forms-sample">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">
                            Sửa dịch vụ {{$service->title}}
                        </h4>
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.service.index') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        @lang('admins::layer.button.cancel')
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input value="{{!empty(old('title')) ? old('title') : $service->title}}" type="text" required name="title" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" value="{{!empty(old('slug')) ? old('slug') : $service->slug}}" required name="slug" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label id="urlfull" data-url="{{ asset("/") }}">Link: <a href=""></a></label>
                            </div>
			                <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" value="{{!empty(old('address')) ? old('address') : $service->address}}" name="address" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Dịch vụ (cách nhau bởi dấu ;)</label>
                                <input value="{{!empty(old('service')) ? old('service') : $service->service}}" type="text" name="service" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" value="{{!empty(old('price')) ? old('price') : $service->price}}" name="price" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Liên hệ</label>
                                <input type="text" value="{{!empty(old('hotline')) ? old('hotline') : $service->hotline}}" name="hotline" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Zalo</label>
                                <input type="text" value="{{!empty(old('zalo')) ? old('zalo') : $service->zalo}}" name="zalo" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Đánh giá</label>
                                <input type="number" value="{{!empty(old('rate')) ? old('rate') : $service->rate}}" name="rate" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Tổng người đánh giá</label>
                                <input type="number" value="{{!empty(old('total_rate')) ? old('total_rate') : $service->total_rate}}" name="total_rate" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label style="display: block">Tỉnh/TP</label>
                                <select id="pick-province" name="province_id" class="js-example-basic-single  form-control col-md-3">
                                    <option value="">Chọn tỉnh/tp</option>
                                    @foreach ($provinces as $provinceItem)
                                        <option @if($provinceItem->id == $service->province_id){{'selected'}}@endif value="{{$provinceItem->id}}">
                                            {{$provinceItem->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="display: block">Quận/huyện</label>
                                <select id="district" name="district_id" class="js-example-basic-single  form-control col-md-3">
                                    @foreach ($districts as $item)
                                        <option @if($item->id == $service->district_id){{'selected'}}@endif value="{{$item->id}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="display: block">Danh mục chính</label>
                                <select name="category_id" class="js-example-basic-single  form-control col-md-3">
                                    @foreach ($category as $categoryItem)
                                        <option value="{{$categoryItem->id}}">
                                            {{$categoryItem->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder"
                                                   class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Chọn thumbnail
                                                </a>
                                            </span>
                                            <input id="thumbnail" required value="{{!empty(old('thumbnail')) ? old('thumbnail') : $service->thumbnail}}" class="form-control" type="text" name="thumbnail"
                                                   readonly>
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="logo" data-preview="logo"
                                                   class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Chọn logo
                                                </a>
                                            </span>
                                            <input id="logo" required value="{{!empty(old('logo')) ? old('logo') : $service->logo}}" class="form-control" type="text" name="logo"
                                                   readonly>
                                        </div>
                                        <img id="logo" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="banner" data-preview="banner"
                                                   class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Chọn banner
                                                </a>
                                            </span>
                                            <input id="banner" required value="{{!empty(old('banner')) ? old('banner') : $service->banner}}" class="form-control" type="text" name="banner"
                                                   readonly>
                                        </div>
                                        <img id="banner" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả ngắn</label>
                                <textarea name="description" class="form-control">{{!empty(old('description')) ? old('description') : $service->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="tinymce" name="content">{{!empty(old('content')) ? old('content') : $service->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="1"
                                                       checked>
                                                @lang('admins::layer.status.active')
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="0">
                                                @lang('admins::layer.status.no_active')
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
                                <a href="{{ route('admin.service.index') }}">
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
        $("input[name='title']").keyup(function(){
            var title = $(this).val();
            $("input[name='slug']").val(get_alias(title));

            var url = $("#urlfull").data("url");
            $("#urlfull a").attr("href", url + get_alias(title) + ".html");
            $("#urlfull a").html(url + get_alias(title) + ".html");
        });
        $('#pick-province').change(function(){
            const province_id = $(this).val();
            $.ajax({
                url: "{{route('admin.service.get_district')}}",
                method: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    province_id: province_id
                },
                success: function(e) {
                    if (e.success) {
                        var string = "";
                        var i = 0;
                        for (i = 0; i < e.data.length; i++) {
                            string+= '<option value="' + e.data[i].id + '">' + e.data[i].name + '</option>';
                        }
                        $('#district').html(string);
                    }
                }
            })
        })
    </script>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Post\CreateRequest','#form-create'); !!}
@endsection
