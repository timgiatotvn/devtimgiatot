<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js" lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    @include('clients::elements.extend.meta')
    @include('clients::elements.extend.style')
</head>
<body>
{!! !empty($data_common['setting']->code_body) ? $data_common['setting']->code_body : '' !!}
@include('clients::elements.header')
@include('clients::elements.menu')
<div class="main-width">
    <div class="row no-gutters">
        <div class="col-12 col-md-3 col-lg-3 col-xl-3">
            111
        </div>
        <div class="col-12 col-md-9 col-lg-9 col-xl-9">
            <div class="pr-4 fix-pr-4">
                @include('clients::elements.extend.breadcrumb')
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html>