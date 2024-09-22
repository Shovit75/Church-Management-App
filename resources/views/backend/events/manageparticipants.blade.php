@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Participants Table</h2>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of Participants</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($participants as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>
                        <a href="{{ route('events.removeparticipant', ['eventid' => $event->id, 'id' => $u->id]) }}" class="btn btn-danger">Remove from the Event</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
