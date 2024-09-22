@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-4 mt-4 text-center">
        <h2>Welcome to Dashboard</h2>
    </div>

    <div class="row g-0 justify-content-center">
        <!-- Card 1 -->
        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Users Count</h5>
                    <p class="card-text">{{$users}}</p>
                    <a href="{{ route('users.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Webusers Count</h5>
                    <p class="card-text">{{$webusers}}</p>
                    <a href="{{ route('webusers.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Categories Count</h5>
                    <p class="card-text">{{$cat}}</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Admin Posts Count</h5>
                    <p class="card-text">{{$adminposts}}</p>
                    <a href="{{ route('postsadmin.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Webuser Posts Count</h5>
                    <p class="card-text">{{$posts}}</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Prayers Count</h5>
                    <p class="card-text">{{$prayers}}</p>
                    <a href="{{ route('prayers.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Events Count</h5>
                    <p class="card-text">{{$events}}</p>
                    <a href="{{ route('events.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mx-2">
            <div class="card text-center shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Donation Links</h5>
                    <p class="card-text">{{$donation}}</p>
                    <a href="{{ route('donations.index') }}" class="btn btn-success">Navigate</a>
                </div>
            </div>
        </div>
       
    </div>

@endsection
