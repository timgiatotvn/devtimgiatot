@extends('clients::layouts.new')

@section('content')
    <section id="box-new-detail">
        <div class="nrd-head">
            <h1>{{ $data['detail']->title }}</h1>
        </div>

        <div class="wrap-info-new-detail">
            <div class="content-view">
                {!! !empty($data_common['setting']->ads1) ? $data_common['setting']->ads1 : '' !!}

                @if(!empty($data['regex']['data']))
                    <div class="wrap-regex">
                        <label>Nội dung bài viết</label>
                        <ul>
                            @foreach($data['regex']['data'] as $k=>$row)
                                <li>
                                    <a href="#{{\Illuminate\Support\Str::slug(strip_tags($row))}}-{{$k}}">{!! strip_tags($row) !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="ctct">{!! !empty($data['regex']['content']) ? str_replace('\"','"', $data['regex']['content']) : str_replace('\"','"', $data['detail']->content) !!}</div>

                {!! !empty($data_common['setting']->ads2) ? $data_common['setting']->ads2 : '' !!}
            </div>

            <div class="fb-share-button"
                 data-href="{{ route('client.post.show', ['slug' => $data['detail']->slug]) }}"
                 data-layout="button"
                 data-size="small">
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                   class="fb-xfbml-parse-ignore">Chia sẻ</a>
            </div>
        </div>

        @if(count($data['related']) > 0)
        <div class="wrap-new-related">
            <label>Tin Liên Quan</label>
            <div class="wnrr-list">
                <ul>
                    @foreach($data['related'] as $row)
                        <li>
                            <div class="wnrr-item">
                                <div class="name-title">
                                    <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                                       title="{{ $row->title }}">
                                        {{ $row->title }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </section>
@endsection
