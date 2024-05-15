<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">

        {{-- @foreach ($modules as $module)
        <li class="menu-title">{{ $module->module_name }}</li>
            @foreach ($module->menuitem as $menu)
            <li>
                @if (Route::has($menu->route))
                    <a href="{{ route($menu->route) }}" class="waves-effect {{setSidebarActive([$menu->route .'.*'])}}">
                        <i class="{{ $menu->icon }}"></i>
                        <span>{{ $menu->menu_name }}</span>
                    </a>
                @else
                    <a href="javascript: void(0);" class="{{ empty(Route::has($menu->route)) ? 'has-arrow' : '' }} waves-effect
                        {{setSidebarActive([$menu->route .'.*',])}}">
                        <i class="{{ $menu->icon }}"></i>
                        <span>{{ $menu->menu_name }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach ($menu->submenu as $submenu)
                        
                            @if (Route::has($submenu->route))
                                <li class="{{ setSidebarActive([$submenu->route . '.*']) }}">
                                    <a href="{{ route($submenu->route) }}">{{ $submenu->sub_name }}</a>
                                </li>
                            @else
                                <li>
                                    <a href="javascript: void(0);" onclick="showErrorAlert()">{{ $submenu->sub_name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
      
        @endforeach --}}

        <li class="menu-title">Menu</li>
        <li>
            <a href="{{ route('account.dashboard') }}"
                class="waves-effect {{setSidebarActive(['account.dashboard.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-title">Tes</li>
        <li>
            <a href="{{ route('account.mapel.index') }}"
                class="waves-effect {{setSidebarActive(['account.mapel.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Mapel</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.eskul.index') }}"
                class="waves-effect {{setSidebarActive(['account.eskul.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Eskul</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.murid.index') }}"
                class="waves-effect {{setSidebarActive(['account.murid.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Murid</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.kelas.index') }}"
                class="waves-effect {{setSidebarActive(['account.kelas.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Kelas</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.daftar.index') }}"
                class="waves-effect {{setSidebarActive(['account.daftar.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Daftar Kelas</span>
            </a>
        </li>
        @role(['superadmin'])
        <li class="menu-title">Developer</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-store-2-line"></i>
                <span>Roles Access</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="{{setSidebarActive(['account.user.*'])}}">
                    <a href="{{ route('account.user.index') }}">User</a>
                </li>
                <li class="{{setSidebarActive(['account.permission.*'])}}">
                    <a href="{{ route('account.permission.index') }}">Permission</a>
                </li>
                <li class="{{setSidebarActive(['account.role.*'])}}">
                    <a href="{{ route('account.role.index') }}">Role</a>
                </li>
            </ul>
        </li>
        @endrole
        {{-- <li>
            <a href="{{ route('account.module.index') }}"
                class=" waves-effect {{setSidebarActive(['account.module.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Module</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.menu-item.index') }}"
                class=" waves-effect {{setSidebarActive(['account.menu-item.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Menu Item</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.sub-menu.index') }}"
                class=" waves-effect {{setSidebarActive(['account.sub-menu.*'])}}">
                <i class="ri-dashboard-line"></i>
                <span>Sub Menu</span>
            </a>
        </li> --}}
       
    </ul>
</div>