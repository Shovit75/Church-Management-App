@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Categories Table</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('categories.create') }}" class="btn btn-secondary">Create Category</a>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of categories</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Slug</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cat as $u)
                <tr>
                    <td>{{$u->slug}}</td>
                    <td>{{$u->name}}</td>
                    <td>
                        <a href="{{ route('categories.edit', ['slug' => $u->slug]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('categories.delete', ['slug' => $u->slug]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
