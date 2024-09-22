@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Permissions Table</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('permissions.create') }}" class="btn btn-secondary">Create Permission</a>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of Permissions</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Guard</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($permissions as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->guard_name}}</td>
                    <td>
                        <a href="{{ route('permissions.edit', ['id' => $u->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('permissions.delete', ['id' => $u->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
