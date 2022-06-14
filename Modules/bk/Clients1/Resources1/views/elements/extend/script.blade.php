<script type="text/javascript" src="{{ asset('/static/client/js/jquery-1.12.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/bootstrap/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/menu/ddsmoothmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/app.js') }}"></script>
@yield('scripts')
@yield('javascript')
@yield('validate')
<script type="text/javascript">
    ddsmoothmenu.init({
        mainmenuid: "smoothmenu1", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'ddsmoothmenu', //class added to menu's outer DIV
        //customtheme: ["#1c5a80", "#18374a"],
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    })

    $(document).scroll(function(){
        var curPos = $(document).scrollTop();
        if(curPos >= 160) {
            $('#fixedmenu').show(10);
            $('body').addClass('scroll-mobile');
        } else {
            $('#fixedmenu').hide(10);
            $('body').removeClass('scroll-mobile');
        }
    });
    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
</script>