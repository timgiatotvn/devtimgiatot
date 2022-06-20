@extends('clients::layouts.product')

@section('content')
    <section id="wrap-product-category">
        <div class="pc-head">
            <h1>{{ !empty($data['search_title']) ? $data['search_title'] : $data['category']->title }}</h1>
        </div>
        @if(!empty($data['category']->description))
        <div class="ctct mb-4">
            {!! $data['category']->description !!}
        </div>
        @endif
        <div class="pc-content">
            <ul>
                @foreach($data['list'] as $row)
                    <li>
                        <div class="pr-item">
                            @if($row->type == "crawler")
                                <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}"
                                   title="{{ $row->title }}" rel="nofollow sponsored">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                         title="{{ $row->title }}">
                                </a>
                                <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                <div class="name-sp">
                                    <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}"
                                       title="{{ $row->title }}" rel="nofollow sponsored">
                                        {{ $row->title }}
                                    </a>
                                </div>
                                <div class="count-location-buy">
                                    Có {{ $row->count_suggest }} nơi bán
                                </div>
                            @else
                                <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                   title="{{ $row->title }}" rel="nofollow sponsored">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                         title="{{ $row->title }}">
                                </a>
                                <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                <div class="name-sp">
                                    <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                       title="{{ $row->title }}" rel="nofollow sponsored">
                                        {{ $row->title }}
                                    </a>
                                </div>
                                <div class="count-location-buy"></div>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ $data['list']->links('admins::elements.extend.pagination') }}
    </section>
@endsection
