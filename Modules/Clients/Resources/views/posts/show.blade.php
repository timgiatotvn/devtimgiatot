@extends('clients::layouts.detail')

@section('content')
    <?php
    $helpers = new App\Helpers\Helpers();

    ?>
        <div class="row">
            <!-- cột trái -->
            <div class="col-md-8 col-sm-8 col-12">
                <div class="detail_post">
                    <h1 class="title_post"><?php echo $detail->title; ?></h1>
                    <div class="clear"></div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p class="date_post"><i class="fa fa-calendar-alt"></i> <?php echo $detail->created_at; ?></p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="share_fb">
                                <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo url()->current(); ?>&width=120&layout=button&action=like&size=small&share=true&height=65&appId=1951538371539278" width="120" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="short_post">
                        <?php echo strip_tags($detail->description); ?>
                    </div>
                    <div class="content_post">
                        <?php echo $detail->content; ?>
                    </div>
                    <div class="post_tag">
                        <div class="block_tag">
                            <div class="txt_tag">
                                Tags:
                            </div>
                            <div class="list_tag">
                                <a href="#">Bảo chung </a>
                                <a href="#">Giải trí </a>
                                <a href="#">Công nghệ </a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>

                    <h3 class="title_special">Bài viết liên quan</h3>
                    <div class="list_news_item">
                        <?php foreach ($listRelated as $k => $v) { ?>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                <a href="#"><img class="img-fluid" src="<?php echo $v['thumbnail'] ?>" /></a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6">
                                <h3><a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><?php echo $v['title'] ?></a></h3>
                                <p class="cate"><?php echo $v['getCategory']['title'] ?> - <span class="time"> {{ $helpers::formatTime($v['created_at']) }}</span></p>
                                <p class="short"><?php echo $v['description'] ?></p>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <!-- cột phải -->
            @include('clients::elements.col_right')

        </div>
@endsection
