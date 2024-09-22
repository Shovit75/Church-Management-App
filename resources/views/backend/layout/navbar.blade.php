<nav class="navbar navbar-expand-lg bg-dark rounded-bottom-right">
  <div class="container-fluid">
    <div class="collapse navbar-collapse">
      <div class="me-auto"></div>
      <div>
      <ul class="navbar-nav d-flex align-items-center mb-2 mb-lg-0">
        <!-- Username or Guest -->
        <li class="nav-item">
            <a href="{{ route('profile.index') }}" class="nav-link textwhite">
            Admin:
            @if(Auth::check())
            <span class="primarycolor">{{ Auth::User()->name }}</span>
            @else
            <span class="primarycolor">Guest</span>
            @endif
            </a>
        </li>
        <!-- User Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle textwhite" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if(Auth::user()->profileImage && Auth::user()->profileImage->path)
            <img class="rounded-circle" src="{{asset('/storage/profilepictures/' . Auth::user()->profileimage->path)}}" alt="Barbarian" width="50" height="50">
            @else
            <img class="rounded-circle" src="{{ asset('default.jpg') }}" alt="" width="50" height="50">
            @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
            <li>
                @if(Auth::check())
                    <a class="dropdown-item" href="{{ route('backend.logout') }}">Logout</a>
                @endif
            </li>
            </ul>
        </li>
      </ul>
      </div>
    </div>
  </div>
</nav>