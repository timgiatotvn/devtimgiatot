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