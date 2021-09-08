<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}" data-locale="{{ \App::getLocale() == 'es' ? 'es_ES' : 'en_US' }}" data-grpublic="{{ env("GRECAPTCHA_PUBLIC") }}" {{ Request::is("login") ? "class=h-100" : "" }} >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{ env('APP_NAME') }} | @yield('title') </title>
        {{-- Bootstrap v5.0.1 --}}
        {{ Html::style("https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css", ["integrity"=>"sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x", "crossorigin"=>"anonymous"]) }}
        {{-- DataTables v1.10.19 --}}
        {{ Html::style('assets/plugins/datatables/jquery.dataTables.min.css') }}
        {{-- FormValidation v0.8.1 --}}
        {{ Html::style('assets/plugins/formvalidation/dist/css/formValidation.min.css') }}
        {{-- jQuery UI v1.12.1 --}}
        {{ Html::style('assets/plugins/jquery-ui/jquery-ui.min.css') }}
        {{-- TimePicker v1.3.5 --}}
        {{ Html::style('assets/plugins/timepicker/jquery.timepicker.min.css') }}
        {{-- Core CSS file --}}
        {{ Html::style( 'assets/css/core.css?'.filemtime('assets/css/core.css') ) }}
        {{-- Custom CSS file --}}
        {{ Html::style( 'assets/css/custom.css?'.filemtime('assets/css/custom.css') ) }}
        <script> direction = "{{ env("APP_URL") }}/" </script>
        @yield('styles')
    </head>
    <body {{ Request::is("login") ? "class=h-100" : "" }}>
        @include('layout.menus.principal')

        @yield('content')

        @include('layout.menus.footer')
        {{-- jQuery v3.6.0 --}}
        {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js') }}
        {{-- jQuery UI v1.12.1 --}}
        {{ Html::script('assets/plugins/jquery-ui/jquery-ui.min.js') }}
        {{-- Bootstrap Bundle (Bootstrap and Popper) js minified v5.0.1 --}}
        {{ Html::script('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', ["integrity"=>"sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4", "crossorigin"=>"anonymous"]) }}
        {{-- Bootstrap Wizard v1.4.2 --}}
        {{ Html::script('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}
        {{-- DataTables v1.10.19 --}}
        {{ Html::script('assets/plugins/datatables/jquery.dataTables.min.js') }}
        {{-- FormValidation v0.8.1 --}}
        {{ Html::script("assets/plugins/formvalidation/dist/js/formValidation.min.js") }}
        {{-- FormValidation v0.8.1 --}}
        {{ Html::script("assets/plugins/formvalidation/dist/js/framework/bootstrap.min.js") }}
        @if(\App::getLocale() == 'es')
            {{ Html::script("assets/plugins/formvalidation/dist/js/language/es_ES.js") }}
        @else
            {{ Html::script("assets/plugins/formvalidation/dist/js/language/en_US.js") }}
        @endif

        {{-- DateTimePicker plugin --}}
        {{ Html::script("assets/plugins/datetimepicker/datepicker.js") }}
        @if(\App::getLocale() == 'es')
            {{ Html::script("assets/plugins/datetimepicker/i18n/datepicker-es.js") }}
        @endif

        {{-- TimePicker plugin --}}
        {{ Html::script("assets/plugins/timepicker/jquery.timepicker.min.js") }}
        {{ Html::script("assets/plugins/timepicker/timepicker.call.js") }}
        {{-- Font Awesome --}}
        {{ Html::script("https://use.fontawesome.com/releases/v5.15.3/js/all.js") }}
        {{-- Custom Script --}}
        {{ Html::script( "assets/js/script.js?".filemtime("assets/js/script.js") ) }}
        {{-- reCaptcha V3 --}}
        {{ Html::script("https://www.google.com/recaptcha/api.js?render=".env("GRECAPTCHA_PUBLIC")) }}

        @yield('scripts')
        @include('notifications')
    </body>
</html>
