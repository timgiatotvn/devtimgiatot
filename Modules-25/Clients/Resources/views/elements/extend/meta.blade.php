<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link type="image/x-icon" href="{{ asset('/static/client/images/favicon.jpeg') }}" rel="icon">
<link type="image/x-icon" href="{{ asset('/static/client/images/favicon.jpeg') }}" rel="shortcut icon">
@include('feed::links')
<title>{{ !empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '' }}</title>
<meta name="keywords" content="{{ !empty($data['common']['meta_key']) ? $data['common']['meta_key'] : '' }}"/>
<meta name="description" content="{{ !empty($data['common']['meta_des']) ? $data['common']['meta_des'] : '' }}"/>

<?php
$title = !empty($data['detail']->title) ? $data['detail']->title : (!empty($data['common']['title_seo']) ? $data['common']['title_seo'] : '');
$description = !empty($data['detail']->description) ? $data['detail']->description : (!empty($data['common']['meta_des']) ? $data['common']['meta_des'] : '');
$img = '';
if (!empty($data['detail']->id)) {
    $img = \App\Helpers\Helpers::renderThumb($data['detail']->thumbnail, 'share_fb');
} else {
    if(!empty($data['slide'])) foreach ($data['slide'] as $k => $row) {
        $img = \App\Helpers\Helpers::renderThumb($row->thumbnail, 'share_fb');
        break;
    }
}

?>
<meta property="og:url" content="<?php echo url()->current(); ?>"/>
<meta property="og:title" content="{{ $title }}"/>
<meta property="og:description" content="{{ $description  }}"/>
<meta property="og:type" content="article"/>
<meta property="og:image" content="{{ $img }}"/>
{!! !empty($data_common['setting']->code_header) ? $data_common['setting']->code_header : '' !!}
