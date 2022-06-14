@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <h4 class="mb-md-0 mb-4 mr-4">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</h4>
                    <div class="wrapper d-flex align-items-center">
                        <form class="form-inline">
                            <input type="text" class="form-control mb-0 mr-sm-2" placeholder="@lang('admins::layer.search.form.keyword')">
                            <div class="input-group mb-0 mr-sm-2">
                                <select class="form-control form-select-search">
                                    <option value="">@lang('admins::layer.search.form.category')</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-0">@lang('admins::layer.search.button.title')</button>
                        </form>
                    </div>
                    <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                        <div class="d-flex mt-4 mt-md-0">
                            <button type="button" class="btn btn-success">
                                @lang('admins::layer.button.add')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <th>@lang('admins::layer.table.status')</th>
                                    <th>@lang('admins::layer.table.created')</th>
                                    <th>@lang('admins::layer.table.modified')</th>
                                    <th width="50">@lang('admins::layer.table.id')</th>
                                    <th width="110"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>2</td>
                                    <td>Herman Beck</td>
                                    <td>Herman Beck</td>
                                    <td>Herman Beck</td>
                                    <td>Herman Beck</td>
                                    <td>1</td>
                                    <td>
                                        <a class="icon-form" href="#">
                                            <i class="icon-note"></i>
                                        </a>
                                        <a class="icon-form status active" href="#">
                                            <i class="icon-check"></i>
                                        </a>
                                        <a class="icon-form" href="#">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
