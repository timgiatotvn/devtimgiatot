<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
        @if(!empty($data['detail']->title))
            @if($data['cate_parent']->id)
                <li class="breadcrumb-item"><a href="{{ route('client.category.index', ['slug' => $data['cate_parent']->slug]) }}">{{ $data['cate_parent']->    title }}</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ route('client.category.index', ['slug' => $data['detail']->category_slug]) }}">{{ $data['detail']->category_title }}</a></li>
            <li class="breadcrumb-item active"
                aria-current="page">{{ $data['detail']->title }}</li>
        @endif
    </ol>
</nav>