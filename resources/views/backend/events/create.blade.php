@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Create Event</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('events.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>

@endsection
