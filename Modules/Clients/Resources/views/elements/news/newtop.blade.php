<?php
$helpers = new App\Helpers\Helpers();
$postSlide = $helpers::getPostHome(10,'choose_2','DESC');
?>
<div class="news_highlights">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="slider_home">
                    <?php foreach ($postSlide as $k => $v) { ?>
                    <div class="item_news">
                        <a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><div class="img" style="background-image: url(<?php echo $v['thumbnail'] ?>);"></div></a>
                        <div class="name">
                            <h3><a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><?php echo $v['title'] ?></a></h3>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>