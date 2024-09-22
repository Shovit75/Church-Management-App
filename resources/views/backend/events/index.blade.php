@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <div class="row">
            <div class="col">
                <h2>Events Table</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('events.create') }}" class="btn btn-secondary">Create Event</a>
            </div>
        </div>
    </div>

    <div class="px-3 table-responsive">
        <table class="table table-bordered caption-top">
        <caption>List of Events</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="text-center">Participants Count</th>
                    <th scope="col" class="text-center">Image</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($event as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->description}}</td>
                    <td class="text-center">
                    @if(is_array($u->participants) && count($u->participants) > 0)
                        {{count($u->participants)}}
                    @else
                        No Participants
                    @endif
                    </td>
                    <td class="text-center">
                        <img src="{{ asset('storage/events/' . $u->image) }}" alt="" width=70 height=70>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('events.allparticipants', ['id' => $u->id]) }}" class="btn btn-secondary">Manage Participants</a>
                        <a href="{{ route('events.edit', ['id' => $u->id]) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('events.delete', ['id' => $u->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
