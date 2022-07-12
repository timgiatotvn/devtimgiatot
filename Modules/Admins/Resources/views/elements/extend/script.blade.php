<!-- base js -->
<script type="text/javascript" src="{{ asset('/static/admin/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<!-- end base js -->
<!-- plugin js -->
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/chartjs/chart.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/moment/moment.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/chartist/chartist.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/progressbarjs/progressbar.min.js') }}"></script>--}}

<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/icheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/typeaheadjs/typeahead.bundle.min.js') }}"></script>
<!-- end plugin js -->
<!-- common js -->
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/off-canvas.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/hoverable-collapse.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/misc.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/settings.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/todolist.js') }}"></script>
<!-- end common js -->
{{--<script type="text/javascript" src="{{ asset('/static/admin/assets/js/dashboard.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/file-upload.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/iCheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/admin/assets/js/typeahead.js') }}"></script>
<script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>

<link href="{{ asset('/tinymce/tinymce.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    var str_folder = "<?php echo ACTIVE_FILE;?>";
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

    $(document).ready(function(){
        $('.check-all').click(
            function(){
                $(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));
            }
        );

    });

</script>
@yield('scripts')
@yield('validate')
