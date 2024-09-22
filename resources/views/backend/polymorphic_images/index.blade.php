@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <h2>Profile Images Table</h2>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of profile images</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Imageable_type</th>
                    <th scope="col">Imageable_id</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($profileimages as $u)
                <tr>
                    <td class="text-center">
                    <img src="{{ asset('storage/profilepictures/' . $u->path) }}" alt="" width=70 height=70>
                    </td>
                    <td>{{$u->imageable_type}}</td>
                    <td>{{$u->imageable_id}}</td>
                    <td>
                        <a href="{{ route('profileimages.edit', ['id' => $u->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('profileimages.delete', ['id' => $u->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
