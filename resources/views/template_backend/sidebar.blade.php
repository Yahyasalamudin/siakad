@php
    use App\Role;
    use App\UserMenu;

    $user_menu = UserMenu::with('role')
        ->whereHas('role', function ($query) {
            return $query->where('role', auth()->user()->role);
        })
        ->get();
        // dd($user_menu->pluck('title'))
    // $user_menu = Role::with('menu')
    //     ->where('role', auth()->user()->role)
    //     ->get();
    // dd($user_menu);
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="">
        <img src="{{ asset('img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">SM - SMK MULU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                    @foreach ($user_menu as $menu)
                        @if ($menu->route == null)
                            <li class="nav-item has-treeview 
                            {{ $menu->sub_menu->contains(function ($sub_menu) {
                                return Route::is($sub_menu->route);
                            })
                                ? 'menu-open'
                                : '' }}"
                                id="{{ 'li' . $menu->title }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon {{ $menu->icon }}"></i>
                                    <p>
                                        {{ $menu->title }}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview ml-4">
                                    @foreach ($menu->sub_menu->filter(function ($subMenu) use ($user_menu) {
                                        return $user_menu->pluck('id')->contains($subMenu->id);
                                    }) as $sub_menu)
                                        <li class="nav-item">
                                            <a href="{{ route($sub_menu->route, $sub_menu->route_param ? $sub_menu->route_param : '') }}"
                                                class="nav-link {{ Route::is($sub_menu->route) && Request::route('role') == $sub_menu->route_param ? 'active' : '' }}">
                                                <i class="{{ $sub_menu->icon }} nav-icon"></i>
                                                <p>{{ $sub_menu->title }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @elseif($menu->menu_id == null && $menu->route)
                            <li class="nav-item">
                                <a href="{{ route($menu->route) }}"
                                    class="nav-link {{ Route::is($menu->route) && Request::route('role') == $menu->route_param ? 'active' : '' }}">
                                    <i class="{{ $menu->icon }} nav-icon"></i>
                                    <p>{{ $menu->title }}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
