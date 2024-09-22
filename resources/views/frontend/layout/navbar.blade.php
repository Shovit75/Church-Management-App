<nav class="navbar navbar-expand-lg bg-dark px-2 rounded-bottom-right">
  <div class="container-fluid">
    <a class="navbar-brand textwhite" href="{{route('frontend.home')}}">Frontend <span class="primarycolor">Church Application</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link text-white" aria-current="page" href="{{route('frontend.home')}}">Homepage</a>
        <a class="nav-link text-white" href="{{route('frontend.admin.posts')}}">AdminPosts</a>
        <a class="nav-link text-white" href="{{route('frontend.posts')}}">WebuserPosts</a>
        <a class="nav-link text-white" href="{{route('frontend.events')}}">Events</a>
        <a class="nav-link text-white" href="{{route('frontend.donations')}}">Donations</a>
        <a class="nav-link text-white" href="{{route('frontend.upload')}}">Upload</a>
      </div>
    </div>
    <div class="collapse navbar-collapse">
      <div class="me-auto"></div>
      <div>
        <ul class="navbar-nav d-flex align-items-center mb-2 mb-lg-0">
          <!-- Username or Guest -->
          <li class="nav-item">
            <a href="{{ route('frontend.profile') }}" class="nav-link text-white">
              User:
              @if(Auth::guard('webuser')->check())
                <span class="primarycolor"> {{ Auth::guard('webuser')->user()->name }} </span>
              @else
                <span class="primarycolor"> Guest </span>
              @endif
            </a>
          </li>
          <!-- User Dropdown -->
          @if(Auth::guard('webuser')->check())
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if(Auth::guard('webuser')->user()->profileImage )
                <img class="rounded-circle" src="{{asset('/storage/profilepictures/' . Auth::guard('webuser')->user()->profileImage->path)}}" alt="User Profile" width="50" height="50">
              @else
                <img class="rounded-circle" src="{{ asset('default.jpg') }}" alt="" width="50" height="50">
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                  <a class="dropdown-item" href="{{ route('frontend.logout') }}">Logout</a>
              </li>
            </ul>
          </li>
          @else
          <li class="nav-item">
            <a class="textwhite btn btn-secondary" href="{{ route('frontend.signin') }}">
            <i class="bi bi-box-arrow-in-right"></i> Login
            </a>  
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</nav>
