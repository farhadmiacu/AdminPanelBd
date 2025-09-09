<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu"></div>

        <ul class="navbar-nav" id="navbar-nav">

            {{-- Menu start --}}
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>

            {{-- Category Menu --}}
            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->routeIs('admin.categories.*') ? '' : 'collapsed' }}"
                   href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs('admin.categories.*') ? 'true' : 'false' }}"
                   aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Category</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs('admin.categories.*') ? 'show' : '' }}" id="sidebarDashboards">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.create') }}" class="nav-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}" data-key="t-analytics">
                                Category Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" data-key="t-crm">
                                Categories
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Brand Menu --}}
            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->routeIs('admin.brands.*') ? '' : 'collapsed' }}"
                   href="#sidebarBrand" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs('admin.brands.*') ? 'true' : 'false' }}"
                   aria-controls="sidebarBrand">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Brand</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs('admin.brands.*') ? 'show' : '' }}" id="sidebarBrand">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.brands.create') }}" class="nav-link {{ request()->routeIs('admin.brands.create') ? 'active' : '' }}" data-key="t-analytics">
                                Brand Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.brands.index') }}" class="nav-link {{ request()->routeIs('admin.brands.index') ? 'active' : '' }}" data-key="t-crm">
                                Brands
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Product Menu --}}
            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->routeIs('admin.products.*') ? '' : 'collapsed' }}"
                   href="#sidebarProduct" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs('admin.products.*') ? 'true' : 'false' }}"
                   aria-controls="sidebarProduct">
                    <i class="ri-store-2-line"></i> <span data-key="t-products">Product</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs('admin.products.*') ? 'show' : '' }}" id="sidebarProduct">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}" data-key="t-create">
                                Product Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" data-key="t-list">
                                Products
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Settings start --}}
            <li class="menu-title"><span data-key="t-menu">Settings</span></li>

            {{-- Role Menu --}}
            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->routeIs('admin.roles.*') ? '' : 'collapsed' }}"
                   href="#sidebarRole" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs('admin.roles.*') ? 'true' : 'false' }}"
                   aria-controls="sidebarRole">
                    <i class="ri-store-2-line"></i> <span data-key="t-products">Role</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs('admin.roles.*') ? 'show' : '' }}" id="sidebarRole">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.create') }}" class="nav-link {{ request()->routeIs('admin.roles.create') ? 'active' : '' }}" data-key="t-create">
                                Role Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}" data-key="t-list">
                                Roles
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- User Menu --}}
            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->routeIs('admin.users.*') ? '' : 'collapsed' }}"
                   href="#sidebarUser" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}"
                   aria-controls="sidebarUser">
                    <i class="ri-store-2-line"></i> <span data-key="t-products">User</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="sidebarUser">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.create') }}" class="nav-link {{ request()->routeIs('admin.users.create') ? 'active' : '' }}" data-key="t-create">
                                User Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" data-key="t-list">
                                Users
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- System Settings --}}
            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->routeIs('admin.system-settings.*') ? '' : 'collapsed' }}"
                   href="#sidebarSetting" data-bs-toggle="collapse" role="button"
                   aria-expanded="{{ request()->routeIs('admin.system-settings.*') ? 'true' : 'false' }}"
                   aria-controls="sidebarSetting">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">System Settings</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->routeIs('admin.system-settings.*') ? 'show' : '' }}" id="sidebarSetting">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.system-settings.edit') }}" class="nav-link {{ request()->routeIs('admin.system-settings.edit') ? 'active' : '' }}" data-key="t-analytics">
                                System Setting
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
<div class="sidebar-background"></div>

