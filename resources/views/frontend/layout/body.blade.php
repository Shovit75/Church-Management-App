@include('frontend.layout.header')

@if(Auth::guard('webuser')->check())
    @include('frontend.layout.navbar')
@endif

@yield('content')

@include('frontend.layout.footer')