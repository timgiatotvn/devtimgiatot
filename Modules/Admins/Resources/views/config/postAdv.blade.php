@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">

                <h4 class="mb-md-0 mb-4 mr-4">Hình ảnh quảng cáo trong mỗi bài viết</h4>
            </div>
        </div>
        @if(Session::has('success'))
            <p class="notifi-tm5 alert alert-success">{{Session::get('success')}}</p>
        @endif
        @if(Session::has('error'))
            <p class="notifi-tm5 alert alert-danger">{{Session::get('error')}}</p>
        @endif
        <form method="post" action="" class="forms-sample" id="form-create">
            @csrf()
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-4 text-center">
                                        <img class="w-50" src="{{ asset($data['img']->path) }}" alt="Hình ảnh quảng cáo">
                                    </div>
                                    <div class="col-md-10 offset-1">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder"
                                                   class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                            <input id="thumbnail"  class="form-control" type="text" name="thumbnail"
                                                   readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Liên kết</label>
                                            <input type="text" name="link" value="{{ $data['img']->link }}" class="form-control" placeholder=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Google code</label>
                                            <textarea class="form-control" name="google_code" rows="5"> {{ $data['img']->google_code }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Vị trí hiển thị code google</label>
                                            <select class="js-example-basic-single  form-select form-control" name="location_code_google" aria-label="Default select example">
                                                <option @if( $data['img']->location_code_google=='top') selected  @endif value="top">Đầu bài viết</option>
                                                <option @if( $data['img']->location_code_google=='bottom') selected  @endif value="bottom">Cuối bài viết</option>
                                                <option @if( $data['img']->location_code_google=='hide') selected  @endif value="hide">Ẩn</option>
                                            </select>
                                        </div>

                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        <div class="form-group">
                                            <div class="text-center">
                                                        <button type="submit" class="btn btn-success">
                                                            Lưu lại
                                                        </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('error'))
                                <p class="alert alert-danger">{{$errors->first('error')}}</p>
                            @endif
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
        if (noti) {
            for (let i = 0; i < noti.length; i++) {
                noti[i].style = 'display:none'
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
