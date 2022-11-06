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
                <a href="/dich-vu">Dịch vụ</a>
                <span><img src="{{asset('assets/images/icons/arrow.svg')}}" alt=""></span>
                <span>Tìm kiếm</span>
            </div>
        </div>
        <section class="banner-school">
            <form method="GET">
                <div class="box-search-service desktop">
                    <div class="box">
                        <input value="@if(isset($inputs['service_name'])){{$inputs['service_name']}}@endif" type="text" name="service_name" class="form-control" placeholder="Nhập dịch vụ cần tìm">
                    </div>
                    <div class="box">
                        <select id="pick-province" name="province_id" class="form-select" aria-label="Default select example">
                            <option value="-1" selected>Tỉnh/TP</option>
                                @foreach ($provinces as $item)
                                    <option @if(isset($inputs['province_id']) && $inputs['province_id'] == $item->id){{'selected'}}@endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="box">
                        <select name="district_id" id="district-mobile" class="form-select" aria-label="Default select example">
                            <option value="-1">Chọn quận/huyện</option>
                            @if (count($districts) > 0)
                                @foreach ($districts as $item)
                                    <option value="{{$item->id}}" @if(isset($inputs['district_id']) && $inputs['district_id'] == $item->id){{'selected'}}@endif>{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-search">Tìm kiếm</button>
                    </div>
                </div>
                <div class="box-search-filter box-filter-school mobile">
                    <div class="box">
                        <input type="text" class="form-control input-search-mobile" placeholder="Nhập dịch vụ cần tìm">
                        <button class="btn btn-filter"><img src="{{asset('assets/images/icons/icon-fillter.svg')}}" alt="">Bộ lọc</button>                        
                        <button class="btn btn-search"><img src="{{asset('images/icons/icon_search_white.svg')}}" alt=""></button>
                    </div>
                </div>
            </form>
        </section>
        <section class="list-school">
            @foreach ($services as $serviceItem)
                <div class="item-school">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="item-image">
                                <a href="{{route('client.service.detail', ['caetgory' => $serviceItem->category->slug, 'slug' => $serviceItem->slug, 'id' => $serviceItem->id])}}">
                                    <img class="img-school" src="{{$serviceItem->thumbnail}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="infor-school">
                                <div class="logo-title">
                                    <div class="logo">
                                        <img src="{{$serviceItem->logo}}" alt="">
                                        <img src="{{asset('assets/images/icons/akar-icons_check.svg')}}" class="standard-school" alt="">
                                    </div>
                                    <h4 class="title">
                                        <a class="a-none" href="{{route('client.service.detail', ['category' => $serviceItem->category->slug, 'slug' => $serviceItem->slug, 'id' => $serviceItem->id])}}">
                                            {{$serviceItem->title}}
                                        </a>
                                    </h4>
                                </div>
                                @php
                                    $service = explode(";", $serviceItem->service);
                                @endphp
                                
                                <div class="content-school">
                                    <p class="description">
                                        {{$serviceItem->description}}
                                    </p>
                                    @if (count($service) > 0)
                                        <div class="row">
                                            @foreach (array_chunk($service, 2) as $listService)
                                            <div class="col-lg-6">
                                                <ul class="utilities">
                                                    @foreach ($listService as $item)
                                                        <li>
                                                            {{$item}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="address-school">
                                        <img src="{{asset('assets/images/icons/location.svg')}}" alt="">
                                        <p>
                                            {{$serviceItem->address}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="infor-price">
                                <div class="item-rate-detail">
                                    <div class="rating">
                                        @for ($star = 0; $star <= $serviceItem->rate; $star++)
                                            <span><img src="{{asset('assets/images/icons/Star.svg')}}" alt=""></span>
                                        @endfor
                                        <p class="number_rate">{{number_format($serviceItem->total_rate)}} đánh giá</p>
                                    </div>
                                    <button class="btn btn-detail"><a class="a-none" style="color: #fff" href="{{route('client.service.detail', ['caetgory' => $serviceItem->category->slug, 'slug' => $serviceItem->slug, 'id' => $serviceItem->id])}}">Xem chi tiết</a> <img src="" alt=""></button>
                                </div>
                                <div class="item-price">
                                    <div class="label-price">Giá dịch vụ chỉ từ:</div>
                                    <div class="number-price">{{number_format($serviceItem->price)}} VNĐ</div>
                                </div>
                                <div class="item-contact">
                                    <button class="btn btn-contact-school">Liên hệ</button>
                                    <a href="https://zalo.me/{{$serviceItem->zalo}}" target="_blank" class="zalo"><img src="{{asset('assets/images/icons/MXH_zalo.svg')}}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$services->appends($inputs)->links('clients::elements.extend.pagination')}}
            
        </section>
    </div>
</main>
@endsection

@section('scripts')
<script>
    $(function(){
        $('#pick-province').change(function(){
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
                        $('#district').html(string);
                    }
                }
            })
        })
    })
</script>
@endsection