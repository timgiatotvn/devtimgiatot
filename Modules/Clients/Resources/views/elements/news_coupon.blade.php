<div class="card sidebar-category">
    <div class="card-header">
        <span>Tin khuyến mãi</span>
    </div>
    <ul class="list-group list-group-flush list-promotion">
        @foreach ($data['news_coupon'] as $newsItem)
            <a href="#" class="item-promotion">
                <div class="image-promotion">
                    <img src="{{ \App\Helpers\Helpers::renderThumb($newsItem->thumbnail, 'list_new') }}"
                    title="{{ $newsItem->title }}" class="card-img-top" alt="">
                </div>
                <div class="content-promotion">
                    <h4 class="title" title="{{ $newsItem->title }}">{{ $newsItem->title }}</h4>
                    <div class="overview">
                        {{-- {!!$newsItem->description!!} --}}
                        {{ strip_tags(html_entity_decode($newsItem->content)) }}
                    </div>
                </div>
            </a>
        @endforeach
    </ul>
</div>
<div class="d-none d-sm-none d-md-none d-lg-block image-ads mb-4">
    <img src="{{asset('assets/images/products/promotion.png')}}" alt="" style="width:100%">
</div>
<div class="d-none d-sm-none d-md-none d-lg-block image-ads">
    <img src="{{asset('assets/images/products/promotion.png')}}" alt="" style="width:100%">
</div>