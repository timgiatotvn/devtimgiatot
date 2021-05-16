<?php
$helpers = new App\Helpers\Helpers();
$listMenu = $helpers::getMenuTop(0);
$setting = $helpers::getSetting(1);
$cateFooter = $helpers::getCate(8, 'choose_3', 'desc');
?>


<div class="footer_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="#">Điều khoản sử dụng</a>
                <a href="#">Quyền lợi</a>
                <a href="#">Tuyển dụng</a>
                <a href="#">Liên hệ quảng cáo</a>
            </div>
        </div>
    </div>
</div>

<div class="footer_top">
    <div class="container">

        <div id="news_category" class="row">

            <?php
            foreach ($cateFooter as $k => $cate) {
            $newsCate = $helpers::getPostByCate(5, $cate['id'], 'DESC');
            ?>
            <div class="col-md-3 col-sm-3 col-6">
                <h4 class="title_cate_footer"><?php echo $cate['title'] ?></h4>
                <ul>
                    <?php
                    foreach ($newsCate as $k => $v) {
                    ?>
                    <li><a title="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><?php echo Str::limit($v['title'],30) ?></a></li>
                    <?php } ?>

                </ul>
            </div>
            <?php } ?>

        </div>
    </div>
</div>

<div class="footer_bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="name text-uppercase font-weight-bold fs18"><?php echo $setting['name'] ?></h2>
            </div>
        </div>
        <div class="row info">
            <div class="col-md-4">
                <?php echo $setting['content_footer'] ?>
            </div>
            <div class="col-md-4">
                <p>
                    <span class="text-uppercase font-weight-bold"><i class="fas fa-mobile-alt"></i>Điện thoại</span>
                    <br><?php echo $setting['hotline'] ?>
                </p>
                <p style="height:30px"></p>
                <p>
                    <span class="text-uppercase font-weight-bold"><i class="fas fa-envelope"></i>email</span>
                    <br><?php echo $setting['email'] ?>
                </p>
            </div>
        </div>
    </div>
</div>

<nav id="menu">
    <ul>
        <li class='has-sub'><a title="" href='/'>Trang chủ</a></li>
        <?php foreach ($listMenu as $k => $v) { ?>
        <li class='has-sub'><a title="<?php echo $v['title'] ?>"
                               href='<?php echo $v['slug'] ?>'><?php echo $v['title'] ?></a></li>
        <?php } ?>
    </ul>
</nav>