@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" name="keyword"
                                   value="{{ request()->has('keyword') ? request()->get('keyword') : '' }}"
                                   class="form-control mb-0 mr-sm-2"
                                   placeholder="@lang('admins::layer.search.form.keyword')">
                            <button type="submit"
                                    class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
                        </form>
                    </div>
                    <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                        <div class="d-flex mt-4 mt-md-0">
                            <a href="{{ route('admin.crawler.category.create', ['crawler_website_id' => request('crawler_website_id')]) }}">
                                <button type="button" class="btn btn-success">
                                    @lang('admins::layer.button.add')
                                </button>
                            </a>
                        </div>
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
                                    <th>@lang('admins::layer.table.title')</th>
                                    <th>Class wrap list</th>
                                    <th>Class item</th>
                                    <th>Class image</th>
                                    <th>Class detail</th>
                                    <th>Tổng page</th>
                                    <th>Author</th>
                                    <th></th>
                                    <th></th>
                                    <th width="50">@lang('admins::layer.table.created')</th>
                                    <th width="80"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['list'] as $k=>$row)
                                    <tr>
                                        <td>{{ \Helpers::renderSTT($k + 1, $data['list']) }}</td>
                                        <td style="width: 250px; word-break: break-word; white-space: initial;">{{ $row->url }}
                                            <a href="{{ $row->url }}" target="_blank">Link</a></td>
                                        <td>{{ $row->class_root_list }}</td>
                                        <td>{{ $row->class_parent }}</td>
                                        <td>{{ $row->class_url_image }}</td>
                                        <td>{{ $row->class_url_a }}</td>
                                        <td>{{ $row->page_max }}</td>
                                        <td>{{ !empty($row->admin->name) ? $row->admin->name : '' }}</td>
                                        <td>
                                            @if($row->checked)
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modalViewArticle_{{ $row->id }}">View demo
                                                </button>
                                            @else
                                                <button class="btn btn-secondary btn-sm">Processing</button>
                                            @endif

                                            <?php
                                            $article = [];
                                            if (count($row->article) > 0) {
                                                $num = count($row->article) - 1;
                                                $article = $row->article[$num];
                                            }
                                            ?>
                                            @if(!empty($article->id))
                                            <!-- Modal -->
                                                <div class="modal fade" id="modalViewArticle_{{ $row->id }}"
                                                     tabindex="-1" role="dialog"
                                                     aria-labelledby="modalViewArticle_{{ $row->id }}"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document" style="max-width: 800px; margin-top: 15px;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">DEMO
                                                                    - {{ $article->name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table">
                                                                    <thead class="thead-dark">
                                                                    <tr>
                                                                        <th scope="col" width="50">#</th>
                                                                        <th scope="col">Nội dung</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody style="font-size: 14px;">
                                                                    <tr>
                                                                        <td scope="row">Tiêu đề</td>
                                                                        <td scope="row">
                                                                            <a href="{{ $article->href }}"
                                                                               target="_blank">
                                                                                {{ $article->name }}
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row">Ảnh</td>
                                                                        <td scope="row">
                                                                            <img src="{{ $article->thumbnail }}"
                                                                                 style="width: 250px;">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row">Giá bán</td>
                                                                        <td scope="row">{{ $article->price }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row">Giá gốc</td>
                                                                        <td scope="row">{{ $article->price_root }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row">Mô tả</td>
                                                                        <td scope="row">
                                                                            <div class="fix-content-crawler">
                                                                                {!! str_replace("data-src", "src", $article->description) !!}
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td scope="row">Nội dung</td>
                                                                        <td scope="row">
                                                                            <div class="fix-content-crawler">
                                                                                {!! str_replace("data-src", "src", $article->content) !!}
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->status == 1 && $row->checked == 1)
                                                <a class="icon-form" title="edit"
                                                   href="javascript:confirmDelete('{{ route('admin.crawler.category.crawlerSetup', ['crawler_website_id' => request('crawler_website_id'), 'id' => $row->id, 'page' => $data['list']->currentPage()]) }}','Khởi động quét dữ liệu')">
                                                    <button type="button" class="btn btn-facebook btn-sm">Quyét 1 lần
                                                    </button>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ \Helpers::formatDate($row->created_at) }}</td>
                                        <td>
                                            <a class="icon-form" title="edit"
                                               href="{{ route('admin.crawler.category.edit', ['crawler_website_id' => request('crawler_website_id'), 'id' => $row->id, 'page' => $data['list']->currentPage()]) }}">
                                                <i class="icon-note"></i>
                                            </a>
                                            <a class="icon-form status active"
                                               href="{{ route('admin.crawler.category.status', ['crawler_website_id' => request('crawler_website_id'), 'id' => $row->id, 'field' => 'status']) }}">
                                                {!! (($row->status == 1) ? '<i class="icon-check"></i>' : '<i class="icon-close"></i>') !!}
                                            </a>
                                            {{--                                            <a class="icon-form" href="javascript:confirmDelete('{{ route('admin.crawler.category.destroy', ['id' => $row->id]) }}','@lang('admins::layer.notify.confirm.delete')')">--}}
                                            {{--                                                <i class="icon-trash"></i>--}}
                                            {{--                                            </a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $data['list']->links('admins::elements.extend.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('style')
    <style type="text/css">
        .fix-content-crawler {
            word-break: break-all;
            white-space: pre-line;
        }

        .fix-content-crawler h1{font-size: 19px;}
        .fix-content-crawler h2{font-size: 17px;}
        .fix-content-crawler h3{font-size: 15px;}

        .fix-content-crawler img {
            min-width: 350px;
        }
    </style>
@endsection
