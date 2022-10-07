<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="column-footer">
                    <h2>CÔNG TY CP CÔNG NGHỆ VÀ TRUYỀN THÔNG WEB89 VIỆT NAM</h2>
                    <p class="item-info"><img src="./assets/images/icons/location.svg" alt=""><span>Tầng 12, Tòa nhà Licogi 13, Số 164 Khuất Duy Tiến, P. Nhân Chính, Q. Thanh Xuân, Hà Nội.</span></p>
                    <p class="item-info"><img src="./assets/images/icons/fax.svg" alt=""><span>0108806638 cấp ngày 05/07/2019 do Sở KHĐT Hà Nội cấp.</span></p>
                    <p class="item-info"><img src="./assets/images/icons/telephone.svg" alt=""><span>Điện thoại: 0246.29.27.089 / Hotline: 0981.185.620</span></p>
                    <p class="item-info"><img src="./assets/images/icons/mdi_web.svg" alt=""><span>Website: https://timgiatot.vn - Email: info@timgiatot.vn</span></p>
                    <div class="note"><span>Lưu ý:</span> Timgiatot.vn là ứng dụng so sánh giá online, cung cấp thông tin giá cả từ nhiều nguồn, nhà cung cấp, nhà bán hàng khác nhau để đưa ra giá tốt nhất. Quý khách tham khảo sản phẩm và liên hệ trực tiếp với nhà cung cấp để có thể có giá tốt hơn. Bằng khả năng sẵn có cùng sự nỗ lực không ngừng, chúng tôi đã tổng hợp hơn 50 triệu sản phẩm, giúp bạn có thể so sánh giá, tìm giá rẻ nhất trước khi mua. Chúng tôi không bán hàng.</div>
                    <div><img src="" alt=""></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="column-footer column-footer-mobile">
                    <div class="footer-header">
                        <h2>Về chúng tôi</h2>
                        <div class="btn-sub-footer"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                    </div>
                    <ul class="nav-footer nav-footer-mobile">
                        @foreach($data_common['category_list']['footer'] as $row)
                            <li><a href="{{ asset($row->slug) }}" title="{{ $row->title }}">{{$row->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="column-footer column-footer-desktop">
                    <h2>Về chúng tôi</h2>
                    <ul>
                        @foreach($data_common['category_list']['footer'] as $row)
                            <li><a href="{{ asset($row->slug) }}" title="{{ $row->title }}">{{$row->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="column-footer column-footer-mobile">
                    <div class="footer-header">
                        <h2>Kết nối với chúng tôi</h2>
                        <div class="btn-sub-footer"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                    </div>
                    <ul class="connect-social nav-footer-mobile">
                        <li><a href="#"><img src="./assets/images/icons/twitter.png" alt=""></a></li>
                        <li><a href="#"><img src="./assets/images/icons/facebook.png" alt=""></a></li>
                        <li><a href="#"><img src="./assets/images/icons/youtube.png" alt=""></a></li>
                        <li><a href="#"><img src="./assets/images/icons/zalo.svg" alt=""></a></li>
                    </ul>
                </div>
                <div class="column-footer column-footer-desktop">
                    <h2>Kết nối với chúng tôi</h2>
                    <ul class="connect-social">
                        <li><a href="#"><img src="./assets/images/icons/twitter.png" alt=""></a></li>
                        <li><a href="#"><img src="./assets/images/icons/facebook.png" alt=""></a></li>
                        <li><a href="#"><img src="./assets/images/icons/youtube.png" alt=""></a></li>
                        <li><a href="#"><img src="./assets/images/icons/zalo.svg" alt=""></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="column-footer column-footer-mobile">
                    <div class="footer-header">
                        <h2>Hộ trợ khách hàng</h2>
                        <div class="btn-sub-footer"><i class="fa-solid fa-chevron-right dropdown"></i></div>
                    </div>
                    <ul class="nav-footer-mobile">
                        @foreach($data_common['category_list']['support'] as $row)
                            <li><a href="{{ asset($row->slug) }}" title="{{ $row->title }}">{{ $row->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="column-footer column-footer-desktop">
                    <h2>Hộ trợ khách hàng</h2>
                    <ul>
                        @foreach($data_common['category_list']['support'] as $row)
                            <li><a href="{{ asset($row->slug) }}" title="{{ $row->title }}">{{ $row->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="column-footer">
                    <h2>Tải ứng dụng</h2>
                    <ul class="download-app">
                        <li class="icon-app"><a href="https://apps.apple.com/us/app/timgiatot/id1631308200" target="_blank" rel="nofollow"><img src="{{asset('assets/images/icons/Taiappstore.svg')}}" alt=""></a></li>
                        <li class="icon-app"><a href="https://play.google.com/store/apps/details?id=com.timgiatot.timgiatot" target="_blank" rel="nofollow"><img src="./assets/images/icons/Taiappchplay.svg" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom">
    © Copyright 2019 - 2022. Website đang trong quá trình chạy thử nghiệm và trong quá trình đăng ký sàn thương mại điện tử từ Bộ Công Thương
</div>