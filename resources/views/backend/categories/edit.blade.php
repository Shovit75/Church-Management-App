@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Edit Categories</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('categories.update', ['slug' => $cat->slug])}}">
        @method('PATCH')
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{$cat->name}}">
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
@endsection
