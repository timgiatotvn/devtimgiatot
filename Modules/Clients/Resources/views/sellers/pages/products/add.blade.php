@extends('clients::sellers.layouts.index')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">Thêm sản phẩm</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('seller.product.store-product')}}">
                            @csrf
                            <div class="row">
                                @if(session('success'))
                                    <div class="col-lg-12">
                                        <div class="alert alert-success">
                                            {{session('success')}}
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Tên sản phẩm</label>
                                        <input type="text" value="{{old('title')}}" name="title" class="form-control" placeholder="Tên sản phẩm...">
                                        @error('title')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Danh mục</label>
                                        <select name="category_id" class="form-control select2" data-toggle="select2">
                                            @foreach ($categories as $cateItem)
                                                <option value="{{$cateItem->id}}">
                                                    {{$cateItem->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Giá gốc</label>
                                        <input type="number" value="{{old('price_root')}}" name="price_root" class="form-control">
                                        @error('price_root')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Giá bán</label>
                                        <input type="number" value="{{old('price')}}" name="price" class="form-control">
                                        @error('price')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <label for="">Ảnh thumbnail</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder"
                                                    class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                            <input id="thumbnail" value="{{old('thumbnail')}}" class="form-control" type="text" name="thumbnail"
                                                    readonly>
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                        @error('thumbnail')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <label for="">Ảnh chi tiêt 1</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail1" data-preview="holder"
                                                    class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="images[]"
                                                    readonly>
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                        @error('images.0')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <label for="">Ảnh chi tiêt 2</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail2" data-preview="holder"
                                                    class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                            <input id="thumbnail2" class="form-control" type="text" name="images[]"
                                                    readonly>
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                        @error('images.1')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" style="margin-bottom: 0px">
                                        <label for="">Ảnh chi tiêt 3</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail3" data-preview="holder"
                                                    class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                            <input id="thumbnail3" class="form-control" type="text" name="images[]"
                                                    readonly>
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                        @error('images.2')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Mô tả</label>
                                        <textarea name="description" class="form-control tinymce" id="" cols="30" rows="10">{{old('description')}}</textarea>
                                        @error('description')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="">Nội dung</label>
                                        <textarea name="content" class="form-control tinymce" id="" cols="30" rows="10">{{old('content')}}</textarea>
                                        @error('content')
                                            <p class="text text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Xác nhận
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<style>
    .form-group {
        margin-bottom: 20px;
    }
</style>
<link href="{{ asset('tinymce/tinymce.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-mini',
        height: 200,
        link_class_list:[
            {title: 'Chọn Class', value: ''},
            {title: 'Lightbox', value: 'lightbox'},
            {title: 'Mua hàng', value: 'smbuy-button'}
        ],
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
            "table contextmenu directionality emoticons paste textcolor code"
        ],
        toolbar: "codesample | undo redo | bold italic underline sizeselect fontselect fontsizeselect | hr alignleft aligncenter alignright alignjustify | forecolor backcolor  | bullist numlist outdent indent | styleselect | responsivefilemanager | link unlink anchor | image media youtube",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        noneditable_noneditable_class: 'fa',
        extended_valid_elements: 'span[*],div[*],main[*],script[*],ul[*],a[*],i[*]',
        custom_elements:"~link",
        image_advtab: true,
        external_filemanager_path: "<?php echo SCRIPT_URL;?>tinymce/plugins/filemanager/",
        filemanager_title: "Upload",
        external_plugins: {"filemanager": "<?php echo SCRIPT_URL;?>tinymce/plugins/filemanager/plugin.min.js"},
        relative_urls: false,
        remove_script_host: true,
        convert_urls: false,
        forced_root_block : 'p',
        content_css : '<?php echo SCRIPT_URL;?>tinymce/content/css/content_admin.css',
        image_caption: true
    });
    tinymce.init({
        selector: 'textarea.tinymce',
        image_caption: true,
        height: 500,
        link_class_list:[
            {title: 'Chọn Class', value: ''},
            {title: 'Lightbox', value: 'lightbox'},
            {title: 'Mua hàng', value: 'smbuy-button'}
        ],
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager youtube code toc",
            "codesample noneditable"
        ],
        toolbar: "codesample toc | undo redo | bold italic underline sizeselect fontselect fontsizeselect | hr alignleft aligncenter alignright alignjustify | forecolor backcolor  | bullist numlist outdent indent | styleselect | responsivefilemanager | link unlink anchor | image media youtube | print preview code",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        noneditable_noneditable_class: 'fa',
        extended_valid_elements: 'span[*],div[*],main[*],script[*],ul[*],a[*],i[*]',
        custom_elements:"~link",
        image_advtab: true,
        // external_filemanager_path: "<?php echo SCRIPT_URL;?>tinymce/plugins/filemanager/",
        // filemanager_title: "Upload",
        // external_plugins: {"filemanager": "<?php echo SCRIPT_URL;?>tinymce/plugins/filemanager/plugin.min.js"},
        relative_urls: false,
        // remove_script_host: true,
        convert_urls: false,
        forced_root_block : 'p',
        content_css : '<?php echo SCRIPT_URL;?>tinymce/content/css/content_admin.css',
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
            var cmsURL = '/laravel-filemanager?field_name=' + field_name;

            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    });
</script>
<script type="text/javascript" src={{ asset('/ckeditor/ckeditor.js') }}></script>
<script>
    var CSRFToken = $('meta[name="csrf-token"]').attr('content');
    var options = {
        'height' : '500px',
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        //filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token='+CSRFToken,
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        //filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='+CSRFToken,
    };

    $('.ckeditor-mini').each(function(){
        CKEDITOR.replace($(this).attr('name'), {'height' : '200px', 'toolbar': [
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
                // { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source'] },
            ] });
        CKEDITOR.addCss("h1{font-size: 20px;}h2{font-size: 17px;}h3{font-size: 16px;}h4, h5, h6{font-size: 15px;}");
    });
    $('.ckeditor').each(function(){
        CKEDITOR.replace($(this).attr('name'), options);
        CKEDITOR.addCss("h1{font-size: 20px;}h2{font-size: 17px;}h3{font-size: 16px;}h4, h5, h6{font-size: 15px;}");
    });

    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    var route_prefix = "/laravel-filemanager";
    $('.lfm').filemanager('image', {prefix: route_prefix});

</script>
@endsection