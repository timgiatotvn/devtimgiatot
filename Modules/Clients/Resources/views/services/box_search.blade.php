<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('client.result_search_service')}}" method="GET">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bộ lọc</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin-bottom: 10px">
                        <input type="text" name="service_name" class="form-control" placeholder="Nhập dịch vụ cần tìm">
                    </div>
                    <div class="form-group" style="margin-bottom: 10px">
                        <select id="pick-province-mobile" name="province_id" class="form-select" aria-label="Default select example">
                            <option value="-1" selected>Tỉnh/TP</option>
                                @foreach ($provinces as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="district" name="district_id" class="form-select" placeholder="" id="">
                            <option value="-1"  selected>Quận huyện</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </form>
</div>