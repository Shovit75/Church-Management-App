@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Admin Posts Table</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('postsadmin.create') }}" class="btn btn-secondary">Create Post</a>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of Posts added by all Admins</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">User name</th>
                    <th scope="col">Category name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->description}}</td>
                    <td class="text-center">
                        <img src="{{ asset('storage/admin_images/' . $u->image) }}" alt="" width="70" height="70">
                    </td>
                    <td>{{$u->user->name}}</td>
                    <td>{{$u->category->name}}</td>
                    <td>
                        <a href="{{ route('postsadmin.edit', ['slug' => $u->slug]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('postsadmin.delete', ['slug' => $u->slug]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
