<div class="col-lg-3">
    <div class="card sidebar-category">
        <div class="card-header">
            <span>Top Sản Phẩm</span>
        </div>
        <ul class="list-group list-group-flush list-promotion">
            @foreach($data_common['top_products'] as $row)
                <a href="" class="item-promotion">
                    <div class="image-promotion">
                        <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                        title="{{ $row->title }}" alt="">
                    </div>
                    <div class="content-promotion">
                        <h4 class="title">{{ $row->title }}</h4>
                        <div class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</div>
                        <div class="time-update">Cập nhật {{ \Carbon\Carbon::parse($row->created_at)->diffForHumans()}} </div>
                    </div>
                </a>
            @endforeach
        </ul>
    </div>
    <div class="d-none d-sm-block image-ads mb-4">
        <img src="{{asset('assets/images/products/promotion.png')}}" alt="" style="width:100%">
    </div>
    <div class="d-none d-sm-block image-ads">
        <img src="{{asset('assets/images/products/promotion.png')}}" alt="" style="width:100%">
    </div>
</div>