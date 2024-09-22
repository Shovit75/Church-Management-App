@extends('frontend.layout.body')

@section('content')

<div class="px-2 py-5 text-center bg-color">
    <h1>
        Profile <span class="primarycolor">Page</span>
    </h1>
    <div class="py-3">
        <h5>Name - {{$user->name}}</h5>
        <p>Email - {{$user->email}}</p>
        <h1 class="my-4"><span class="primarycolor">User</span> Uploads</h1>
        <div class="row justify-content-center g-3">
            @foreach($user->posts as $p)
            <div class="col-md-3 d-flex align-items-stretch mb-4">
                <div class="card shadow-sm" style="width: 100%;">
                    <img src="{{ asset('storage/images/' . $p->image) }}" class="card-img-top" alt="{{ $p->title }}" style="object-fit: stretch; height: 250px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $p->title }}</h5>
                        <p class="card-text">{{ $p->description }}</p>
                        <a href="#{{$p->slug}}" class="btn btn-success mt-auto">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</div>

@endsection