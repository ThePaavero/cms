<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <title>{{ $data['title'] }}</title>

    <link rel='stylesheet' href='{{ url('assets/css/project.css') }}'/>
    <meta name='csrf-token' content='{{ csrf_token() }}'/>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
    <script>
        window._root = '{{ url('') }}/';
        window._CmsUserIsAdmin = {{ $userIsAdmin ? 'true' : 'false' }};
    </script>
    @if(App::environment() != 'local')
        <script src='{{ url('build.js') }}'></script>
    @else
        <script src='{{ url('jspm_packages/system.js') }}'></script>
        <script src='{{ url('config.js') }}'></script>
        <script>
            System.baseURL = window._root;
            System.import('main');
        </script>
    @endif

</head>
<body>
<header class='main-header'>
    {!! $cms->getCompleteSiteMapAsNavigation() !!}
</header>
<!-- main-header -->
@yield('content')
{!! $cms->getAdminPanel() !!}
</body>
</html>