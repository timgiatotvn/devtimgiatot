@extends('clients::layouts.cart')

@section('content')
    <section id="user-page">
        <div class="wrap-user-page">
            <h1>
                Thêm bài viết
            </h1>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <div class="main-user-page">
                <form style="width: 100%" method="post" action="{{ route('client.user.store-post') }}" enctype="multipart/form-data" id="form-update">
                    @csrf()
                    <div class="form-group">
                        <label for="name">Mã xác thực</label>
                        <input type="text" class="form-control" name="code" placeholder="Mã xác thực">
                        @error('code')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Tiêu đề</label>
                        <input type="text" class="form-control" name="title" placeholder="Tiêu đề">
                        @error('title')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Chọn ảnh</label>
                        <input type="file" name="thumbnail" class="form-control">
                        @error('thumbnail')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                        {{-- <div class="input-group">
                            <span class="input-group-btn">
                                <a data-input="thumbnail" data-preview="holder"
                                   class="lfm btn btn-primary">
                                    <i class="fa fa-picture-o"></i> CHOOSE
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="thumbnail"
                                readonly>
                        </div> --}}
                    </div>
                    <div class="form-group">
                        <label for="name">Danh mục</label>
                        <select class="form-control" name="category_id" id="">
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea class="tinymce"
                                  name="content"></textarea>
                        @error('content')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề SEO</label>
                        <textarea class="form-control"
                                  name="title_seo"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta des</label>
                        <textarea class="form-control"
                                  name="meta_des"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta key</label>
                        <textarea class="form-control"
                                  name="meta_key"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Đăng bài</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<link href="{{ asset('/tinymce/tinymce.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
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
        external_filemanager_path: "<?php echo SCRIPT_URL;?>tinymce/plugins/filemanager/",
        filemanager_title: "Upload",
        external_plugins: {"filemanager": "<?php echo SCRIPT_URL;?>tinymce/plugins/filemanager/plugin.min.js"},
        relative_urls: false,
        remove_script_host: true,
        convert_urls: false,
        forced_root_block : 'p',
        content_css : '<?php echo SCRIPT_URL;?>tinymce/content/css/content_admin.css'
    });
</script>
<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    var route_prefix = "/laravel-filemanager";
    $('.lfm').filemanager('image', {prefix: route_prefix});
    $(function(){
        $('.form-check-input').change(function(){
            var value = $(this).val();
            if (value == 2) {
                $('.date').show();
            } else {
                $('.date').hide();
            }
        })
    })
</script>

@endsection