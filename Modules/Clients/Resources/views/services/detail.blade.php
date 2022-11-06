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
                <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
                <a href="{{route('client.service.list', ['slug' => $service->category->slug])}}">{{$service->category->title}}</a>
                <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
                <span>{{$service->title}}</span>
            </div>
        </div>
        <section class="detail-school">
            <div class="banner-detail">
                <img class="image-desktop" src="{{$service->banner}}" style="width: 100%;" alt="">
                <img class="image-mobile" src="{{$service->banner}}" style="width: 100%;" alt="">
            </div>
            <div class="box-title-school">
                <div class="logo-title">
                    <div class="logo">
                        <img src="{{$service->logo}}" style="width: 64px; height: 64px; object-fit: cover" alt="">
                        <img src="{{asset('assets/images/icons/akar-icons_check.svg')}}" class="standard-school" alt="">
                    </div>
                    <div class="title-address">
                        <h4 class="title">
                            {{$service->title}}
                        </h4>
                        <div class="address-school">
                            <img src="images/icons/location.svg" alt="">
                            <p>{{$service->address}}</p>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row">
               <div class="col-lg-8">
                  <div class="box-info">
                        <div class="detail-title">
                            <img src="{{asset('assets/images/icons/frame_detail.svg')}}" alt=""><span>Thông tin chi tiết</span>
                        </div>
                        <div class="content">
                            {!!$service->content!!}
                        </div>
                  </div>
               </div>
               <div class="col-lg-4">
                   <div class="sidebar-right">
                        <div class="infor-price">
                            <div class="box-rate-price">
                                <div class="item-rate-detail">
                                    <div class="rating">
                                        @for ($star = 0; $star <= $service->rate; $star++)
                                            <span><img src="{{asset('assets/images/icons/Star.svg')}}" alt=""></span>
                                        @endfor
                                        <p class="number_rate">{{number_format($service->total_rate)}} đánh giá</p>
                                    </div>
                                </div>
                                <div class="item-price">
                                    <div class="label-price">Giá dịch vụ chỉ từ:</div>
                                    <div class="number-price">{{number_format($service->price)}} VNĐ</div>
                                </div>
                            </div>
                            <div class="item-contact">
                                <button class="btn btn-contact-school">Liên hệ</button>
                                <a href="#" class="zalo"><img src="images/icons/MXH_zalo.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="box-form">
                            <div class="header-form">
                                <img src="images/icons/group_user.svg" alt="">
                                <p>Nhận yêu cầu tư vấn miễn phí từ trường ngay</p>
                            </div>
                            <form action="{{route('client.add_advise_request')}}" method="POST">
                                @csrf
                                <div class="group-input">
                                    <img class="icon-input" src="{{asset('assets/images/icons/icon_user.svg')}}" alt="">
                                    <input type="text" class="form-control" name="full_name" placeholder="Họ và tên">
                                </div>
                                <div class="group-input">
                                    <img class="icon-input" src="{{asset('assets/images/icons/address_icon.svg')}}" alt="">
                                    <input type="text" class="form-control" name="email" placeholder="Địa chỉ email">
                                </div>
                                <div class="group-input">
                                    <img class="icon-input" src="{{asset('assets/images/icons/phone.svg')}}" alt="">
                                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                                </div>
                                <div class="group-input">
                                    <img class="icon-input" src="{{asset('assets/images/icons/icon-location.svg')}}" alt="">
                                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                                </div>
                                <textarea id="" rows="4" name="description" class="form-control" placeholder="Yêu cầu thêm"></textarea>
                               <div class="group-button">
                                <button class="btn btn-send">Tư vấn cho tôi ngay</button>
                               </div>
                            </form>
                            <div class="text">( Hoàn toàn miễn phí )</div>
                            <div class="register-school">Đã có <span class="number">{{number_format($service->total_rate)}}</span> đăng ký nhận tư vấn</div>
                        </div>
                   </div>
               </div>
           </div>
        </section>
        @if (count($serviceRelates) > 0)
            <section class="section-relate">
                <h3>Dịch vụ liên quan</h3>
                <input type="hidden" value="{{count($serviceRelates)}}" id="total-service-relate">
                <div class="list-service-relate">
                    @foreach ($serviceRelates as $item)
                        <div class="item-service-relate">
                            <div class="image-relate">
                                <a href="{{route('client.service.detail', ['category' => $item->category->slug, 'slug' => $item->slug, 'id' => $item->id])}}">
                                    <img src="{{$item->thumbnail}}" alt="">
                                </a>
                            </div>
                            <div class="panel-service">
                                <h4>
                                    <a class="a-none" href="{{route('client.service.detail', ['category' => $item->category->slug, 'slug' => $item->slug, 'id' => $item->id])}}">{{$item->title}}</a>
                                </h4>
                                <p>
                                    {{strip_tags($item->description)}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="button">
                    <button id="load-more" onclick="loadMore()" class="btn btn-read-more">Xem thêm</button>
                </div>
            </section>
       @endif
    </div>
</main>
@endsection

@section('scripts')
<script>
    function loadMore() {
        const offset = $('#total-service-relate').val();
        $.ajax({
            url: "{{route('client.load_more_service_relate')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                category_id: "{{$service->category_id}}",
                offset: offset
            },
            success: function(e) {
                if (e.success) {
                    $('#total-service-relate').val(parseInt(offset) + parseInt(e.total));
                    if (e.string != '') {
                        $('.list-service-relate').append(e.string);
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