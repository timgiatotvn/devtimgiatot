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
            <div class="alert alert-success">
                - Yêu cầu bài viết từ 700 ký tự trở lên có đầy đủ hình ảnh, nội dung phù hợp với quy định pháp luật (Những bài viết liên quan đến cá độ, cờ bạc, mại dâm, sai quy định sẽ không được duyệt) <br>
                - Đặt tối đa 2link do (Mặc định là noflow, vui lòng chỉnh thành doflow) <br>
                - Bài viết chuẩn SEO <br>

                - Các bài viết được duyệt trong vòng 24h làm việc, cập nhật duyệt bài thông qua email - Hệ thống index cực nhanh từ 15-30p sau khi bài viết được duyệt. Theo gõi <a href="https://news.google.com/publications/CAAqBwgKMNvXoQsw8-G5Aw?ceid=VN:vi&oc=3&hl=vi&gl=VN" target="_blank">Google News</a> để cập nhật. <br>

                - Hạng mục đăng bài như sau: <br>

                +) Các nội dụng liên quan đến dịch vụ, giới thiệu doanh nghiệp đăng tại mục Đối tác <br>

                +) Các nội dụng liên quan đến đánh giá rieview tương ứng tại các danh mục Kiến thức (Nếu không chọn đc danh mục phù hợp vui lòng chọn danh mục Tổng hợp) - Liên hệ hỗ trợ thông qua <a href="https://zalo.me/2060956194954401468" target="_blank">Zalo OA</a>  tại website hoặc email: info@timgiatot.vn <br>
            </div>
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
                                <td><img src="{{ $item->thumbnail }}" style="width: 200px !important"></td>
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