<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles-end')
        {!! Html::style(elixir('css/frontend.css')) !!}
        @yield('after-styles-end')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    </head>
    <body class="hold-transition login-page">



        <div class="wrapper">
            <div class="login-box">
                @include('includes.partials.messages')
            </div>

            @yield('content')
        </div><!-- container -->

        <!-- JavaScripts -->
        {!! Html::script('js/vendor/jquery/jquery-2.1.4.min.js') !!}
        {!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}

        @yield('before-scripts-end')
        {!! HTML::script(elixir('js/frontend.js')) !!}
        @yield('after-scripts-end')

        @include('includes.partials.ga')
    </body>
</html>