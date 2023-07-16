<form method="post" action="{{route('widget.store', ['name' => $widget->name])}}" class="forms-sample" id="form-create">
    @csrf()
    <div class="card-body">
        <div class="form-group">
            <label for="">Tiêu đề</label>
            <input type="text" required placeholder="Shopee" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Url</label>
            <input type="text" required name="url" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Mô tả</label>
            <input type="text" required placeholder="Freeship toàn quốc" name="description" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Hành động</label>
            <input type="text" required placeholder="Mua sắm ngay" name="action" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Ngày</label>
            <input type="text" required placeholder="11.11" name="date" class="form-control">
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
                <th>Url</th>
                <th>Nội dung</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if (!is_null($widget->content))
                @foreach (json_decode($widget->content, true) as $key => $item)
                @csrf
                <tr>
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td>
                        <form method="POST" action="{{ route('widget.update', ['name' => $widget->name]) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $key }}">
                            <div class="form-group">
                                <label for="">Tiêu đề</label>
                                <input type="text" name="title" value="{{ $item['title'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Url</label>
                                <input type="text" name="url" value="{{ !empty($item['url']) ? $item['url'] : '' }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <input type="text" name="description" value="{{ $item['description'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Hành động</label>
                                <input type="text" name="action" value="{{ $item['action'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Ngày</label>
                                <input type="text" name="date" value="{{ $item['date'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('widget.delete', ['name' => $widget->name, 'id' => $key]) }}" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
</div>
