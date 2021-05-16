@extends('clients::layouts.app')

@section('content')
    <?php
    $helpers = new App\Helpers\Helpers();

    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb-zone">
                <h1>
                    <a href="#">
                        <strong><?php echo $cate->title ?></strong>
                        <?php if (count($cate_sub) > 0) { ?>
                        <span><i class="fas fa-caret-right"></i></span>
                        <?php } ?>
                    </a>
                </h1>
                <ul class="cate_sub">
                    <?php foreach ($cate_sub as $k => $v){ ?>
                    <li><a title="<?php echo $v['title'] ?>"
                           href='<?php echo $v['slug'] ?>'><?php echo $v['title'] ?></a></li>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- cột trái -->
        <div class="col-md-8 col-sm-8 col-12">
            <div class="news_special" style="display: none">
                <h3 class="title_special">Danh sách bài viết</h3>
                <a href="#">
                    <div class="news1" style="background-image: url({{ asset('/static/client/images/5.jpg')}});">
                        <div class="name">Lý Nhã Kỳ tiết lộ mối quan hệ thân thiết với "Ảnh hậu TVB" Xa Thi Mạn</div>
                    </div>
                </a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>


            <div class="list_news_item">
                <?php foreach ($listNews as $k => $v) { ?>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6">
                            <a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><img class="img-fluid" src="<?php echo $v['thumbnail'] ?>" /></a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <h3><a alt="<?php echo $v['title'] ?>" href="<?php echo $v['slug'] ?>.html"><?php echo $v['title'] ?></a></h3>
                            <p class="cate"><?php echo $v['getCategory']['title'] ?> - <span class="time"> {{ $helpers::formatTime($v['created_at']) }}</span></p>
                            <p class="short"><?php echo $v['description'] ?></p>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                {{ $listNews->appends(request()->input())->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
        <!-- cột phải -->
        @include('clients::elements.col_right')
    </div>
@endsection
