@extends('backend.layout.body')

@section('content')

    <div class="px-3 py-3">
        <h2>Edit Webuser</h2>
    </div>

    <div class="px-3">
        <form method="POST" action="{{route('webusers.update', ['id' => $webuser->id])}}">
        @method('PATCH')
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{$webuser->name}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{$webuser->email}}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
@endsection
