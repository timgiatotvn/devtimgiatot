<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js" lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="image/x-icon" href="{{ asset('/static/admin/images/favicon.jpeg') }}" rel="icon">
    <link type="image/x-icon" href="{{ asset('/static/admin/images/favicon.jpeg') }}" rel="shortcut icon">
    <title>{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</title>
    <link rel="stylesheet" href="{{ asset('/static/admin/assets/plugins/%40mdi/font/css/materialdesignicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/static/admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/static/admin/css/app.css') }}"/>
</head>
<body>
@yield('content')
<script type="text/javascript" src="{{ asset('/static/admin/js/app.js') }}"></script>
<script type="text/javascript" src="{{ url('/vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@yield('validate')
</body>
</html>