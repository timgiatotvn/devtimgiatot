<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="column-footer">
                    @php
                        $footer = !is_null($data_share['widget_footer']) ? json_decode($data_share['widget_footer']->content, true) : [];
                    @endphp
                    <h2>
                        @if(!empty($footer['first_block']['title']))
                            {!! $footer['first_block']['title'] !!}
                        @endif
                    </h2>
                    <p class="item-info"><img src="{{asset('assets/images/icons/location_footer.svg')}}" alt="">
                        <span>
                            {!! !empty($footer['first_block']['address']) ? $footer['first_block']['address'] : "" !!}
                        </span>
                    </p>
                    <p class="item-info"><img src="{{asset('assets/images/icons/fax.svg')}}" alt="">
                        <span>
                            {!! !empty($footer['first_block']['tax_code']) ? $footer['first_block']['tax_code'] : "" !!}
                        </span>
                    </p>
                    <p class="item-info"><img src="{{asset('assets/images/icons/telephone.svg')}}" alt="">
                        <span>
                            {!! !empty($footer['first_block']['phone']) ? $footer['first_block']['phone'] : "" !!}
                        </span>
                    </p>
                    <p class="item-info"><img src="{{asset('assets/images/icons/mdi_web.svg')}}" alt="">
                        <span>
                            {!! !empty($footer['first_block']['website']) ? $footer['first_block']['website'] : "" !!}
                        </span>
                    </p>
                    <div class="note">
                        {!! !empty($footer['first_block']['description']) ? $footer['first_block']['description'] : "" !!}
                    </div>
                    <div><img src="" alt=""></div>
                </div>
            </div>
            <div class="col-lg-3 footer-item-center">
                <div class="column-footer column-footer-mobile">
                    <div class="footer-header">
                        <h2>{!! !empty($footer['center_block']['title']) ? $footer['center_block']['title'] : "" !!}</h2>
                        <div class="btn-sub-footer"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                    </div>
                    @if (!empty($footer['center_block']['link_item']))
                        <ul class="nav-footer nav-footer-mobile">
                            @foreach ($footer['center_block']['link_item'] as $linkItem)
                                <li>
                                    <a href="{{ explode("||", $linkItem)[1] }}">
                                        {{ explode("||", $linkItem)[0] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="column-footer column-footer-desktop">
                    <h2>{!! !empty($footer['center_block']['title']) ? $footer['center_block']['title'] : "" !!}</h2>
                    @if (!empty($footer['center_block']['link_item']))
                        <ul>
                            @foreach ($footer['center_block']['link_item'] as $linkItem)
                                <li>
                                    <a href="{{ explode("||", $linkItem)[1] }}">
                                        {{ explode("||", $linkItem)[0] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="column-footer column-footer-mobile">
                    <div class="footer-header">
                        <h2>{!! !empty($footer['center_block']['title_2']) ? $footer['center_block']['title_2'] : "" !!}</h2>
                        <div class="btn-sub-footer"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                    </div>
                    @if(!empty($footer['center_block']['social']))
                    <ul class="connect-social nav-footer-mobile">
                        @foreach ($footer['center_block']['social'] as $item)
                            <li><a href="#"><img src="{{asset('assets/images/icons/$item')}}" alt=""></a></li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="column-footer column-footer-desktop">
                    <h2>{!! !empty($footer['center_block']['title_2']) ? $footer['center_block']['title_2'] : "" !!}</h2>
                    @if(!empty($footer['center_block']['social']))
                    <ul class="connect-social">
                        @foreach ($footer['center_block']['social'] as $item)
                            <li><a href="#"><img src="{{asset('assets/images/icons')}}/{{$item}}" alt=""></a></li>
                        @endforeach
                    </ul>
                    @endif
                    {{-- <ul class="connect-social">
                        <li><a href="#"><img src="{{asset('assets/images/icons/twitter.png')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('assets/images/icons/facebook.png')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('assets/images/icons/youtube.png')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('assets/images/icons/zalo.svg')}}" alt=""></a></li>
                    </ul> --}}
                </div>
            </div>
            <div class="col-lg-4 footer-item-last">
                <div class="column-footer column-footer-mobile">
                    <div class="footer-header">
                        <h2>{!! !empty($footer['last_block']['title']) ? $footer['last_block']['title'] : "" !!}</h2>
                        <div class="btn-sub-footer"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                    </div>
                    <ul class="nav-footer-mobile">
                        @foreach($footer['last_block']['link_item'] as $linkItem)
                            <li>
                                <a href="{{ explode("||", $linkItem)[1] }}">
                                    {{ explode("||", $linkItem)[0] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="column-footer column-footer-desktop">
                    <h2>{!! !empty($footer['last_block']['title']) ? $footer['last_block']['title'] : "" !!}</h2>
                    <ul>
                        @foreach($footer['last_block']['link_item'] as $linkItem)
                            <li>
                                <a href="{{ explode("||", $linkItem)[1] }}">
                                    {{ explode("||", $linkItem)[0] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="column-footer">
                    <h2>Tải ứng dụng</h2>
                    <ul class="download-app">
                        <li class="icon-app"><a href="https://apps.apple.com/us/app/timgiatot/id1631308200" target="_blank" rel="nofollow"><img src="{{asset('assets/images/icons/Taiappstore.svg')}}" alt=""></a></li>
                        <li class="icon-app"><a href="https://play.google.com/store/apps/details?id=com.timgiatot.timgiatot" target="_blank" rel="nofollow"><img src="{{asset('assets/images/icons/Taiappchplay.svg')}}" alt=""></a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom">
    © Copyright 2019 - 2022. Website đang trong quá trình chạy thử nghiệm và trong quá trình đăng ký sàn thương mại điện tử từ Bộ Công Thương
</div>