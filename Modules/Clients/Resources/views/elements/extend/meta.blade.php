<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link type="image/x-icon" href="{{ asset('/static/client/images/favicon.ico') }}" rel="icon">
<link type="image/x-icon" href="{{ asset('/static/client/images/favicon.ico') }}" rel="shortcut icon">

<title>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</title>
<meta property="og:url" content="<?php echo url()->current(); ?>" />
<meta property="og:title" content="{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}" />
<meta property="og:description" content="{{ !empty($data['common']['meta_des']) ? $data['common']['meta_des'] : '' }}" />
<meta name="keywords" content="{{ !empty($data['common']['meta_key']) ? $data['common']['meta_key'] : '' }}" />