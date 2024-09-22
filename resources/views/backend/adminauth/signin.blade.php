@extends('backend.layout.body')

@section('content')
<div class="text-center py-5">
    <h1 class="pb-4">Login Page</h1>
    <form method="post" action="{{route('backend.loginuser')}}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <br>
    <a href="{{route('index.homepage')}}">Go to Home</a>
    <br><br>
    <a href="{{route('backend.signup')}}">Go to register page</a>
</div>
@endsection