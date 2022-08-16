@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="{{route('admin.config.update-smtp')}}" class="forms-sample" id="form-create">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">Config SMTP</h4>
                        <div class="wrapper ml-md-auto d-flex flex-column flex-md-row kanban-toolbar ml-n2 ml-md-0 mt-4 mt-md-0">
                            <div class="d-flex mt-4 mt-md-0">
                                <button type="submit" class="btn btn-success">
                                    Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(session('success'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        @if($errors->has('error'))
                            <p class="alert alert-danger">{{$errors->first('error')}}</p>
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label>Driver <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->driver : ''}}" required name="driver" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Host <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->host : ''}}" required name="host" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Port <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->port : ''}}" required name="port" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>From Email <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->from_email : ''}}" required name="from_email" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>From Name <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->from_name : ''}}" required name="from_name" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Encryption <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->encryption : ''}}" required name="encryption" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Username <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->username : ''}}" required name="username" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Password <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($smtp) ? $smtp->password : ''}}" required name="password" class="form-control" placeholder=""/>
                            </div>
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
                                    Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
