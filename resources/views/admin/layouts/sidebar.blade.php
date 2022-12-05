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
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Panel</div>
            </a>
            <ul>
                <li> <a href="{{route('panel.index')}}"><i class="bi bi-circle"></i>Dashboard</a>
                </li>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>
                <li> <a href="#"><i class="bi bi-circle"></i>Users</a></li>
                <li> <a href="{{route('admin.role.index')}}"><i class="bi bi-circle"></i>Roles</a></li>
                <li> <a href="{{route('admin.permissions.index')}}"><i class="bi bi-circle"></i>Permissions</a></li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Language Management</div>
            </a>
            <ul>
                <li> <a href="#"><i class="bi bi-circle"></i>Language List</a>
                </li>
                <li> <a href="#"><i class="bi bi-circle"></i>Language Add</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Modüller</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-basket2-fill"></i>
                </div>
                <div class="menu-title">Menü Yönetimi</div>
            </a>
            <ul>
                <li> <a href="#"><i class="bi bi-circle"></i>Menus</a>
            </ul>
        </li>



    </ul>
    <!--end navigation-->
</aside>
