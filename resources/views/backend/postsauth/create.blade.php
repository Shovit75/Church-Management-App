@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Create Admin Post</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('postsauth.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="video">Video Upload</label>
                <input type="file" class="form-control" name="video">
            </div>
            <div class="mb-3">
                <label for="image">Image Upload</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>

@endsection
