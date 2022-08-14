@section('style')
    <link rel="stylesheet" href="{{ asset('/static/admin/assets/plugins/boostrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}"/>
@endsection

<form method="post"
      action="{{ empty($notification) ? route('notification.store') : route('notification.update', $notification->id) }}"
      class="forms-sample" id="form-create">
    @csrf()
    @if (isset($notification))
        @method('PUT')
    @endif
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <h4 class="mb-md-0 mb-4 mr-4">Thêm mới</h4>
                <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                    <div class="d-flex mt-4 mt-md-0">
                        <button type="submit" class="btn btn-success">
                            @lang('admins::layer.button.submit')
                        </button>
                        <a href="{{ route('admin.category.index') }}">
                            <button type="button" class="btn btn-inverse-dark">
                                @lang('admins::layer.button.cancel')
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                @if($errors->has('error'))
                    <p class="alert alert-danger">{{$errors->first('error')}}</p>
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ isset($notification) ? $notification->title : null }}" placeholder="" required/>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail</label>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ isset($notification) && $notification->thumbnail ? asset($notification->thumbnail) : null }}"
                                     width="150" class="mb-2">
                                <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder"
                                                   class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                    <input id="thumbnail" class="form-control" type="text" name="thumbnail"
                                           readonly>
                                </div>
                                <img id="holder" style="margin-top:15px;max-height:100px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control" rows="6">{!! isset($notification) ? $notification->description : null !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea class="tinymce"
                                  name="content">{!! isset($notification) ? $notification->content : null !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" value="1"
                                                {{ isset($notification) && $notification->status == 1 ? 'checked' : 'checked' }}>
                                        Đăng ngay
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" value="2"
                                                {{ isset($notification) && $notification->status == 2 ? 'checked' : '' }}>
                                        Lên lịch
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                               value="3" {{ isset($notification) && $notification->status == 3 ? 'checked' : '' }}>
                                        Huỷ đăng
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-sm-4'>
                                <div class="form-group">
                                    <div class='input-group publish-date {{ isset($notification) && $notification->status == 2 ? 'show' : 'hide' }}' id='datetimepicker'>
                                        <input type='text' class="form-control" name="publish_at"
                                               value="{{ isset($notification) && $notification->publish_at ? date('d/m/Y H:i:s', strtotime($notification->publish_at)) : null }}"/>
                                        <span class="input-group-addon">
                                                       <i class="icon-calendar"></i>
                                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    <script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/static/admin/assets/plugins/boostrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: "DD/MM/Y HH:mm:ss"
            });
        });
        $('input[name="status"]').on('click', function () {
            let status = $(this).val();
            if (status == 2) {
                $('.publish-date').removeClass('hide');
            } else {
                $('.publish-date').addClass('hide');
            }
        })
    </script>
@endsection
