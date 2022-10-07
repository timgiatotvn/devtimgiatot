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
                    <div class="overview">{!!$newsItem->description!!}</div>
                </div>
            </a>
        @endforeach
    </ul>
</div>
<div class="image-ads mb-4">
    <img src="./assets/images/products/promotion.png" alt="" style="width:100%">
</div>
<div class="image-ads">
    <img src="./assets/images/products/promotion.png" alt="" style="width:100%">
</div>