<form method="post" action="{{route('widget.store', ['name' => $widget->name])}}" class="forms-sample" id="form-create">
    @csrf()
    @php
        $content = json_decode($widget->content, true);
    @endphp
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <h4>
                    Block đầu
                </h4>
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input value="{{ !empty($content['first_block']['title']) ? $content['first_block']['title'] : old('block[first_block][title]')}}" type="text" placeholder="CÔNG TY CP CÔNG NGHỆ VÀ TRUYỀN THÔNG WEB89 VIỆT NAM" name="block[first_block][title]" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn</label>
                    <input type="text" value="{{ !empty($content['first_block']['address']) ? $content['first_block']['address'] : old('block[first_block][address]')}}" name="block[first_block][address]" required placeholder="Tầng 12, Tòa nhà Licogi 13, Số 164 Khuất Duy Tiến, P. Nhân Chính, Q. Thanh Xuân, Hà Nội." class="form-control">
                </div>
                <div class="form-group">
                    <label for="">MST</label>
                    <input type="text" value="{{ !empty($content['first_block']['tax_code']) ? $content['first_block']['tax_code'] : old('block[first_block][tax_code]')}}" name="block[first_block][tax_code]" required placeholder="0108806638 cấp ngày 05/07/2019 do Sở KHĐT Hà Nội cấp." class="form-control">
                </div>
                <div class="form-group">
                    <label for="">SĐT</label>
                    <input type="text" value="{{ !empty($content['first_block']['phone']) ? $content['first_block']['phone'] : old('block[first_block][phone]')}}" name="block[first_block][phone]" required placeholder="Điện thoại: 0246.29.27.089 / Hotline: 0981.185.620" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Website</label>
                    <input type="text" value="{{ !empty($content['first_block']['website']) ? $content['first_block']['website'] : old('block[first_block][website]')}}" name="block[first_block][website]" required placeholder="Website: https://timgiatot.vn - Email: info@timgiatot.vn" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Website</label>
                    <textarea class="form-control" required name="block[first_block][description]" id="" cols="30" rows="10" placeholder="Lưu ý: Timgiatot.vn là ứng dụng so sánh giá online, cung cấp thông tin giá cả từ nhiều nguồn, nhà cung cấp, nhà bán hàng khác nhau để đưa ra giá tốt nhất. Quý khách tham khảo sản phẩm và liên hệ trực tiếp với nhà cung cấp để có thể có giá tốt hơn. Bằng khả năng sẵn có cùng sự nỗ lực không ngừng, chúng tôi đã tổng hợp hơn 50 triệu sản phẩm, giúp bạn có thể so sánh giá, tìm giá rẻ nhất trước khi mua. Chúng tôi không bán hàng.">{{ !empty($content['first_block']['description']) ? $content['first_block']['description'] : old('block[first_block][description]')}}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <h4>
                    Block giữa
                </h4>
                <div class="form-group">
                    <label for="">Tiêu đề 1</label>
                    <input type="text" value="{{ !empty($content['center_block']['title']) ? $content['center_block']['title'] : old('block[center_block][title]')}}" required placeholder="VỀ CHÚNG TÔI" name="block[center_block][title]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 1</label>
                    <input type="text" required value="{{ !empty($content['center_block']['link_item']) ? $content['center_block']['link_item'][0] : old('block[center_block][link_item][0]')}}" name="block[center_block][link_item][]" placeholder="Định dạng: Giới thiệu||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 2</label>
                    <input type="text" required value="{{ !empty($content['center_block']['link_item']) ? $content['center_block']['link_item'][1] : old('block[center_block][link_item][1]')}}" name="block[center_block][link_item][]" name="block[center_block][link_item][]" placeholder="Định dạng: Giới thiệu||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 3</label>
                    <input type="text" value="{{ !empty($content['center_block']['link_item']) ? $content['center_block']['link_item'][2] : old('block[center_block][link_item][2]')}}" name="block[center_block][link_item][]" required name="block[center_block][link_item][]" placeholder="Định dạng: Giới thiệu||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 4</label>
                    <input type="text" required value="{{ !empty($content['center_block']['link_item']) ? $content['center_block']['link_item'][3] : old('block[center_block][link_item][3]')}}" name="block[center_block][link_item][]" name="block[center_block][link_item][]" placeholder="Định dạng: Giới thiệu||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
                <hr>
                <div class="form-group">
                    <label for="">Tiêu đề 2</label>
                    <input type="text" value="{{ !empty($content['center_block']['title_2']) ? $content['center_block']['title_2'] : old('block[center_block][title_2]')}}" required name="block[center_block][title_2]" class="form-control" placeholder="Kết nối với chúng tôi">
                    <br>
                    <label for="">
                        <input @if(!empty($content['center_block']['social'] && in_array('twitter.png', $content['center_block']['social']))){{ 'checked' }}@endif name="block[center_block][social][]" value="twitter.png" type="checkbox"> Twitter
                    </label>
                    <label for="">
                        <input @if(!empty($content['center_block']['social'] && in_array('facebook.png', $content['center_block']['social']))){{ 'checked' }}@endif name="block[center_block][social][]" value="facebook.png" type="checkbox"> Facebook
                    </label>
                    <label for="">
                        <input @if(!empty($content['center_block']['social'] && in_array('youtube.png', $content['center_block']['social']))){{ 'checked' }}@endif name="block[center_block][social][]" value="youtube.png" type="checkbox"> Youtube
                    </label>
                    <label for="">
                        <input @if(!empty($content['center_block']['social'] && in_array('zalo.svg', $content['center_block']['social']))){{ 'checked' }}@endif name="block[center_block][social][]" value="zalo.svg" type="checkbox"> Zalo
                    </label>
                </div>
            </div>
            <div class="col-lg-4">
                <h4>
                    Block cuối
                </h4>
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" value="{{ !empty($content['last_block']['title']) ? $content['last_block']['title'] : old('block[last_block][title]')}}" required placeholder="HỖ TRỢ KHÁCH HÀNG" name="block[last_block][title]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 1</label>
                    <input type="text" value="{{ !empty($content['last_block']['link_item'][0]) ? $content['last_block']['link_item'][0] : old('block[last_block][link_item][0]')}}" required name="block[last_block][link_item][]" placeholder="Định dạng: Quy Định Truy Cập Website||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 2</label>
                    <input type="text" required value="{{ !empty($content['last_block']['link_item'][0]) ? $content['last_block']['link_item'][1] : old('block[last_block][link_item][1]')}}" name="block[last_block][link_item][]" placeholder="Định dạng: Chính sách bán hàng||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 3</label>
                    <input type="text" value="{{ !empty($content['last_block']['link_item'][2]) ? $content['last_block']['link_item'][2] : old('block[last_block][link_item][2]')}}" required name="block[last_block][link_item][]" placeholder="Định dạng: Chính sách bảo vệ thông tin cá nhân của người tiêu dùng||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn 4</label>
                    <input type="text" value="{{ !empty($content['last_block']['link_item'][3]) ? $content['last_block']['link_item'][3] : old('block[last_block][link_item][3]')}}" required name="block[last_block][link_item][]" placeholder="Định dạng: Phần mềm - Ứng dụng||https://timgiatot.vn/gioi-thieu" class="form-control">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Copyright</label>
                    <textarea class="form-control" name="block[copyright]" id="" placeholder="© Copyright 2019 - 2022. Website đang trong quá trình chạy thử nghiệm và trong quá trình đăng ký sàn thương mại điện tử từ Bộ Công Thương" cols="30" rows="10">{{ !empty($content['copyright']) ? $content['copyright'] : '' }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <button style="width: 100%" class="btn btn-success">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</form>