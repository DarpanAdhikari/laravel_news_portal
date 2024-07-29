@if(!empty($metaData))
    <meta name="description" content="{{ $metaData }}" />
@endif

@if(!empty($author))
    <meta name="author" content="{{ $author }}" />
@endif

@if(!empty($keywords))
    <meta name="keywords" content="{{ $keywords }}" />
@endif

@if(!empty($tags))
    <meta name="keywords" content="{{ $tags }}" />
@endif

@if(!empty($title))
    <meta property="og:title" content="{{ $title }}" />
@endif

@if(!empty($image))
    <meta property="og:image" content="{{ $image }}" />
@endif

@if(!empty($slug))
    <meta property="og:url" content="{{ url($slug) }}" />
@endif

@if(!empty($title))
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ __('site-name') }}" />
    <meta property="og:description" content="{{ $metaData }}" />
@endif

@if(!empty($title))
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ __('twitter') }}" />
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{{ $metaData }}" />
    <meta name="twitter:image" content="{{ $image }}" />
@endif