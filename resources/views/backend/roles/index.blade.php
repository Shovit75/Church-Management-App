@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Roles Table</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('roles.create') }}" class="btn btn-secondary">Create Roles</a>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of Roles</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Permissions Assigned</th>
                    <th scope="col">Guard</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>
                    @if($u->permissions->isEmpty())
                        No permissions assigned
                    @else
                        <ul>
                            @foreach($u->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                    </td>
                    <td>{{$u->guard_name}}</td>
                    <td>
                        <a href="{{ route('roles.edit', ['id' => $u->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('roles.delete', ['id' => $u->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
