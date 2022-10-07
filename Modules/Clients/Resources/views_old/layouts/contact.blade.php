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
    @include('clients::elements.extend.breadcrumb')
    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            @yield('content')
        </div>
    </div>
</div>
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html>