@extends('frontend.layout.body')

@section('content')
<div class="bg-color min-vh-89">
    <div class="text-center pt-5 pb-4">
        <h2>All <span class="primarycolor">Admin Posts</span> Frontend</h2>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            @foreach($posts as $p)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-4">
                    <div class="card">
                        <a href="#{{$p->slug}}" class="text-decoration-none text-dark">
                            <img src="{{ asset('storage/admin_images/' . $p->image) }}" class="card-img-top" alt="{{ $p->name }}" height="240">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $p->name }}</h5>
                                @if(Auth::guard('webuser')->check())
                                <a href="{{ route('frontend.admin.pray' , [ 'slug' => $p->slug ]) }}" class="btn btn-success mt-2" >
                                    <i class="bi bi-moon-stars"></i> 
                                    <span class="px-1">Pray</span>
                                </a>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
