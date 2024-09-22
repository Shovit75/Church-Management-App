@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <h2>Assigning Role to Users Table</h2>
    </div>

    <div class="px-3 table-responsive text-center">
        <table class="table table-bordered caption-top">
        <caption>List of Users to be Assigned</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>
                    @foreach($u->roles as $role)
                        {{ $role->name }}
                    @endforeach
                    </td>
                    <td>
                        <a href="{{ route('assign.edit', ['id' => $u->id]) }}" class="btn btn-success">Assign or Edit Role</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
