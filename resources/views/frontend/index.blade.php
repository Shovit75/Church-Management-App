@extends('frontend.layout.body')

@section('content')

<div class="px-2 text-center bg-color">
    <h2 class="pt-4 pb-4">
        All<span class="primarycolor"> Recent Posts</span> using <span class="primarycolor">Union Query</span> Operator
    </h2>
    <div class="row justify-content-center g-3 px-4">
        @foreach($allposts as $p)
            <div class="col-md-2 d-flex align-items-stretch mb-4">
                <div class="card shadow-sm" style="width: 100%;">
                <img src="{{ file_exists(public_path('storage/images/' . $p->image)) ? asset('storage/images/' . $p->image) : asset('storage/admin_images/' . $p->image) }}" class="card-img-top" alt="{{ $p->name }}" style="object-fit: stretch; height: 160px;">
                <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $p->name }}</h5>
                        <p class="card-text">{{ $p->description }}</p>
                        <a href="#{{$p->slug}}" class="btn btn-success mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h2 class="pb-3">
        <span class="primarycolor">Admin</span> Posts
    </h2>
    <div class="row justify-content-center g-0 px-5">
        @foreach($adminposts as $p)
            <div class="col-md-3 d-flex align-items-stretch mb-4 mx-4">
                <div class="card shadow-sm" style="width: 100%;">
                    <img src="{{ asset('storage/admin_images/' . $p->image) }}" class="card-img-top" alt="{{ $p->name }}" style="object-fit: stretch; height: 250px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $p->name }}</h5>
                        <p class="card-text">{{ $p->description }}</p>
                        <a href="#{{$p->slug}}" class="btn btn-success mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h2 class="pb-3">
        Webuser<span class="primarycolor"> Posts</span> 
    </h2>
    <div class="row justify-content-center g-3 px-4">
        @foreach($posts as $p)
            <div class="col-md-3 d-flex align-items-stretch mb-4">
                <div class="card shadow-sm" style="width: 100%;">
                <img src="{{ asset('storage/images/' . $p->image) }}" class="card-img-top" alt="{{ $p->name }}" style="object-fit: stretch; height: 230px;">
                <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $p->name }}</h5>
                        <p class="card-text">{{ $p->description }}</p>
                        <a href="#{{$p->slug}}" class="btn btn-success mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection