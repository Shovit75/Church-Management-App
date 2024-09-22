@extends('frontend.layout.body')

@section('content')

<div class="bg-color min-vh-89">
<div class="text-center pt-5 pb-4">
    <h2>All <span class="primarycolor">Donations</span> Frontend</h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        @foreach($donations as $p)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <a href="#{{$p->id}}" class="text-decoration-none text-dark">
                        <div class="card-body text-center">
                            <h5>{{ $p->name }}</h5>
                            <div class="py-3">
                            <a class="btn btn-success" href="{{$p->url}}">Click to donate</a>
                            </div>
                            <p> Contact - {{ $p->phone }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>

@endsection