{{-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="a-none" href="{{ route('client.home') }}">Trang chủ</a></li>
        @if(!empty($data['detail']->title))
            @if(!empty($data['cate_parent']->id))
                <li class="breadcrumb-item"><a class="a-none"
                            href="{{ route('client.category.index', ['slug' => $data['cate_parent']->slug]) }}">{{ $data['cate_parent']->title }}</a>
                </li>
            @endif
            <li class="breadcrumb-item"><a class="a-none"
                        href="{{ route('client.category.index', ['slug' => $data['detail']->category_slug]) }}">{{ $data['detail']->category_title }}</a>
            </li>
            <li class="breadcrumb-item active"
                aria-current="page">{{ $data['detail']->title }}</li>
        @endif
        @if(!empty($data['category']->id))
            <li class="breadcrumb-item active"
                aria-current="page">{{ $data['category']->title }}</li>
        @endif
        @if(!empty($data_common['page_user']))
            <li class="breadcrumb-item active"
                aria-current="page">{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</li>
        @endif
    </ol>
</nav> --}}
<div class="nd-breadcrumb">
    <div class="breadcrumb-custom">
        <a href="{{ route('client.home') }}">Trang chủ</a>
        @if(!empty($data['detail']->title))
            @if(!empty($data['cate_parent']->id))
                <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
                <a class="a-none" href="{{ route('client.category.index', ['slug' => $data['cate_parent']->slug]) }}">
                    {{ $data['cate_parent']->title }}
                </a>
            @endif
            <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
            <a class="a-none"
                        href="{{ route('client.category.index', ['slug' => $data['detail']->category_slug]) }}">{{ $data['detail']->category_title }}</a>
            <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
            <a href="#" class="a-none">
                {{ $data['detail']->title }}
            </a>
        @endif
        @if(!empty($data['category']->id))
            <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
            <a href="#" class="a-none">{{ $data['category']->title }}</a>
        @endif
        @if(!empty($data_common['page_user']))
            <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
            <a class="a-none">{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</a>
        @endif
    </div>
</div>