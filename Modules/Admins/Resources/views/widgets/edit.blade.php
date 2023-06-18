@extends('admins::layouts.app')
@section('content')
    <div class="content-wrapper">
        
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <h4 class="mb-md-0 mb-4 mr-4">
                            Sửa widget {{ $widget->name }}
                        </h4>
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
                        @include('admins::widgets.elements.' . $widget->name)
                    </div>
                </div>
            </div>
        </div>
@endsection
