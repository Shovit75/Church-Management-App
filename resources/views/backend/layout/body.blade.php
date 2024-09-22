@include('backend.layout.header')

@if(Auth::check())
    @include('backend.layout.sidebar')
@else
    @yield('content')
@endif

@include('backend.layout.footer')