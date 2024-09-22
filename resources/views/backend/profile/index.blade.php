@extends('backend.layout.body')

@section('content')
<div class="px-3 pt-3">
    <h2>Profile Section</h2>
</div>

<div class="py-5 my-4">
    <div class="container px-3 text-center py-3 my-5">
        @if(Auth::user()->profileImage)
        <div class="pb-3">
        <img class="rounded-circle" src="{{ asset('storage/profilepictures/' . $user->profileImage->path) }}" alt="" width="150" height="150">
        </div>
        @endif
        <h5><span class="primarycolor">Name</span> - {{$user->name}}</h5>
        <h5><span class="primarycolor">Email</span> - {{$user->email}}</h5>
        <h5><span class="primarycolor">Role</span> -
        @foreach($user->roles as $role)
            {{ $role->name }}
        @endforeach
        </h5>
    </div>
</div>
@endsection
