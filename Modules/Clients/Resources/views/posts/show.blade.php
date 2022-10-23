@extends('clients::layouts.index')

@section('style')
    <link rel="stylesheet" href="{{asset('static/client/css/ftoc.css')}}">
    <style>
        .content-page img {
            height: auto;
            max-width: 100%;
        }
        .content-page ul, .content-page ol {
            margin-bottom: 16px;
        }
        .content-page ul li, .content-page ol li {
            margin-bottom: 5px;
        }
        .content-page span {
            font-size: unset !important;
        }
        .contentck h3 {
            font-size: 16px !important;
        }
        .contentck p {
            margin-bottom: 16px !important;
        }
    </style>
@endsection

@section('content')
<main class="main">
    <div class="container">
        @include('clients::elements.extend.breadcrumb')
        <section class="category-banner page-detail">
            <div class="row">
                <div class="col-lg-9">
                    <div class="new-detail">
                        <h2>
                            {{ $data['detail']->title }}
                        </h2>
                        <div class="box-date">
                            <p class="item"><img src="{{asset('assets/images/icons/clock.svg')}}" alt=""><span>{{date('d/m/Y', strtotime($data['detail']->created_at))}}</span></p>
                            <p class="item"><img src="{{asset('assets/images/icons/user-edit.svg')}}" alt=""><span class="author">{{!empty($data['detail']->customer_name) ? $data['detail']->customer_name : $data['detail']->author_name}}</span></p>
                            <p class="item"><img src="{{asset('assets/images/icons/eye-r.svg')}}" alt=""><span>{{number_format($data['detail']->total_views)}}</span></p>
                        </div>
                        <hr>
                        {{-- <div class="table-of-contents">
                            <div class="content-new"><img src="./assets/images/icons/menu2.svg" alt=""><span>Nội dung bài viết</span></div>
                            
                            <ol>
                                <li class="first"><span>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</span>
                                    <ol>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                    </ol>
                                </li>
                                <li class="first"><span>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</span>
                                    <ol>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                    </ol>
                                </li>
                                <li class="first"><span>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</span>
                                    <ol>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                    </ol>
                                </li>
                              </ol>
                        </div> --}}
                        <?php
                            function getIdHeadings($content) {
                                preg_match('/(?<!_)id=([\'"])?(.*?)\\1/',$content, $matches);
                                return isset($matches[2])?$matches[2]:'';
                            }

                            function isParent($source, $id){
                                $current = $source[$id][2];
                                $next = 0;
                                if(isset($source[$id+1][2])){
                                    $next = $source[$id+1][2];
                                }
                                if($next > $current){
                                    //return true;
                                }
                                return false;
                            }
                            function split_head($content) {
                                preg_match_all('/<h2(.*?)>(.+?)<\/h2>|<h3(.*?)>(.*?)<\/h3>|<h4(.*?)>(.*?)<\/h4>|<h5(.*?)>(.*?)<\/h5>|<h6(.*?)>(.*?)<\/h6>/is', $content, $tach_h);
                                $matches = $tach_h[0];
                                $list = '';
                                $current_depth = 7;
                                $numbered_items = array();
                                $numbered_items_min = null;

                                @array_walk($matches, "removelines");
                                // find the minimum heading to establish our baseline

                                if(count($matches)>0){
                                    foreach ($matches as $i => $match) {
                                        if ($current_depth > $matches[$i][2]) {
                                            $current_depth = (int) $matches[$i][2];
                                        }
                                    }
                                    $numbered_items[$current_depth] = 0;
                                    $numbered_items_min = 7;
                                    foreach ($matches as $i => $match) {
                                        $level = $matches[$i][2];
                                        if($level==2){
                                            $count = $i + 1;
                                            $collapse = $button = '';
                                            if(isParent($matches, $i)){
                                                $collapseCSS = 'collapse';
                                                $collapseCSS = 'expand';
                                                $collapse = 'ft-has-sub ft-'.$collapseCSS;
                                                $button = '<button type="button" class="ft-icon-'.$collapseCSS.'"></button>';
                                            }
                                            if ($current_depth == (int) $matches[$i][2]) {
                                                $list .= '<li class="first ft-item '.$collapse.'">'.$button;
                                            }
                                            // start lists
                                            if ($current_depth != (int) $matches[$i][2]) {
                                                for ($current_depth; $current_depth < (int) $matches[$i][2]; $current_depth++) {
                                                    $numbered_items[$current_depth + 1] = 0;
                                                    $list .= '<ol class="ft-sub"><li class="ft-item '.$collapse.'">'.$button;
                                                }
                                            }
                                            $link = getIdHeadings($match);
                                            $list .= '<a href="#'.$link.'" class="ft-anchor"><span>'.strip_tags($match).'</span></a>';
                                            //$list .= '<span>'.strip_tags($match).'</span>';
                                            // end lists
                                            if ($i != count($matches) - 1) {
                                                if ($current_depth > (int) $matches[$i + 1][2]) {
                                                    for ($current_depth; $current_depth > (int) $matches[$i + 1][2]; $current_depth--) {
                                                        $list .= '</li></ol>';
                                                        $numbered_items[$current_depth] = 0;
                                                    }
                                                }
                                                if ($current_depth == (int) @$matches[$i + 1][2]) {
                                                    $list .= '</li>';
                                                }
                                            }
                                        }
                                    }
                                }
                                if(!empty($list)){
                                    $level = $level - 2;
                                    $list .= str_repeat("</li></ol>", $level).'</li>';
                                }
                                return $list;
                            }
                            function split_content($content){
                                preg_match_all('/<h2(.*?)>(.+?)<\/h2>|<h3(.*?)>(.*?)<\/h3>|<h4(.*?)>(.*?)<\/h4>|<h5(.*?)>(.*?)<\/h5>|<h6(.*?)>(.*?)<\/h6>/is', $content, $tach_h);
                                $matches_old = $matches = $tach_h[0];
                                if(count($matches)>0){
                                    $i=0;
                                    foreach($matches as $key=> &$match){
                                        $level = $matches[$key][2];
                                        if($level==2){
                                            $i++;
                                            $matches[$key] = str_replace('class="ft-heading">', 'class="ft-heading"><span>'.$i.'</span>', $match);
                                        }
                                    }
                                }
                                return str_replace($matches_old,$matches,$content);
                            }
                            $tocContainer = split_head($data['detail']->content);
                            if($tocContainer !=""){
                        ?>
                        <div class="table-of-contents" style="padding-block: 20px">
                            <div class="content-new">
                                <img src="{{asset('assets/images/icons/menu2.svg')}}" alt="">
                                <span>Nội dung bài viết</span>
                                <img class="open-table-content" src="{{asset('assets/images/icons/arrow-down.svg')}}" alt="">
                            </div>
                            <ol>
                                <?php echo $tocContainer; ?>
                                {{-- <li class="first"><span>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</span>
                                    <ol>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                    </ol>
                                </li>
                                <li class="first"><span>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</span>
                                    <ol>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                    </ol>
                                </li>
                                <li class="first"><span>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</span>
                                    <ol>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                        <li>Lợi ích của phần mềm đăng bài hàng loạt trên Facebook</li>
                                    </ol>
                                </li> --}}
                              </ol>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="content-page contentck ">
                            <?php echo split_content($data['detail']->content); ?>
                        </div>
                        <div class="box-social">
                            <span>Chia sẻ</span>
                            <div class="item-social"><img src="{{asset('assets/images/icons/twitter.png')}}" alt=""></div>
                            <div class="item-social"><img src="{{asset('assets/images/icons//facebook.png')}}" alt=""></div>
                            <div class="item-social"><img src="{{asset('assets/images/icons/zalo.svg')}}" alt=""></div>
                        </div>
                        {{-- <div class="list-tag">
                            <span class="badge item-tags">thẻ tags</span>
                            <span class="badge item-tags">thẻ tags</span>
                            <span class="badge item-tags">thẻ tags</span>
                            <span class="badge item-tags">thẻ tags</span>
                        </div> --}}
                        
                    </div>
					<section class="news-relate">
						<div class="row">
							<h3 style="margin-bottom: 20px">Tin liên quan</h3>
						</div>
						<div class="row">
                            <ul class="list-news-relate">
                                @foreach($data['related'] as $row)
                                    <li>
                                        <a title="{{$row->title}}" href="{{ route('client.post.show', ['slug' => $row->slug]) }}">
                                            {{$row->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
							{{-- @foreach($data['related'] as $row)
								<div class="news-relate-item col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
									<a href="{{ route('client.post.show', ['slug' => $row->slug]) }}">
										<img class="thumbnail" src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new') }}" class="card-img-top" alt="{{ $row->title }}">
									</a>
									<h4 class="title">
										<a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
											title="{{ $row->title }}">
											{{$row->title}}
										</a>
									</h4>
									<p class="description">
										{{$row->description}}
									</p>
									<p class="view d-flex justify-content-between align-items-center">
										<span>
											<img src="{{asset('assets/images/products/avatar.svg')}}" alt="">
										</span>
										<span>
											<i class="fa-regular fa-eye"></i> {{$row->total_views}}
										</span>
									</p>
								</div>
							@endforeach --}}
						</div>
					</section>
                </div>
                <div class="col-lg-3">
                    @include('clients::elements.news_coupon')
                </div>
            </div>
            <hr>
            <img src="{{asset('assets/images/products/image8.png')}}" alt="" style="width:100%;">
        </section>
    </div>
</main>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('.open-table-content').click(function(){
                $('.wrapper .main .new-detail .table-of-contents ol').toggle('slow');
            })
        })
    </script>
    <script>
        $(function() {
            $('.box-search input').attr('placeholder', 'Tìm kiếm tin tức');
        })
    </script>
@endsection