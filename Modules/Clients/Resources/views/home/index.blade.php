@extends('clients::layouts.app')

@section('content')
    <?php
    $helpers = new App\Helpers\Helpers();
    $postSlide = $helpers::getPostHome(10,'','DESC');
    $tinNoibat = $helpers::getPostHome(10,'choose_1','desc');
    $tinMoiNhat = $helpers::getPostHome(10,'','desc');

    ?>

    <div class="row">
        <!-- cột trái -->
        <div class="col-md-8 col-sm-8 col-12">
            <div class="news_special">
                <h3 class="title_special">BÀI VIẾT NỔI BẬT</h3>
                <a alt="<?php echo $tinNoibat[0]['title'] ?>" href="<?php echo $tinNoibat[0]['slug'] ?>.html">
                    <div class="news1" style="background-image: url(<?php echo $tinNoibat[0]['thumbnail'] ?>);">
                        <div class="name"><?php echo $tinNoibat[0]['title'] ?></div>
                    </div>
                </a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>


            <div class="row">
                <?php
                $i=0;
                foreach ($tinNoibat as $k => $v) {
                    $i++;
                    if($i>1){
                    ?>
                <div class="col-md-6 col-sm-6 col-12">
                    <a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html">
                        <div class="news2" style="background-image: url(<?php echo $v['thumbnail'] ?>);">
                            <div class="name"><?php echo $v['title'] ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php }} ?>

            </div>


            <h3 class="title_special">BÀI VIẾT MỚI NHẤT</h3>
            <div class="list_news_item">

                <?php foreach ($tinMoiNhat as $k => $v) { ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        <a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><img class="img-fluid" src="<?php echo $v['thumbnail'] ?>" /></a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <h3><a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><?php echo $v['title'] ?></a></h3>
                        <p class="cate"><?php echo $v['get_category']['title'] ?> - <span class="time"> {{ $helpers::formatTime($v['created_at']) }}</span></p>
                        <p class="short"><?php echo $v['description'] ?></p>
                    </div>
                </div>
                <?php } ?>

            </div>


        </div>
        <!-- cột phải -->
        @include('clients::elements.col_right')
    </div>

    <div class="row">
        <?php foreach ($cateHome as $k => $cate) {
        $newsCate = $helpers::getPostByCate(5,$cate['id'],'DESC');
            ?>
        <div class="col-md-4 col-sm-4 col-12">
            <h3 class="title_special"><?php echo $cate['title'] ?></h3>

            <div class="new_first">
                <div class="img">
                    <a alt="<?php echo $newsCate[0]['title'] ?>" href="<?php echo $newsCate[0]['slug'] ?>.html">
                        <img class="img-fluid" src="<?php echo $newsCate[0]['thumbnail'] ?>"/>
                    </a>
                </div>
                <div class="name">
                    <a alt="<?php echo $newsCate[0]['title'] ?>" href="<?php echo $newsCate[0]['slug'] ?>.html">
                        <?php echo $newsCate[0]['title'] ?>
                    </a>
                </div>
            </div>

            <div class="list_news_cate">
                <?php
                $i=0;
                foreach ($newsCate as $k => $v) {
                    $i++;
                if($i>1){
                    ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        <a title="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html">
                            <img class="img-fluid" src="<?php echo $v['thumbnail'] ?>"/>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <h3>
                            <a title="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html">
                                <?php echo $v['title'] ?>
                            </a>
                        </h3>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>

        <?php } ?>
    </div>
@endsection
