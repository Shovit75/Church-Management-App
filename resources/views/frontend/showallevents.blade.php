@extends('frontend.layout.body')

@section('content')

<div class="bg-color min-vh-89">

<div class="text-center pt-5 pb-4">
    <h2>All <span class="primarycolor">Events</span> Frontend</h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        @foreach($events as $p)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <a href="#{{$p->id}}" class="text-decoration-none text-dark">
                    <img src="{{ asset('storage/events/' . $p->image) }}" class="card-img-top" alt="{{ $p->name }}" height="280">
                        <div class="card-body text-center">
                            <h5 class="text-center">{{ $p->name }}</h5>
                            <p>Total Participants - {{ is_array($p->participants) ? count($p->participants) : 0 }}</p>
                            @if(Auth::guard('webuser')->check())
                            <a href="{{ route('frontend.participate' , [ 'id' => $p->id ]) }}" class="btn btn-success mt-2" >
                                <i class="bi bi-flag"></i>
                                <span class="px-1">Participate</span>
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