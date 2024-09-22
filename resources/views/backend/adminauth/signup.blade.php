@extends('backend.layout.body')

@section('content')
<div class="text-center py-5">
    <h1 class="pb-4">Register Page</h1>
    <form method="POST" action="{{route('backend.registeruser')}}" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <br><br>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <br><br>
        <label for="image">Image</label>
        <input type="file" name="image" required>
        <br><br>
        <button type="submit">Register</button>
    </form>
    <br>
    <a href="{{route('index.homepage')}}">Go to Home</a>
    <br><br>
    <a href="{{route('backend.signin')}}">Go to login page</a>
</div>

@endsection