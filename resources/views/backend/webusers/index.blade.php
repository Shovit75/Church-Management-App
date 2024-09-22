@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Webusers Table</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('webusers.create') }}" class="btn btn-secondary">Create Webuser</a>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of Webusers</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($webusers as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>
                        <a href="{{ route('webusers.edit', ['id' => $u->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('webusers.delete', ['id' => $u->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
