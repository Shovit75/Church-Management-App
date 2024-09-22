@extends('frontend.layout.body')

@section('content')
    <div class="text-center">
        <h1 class="mt-5">Login <span class="primarycolor">Page</span></h1>
        <div class="py-4">
        <form method="post" action="{{route('frontend.loginuser')}}">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" required>
            <br><br>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <br><br>
            <button type="submit">Login</button>
        </form>
        </div>
        <a href="{{route('frontend.signup')}}">Go to register page</a>
    </div>
@endsection