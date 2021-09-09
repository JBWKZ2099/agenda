<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{{ env('APP_NAME') }} @yield('title')</title>

        {{-- Admin CSS --}}
        {{ Html::style('assets/css/admin/styles.css') }}

        {{-- Custom CSS --}}
        {{ Html::style('assets/css/custom.css') }}
        {{ Html::style('assets/css/core.css') }}

        {{-- DataTables --}}
        {{ Html::style('https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css') }}

        {{-- FormValidation CSS file --}}
        {{ Html::style('assets/plugins/formvalidation/dist/css/formValidation.min.css') }}

        {{-- DateTimePicker CSS file --}}
        {{ Html::style('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}

        {{-- TimePicker CSS file --}}
        {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css') }}

        {!! Html::style("https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css") !!}

        {{-- Font Awesome --}}
        {!! Html::script("https://use.fontawesome.com/releases/v5.15.3/js/all.js") !!}

        <script> direction = "{{ env('APP_URL') }}"; </script>

        @yield('styles')
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            @include('admin.layout.menus.logo')
            <!-- Navbar-->

            @include("admin.layout.menus.top")
        </nav>


        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include("admin.layout.menus.principal")
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        @yield('card-breadcrumb')

                        @if( !Request::is("admin") )
                          <div class="row">
                        		<div class="col-md-12">
                        			<div class="card mb-4">
                        				<div class="card-header">@yield("card-title")</div>
                        				<div class="card-body">@yield("card-body")</div>
                        			</div>
                        		</div>
                        	</div>
                        @endif
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                      @include("admin.layout.menus.footer")
                    </div>
                </footer>
            </div>
        </div>

        {{-- jQuery --}}
        {{ Html::script("https://code.jquery.com/jquery-3.6.0.min.js") }}
        {{ Html::script('https://code.jquery.com/ui/1.12.1/jquery-ui.js') }}

        {{-- Bootstrap Bundle (Bootstrap and Popper) js minified v5.0.1 --}}
        {{ Html::script('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', ["integrity"=>"sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4", "crossorigin"=>"anonymous"]) }}

        {{-- Bootstrap Core JavaScript --}}
        {{-- Debemos dejar este script para que funcione el bootstrap wizard con las tabs --}}
        {{ Html::script("https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js") }}

        {{-- Custom Theme JavaScript --}}
        {{ Html::script("assets/js/scripts.js") }}

        {{ Html::script("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js") }}
        {{-- {{ Html::script("assets/demo/chart-area-demo.js") }} --}}
        {{-- {{ Html::script("assets/demo/chart-bar-demo.js") }} --}}
        {{ Html::script("https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js") }}
        {{ Html::script("https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js") }}
        {{-- {{ Html::script("assets/demo/datatables-demo.js") }} --}}

        {{-- Bootstrap Wizard --}}
        {{ Html::script('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}

        {{-- DataTables --}}
        {{ Html::script('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}
        {{ Html::script('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}

        {{-- FormValidation plugin and the class supports validating Bootstrap form --}}
        {{ Html::script("assets/plugins/formvalidation/dist/js/formValidation.min.js") }}
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
        {{ Html::script("https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js") }}
        {{ Html::script("assets/plugins/timepicker/timepicker.call.js") }}

        {{-- Google Maps --}}
        {{-- {{ Html::script("https://maps.googleapis.com/maps/api/js?key=". env('GOOGLE_MAPS_KEY') ."&libraries=places&callback=initAutocomplete", ['async', 'defer']) }}
        {{ Html::script("assets/plugins/google-maps/google_maps.js") }} --}}

        @yield('scripts')

        @include('notifications')
    </body>
</html>
