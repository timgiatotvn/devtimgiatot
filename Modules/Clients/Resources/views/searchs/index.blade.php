@extends('clients::layouts.index')

@section('content')
<main class="main">
    <div class="container">
        <div class="nd-breadcrumb">
            <div class="breadcrumb-custom">
                <a href="/">Trang chủ</a>
                <span><img src="./assets/images/icons/arrow.svg" alt=""></span>
                <span>Tìm kiếm kết quả</span>
            </div>
        </div>
        @include('clients::elements.list_ecommerce')
        <section class="box-product">
            <p>
                <b>Kết quả tìm kiếm:</b> <span>{{number_format($data['list']->total())}} sản phẩm cho “{{$data['keyword']}}”</span>
            </p>
            <div class="product-list">
                @foreach ($data['list'] as $row)
                    @if($row->type == "crawler")
                        <a href="{{ route('client.product.showSosanh', ['slug' => $row->slug.'-'.$row->id]) }}" title="{{ $row->title }}" class="item-product card-product">
                            <div class="box-image">
                                <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                title="{{ $row->title }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                <h5 title="{{ $row->title }}" class="card-title product-title">{{ $row->title }}</h5>
                                <p class="card-text note">Có {{ $row->count_suggest }} nơi bán</p>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('client.product.show', ['slug' => $row->slug.'-'.$row->id]) }}" title="{{ $row->title }}" class="item-product card-product">
                            <div class="box-image">
                                <img src="{{ \App\Helpers\Helpers::renderThumb((!empty($row->thumbnail_cr) ? $row->thumbnail_cr : $row->thumbnail), 'list_product') }}"
                                title="{{ $row->title }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <p class="price">{{ \App\Helpers\Helpers::formatPrice($row->price) }}</p>
                                <h5 title="{{ $row->title }}" class="card-title product-title">{{ $row->title }}</h5>
                                {{-- <p class="card-text note">Có {{ $row->count_suggest }} nơi bán</p> --}}
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
            <br>
            {{ $data['list']->links('clients::elements.extend.pagination') }}
        </section>
        
    </div>
</main>
@endsection