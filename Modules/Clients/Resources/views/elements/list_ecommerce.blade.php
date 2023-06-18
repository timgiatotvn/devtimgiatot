<section class="box-trading">
    <div class="box-trading-floor">
        @if(!empty($data["widget"]["ecommerce"]))
            @foreach (json_decode($data["widget"]["ecommerce"]->content, true) as $item)
                <div class="item-trading {{ strtolower($item['title']) }}">
                    <div class="box-info">
                        <div class="icon">
                            <img src="{{asset('assets/images/icons') . '/' . $item['title'] . ($item['title'] == 'Tiki' ? '.jpg' : '.svg')}}" alt="">
                        </div>
                        <div class="content">
                            <h4>{{ $item["title"] }}</h4>
                            <p>
                                {{ $item["description"] }}
                            </p>
                        </div>
                    </div>
                    <a href="https://shopee.vn/" class="item-link">{{ $item["action"] }}</a>
                    <div class="date-sale"></div>
                    <div class="number-date">{{ $item["date"] }}</div>
                </div>
            @endforeach
        
        @endif
        {{-- <div class="item-trading shopee">
            <div class="box-info">
                <div class="icon">
                    <img src="{{asset('assets/images/icons/shopee.svg')}}" alt="">
                </div>
                <div class="content">
                    <h4>Shopee</h4>
                    <p>
                        Freeship toàn quốc
                        </p>
                </div>
            </div>
            <a href="https://shopee.vn/" class="item-link">Mua sắm ngay</a>
            <div class="date-sale"></div>
            <div class="number-date">11.11</div>
        </div>
        <div class="item-trading lazada">
            <div class="box-info">
                <div class="icon">
                    <img src="{{asset('assets/images/icons/lazada.svg')}}" alt="">
                </div>
                <div class="content">
                    <h4>Lazada</h4>
                    <p>
                        Freeship toàn quốc
                        </p>
                </div>
            </div>
            <a href="https://www.lazada.vn/" class="item-link">Mua sắm ngay</a>
            <div class="date-sale"></div>
            <div class="number-date">11.11</div>
        </div>
        <div class="item-trading tiki">
            <div class="box-info">
                <div class="icon">
                    <img src="{{asset('assets/images/icons/tiki.jpg')}}" alt="">
                </div>
                <div class="content">
                    <h4>Tiki</h4>
                    <p>
                        Freeship toàn quốc
                        </p>
                </div>
            </div>
            <a href="https://tiki.vn/" class="item-link">Mua sắm ngay</a>
            <div class="date-sale"></div>
            <div class="number-date">11.11</div>
        </div>
        <div class="item-trading sendo">
            <div class="box-info">
                <div class="icon">
                    <img src="{{asset('assets/images/icons/sendo.svg')}}" alt="">
                </div>
                <div class="content">
                    <h4>Sendo</h4>
                    <p>
                        Freeship toàn quốc
                        </p>
                </div>
            </div>
            <a href="https://sendo.vn" class="item-link">Mua sắm ngay</a>
            <div class="date-sale"></div>
            <div class="number-date">11.11</div>
        </div> --}}
    </div>
</section>
