<?php
$helpers = new App\Helpers\Helpers();
$listMenu = $helpers::getMenuTop(0);
$setting = $helpers::getSetting(1);
?>

<div class="main-header">
    <div id="nav-mobile" class="nav-mobile">
        <div class="icon_pr_mb"><a href="#menu" title="menu category"><i><span></span><span></span><span></span></i></a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-top">
                    <div class="logo">
                        <a href="/"><img class="img-fluid"
                                         src="<?php echo $setting->logo_top ?>"></a>
                    </div>
                    <div class="main-menu">
                        <div id="cssmenu">
                            <ul>

                                <li class='has-sub'><a title="" href='/'>Trang chủ</a></li>
                                <?php foreach ($listMenu as $k => $v) {
                                    $listSub = $helpers::getSubMenuTop(10,$v['id']);
                                    ?>
                                <li class='has-sub'><a title="<?php echo $v['title'] ?>" href='<?php echo $v['slug'] ?>'><?php echo $v['title'] ?></a>
                                    <ul>
                                        <?php foreach ($listSub as $k2 => $v2){ ?>
                                        <li class='has-sub'><a title="<?php echo $v2['title'] ?>" href='<?php echo $v2['slug'] ?>'><?php echo $v2['title'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>