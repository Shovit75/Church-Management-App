@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Create Event</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('donations.store')}}">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" name="url">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" name="phone">
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>

@endsection
