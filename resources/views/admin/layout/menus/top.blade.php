<ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#editar-usuario"> <i class="fas fa-user fa-fw"></i> {{ trans('strings.user.profile') }}</a>
            <a class="dropdown-item" href="#editar-usuario"> <i class="fas fa-cog fa-fw"></i> {{ trans('strings.user.settings') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#logout"><i class="fas fa-sign-out-alt"></i> {{ trans('auth.title.logout') }}</a>
        </div>
    </li>
</ul>
