@extends('clients::layouts.app')

@section('content')
    <section id="box-category-suggest">
        <div class="cs-head">
            <label>TÌM GIÁ TỐT & KHUYẾN MÃI HOT</label>
            <div class="line"></div>
        </div>
        <div class="cs-list">
            <ul>
                @for($i = 0; $i < 20; $i ++)
                    <li>
                        <div class="cs-item">
                            dsa
                        </div>
                    </li>
                @endfor
            </ul>
        </div>
    </section>
@endsection
