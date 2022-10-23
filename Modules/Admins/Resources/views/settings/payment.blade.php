@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        <form method="post" action="{{route('admin.config.store-payment')}}" class="forms-sample" id="form-create">
            @csrf()
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">Cấu hình thanh toán</h4>
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
                                <label>Số tài khoản <span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($paymentSetting) ? $paymentSetting->bank_account_number : ''}}" required name="bank_account_number" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Tên ngân hàng <span style="color: red"> *</span></label>
                                <input type="text" required value="{{!empty($paymentSetting) ? $paymentSetting->bank_name : ''}}" name="bank_name" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label>Chủ tài khoản<span style="color: red"> *</span></label>
                                <input type="text" value="{{!empty($paymentSetting) ? $paymentSetting->bank_account_name : ''}}" required name="bank_account_name" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder"
                                                   class="lfm btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> CHOOSE
                                                </a>
                                            </span>
                                            <p>
                                                <input value="{{!empty($paymentSetting) ? $paymentSetting->qr_code : ''}}" id="thumbnail" required class="form-control" type="text" name="qr_code">
                                            </p>
                                            @if(!empty($paymentSetting))
                                                <p>
                                                    <img src="{{$paymentSetting->qr_code}}" alt="">
                                                </p>
                                            @endif
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>
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
