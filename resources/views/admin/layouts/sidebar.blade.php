<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/admin/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Global</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('panel.index')}}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">{{Dashboard}}</div>
            </a>
        </li>
        @can('create user')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">{{User_Management}}</div>
            </a>
            <ul>
                @can('create user')
                <li> <a href="{{route('admin.user.index')}}"><i class="bi bi-circle"></i>{{Users}}</a></li>
                @endcan
                    @can('create roles')
                        <li> <a href="{{route('admin.role.index')}}"><i class="bi bi-circle"></i>{{Roles}}</a></li>
                    @endcan
                    @can('create permission')
                    <li> <a href="{{route('admin.permissions.index')}}"><i class="bi bi-circle"></i>{{Permissions}}</a></li>
                    @endcan
            </ul>
        </li>
        @endcan
        @can('create language')
        <li>
            <a href="{{route('admin.language.index')}}">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">{{Language_Management}}</div>
            </a>
        </li>
        @endcan

        @can('settings')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">{{General_Setting}}</div>
            </a>
            <ul>
                @can('create car brands')
                    <li> <a href="{{route('admin.cbrand.index')}}"><i class="bi bi-circle"></i>{{Car_Brands}}</a></li>
                @endcan
                @can('create car models')
                    <li> <a href="{{route('admin.cmodel.index')}}"><i class="bi bi-circle"></i>{{Car_Models}}</a></li>
                @endcan
                @can('create car brains')
                    <li> <a href="{{route('admin.cbrain.index')}}"><i class="bi bi-circle"></i>{{Car_Brains}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        <li class="menu-label">Modüller</li>



    </ul>
    <!--end navigation-->
</aside>
