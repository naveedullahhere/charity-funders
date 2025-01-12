        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-shadow menu-border navbar-brand-center"
            role="navigation" data-menu="menu-wrapper">
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content center-layout" data-menu="menu-container">
                <!-- include ../../../includes/mixins-->
                <ul class="navigation-main nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="nav-item" data-menu="dropdown">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="javascript:;"
                            data-toggle="dropdown"><i class="ft-home"></i><span
                                data-i18n="Dashboard">Dashboard</span></a>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown"><a
                            class="dropdown-toggle nav-link d-flex align-items-center" href="javascript:;"
                            data-toggle="dropdown"><i class="ft-aperture"></i><span
                                data-i18n="UI Kit">Arrival</span></a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="grids.html"
                                    data-toggle="dropdown"><i class="ft-arrow-right submenu-icon"></i><span
                                        data-i18n="Grid">Grid</span></a>
                            </li>
                            <li class="has-sub dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item d-flex align-items-center dropdown-toggle" href="javascript:;"
                                    data-toggle="dropdown"><i class="ft-arrow-right submenu-icon"></i><span
                                        data-i18n="Icons">Icons</span></a>
                                <ul class="dropdown-menu">
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="icons-feather.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Feather Icon">Feather Icon</span></a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="icons-font-awesome.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Font Awesome Icon">Font Awesome Icon</span></a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="icons-simple-line.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Simple Line Icon">Simple Line Icon</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown"><a
                            class="dropdown-toggle nav-link d-flex align-items-center" href="javascript:;"
                            data-toggle="dropdown"><i class="ft-box"></i><span data-i18n="Apps">Access
                                Control</span></a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('roles.index') }}" data-toggle="dropdown"><i
                                        class="ft-arrow-right submenu-icon"></i><span data-i18n="Email">Manage Roles &
                                        Permission</span></a>
                            </li>
                             <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('company.index') }}" data-toggle="dropdown"><i
                                        class="ft-arrow-right submenu-icon"></i><span data-i18n="Email">Manage Company</span></a>
                            </li>
                            <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('users.index') }}" data-toggle="dropdown"><i
                                        class="ft-arrow-right submenu-icon"></i><span data-i18n="Chat">Manage
                                        Users</span></a>
                            </li>
                            <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                    href="app-taskboard.html" data-toggle="dropdown"><i
                                        class="ft-arrow-right submenu-icon"></i>
                                    <span data-i18n="Task Board">Manage Menu</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item" data-menu="dropdown"><a
                            class="dropdown-toggle nav-link d-flex align-items-center" href="javascript:;"
                            data-toggle="dropdown"><i class="ft-grid"></i><span data-i18n="Tables">Master
                                Control</span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item d-flex align-items-center dropdown-toggle" href="javascript:;"
                                    data-toggle="dropdown"><i class="ft-arrow-right submenu-icon"></i><span
                                        data-i18n="Bootstrap Tables">Bootstrap Tables</span></a>
                                <ul class="dropdown-menu">
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="table-basic.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Basic">Basic</span></a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="table-extended.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Extended">Extended</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item d-flex align-items-center dropdown-toggle"
                                    href="javascript:;" data-toggle="dropdown"><i
                                        class="ft-arrow-right submenu-icon"></i><span
                                        data-i18n="DataTables">DataTables</span></a>
                                <ul class="dropdown-menu">
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="dt-basic-initialization.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Basic Initialization">Basic Initialization</span></a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="dt-advanced-initialization.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Advanced Initialization">Advanced Initialization</span></a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="dt-data-sources.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="Data Sources">Data Sources</span></a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item d-flex align-items-center"
                                            href="dt-api.html" data-toggle="dropdown"><i
                                                class="ft-arrow-right submenu-icon"></i><span
                                                data-i18n="API">API</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
