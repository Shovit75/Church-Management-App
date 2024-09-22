@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Create Permission</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('permissions.store')}}">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>

@endsection
