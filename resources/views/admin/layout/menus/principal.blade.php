<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading {!! (Request::is('admin') ? 'active' : '') !!}">{{ trans("admin.navbar.core") }}</div>
            <a class="nav-link" href="{!! URL::route('dashboard') !!}" ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a >
            <div class="sb-sidenav-menu-heading">{{ trans("admin.navbar.modules") }}</div>

                {{-- Schedule --}}
                @php
                    $route_module = 'schedules';
                    $route_title = trans('module_'.$route_module.'.module_title_s');
                    $route_title_plural = trans('module_'.$route_module.'.module_title');
                    $route_font_awesome = 'flag';

                    if( Request::is('admin/'.$route_module) || Request::is('admin/'.$route_module.'/*') ) {
                      $nav_class = "active";
                      $aria_expanded = "true";
                      $accordion = "show";
                    } else {
                      $nav_class = "collapsed";
                      $aria_expanded = "false";
                      $accordion = "";
                    }
                @endphp

                <a class="nav-link {{ $nav_class }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapse{{ $route_module }}" aria-expanded="{{ $aria_expanded }}" aria-controls="collapse{{ $route_module }}">
                  <div class="sb-nav-link-icon"><i class="fas fa-{{ $route_font_awesome }}"></i></div>
                  {{ $route_title }}
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ $accordion }}" id="collapse{{ $route_module }}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{!! URL::route($route_module) !!}">{{ trans('strings.crud.list_of') }} {{ $route_title_plural }}</a>
                    <a class="nav-link" href="{!! URL::route($route_module.'.create') !!}">{{ trans('strings.crud.add') }} {{ $route_title }}</a>
                    <a class="nav-link" href="{!! URL::route($route_module.'.deleted') !!}">{{ trans('strings.crud.restore') }} {{ $route_title }}</a>
                  </nav>
                </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">{{ trans("admin.navbar.loggedin") }}:</div>
        {{ env("APP_NAME") }}
    </div>
</nav>
