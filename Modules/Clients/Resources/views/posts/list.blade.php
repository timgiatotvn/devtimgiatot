@extends('clients::layouts.cart')

@section('content')
    <section id="user-page">
        <div class="wrap-user-page">
            <h1>
                Danh sách bài viết
            </h1>
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <div class="main-user-page">
                <p>
                    <a href="{{route('client.user.create-post')}}" class="btn btn-primary">Thêm mới</a>
                </p>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Ảnh</td>
                            <td>Tiêu đề</td>
                            <td>Trạng thái</td>
                            <td>Hành động</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><img src="{{ asset($item->thumbnail) }}" class="mw-100"></td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->status ? 'Đã duyệt' : 'Chưa duyệt'}}</td>
                                <td align="center">
                                    <a class="btn btn-warning" href="{{route('client.user.edit', ['id' => $item->id])}}">Sửa</a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger" href="{{route('client.user.delete-post', ['id' => $item->id])}}">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection