<nav id="site-bar-product">
    <div class="wrap-site-bar-product">
        <label>Top sản phẩm</label>
        <ul>
            @foreach($data_common['top_products'] as $row)
                <li>
                    @if($row->type == "crawler")
                        <div class="sbp-item">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                    <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}"
                                       title="{{ $row->title }}" rel="nofollow sponsored">
                                        <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                             title="{{ $row->title }}">
                                    </a>

                                </div>
                                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                                    <div class="mt-1 pl-3">
                                        <div class="name-sp">
                                            <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}"
                                               title="{{ $row->title }}" rel="nofollow sponsored">
                                                {{ $row->title }}
                                            </a>
                                        </div>
                                        <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}đ</p>
                                        <div class="count-location-buy">
                                            Có {{ $row->count_suggest }} nơi bán
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="sbp-item">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                    <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                       title="{{ $row->title }}" rel="nofollow sponsored">
                                        <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                             title="{{ $row->title }}">
                                    </a>

                                </div>
                                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                                    <div class="mt-1 pl-3">
                                        <div class="name-sp">
                                            <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                               title="{{ $row->title }}" rel="nofollow sponsored">
                                                {{ $row->title }}
                                            </a>
                                        </div>
                                        <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}đ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    {!! !empty($data_common['setting']->ads3) ? $data_common['setting']->ads3 : '' !!}

</nav>