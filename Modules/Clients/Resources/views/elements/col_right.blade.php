<?php
$helpers = new App\Helpers\Helpers();
$setting = $helpers::getSetting(1);
$cateFooter = $helpers::getCate(8, 'choose_2', 'desc');
?>
<div class="col-md-4 col-sm-4 col-12">
    <?php
    foreach ($cateFooter as $k => $cate) {
        $newsCate = $helpers::getPostByCate(5, $cate['id'], 'DESC');
        ?>
    <h3 class="title_special"><?php echo $cate['title'] ?></h3>
    <div class="list_news_cate">
        <?php
        foreach ($newsCate as $k => $v) {
        ?>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6">
                <a title="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><img class="img-fluid" src="<?php echo $v['thumbnail'] ?>" /></a>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <h3><a title="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><?php echo $v['title'] ?></a></h3>
            </div>
        </div>
        <?php } ?>
    </div>
        <?php } ?>


    <h3 class="title_special">Theo dõi chúng tôi</h3>
    <div class="fanpage_col_right">
        <iframe src="https://www.facebook.com/plugins/page.php?href=<?php echo $setting['facebook'] ?>&tabs=timeline&width=340&height=400&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1951538371539278" width="340" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
    </div>


</div>