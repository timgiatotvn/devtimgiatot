@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
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
                        <a href="{{ route('category_wp.create') }}" class="btn btn-success">
                            Thêm mới
                        </a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Link</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $item)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->link }}
                                            </td>
                                            <td>
                                                <a href="{{ route('category_wp.edit', ['id' => $item->id]) }}" class="btn btn-warning">Sửa</a>
                                                <a href="{{ route('category_wp.delete', ['id' => $item->id]) }}" class="btn btn-danger">Xóa</a>
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
