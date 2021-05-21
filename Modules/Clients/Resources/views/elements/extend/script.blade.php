<script type="text/javascript" src="{{ asset('/static/client/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/bootstrap/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/menu/ddsmoothmenu.js') }}"></script>
@yield('scripts')
@yield('javascript')
<script type="text/javascript">
    ddsmoothmenu.init({
        mainmenuid: "smoothmenu1", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'ddsmoothmenu', //class added to menu's outer DIV
        //customtheme: ["#1c5a80", "#18374a"],
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    })
</script>