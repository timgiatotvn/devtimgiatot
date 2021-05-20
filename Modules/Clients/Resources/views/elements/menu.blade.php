<div class="wrap-menu">
    <div class="main-width">
        <div id="smoothmenu1" class="ddsmoothmenu">
            {!! $data_common['category_list']['menu'] !!}
            <br style="clear: left"/>
        </div>
        <a class="animateddrawer" id="ddsmoothmenu-mobiletoggle" href="#">
            <span></span>
        </a>
    </div>
</div>
@section('scripts')
    <script type="text/javascript">

        ddsmoothmenu.init({
            mainmenuid: "smoothmenu1", //menu DIV id
            orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
            classname: 'ddsmoothmenu', //class added to menu's outer DIV
            //customtheme: ["#1c5a80", "#18374a"],
            contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
        })

    </script>
@endsection