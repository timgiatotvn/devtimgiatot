<form method="post" action="{{route('widget.store', ['name' => $widget->name])}}" class="forms-sample" id="form-create">
    @csrf()
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a data-input="thumbnail" data-preview="holder"
                               class="lfm btn btn-primary">
                                <i class="fa fa-picture-o"></i> CHOOSE
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="image"
                               readonly>
                    </div>
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success">Thêm mới</button>
        </div>
    </div>
</form>
<hr>
<div class="col-lg-12">
    <h4>Danh sách</h4>
    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if (!is_null($widget->content))
                @foreach (json_decode($widget->content, true) as $key => $item)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            <img src="{{ $item }}" alt="">
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{ route('widget.delete', ['name' => $widget->name, 'id' => $key]) }}">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
</div>
