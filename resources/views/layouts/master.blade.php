<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LMS API Moodle</title>
    @include('layouts.style')
</head>

<body>
    @include('sweetalert::alert')
    <script src="{{ asset('mazer/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        
        <div id="main" class="layout-horizontal">
            @include('layouts.header')

            <div class="content-wrapper container">
                <div class="page-content">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
    @include('layouts.script')
</body>

</html>
