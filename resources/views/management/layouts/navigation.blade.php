<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-shadow menu-border navbar-brand-center"
    role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content center-layout" data-menu="menu-container">
        <!-- Navigation -->
        <ul class="navigation-main nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Dashboard -->
            <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}" data-menu="dropdown">
                <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{ route('dashboard') }}"
                    data-toggle="dropdown"><i class="ft-home"></i>
                    <span data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <!-- Manage Company -->
            <li class="dropdown nav-item {{ Request::is('workareas*') || Request::is('types*') ? 'active' : '' }}" data-menu="dropdown">
                <a class="dropdown-toggle nav-link d-flex align-items-center" href="javascript:;"
                    data-toggle="dropdown"><i class="ft-box"></i>
                    <span data-i18n="Apps">Manage Company</span>
                </a>
                <ul class="dropdown-menu">
                    <li data-menu="">
                        <a class="dropdown-item d-flex align-items-center {{ Route::is('workareas.index') ? 'active' : '' }}"
                            href="{{ route('workareas.index') }}" data-toggle="dropdown">
                            <i class="ft-arrow-right submenu-icon"></i>
                            <span data-i18n="Email">Work Areas</span>
                        </a>
                    </li>
                    <li data-menu="">
                        <a class="dropdown-item d-flex align-items-center {{ Route::is('types.index') ? 'active' : '' }}"
                            href="{{ route('types.index') }}" data-toggle="dropdown">
                            <i class="ft-arrow-right submenu-icon"></i>
                            <span data-i18n="Email">Types</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Work Areas -->
            <li class="nav-item {{ Route::is('workareas.index') ? 'active' : '' }}" data-menu="dropdown">
                <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{ route('workareas.index') }}"
                    data-toggle="dropdown"><i class="ft-home"></i>
                    <span data-i18n="Dashboard">Work Areas</span>
                </a>
            </li>

            <!-- Types -->
            <li class="nav-item {{ Route::is('types.index') ? 'active' : '' }}" data-menu="dropdown">
                <a class="dropdown-toggle nav-link d-flex align-items-center" href="{{ route('types.index') }}"
                    data-toggle="dropdown"><i class="ft-home"></i>
                    <span data-i18n="Dashboard">Types</span>
                </a>
            </li>

            <!-- Access Control -->
            <li class="dropdown nav-item {{ Request::is('roles*') || Request::is('users*') ? 'active' : '' }}" data-menu="dropdown">
                <a class="dropdown-toggle nav-link d-flex align-items-center" href="javascript:;"
                    data-toggle="dropdown"><i class="ft-box"></i>
                    <span data-i18n="Apps">Access Control</span>
                </a>
                <ul class="dropdown-menu">
                    <li data-menu="">
                        <a class="dropdown-item d-flex align-items-center {{ Route::is('roles.index') ? 'active' : '' }}"
                            href="{{ route('roles.index') }}" data-toggle="dropdown">
                            <i class="ft-arrow-right submenu-icon"></i>
                            <span data-i18n="Email">Manage Roles & Permission</span>
                        </a>
                    </li>
                    <li data-menu="">
                        <a class="dropdown-item d-flex align-items-center {{ Route::is('users.index') ? 'active' : '' }}"
                            href="{{ route('users.index') }}" data-toggle="dropdown">
                            <i class="ft-arrow-right submenu-icon"></i>
                            <span data-i18n="Chat">Manage Users</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
