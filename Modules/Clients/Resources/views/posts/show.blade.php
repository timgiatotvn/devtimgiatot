@extends('clients::layouts.new')

@section('content')
    <section id="box-new-detail">
        <div class="nrd-head">
            <h1>{{ $data['detail']->title }}</h1>
        </div>

        <div class="wrap-info-new-detail">
            <div class="content-view">
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
										$list .= '<li class="ft-item '.$collapse.'">'.$button;
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
				<div id="ft-container-outer" class="ft-in-post">
					<div id="ft-container" class="ft-wrap ft-hidden-state ft-minimize ft-middle-right">
						<button type="button" id="ft-trigger" class="ft-shape-round ft-border-thin">
							<i class="ft-trigger-icon fa fa-list-ol"></i>
						</button>
						<nav id="ft-contents" class="ft-border-thin">
							<header id="ft-header">
								<i id="ft-header-control" class="fa fa-list-ol"></i>
								<i type="button" id="ft-header-minimize"></i>
								<h3>Nội dung bài viết</h3>
							</header>
							<ol id="ft-list" class="ft-list-nest ft-strong-first ft-colexp ft-colexp-icon"><?php echo $tocContainer; ?></ol>
						</nav>
					</div>
				</div>
				<?php
					}
				?>
				<div id="ft-postcontent" class="contentck">
					<?php echo split_content($data['detail']->content); ?>
				</div>

                {!! !empty($data_common['setting']->ads2) ? $data_common['setting']->ads2 : '' !!}
            </div>

            <div class="fb-share-button"
                 data-href="{{ route('client.post.show', ['slug' => $data['detail']->slug]) }}"
                 data-layout="button"
                 data-size="small">
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                   class="fb-xfbml-parse-ignore">Chia sẻ</a>
            </div>
        </div>

        @if(count($data['related']) > 0)
        <div class="wrap-new-related">
            <label>Tin Liên Quan</label>
            <div class="wnrr-list">
                <ul>
                    @foreach($data['related'] as $row)
                        <li>
                            <div class="wnrr-item">
                                <div class="name-title">
                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                       title="{{ $row->title }}">
                                        {{ $row->title }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </section>
@endsection
