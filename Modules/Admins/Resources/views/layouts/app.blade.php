<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js" lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    @include('admins::elements.extend.meta')
    @include('admins::elements.extend.style')
</head>
<body>
<div class="container-scroller" id="app">
    @include('admins::elements.header')
    <div class="container-fluid page-body-wrapper">
        @include('admins::elements.sitebar')
        <div class="main-panel">
            @yield('content')
            @include('admins::elements.footer')
        </div>
    </div>
</div>
@include('admins::elements.extend.script')
</body>
</html>