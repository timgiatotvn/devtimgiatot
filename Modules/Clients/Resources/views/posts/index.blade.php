@extends('clients::layouts.index')

@section('content')
<main class="main">
    <div class="container">
        @include('clients::elements.extend.breadcrumb')
        <section class="category-banner">
            <div class="row">
                <div class="col-lg-3">
                    @if(count($data['category_products']) > 0)
                        <div class="card sidebar-category">
                            <div class="card-header">
                                <img src="./assets/images/icons/menu.svg" alt=""><span>Danh mục {{$data['category']->title}}</span>
                            </div>
                            <ul class="list-group list-group-flush list-category">
                                @foreach ($data['category_products'] as $cate_item)
                                    @if ($cate_item->category->count())
                                        <li class="list-group-item">
                                            <div class="item-category">
                                                <a href="{{route('client.category.index', ['slug' => $cate_item->slug])}}">{{$cate_item->title}}</a>
                                                <div class="sub-btn"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                                            </div>
                                            <ul class="sub-menu">
                                                @foreach ($cate_item->category as $item)
                                                    <li>
                                                        <a href="{{route('client.category.index', ['slug' => $item->slug])}}" class="sub-item">{{$item->title}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="list-group-item"><a href="{{route('client.category.index', ['slug' => $cate_item->slug])}}">{{$cate_item->title}}</a></li>
                                    @endif                                
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @include('clients::elements.news_coupon')
                </div>
                <div class="col-lg-9">
                    <section class="box-product knowledge category-knowledge">
                        <div class="category-product-header">
                            <h2>{{$data['category']->title}}</h2>
                        </div>
                        <div class="row">
                            @foreach($data['list'] as $row)
                                <div class="col-lg-4 mb-4">
                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                        title="{{ $row->title }}" class="card item-knowledge">
                                        <div class="box-image">
                                            <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new_index') }}"
                                            title="{{ $row->title }}" class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="knowledge-title">{{ $row->title }}</h5>
                                            <div class="overview">{{ $row->description }}</div>
                                            <div class="box-user">
                                                <div class="avatar-user">
                                                    <img src="./assets/images/products/avatar.svg" alt="">
                                                </div>
                                                <div class="view"><i class="fa-regular fa-eye"></i><span>{{$row->view}}</span></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            {{ $data['list']->links('clients::elements.extend.pagination') }}
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection