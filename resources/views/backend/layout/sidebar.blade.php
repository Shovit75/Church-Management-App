<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-0 bg-dark rounded-bottom-right">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-90">
                <a href="{{route('backend.home')}}" class="d-flex align-items-center pt-4 pb-2 mb-md-0 me-md-auto text-white text-decoration-none">
                    <h4 class="d-none d-sm-inline">CMS <span class="primarycolor">Church</span> Panel</h4>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                    <li class="nav-item">
                        <a href="{{route('backend.home')}}" class="nav-link align-middle px-0 mt-1 textwhite">
                            <i class="bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    @role('Superadmin')
                    <li>
                        <a href="{{route('users.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-person"></i>
                        <span class="ms-1 d-none d-sm-inline">Admin Users</span></a>
                    </li>
                    @endrole
                    <li>
                        <a href="{{route('webusers.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-people"></i>
                        <span class="ms-1 d-none d-sm-inline">Web Users</span></a>
                    </li>
                    <li>
                        <a href="{{route('categories.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-list-ul"></i>
                        <span class="ms-1 d-none d-sm-inline">Categories</span></a>
                    </li>
                    <li>
                        <a href="#submenu" data-bs-toggle="collapse" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-journal-text"></i>
                        <span class="ms-1 d-none d-sm-inline">Posts</span></a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu">
                            <li class="w-100">
                                <a href="{{route('posts.index')}}" class="nav-link px-0 px-lg-2 textwhite">
                                <i class="bi bi-file-earmark-text"></i>
                                <span class="d-none d-sm-inline px-0 px-lg-1">Web Users Posts</span></a>
                            </li>
                            @role('Superadmin')
                            <li>
                                <a href="{{route('postsadmin.index')}}" class="nav-link px-0 px-lg-2 textwhite"> 
                                <i class="bi bi-file-earmark-text"></i>
                                <span class="d-none d-sm-inline px-0 px-lg-1">Admin Users Posts</span></a>
                            </li>
                            @endrole
                            <li>
                                <a href="{{route('postsauth.index')}}" class="nav-link px-0 px-lg-2 textwhite"> 
                                <i class="bi bi-file-earmark-text"></i>
                                <span class="d-none d-sm-inline px-0 px-lg-1">Auth Admin's Posts</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('events.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-calendar-plus"></i>
                        <span class="ms-1 d-none d-sm-inline">Events</span></a>
                    </li>
                    <li>
                        <a href="{{route('donations.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-gift"></i>
                        <span class="ms-1 d-none d-sm-inline">Donations</span></a>
                    </li>
                    <li>
                        <a href="{{route('prayers.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-moon-stars"></i>
                        <span class="ms-1 d-none d-sm-inline">Polymorphic Prays</span></a>
                    </li>
                    <li>
                        <a href="{{route('profileimages.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-image"></i>
                        <span class="ms-1 d-none d-sm-inline">Polymorphic Images</span></a>
                    </li>
                    @role('Superadmin')
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-shield-check"></i>
                        <span class="ms-1 d-none d-sm-inline">Roles and Permissions</span></a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu2">
                            <li class="w-100">
                                <a href="{{route('roles.index')}}" class="nav-link px-0 px-lg-2 textwhite">
                                <i class="bi bi-lock"></i>
                                <span class="d-none d-sm-inline px-0 px-lg-1">Roles</span></a>
                            </li>
                            <li>
                                <a href="{{route('permissions.index')}}" class="nav-link px-0 px-lg-2 textwhite"> 
                                <i class="bi bi-key"></i>
                                <span class="d-none d-sm-inline px-0 px-lg-1">Permissions</span></a>
                            </li>
                            <li>
                                <a href="{{route('assign.index')}}" class="nav-link px-0 px-lg-2 textwhite"> 
                                <i class="bi bi-person-check"></i>
                                <span class="d-none d-sm-inline px-0 px-lg-1">Assign Admin Users</span></a>
                            </li>
                        </ul>
                    </li>
                    @endrole
                    <li>
                        <a href="{{route('profile.index')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-person-badge"></i>
                        <span class="ms-1 d-none d-sm-inline">Auth Admin's Profile</span></a>
                    </li>
                    <li>
                        <a href="{{route('backend.logout')}}" class="nav-link px-0 align-middle textwhite">
                        <i class="bi bi-door-open"></i>
                        <span class="ms-1 d-none d-sm-inline">Logout Admin</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col p-0 bg-color">
            @include('backend.layout.navbar')
            @yield('content')
        </div>
    </div>
</div>
