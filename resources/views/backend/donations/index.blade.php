@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Donations Table</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('donations.create') }}" class="btn btn-secondary">Create Donation</a>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of Donations</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">URL</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($donate as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->url}}</td>
                    <td>{{$u->phone}}</td>
                    <td>
                        <a href="{{ route('donations.edit', ['id' => $u->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('donations.delete', ['id' => $u->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
