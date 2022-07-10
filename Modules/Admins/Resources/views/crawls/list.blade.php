@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">
                        Danh sách các trang crawl
                    </h4>
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline" action="{{route('admin.crawls.store-link')}}" method="POST">
                            @csrf
                            <input type="text" name="link" class="form-control mb-0 mr-sm-2"
                                   placeholder="Link gốc...">
                            <select name="website_name" class="form-control mb-0 mr-sm-2" id="">
                                <option value="{{$so_sanh_gia}}">Trang sosanhgia.com</option>
                                <option value="{{$web_so_sanh}}">Trang websosanh.vn</option>
                            </select>
                            <select name="page_number" class="form-control mb-0 mr-sm-2" id="">
                                @for ($page = 1; $page <= 20; $page++)
                                    <option value="{{$page}}">Lấy {{$page}} trang đầu</option>
                                @endfor
                            </select>
                            <button type="submit"
                                    class="btn btn-primary mb-0">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
            <p class="alert alert-success">{{Session::get('success')}}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert alert-danger">{{Session::get('error')}}</p>
        @endif
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="50">@lang('admins::layer.table.stt')</th>
                                        <th>Link</th>
                                        <th>Website</th>
                                        <th>Số trang lấy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($links as $key => $linkItem)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <a href="{{$linkItem->link}}" target="_blank">
                                                    {{$linkItem->link}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$linkItem->website_name}}
                                            </td>
                                            <td>
                                                {{$linkItem->page_number}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
