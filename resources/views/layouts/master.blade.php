<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') &mdash; DeveloperShame.com</title>

        {{-- Bootstrap --}}
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        {{-- Custom Styles --}}
        <link href="{{ asset('css/site.css') }}" rel="stylesheet">

        {{-- Font Awesome --}}
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @include('shared.navbar')
        @yield('content')

        {{-- jQuery --}}
        <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
        {{-- Plugins --}}
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        {{-- Extra scripts --}}
        @yield('scripts')
    </body>
</html>