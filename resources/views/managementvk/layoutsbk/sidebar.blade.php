<div class="fixed-side-absolute text-center">
    <div>
        <a href="{{url('/')}}"><img src="{{asset('assets/images/logo.png')}}"></a>
    </div>
    <ul class="sidebar-icons">
        <li class="tooltip">
            <a href="{{url('/')}}"><img src="{{asset('assets/images/icons/home.png')}}"></a>
            <span class="tooltiptext">Dashboard</span>
        </li>
        @canany('lead')
        <li class="tooltip">
            <a  onclick="openNav('leads')" ><img src="{{asset('assets/images/icons/02.png')}}"></a>
            <span class="tooltiptext">Leads</span>
        </li>
        @endcanany
        @canany('contact')
        <li class="tooltip">
            <a onclick="openNav('contact')"><img src="{{asset('assets/images/icons/03.png')}}"></a>
            <span class="tooltiptext">Contacts</span>
        </li>
        @endcanany
        @canany('company')
            <li class="tooltip">
                <a onclick="openNav('company')"><img src="{{asset('assets/images/icons/04.png')}}"></a>
                <span class="tooltiptext">Company</span>
            </li>
        @endcanany
        <li class="tooltip">
            <a onclick="openNav('product')"><img src="{{asset('assets/images/icons/04.png')}}"></a>
            <span class="tooltiptext">Product</span>
        </li>
                <li class="tooltip">
                    <a href="{{url('/business-profile')}}"><img src="{{asset('assets/images/icons/05.png')}}"></a>
                    <span class="tooltiptext">Business Profile</span>
                </li>
        {{--        <li class="tooltip">--}}
        {{--            <a href="#"><img src="assets/images/icons/06.png"></a>--}}
        {{--            <span class="tooltiptext">Dashboard</span>--}}
        {{--        </li>--}}
        {{--        <li class="tooltip">--}}
        {{--            <a href="#"><img src="assets/images/icons/chat.png"></a>--}}
        {{--            <span class="tooltiptext">Dashboard</span>--}}
        {{--        </li>--}}
        @canany('user')
            <li class="tooltip">
                <a  onclick="openNav('user')" ><img src="{{asset('assets/images/icons/settings_account_box.png')}}"></a>
                <span  class="tooltiptext">Users & Roles</span>
            </li>
        @endcanany
        {{--        <li class="tooltip">--}}
        {{--            <a onclick="openNav('setting')" ><img src="{{asset('assets/images/icons/settings.png')}}"></a>--}}
        {{--            <span class="tooltiptext">Setting</span>--}}
        {{--        </li>--}}
        {{--        <li class="tooltip">--}}
        {{--            <a href="#"><img src="assets/images/icons/page_info.png"></a>--}}
        {{--            <span class="tooltiptext">Dashboard</span>--}}
        {{--        </li>--}}

        <li class="tooltip">
            <a href="#"><img src="{{asset('assets/images/icons/select_window.png')}}"></a>
            <span class="tooltiptext">Dashboard</span>
        </li>
        <li class="tooltip">
            <a href="#"><img src="{{asset('assets/images/icons/youtube_activity.png')}}"></a>
            <span class="tooltiptext">Dashboard</span>
        </li>
    </ul>
</div>

<div id="mySidenavsetting" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav('setting')">&times;</a>
    <a href="{{url('/leads')}}">Leads Tags</a>
    <a href="{{url('/leads')}}">Leads Source</a>
    <a href="{{url('/leads')}}">Leads Stages</a>
    <a href="{{url('/leads')}}">Contact Type</a>
</div>
<div id="mySidenavcontact" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav('contact')">&times;</a>
    <div class="clearfix"></div>
    <ul>
        <li class="menu-items">
            <a class="text-white menu-items-link">
                Contacts <span class="material-symbols-outlined">expand_more</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item"> <a href="{{url('/contact')}}">Contacts </a></li>
                <li class="submenu-item"> <a href="{{url('/department')}}">Departments</a></li>
            </ul>
        </li>
    </ul>
</div>
<div id="mySidenavproduct" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav('product')">&times;</a>
    <div class="clearfix"></div>
    <ul>
        <li class="menu-items">
            <a class="text-white menu-items-link">
                Products <span class="material-symbols-outlined">expand_more</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item"> <a href="{{url('/product')}}">Products </a></li>
            </ul>
        </li>
    </ul>
</div>

<div id="mySidenavleads" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav('leads')">&times;</a>

    <div class="clearfix"></div>
    <ul>
        <li class="menu-items">
            <a class="text-white menu-items-link">
                Leads <span class="material-symbols-outlined">expand_more</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item"> <a href="{{url('/leads')}}">Leads List</a></li>
                <li class="submenu-item"> <a href="{{url('/leads-kanban-view')}}">Leads kanban View</a></li>
                {{--                <li class="submenu-item"> <a href="{{url('/leads')}}">Leads Tags</a></li>--}}
                <li class="submenu-item"> <a href="{{url('/leads-stage')}}">Leads Stages</a></li>
                {{--                <li class="submenu-item"> <a href="{{url('/leads')}}">Leads Source</a></li>--}}

            </ul>
        </li>
    </ul>
</div>


<div id="mySidenavcompany" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav('company')">&times;</a>
    <div class="clearfix"></div>
    <ul>
        <li class="menu-items">
            <a class="text-white menu-items-link">
                Company <span class="material-symbols-outlined">expand_more</span>
            </a>
            <ul class="submenu">
                <li class="submenu-item"> <a href="{{url('/company')}}">Company </a></li>
                <li class="submenu-item"> <a href="{{url('/company-category')}}">Category</a></li>
            </ul>
        </li>
    </ul>
    {{--    @can('company')--}}
    {{--        <a href="{{url('/company')}}">Company</a>--}}
    {{--    @endcan--}}
    {{--    <a href="{{url('/company-category')}}">Category</a>--}}

</div>
<div id="mySidenavuser" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav('user')">&times;</a>
    @can('user')
        <a href="{{url('/users')}}">Users</a>
    @endcan
    <a href="{{url('/roles')}}">Roles & Permission</a>
</div>
{{--<div id="main"></div>--}}
