@extends('backend.layout.body')

@section('content')

<div class="text-center py-5">
    @if (session('success'))
        <div class="alert alert-success mx-5">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mx-5">
            {{ session('error') }}
        </div>
    @endif
    <a href="{{ route('dbseed') }}" class="btn btn-success">Seed Database</a>
    <br><br>
    <a href="{{route('backend.signin')}}">Go to login page</a>
    <br><br>
    <a href="{{route('backend.signup')}}">Go to register page</a>
</div>

@endsection