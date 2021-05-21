@extends('clients::layouts.product')

@section('content')
    <section id="wrap-product-category">
        <div class="pc-head">
            <label>{{ !empty($data['search_title']) ? $data['search_title'] : $data['category']->title }}</label>
        </div>
        <div class="pc-content">
            <ul>
                @foreach($data['list'] as $row)
                    <li>
                        <div class="pr-item">
                            <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                               title="{{ $row->title }}">
                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_product') }}"
                                     title="{{ $row->title }}">
                            </a>
                            <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                            <h3>
                                <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}"
                                   title="{{ $row->title }}">
                                    {{ $row->title }}
                                </a>
                            </h3>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        {{ $data['list']->links('admins::elements.extend.pagination') }}
    </section>
@endsection
