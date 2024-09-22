@extends('frontend.layout.body')

@section('content')
<div class="text-center mt-5">
    <h1>Register <span class="primarycolor">Page</span></h1>
    <div class="py-4">
        <form method="POST" action="{{route('frontend.registeruser')}}" enctype="multipart/form-data">
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
    </div>
    <a href="{{route('frontend.signin')}}">Go to login page</a>
</div>

@endsection