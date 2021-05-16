<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js" lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    @include('clients::elements.extend.meta')
    @include('clients::elements.extend.style')
</head>
<body>
@include('clients::elements.menu')
@include('clients::elements.header')
@include('clients::elements.ads.detail_ads')
<div class="container">
    @yield('content')
</div>
@include('clients::elements.footer')
@include('clients::elements.extend.script')
</body>
</html>