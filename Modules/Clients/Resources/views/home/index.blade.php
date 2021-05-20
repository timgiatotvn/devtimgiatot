@extends('clients::layouts.app')

@section('content')
    <section id="box-category-suggest">
        <div class="cs-head">
            <label>TÌM GIÁ TỐT & KHUYẾN MÃI HOT</label>
            <div class="line"></div>
        </div>
        <div class="cs-list">
            <ul>
                @foreach($data['link'] as $row)
                    <li>
                        <div class="cs-item">
                            <div class="cs-item-right">
                                <a href="{{ $row->url }}" title="{{ $row->url_title }}" target="_blank">
                                    <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'link') }}"
                                         title="{{ $row->title }}">
                                </a>
                            </div>
                            <div class="cs-item-left">
                                <label>{{ $row->title }}</label>
                                <p>{{ \App\Helpers\Helpers::shortDesc($row->description, 42) }}</p>
                                <a href="{{ $row->url }}" title="{{ $row->url_title }}" target="_blank">
                                    {{ $row->url_title }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section id="box-product">
        <div class="pr-head">
            <label>TÌM KIẾM NHIỀU</label>
        </div>
        <div class="pr-content">
            <ul>
                @for($i = 0; $i < 20; $i ++)
                    <li>
                        <div class="pr-item">
                            dsa
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </section>
@endsection
