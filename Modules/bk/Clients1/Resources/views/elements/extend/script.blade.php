<script type="text/javascript" src="{{ asset('/static/client/js/jquery-1.12.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/bootstrap/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/menu/ddsmoothmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('/static/client/js/app.js') }}"></script>
<?php
    if(isset($data['ftoc']) && $data['ftoc']){
?>
<script type='text/javascript'>
    var fixedtocOption = {
        showAdminbar: "",
        inOutEffect: "zoom",
        isNestedList: "1",
        isColExpList: "1",
        showColExpIcon: "1",
        isAccordionList: "",
        isQuickMin: "1",
        isEscMin: "1",
        isEnterMax: "1",
        fixedMenu: "",
        scrollOffset: "10",
        fixedOffsetX: "10",
        fixedOffsetY: "0",
        fixedPosition: "middle-right",
        contentsFixedHeight: "",
        inPost: "1",
        contentsFloatInPost: "none",
        contentsWidthInPost: "250",
        contentsHeightInPost: "",
        inWidget: "",
        fixedWidget: "",
        triggerBorder: "thin",
        contentsBorder: "thin",
        triggerSize: "52",
        debug: "0",
        contentsColexpInit: "",
    };
</script>
<script type="text/javascript" src="{{ asset('/static/client/js/ftoc.js') }}"></script>
<?php
	}
?>
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