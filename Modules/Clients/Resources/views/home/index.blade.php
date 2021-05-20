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
                            dsa
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
