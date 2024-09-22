@extends('backend.layout.body')

@section('content')

    <div class="container px-3 pt-3">
        <h2>Prayers Table</h2>
    </div>

    <div class="px-3 table-responsive text-center">
        <table class="table table-bordered caption-top">
        <caption>List of prayers</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Prayer Count</th>
                    <th scope="col">Prayed Users</th>
                    <th scope="col">Prayable_type</th>
                    <th scope="col">Prayable_id</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($prayers as $u)
                <tr>
                    <td>
                        {{$u->prayercount}}
                    </td>
                    <td>
                    @foreach($u->prayedusers as $p)
                    {{$p}}, 
                    @endforeach
                    </td>
                    <td>{{$u->prayable_type}}</td>
                    <td>{{$u->prayable_id}}</td>
                    <td>
                        <a href="{{ route('prayers.delete', ['id' => $u->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
