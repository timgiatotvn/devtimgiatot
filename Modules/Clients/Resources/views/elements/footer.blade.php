<footer id="footer">
    <div class="ft-one">
        <div class="main-width">
            <div class="row no-gutters">
                <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                    <div class="ft-content">
                        <label>VỀ CHÚNG TÔI</label>
                        <ul class="mnft">
                            @foreach($data_common['category_list']['footer'] as $row)
                                <li><a href="{{ asset($row->slug) }}" title="{{ $row->title }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $row->title }}</a></li>
                            @endforeach
                            <li><a href="{{ asset('lien-he') }}" title="Liên hệ"><i class="fa fa-angle-right" aria-hidden="true"></i>Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
{{--                <div class="col-12 col-md-2 col-lg-2 col-xl-2">--}}
{{--                    <div class="ft-content">--}}
{{--                        <label>DỊCH VỤ</label>--}}
{{--                        <ul class="mnft">--}}
{{--                            @foreach($data_common['category_list']['service'] as $row)--}}
{{--                                <li><a href="{{ asset($row->slug) }}" title="{{ $row->title }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $row->title }}</a></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="ft-content">
                        <label>HỖ TRỢ KHÁCH HÀNG</label>
                        <ul class="mnft">
                            @foreach($data_common['category_list']['support'] as $row)
                                <li><a href="{{ asset($row->slug) }}" title="{{ $row->title }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $row->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="ft-content">
                        <label>THÔNG TIN LIÊN HỆ</label>
                        <div class="ftct">
                            {!! !empty($data_common['setting']->content_footer) ? $data_common['setting']->content_footer : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ft-two">
        <div class="main-width">
            {!! !empty($data_common['setting']->copyright) ? $data_common['setting']->copyright : 'Timgiatot.vn tổng hợp và sắp xếp các thông tin tự động bởi chương trình máy tính!' !!}
        </div>
    </div>
</footer>
<nav class="searchft">
    <style type="text/css">
        .fix-icon-right{
            position: fixed;
            right: 0;
            left: 0;
            top: 0px;
            display: none;
            z-index: 999;
            background: #386384;
            border-bottom: 1px solid #ddd;
        }
        .fix-icon-right img{
            margin-bottom: 5px;
        }
    </style>

    <div class="fix-icon-right" id="fixedmenu">
        <div class="row-fluid">
            <form method="get" action="{{ route('client.category.search') }}" class="wrap-form-search">
                <input type="text" name="keyword" value="{{ !empty($_GET['keyword']) ? $_GET['keyword'] : '' }}" class="form-control" placeholder="Keyword"/>
                <button type="submit" class="btn btn-primary mb-2">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
{!! !empty($data_common['setting']->code_footer) ? $data_common['setting']->code_footer : '' !!}