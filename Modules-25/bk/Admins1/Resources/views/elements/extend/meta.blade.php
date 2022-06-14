<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link type="image/x-icon" href="{{ asset('/static/admin/images/favicon.jpeg') }}" rel="icon">
<link type="image/x-icon" href="{{ asset('/static/admin/images/favicon.jpeg') }}" rel="shortcut icon">
<title>{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</title>