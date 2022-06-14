@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="" class="forms-sample" id="form-create">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.crawler.website.index') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        @lang('admins::layer.button.cancel')
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Template</label>
                                <select id="dynamic_select" class="form-control">
                                    <option value="" @if(empty($_GET["template"])) selected @endif>Chọn template
                                    </option>
                                    <option value="?template=tiki" @if(!empty($_GET["template"])) {{ ($_GET["template"] == "tiki") ? "selected" : "" }} @endif>
                                        Tiki
                                    </option>
                                    <option value="?template=lazada" @if(!empty($_GET["template"])) {{ ($_GET["template"] == "lazada")? "selected" : "" }} @endif>
                                        Lazada
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Domain đầy đủ website (VD: https://www.thegioididong.com)</label>
                                <input type="text" name="domain_url"
                                       value="{{ !empty($templateCrawler['domain_url']) ? $templateCrawler["domain_url"] : '' }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>URL mục sản phẩm</label>
                                <input type="text" name="url" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Class bao list sản phẩm</label>
                                <input type="text" name="class_root_list"
                                       value="{{ !empty($templateCrawler['class_root_list']) ? $templateCrawler["class_root_list"] : '' }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Class bao từng sản phẩm</label>
                                <input type="text" name="class_parent"
                                       value="{{ !empty($templateCrawler['class_parent']) ? $templateCrawler["class_parent"] : '' }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Class bao ảnh</label>
                                <input type="text" name="class_url_image"
                                       value="{{ !empty($templateCrawler['class_url_image']) ? $templateCrawler["class_url_image"] : '' }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Ảnh attr</label>
                                <input type="text" name="class_url_image_attr"
                                       value="{{ !empty($templateCrawler['class_url_image_attr']) ? $templateCrawler["class_url_image_attr"] : 'src' }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Class bao link chi tiết sản phẩm</label>
                                <input type="text" name="class_url_a"
                                       value="{{ !empty($templateCrawler['class_url_a']) ? $templateCrawler["class_url_a"] : '' }}"
                                       class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Link page mẫu</label>
                                <input type="text" name="url_page_example" class="form-control" placeholder=""/>
                                <figcaption class="figure-caption text-danger text-small">Vd:
                                    https://timgiatot.vn/tim-gia-tot?page=
                                </figcaption>
                            </div>
                            <div class="form-group">
                                <label>Tổng page</label>
                                <input type="text" name="page_max" class="form-control" placeholder=""/>
                                <figcaption class="figure-caption text-danger text-small">Vd: 10</figcaption>
                            </div>

                            <div style="background: #0a6aa1; color: #fff; padding: 20px 20px 1px 20px; margin-bottom: 15px;">
                                <h4 class="mb-3">Chi tiết</h4>
                                <div class="form-group">
                                    <label>Class bao quanh tất cả</label>
                                    <input type="text" name="class_detail"
                                           value="{{ !empty($templateCrawler['class_detail']) ? $templateCrawler["class_detail"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Class tên</label>
                                    <input type="text" name="class_detail_name"
                                           value="{{ !empty($templateCrawler['class_detail_name']) ? $templateCrawler["class_detail_name"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Class giá</label>
                                    <input type="text" name="class_detail_price"
                                           value="{{ !empty($templateCrawler['class_detail_price']) ? $templateCrawler["class_detail_price"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Class giá gốc</label>
                                    <input type="text" name="class_detail_price_root"
                                           value="{{ !empty($templateCrawler['class_detail_price_root']) ? $templateCrawler["class_detail_price_root"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Class giá flash sale</label>
                                    <input type="text" name="class_detail_price_sale"
                                           value="{{ !empty($templateCrawler['class_detail_price_sale']) ? $templateCrawler["class_detail_price_sale"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Class giá flash sale root</label>
                                    <input type="text" name="class_detail_price_sale_root"
                                           value="{{ !empty($templateCrawler['class_detail_price_sale_root']) ? $templateCrawler["class_detail_price_sale_root"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Class description</label>
                                    <input type="text" name="class_detail_description"
                                           value="{{ !empty($templateCrawler['class_detail_description']) ? $templateCrawler["class_detail_description"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Class content</label>
                                    <input type="text" name="class_detail_content"
                                           value="{{ !empty($templateCrawler['class_detail_content']) ? $templateCrawler["class_detail_content"] : '' }}"
                                           class="form-control" placeholder=""/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Loại danh mục</label>
                                <select name="type" class="form-control col-md-3">
                                    @foreach($type_cate as $row)
                                        <option value="{{ $row }}">{{ $type_text[$row] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại web</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        @if(!empty($templateCrawler["type_crawler"]))
                                            @if($templateCrawler["type_crawler"] == "static")
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="type_crawler"
                                                               value="static"
                                                               checked>
                                                        Static
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="type_crawler"
                                                               value="ajax">
                                                        Ajax
                                                    </label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="type_crawler"
                                                               value="static">
                                                        Static
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="type_crawler"
                                                               value="ajax" checked>
                                                        Ajax
                                                    </label>
                                                </div>
                                            @endif
                                        @else
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="type_crawler"
                                                           value="static"
                                                           checked>
                                                    Static
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="type_crawler"
                                                           value="ajax">
                                                    Ajax
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="1"
                                                       checked>
                                                @lang('admins::layer.status.active')
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" value="0">
                                                @lang('admins::layer.status.no_active')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('error'))
                                <p class="alert alert-danger">{{$errors->first('error')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    @lang('admins::layer.button.submit')
                                </button>
                                <a href="{{ route('admin.crawler.website.index') }}">
                                    <button type="button" class="btn btn-inverse-dark">
                                        @lang('admins::layer.button.cancel')
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            });
        });
    </script>
@endsection
@section('validate')
    {!! JsValidator::formRequest('Modules\Admins\Http\Requests\Crawlers\Category\CreateRequest','#form-create'); !!}
@endsection
