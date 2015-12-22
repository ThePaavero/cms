<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <title>{{ $data['title'] }}</title>

    <link rel='stylesheet' href='{{ url('assets/css/project.css') }}'/>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
    @if(App::environment() != 'local')
        <script src='build.js'></script>
    @else
        <script src='jspm_packages/system.js'></script>
        <script src='config.js'></script>
        <script>
            System.import('main');
        </script>
    @endif

</head>
<body>
@yield('content')
</body>
</html>