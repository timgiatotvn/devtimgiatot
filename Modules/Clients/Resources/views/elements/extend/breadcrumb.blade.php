<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('admins::layer.dashboard.title')</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ !empty($data['common']['title']) ? $data['common']['title'] : '' }}</li>
    </ol>
</nav>