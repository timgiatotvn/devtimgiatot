@extends('clients::layouts.index')

@section('style')
<link rel="stylesheet" href="{{asset('assets/css/category_service.css')}}">
@endsection

@section('content')
<main class="main">
    <div class="container">
        <div class="nd-breadcrumb">
            <div class="breadcrumb-custom">
                <a href="/">Trang chủ</a>
                <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt="icon-arrow"></span>
                <span>Tìm dịch vụ</span>
            </div>
        </div>
        <section class="banner-service">
            <img src="{{asset('assets/images/banners/banner-service.png')}}" style="width:100%;" alt="banner-service">
            <h1 class="title-service">TÌM KIẾM CÁC DỊCH VỤ GẦN BẠN NHẤT TẠI <a href="#">TIMGIATOT.vn</a></h1>
            <form action="{{route('client.result_search_service')}}" method="GET">
                <div class="box-search-service desktop">
                    <div class="box">
                        <input type="text" name="service_name" class="form-control" placeholder="Nhập dịch vụ cần tìm">
                    </div>
                    <div class="box">
                        <select id="pick-province" name="province_id" class="form-select" aria-label="Default select example">
                            <option value="-1" selected>Tỉnh/TP</option>
                                @foreach ($provinces as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                          </select>
                    </div>
                    <div class="box">
                        <select id="district" name="district_id" class="form-select" placeholder="" id="">
                            <option value="-1"  selected>Quận huyện</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-search">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            
            <div class="box-search-filter mobile">
                <form action="">
                    <div class="box">
                        <input type="text" class="form-control input-search-mobile" placeholder="Nhập dịch vụ cần tìm">
                        <button type="button" class="btn btn-filter" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="{{asset('assets/images/icons/icon-fillter.svg')}}" alt="">Bộ lọc</button>                        
                        <button class="btn btn-search"><img src="{{asset('assets/images/icons/icon_search_white.svg')}}" alt="icon-search"></button>
                    </div>
                </form>
            </div>
        </section>
        @include('clients::services.box_search')

        <section class="result-search">
            <h4>Tìm dịch vụ nhanh chóng chỉ với một click chuột</h4>
            <div class="list-service">
                <input type="hidden" value="{{count($categories)}}" id="total-category-service">
                @foreach ($categories as $categoryItem)
                    <a href="{{route('client.service.list', ['slug' => $categoryItem->slug])}}" class="item-service">
                        <div class="image-service">
                            <img src="{{$categoryItem->thumbnail}}" alt="{{$categoryItem->title}}">
                        </div>
                        <div class="panel-service">
                            <h4 class="title">{{$categoryItem->title}}</h4>
                            <p class="overview">Top 10 các đơn vị cung cấp uy tín</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="box-read-more">
                <a onclick="loadMore()" id="load-more" style="cursor: pointer" class="read-more">Xem thêm</a>
            </div>
            <p class="infor">Dành cho các đơn vị đưa thông tin dịch vụ lên <a href="#">TIMGIATOT.vn</a> tiếp cận hàng triệu khách hàng</p>
        </section>
        <section class="contact">
            <div class="row">
                <div class="col-lg-6">
                    <div class="box-image">
                        <img src="{{asset('assets/images/icons/Artboard 10bgr.svg')}}" alt="icon">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="box-contact">
                        <h4>Liên hệ</h4>
                        <p class="overview">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the indus.</p>
                        <form action="{{route('client.add_advise_request')}}" method="POST">
                            @csrf
                            <div class="group-input">
                                <img class="icon-input" src="{{asset('assets/images/icons/icon_user.svg')}}" alt="icon-user">
                                <input type="text" class="form-control" name="full_name" placeholder="Họ và tên">
                            </div>
                            <div class="group-input">
                                <img class="icon-input" src="{{asset('assets/images/icons/address_icon.svg')}}" alt="icon-email">
                                <input type="text" class="form-control" name="email" placeholder="Địa chỉ email">
                            </div>
                            <div class="group-input">
                                <img class="icon-input" src="{{asset('assets/images/icons/phone.svg')}}" alt="icon-phone">
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                            </div>
                            <div class="group-input">
                                <img class="icon-input" src="{{asset('assets/images/icons/icon-location.svg')}}" alt="icon-location">
                                <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                            </div>
                            <textarea name="description" id="" rows="4" class="form-control" placeholder="Yêu cầu thêm"></textarea>
                           <div class="group-button">
                            <button class="btn btn-send">Gửi đi</button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@section('scripts')
<script>
    $(function(){
        $('#pick-province, #pick-province-mobile').change(function(){
            const province_id = $(this).val();
            $.ajax({
                url: "{{route('client.service.get_district')}}",
                method: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    province_id: province_id
                },
                success: function(e) {
                    if (e.success) {
                        var string = "<option value='-1'>Chọn quận/huyện</option>";
                        var i = 0;
                        for (i = 0; i < e.data.length; i++) {
                            string+= '<option value="' + e.data[i].id + '">' + e.data[i].name + '</option>';
                        }
                        $('#district, #district-mobile').html(string);
                    }
                }
            })
        })
        
    })
    function loadMore() {
        const offset = $('#total-category-service').val();
        $.ajax({
            url: "{{route('client.load_more_category_service')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                offset: offset
            },
            success: function(e) {
                if (e.success) {
                    $('#total-category-service').val(parseInt(offset) + parseInt(e.total));
                    if (e.string != '') {
                        $('.list-service').append(e.string);
                    }
                    if (e.total == 0) {
                        $('#load-more').hide();
                    }
                }
            }
        })
    }
</script>
@endsection