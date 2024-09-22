@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Edit Profile Image</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('profileimages.update', ['id' => $profileimage->id])}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Edit Image</label>
                <input type="file" class="form-control" name="image">
                <br>
                <img src="{{ asset('storage/profilepictures/' . $profileimage->path) }}" width=200 height=200>
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
@endsection
