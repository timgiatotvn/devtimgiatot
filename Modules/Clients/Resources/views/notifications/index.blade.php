@extends('clients::layouts.cart')

@section('content')
    <section id="user-page">
        <div class="wrap-user-page">
            <h1>
                Thông báo
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
                    Hướng dẫn gửi Push Notication: Xem <a target="_blank" href=" https://timgiatot.vn/trai-nghiem-quang-cao-ung-dung-push-notification-mien-phi.html">tại đây</a>. Liên hệ CSKH để được hỗ trợ trong quá trình sử dụng: 0912.399.322 hoặc OA của chúng tôi!
                </p><br>
                <p>
                    <a href="{{route('client.user.notification.create')}}" class="btn btn-primary">Thêm mới</a>
                </p>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Tiêu đề</td>
                            <td>Trạng thái</td>
                            <td>Lượt xem</td>
                            <td>Ngày thông báo</td>
                            <td>Ngày tạo</td>
                            <td>Ngày sửa</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data['list']) > 0)
                            @foreach($data['list'] as $k=>$row)
                                <tr>
                                    <td>{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                    {{-- <td><img src="{{ asset($row->thumbnail) }}" class="mw-100"></td> --}}
                                    <td>{{ $row->title }}</td>
                                    <td>
                                        @if ($row->status == 1)
                                            Đã thông báo
                                        @elseif ($row->status == 2)
                                            Lên lịch thông báo
                                        @else
                                            Huỷ thông báo
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $row->deviceReadNotification->count() }}
                                    </td>
                                    <td>{{ !empty($row->publish_at) ? date('d/m/Y H:i:s', strtotime($row->publish_at)) : null }}</td>
                                    <td>{{ \Helpers::formatDate($row->created_at) }}</td>
                                    <td>{{ \Helpers::formatDate($row->updated_at) }}</td>
                                    <td>
                                        <a class="icon-form" title="edit" href="{{ route('client.user.notification.edit', $row->id) }}">
                                            Sửa
                                        </a>
                                        <a class="icon-form" href="javascript:confirmDelete('{{ route('client.user.notification.delete', ['id' => $row->id]) }}','@lang('admins::layer.notify.confirm.delete')')">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('validate')
    {!! JsValidator::formRequest('Modules\Clients\Http\Requests\User\UpdateRequest','#form-update'); !!}
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection