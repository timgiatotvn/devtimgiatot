@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">

                <h4 class="mb-md-0 mb-4 mr-4">Cấu hình danh mục hiển thị</h4>
            </div>
        </div>
        @if(Session::has('success'))
            <p class="notifi-tm5 alert alert-success">{{Session::get('success')}}</p>
        @endif
        @if(Session::has('error'))
            <p class="notifi-tm5 alert alert-danger">{{Session::get('error')}}</p>
        @endif
        <form method="post" action="{{ route('admin.config.setvalue')}}">
            @csrf()
            <div class="row">
                <div class="col-8 offset-2 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="50">Vị trí</th>
                                        <th class="text-center">Danh mục</th>
                                        <th class="text-center">Trạng thái</th>
                                        {{--                                        <th class="text-center">Thao tác</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['list_cate_show'] as $index=>$cate_show)
                                        <tr>
                                            <td class="text-center">{{$index+1}}</td>
                                            <td>
                                                <select name="cate_show[]" class="js-example-basic-single form-control"
                                                        style="width: 100%">
                                                    @foreach($data['list_cate'] as $cate)
                                                        <option value="{{ $cate->id }}"
                                                                @if ($cate->id  == $cate_show->cate_id)
                                                                selected="selected"
                                                                @endif
                                                        >
                                                            {{ $cate->title }} - [{{$cate->id}}]
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                @if($cate_show->status==1)
                                                    <input type="button" value="Đang hiển thị"
                                                           class="btn btn-sm btn-success">
                                                @else
                                                    <input type="button" value="Đã ẩn" class="btn btn-sm btn-danger">
                                                @endif
                                            </td>
                                            {{--                                            <td class="text-center">--}}
                                            {{--                                                @if($cate_show->status==1)--}}
                                            {{--                                                    <input type="button" value="Ẩn" class="btn btn-sm btn-danger">--}}
                                            {{--                                                @else--}}
                                            {{--                                                    <input type="button" value="Hiển thị" class="btn btn-sm btn-success">--}}
                                            {{--                                                @endif--}}
                                            {{--                                            </td>--}}
                                        </tr>
                                        <input type="hidden" name="cate_id[]" value="{{$cate_show->id}}">
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Lưu lại
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
<script>
    function hideNoti() {
        var noti = document.getElementsByClassName("notifi-tm5");
        if(noti){
            for (let i = 0; i < noti.length; i++) {
                noti[i].style='display:none'
            }
        }
    }
    setTimeout(hideNoti, 3000);
</script>

@section('style')
    <style type="text/css">
        .fix-content {
            word-break: break-all;
            white-space: pre-line;
        }

        .fix-content img {
            max-width: 300px;
        }
    </style>
@endsection
