@extends('clients::layouts.new')

@section('content')
    <section id="box-new-list">
        <div class="nrl-head">
            <h1>{{ $data['category']->title }}</h1>
        </div>
        <div class="nrl-content">
            <ul>
                @foreach($data['list'] as $row)
                    <li>
                        <div class="pr-item">
                            <a href="{{ route('client.post.show', ['slug' => $row->slug]) }}"
                               title="{{ $row->title }}">
                                <img src="{{ \App\Helpers\Helpers::renderThumb($row->thumbnail, 'list_new_index') }}"
                                     title="{{ $row->title }}">
                            </a>
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
        {{ $data['list']->links('admins::elements.extend.pagination') }}
    </section>
@endsection
