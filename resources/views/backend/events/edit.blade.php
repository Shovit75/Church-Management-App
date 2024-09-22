@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Edit Event</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('events.update', ['id' => $event->id])}}">
        @method('PATCH')
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{$event->name}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <textarea name="description" class="form-control">{{$event->description}}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" name="image">
                <br>
                <img src="{{ asset('storage/events/' . $event->image) }}" alt="" width=100 height=100>
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
@endsection
